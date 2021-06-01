<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories() {
        $categories = Category::get();

        return view('admin.categories')->with('categories',$categories);
    }

    public function addcategory() {

        return view('admin.addcategory');
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

    public function editcategory($id) {
        $category = Category::findOrFail($id);

        return view('admin.editcategory')->with('category', $category);
    }

    public function updatecategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->update();

        return redirect()->route('category.index')->with('status', 'The '.$request->category_name.' Category has been updated successfully');
    }
}
