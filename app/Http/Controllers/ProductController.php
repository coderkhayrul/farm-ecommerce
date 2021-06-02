<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct() {
        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.addproduct')->with('categories', $categories);
    }
    // GET ALL PRODUCT
    public function products() {
        $products = Product::get();
        return view('admin.products')->with('products', $products);
    }

    public function saveproduct(Request $request) {
        // dd($request->all());
        // Product Validation
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999'

        ]);
        if ($request->product_category) {

                // Product Image Store
            if ($request->hasFile('product_image')) {
                // get filename with ext
                $filenamewithext = $request->file('product_image')->getClientOriginalName();

                //  get filename
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

                //get just extension
                $extension = $request->file('product_image')->getClientOriginalExtension();

                //file name to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                //upload image
                $path = $request->file('product_image')->storeAs('public/product_image', $filenametostore);
            }else {
                $filenametostore = 'noimage.jpg';
            }
            // Product Save
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_price = $request->product_price;
            $product->product_category = $request->product_category;
            $product->product_image = $filenametostore;
            $product->status = 1;

            $product->save();

            return redirect()->route('product.create')->with('status', 'The '.$request->product_name.' Product has been Create successfully');
        }else {
            return redirect()->route('product.create')->with('status1', 'The Do select the category please');
        }
    }

}
