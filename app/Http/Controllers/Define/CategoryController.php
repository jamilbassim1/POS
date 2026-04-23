<?php

namespace App\Http\Controllers\Define;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     public function list()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        return response()->json($category);
    }
}
