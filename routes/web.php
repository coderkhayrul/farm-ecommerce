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
Route::get('/edit_category/{id}', [CategoryController::class, 'editcategory'])->name('category.edit');
Route::put('/updatecategory/{id}', [CategoryController::class, 'updatecategory'])->name('category.update');
Route::get('/delete_category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

// Product Route
Route::get('/products',[ProductController::class, 'products'])->name('product.index');
Route::get('/addproduct', [ProductController::class, 'addproduct'])->name('product.create');
Route::post('/saveproduct', [ProductController::class, 'saveproduct'])->name('product.store');
Route::get('/edit_product/{id}', [ProductController::class, 'editproduct'])->name('product.edit');
Route::put('/update_product/{id}', [ProductController::class, 'updateproduct'])->name('product.update');
Route::get('/deleteproduct/{id}', [ProductController::class, 'deleteproduct'])->name('product.delete');

Route::get('/activated_product/{id}', [ProductController::class, 'activated'])->name('product.activated');
Route::get('/unactivated_product/{id}', [ProductController::class, 'unactivated'])->name('product.unactivated');



// Slider Route
Route::get('/sliders',[SliderController::class, 'sliders'])->name('slider.index');
Route::get('/addslider', [SliderController::class, 'addslider'])->name('slider.create');
Route::post('/saveslider',[SliderController::class, 'saveslider'])->name('sldier.store');
Route::get('/editslider/{id}',[SliderController::class, 'editslider'])->name('slider.edit');
Route::put('/updateslider/{id}',[SliderController::class, 'updateslider'])->name('slider.update');
Route::get('/deleteslider/{id}',[SliderController::class, 'deleteslider'])->name('slider.delete');


//  <!-- Admin Route List End -->


