<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//  <!-- Client Route List Start-->
Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/checkout', [ClientController::class, 'checkout']);
Route::get('/login', [ClientController::class, 'login']);
Route::get('/singup', [ClientController::class, 'singup']);
//  <!-- Client Route List End-->

// -----------------------------
// #############################
// -----------------------------

//  <!-- Admin Route List Start -->

Route::get('/admin',[AdminController::class, 'dashboard']);
// Order Route
Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
// Category Route
Route::get('/categories',[CategoryController::class, 'categories'])->name('category.index');
Route::get('/addcategory', [CategoryController::class, 'addcategory'])->name('category.create');
Route::post('/savecategory', [CategoryController::class, 'savecategory'])->name('category.store');
Route::get('/edit/{id}', [CategoryController::class, 'editcategory'])->name('category.edit');
Route::put('/updatecategory/{id}', [CategoryController::class, 'updatecategory'])->name('category.update');
// Product Route
Route::get('/products',[ProductController::class, 'products'])->name('product.index');
Route::get('/addproduct', [ProductController::class, 'addproduct'])->name('product.create');
// Slider Route
Route::get('/addslider', [SliderController::class, 'addslider'])->name('slider.create');
Route::get('/sliders',[SliderController::class, 'sliders'])->name('slider.index');


//  <!-- Admin Route List End -->


