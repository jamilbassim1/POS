<?php

namespace App\Http\Controllers\Define;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
  public function list()
{
    return response()->json(Company::all());
}

public function store(Request $request)
{
    Company::create([
        'company_name' => $request->company_name
    ]);

    return response()->json(['success' => true]);
}
}
