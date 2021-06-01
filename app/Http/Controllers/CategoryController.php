<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    // Category Function
    public function addcategory() {

        return view('admin.addcategory');
    }
    public function categories() {

        return view('admin.categories');
    }
    public function savecategory(Request $request) {
        // dd($request->category_name);
        $checkcategory = Category::where('category_name', $request->category_name)->first();
        if (!$checkcategory) {
            Category::create($request->all());
            return redirect()->route('category.create')->with('status', 'The'.$request->category_name.' Category has been saved successfully');
        }else {
            return redirect()->route('category.create')->with('status1', 'The '.$request->category_name.' Category already exist');
        }
    }
}
