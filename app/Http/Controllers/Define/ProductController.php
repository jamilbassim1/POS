<?php

namespace App\Http\Controllers\Define;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{
    public function defineproduct()
    {
        return view ('define.product');
    }

 public function store(Request $request)
{
    try {

        // =========================
        // VALIDATION
        // =========================
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
            'purchase_rate' => 'required|numeric|min:0',
            'sale_rate' => 'required|numeric|min:0',
            'whole_sale_rate' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $purchase = $request->purchase_rate;
        $sale = $request->sale_rate;
        $wholesale = $request->whole_sale_rate;

        // =========================
        // BUSINESS RULES
        // =========================

        if ($sale <= $purchase) {
            return response()->json([
                'status' => false,
                'message' => 'Sale rate must be greater than purchase rate'
            ], 422);
        }

        if (!is_null($wholesale)) {
            if ($wholesale <= $purchase || $wholesale >= $sale) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wholesale rate must be between purchase and sale rate'
                ], 422);
            }
        }

        // =========================
        // ROI
        // =========================
        $roi = (($sale - $purchase) / $purchase) * 100;

        // =========================
        // ASIN
        // =========================
        $asin = $request->asin;

        if (!$asin) {
            $asin = 'AS.' . strtoupper(Str::random(8));
        }

        while (Product::where('asin', $asin)->exists()) {
            $asin = 'AS.' . strtoupper(Str::random(8));
        }

        // =========================
        // BARCODE
        // =========================
        $barcode = $request->barcode;

        if (!$barcode) {
            $barcode = (string) random_int(100000000000, 999999999999);
        }

        while (Product::where('barcode', $barcode)->exists()) {
            $barcode = (string) random_int(100000000000, 999999999999);
        }

        // =========================
        // SAVE PRODUCT
        // =========================
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'company_id' => $request->company_id,
            'location' => $request->location,
            'purchase_rate' => $purchase,
            'sale_rate' => $sale,
            'whole_sale_rate' => $wholesale,
            'roi' => $roi,
            'asin' => $asin,
            'barcode' => $barcode,
            'summary' => $request->summary,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Server error occurred',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
