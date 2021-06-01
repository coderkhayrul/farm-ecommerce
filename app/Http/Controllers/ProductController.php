<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categories() {
        return view('admin.categories');
    }

    public function products() {
        return view('admin.products');
    }

    public function sliders() {
        return 'Working';
    }


}
