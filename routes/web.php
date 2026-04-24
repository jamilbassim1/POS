<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Define\ProductController;
use App\Http\Controllers\Define\CategoryController;
use App\Http\Controllers\Define\CompanyController;

Route::view('/', 'welcome');


// Auth routes (from Laravel UI)
Auth::routes();

// Admin & Writer Login/Register Views
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/writer', [LoginController::class, 'showWriterLoginForm']);

Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::get('/register/writer', [RegisterController::class, 'showWriterRegisterForm']);

// Admin & Writer Actions
Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/login/writer', [LoginController::class, 'writerLogin']);

Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/writer', [RegisterController::class, 'createWriter']);

// Basic pages
Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/writer', 'writer');

Route::get('/define/product', [ProductController::class, 'defineProduct'])
    ->name('product');
Route::get('/categories/list', [CategoryController::class, 'list']);
Route::post('/categories/store', [CategoryController::class, 'store']);
Route::post('/companies/store', [CompanyController::class, 'store'])->name('company.store');
Route::get('/companies/list', [CompanyController::class, 'list']);


Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
Route::put('/products/{barcode}', [ProductController::class, 'update']);
Route::delete('/products/{barcode}', [ProductController::class, 'destroy']);
