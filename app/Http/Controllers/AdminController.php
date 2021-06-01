<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {

        return view('admin.dashboard');
    }

    // Category Function
    public function addcategory() {

        return view('admin.addcategory');
    }

    // Product Funtion
    public function addproduct() {

        return view('admin.addproduct');
    }

    // Slider Funtion
    public function addslider() {

        return view('admin.addslider');
    }
}
