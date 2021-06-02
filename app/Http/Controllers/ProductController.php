<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct() {

        return view('admin.addproduct');
    }

    public function products() {
        return view('admin.products');
    }

    public function saveproduct(Request $request) {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999',

        ]);
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
        }

        return "Save Product Function Call";
    }


}
