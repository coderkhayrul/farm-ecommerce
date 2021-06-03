<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->validate($request, [
            'category_name' => 'required'
        ]);
        // dd($request->category_name);
        $checkcategory = Category::where('category_name', $request->category_name)->first();
        if (!$checkcategory) {
            Category::create($request->all());
            return redirect()->route('category.create')->with('status', 'The '.$request->category_name.' Category has been saved successfully');
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
        $old_category = $category->category_name;
        $category->category_name = $request->category_name;
        $data = array();
        $data['product_category'] = $request->category_name;

        DB::table('products')->where('product_category', $old_category)->update($data);
        $category->update();

        return redirect()->route('category.index')->with('status', 'The '.$request->category_name.' Category has been updated successfully');
    }

    public function delete($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('status', 'The '.$category->category_name.' Category has been Delete successfully');
    }

    public function view_by_cat($name) {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->get();
        return view('client.shop ', compact('categories'))->with('products', $products);
    }
}
