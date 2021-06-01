<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {

        return view('admin.dashboard');
    }

    // Order Function
    public function orders() {
        return view('admin.orders');
    }
}
