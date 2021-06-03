<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

    public function editproduct($id) {
        $categories = Category::all()->pluck('category_name', 'category_name');

        $product = Product::findOrFail($id);

        return view('admin.editproduct')->with('product', $product)->with('categories', $categories);
    }

    public function updateproduct(Request $request, $id) {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999'

        ]);
        // Product Save
        $product = Product::findOrFail($request->id);
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        // IMAGE UPDATE
        if ($request->hasFile('product_image')) {
            $filenamewithext = $request->file('product_image')->getClientOriginalName();

                //  get filename
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

                //get just extension
                $extension = $request->file('product_image')->getClientOriginalExtension();

                //file name to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                //upload image
                $path = $request->file('product_image')->storeAs('public/product_image', $filenametostore);

                // OLD IMAGE DELETE
                $old_image = Product::findOrFail($request->id);
                if ($old_image->product_image != 'noimage.jpg') {
                    Storage::delete(['public/product_image/'.$old_image->product_image]);
                }
                $product->product_image = $filenametostore;
        }

        $product->save();

        return redirect()->route('product.index')->with('status', 'The '.$request->product_name.' Product has been updated successfully');
    }

    public function deleteproduct($id) {
        $product = Product::findOrFail($id);
        if ($product->product_image != 'noimage.jpg') {
            Storage::delete(['public/product_image/'.$product->product_image]);
        }
        $product->delete();
        return redirect()->route('product.index')->with('status', 'The '.$product->product_name.' Product has been deleted successfully');

    }

    // ACTIVITED & UNACTIVITED
    public function activated($id) {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();
        return back()->with('status', 'The '.$product->product_name.' Product has been Activated successfully');
    }
    public function unactivated($id) {
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();
        return back()->with('status', 'The '.$product->product_name.' Product has been Unactivated successfully');
    }

    // CART
    public function addToCart($id) {
        $product = Product::findOrFail($id);

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return redirect('/shop');
    }

}
