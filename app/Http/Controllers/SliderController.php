<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addslider() {
        return view('admin.addslider');
    }

    public function sliders() {
        return view('admin.sliders');
    }

    public function editslider() {
        return view('admin.addslider');
    }

    public function updateslider($id) {
        return view('admin.sliders');
    }

    public function deleteslider($id) {
        return view('admin.sliders');
    }

}
