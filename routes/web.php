<?php

use App\Http\Controllers\AdminController;
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
Route::get('/addcategory', [AdminController::class, 'addcategory'])->name('category.create');
Route::get('/addproduct', [AdminController::class, 'addproduct'])->name('product.create');
Route::get('/addslider', [AdminController::class, 'addslider'])->name('slider.create');

Route::get('/categories',[ProductController::class, 'categories'])->name('category.index');
Route::get('/products',[ProductController::class, 'products'])->name('product.index');
Route::get('/sliders',[SliderController::class, 'sliders'])->name('slider.index');
// Route::get('/orders',[AdminController::class, 'orders'])->name('order.store');

//  <!-- Admin Route List End -->


