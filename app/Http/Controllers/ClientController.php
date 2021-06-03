<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function home() {
        $sliders = Slider::get();
        $products = Product::get();
        return view('client.home', compact('sliders', 'products'));
    }

    public function shop() {
        $categories = Category::get();
        $products = Product::get();

        return view('client.shop', compact('categories', 'products'));
    }

    public function cart() {
        if (!Session::has('cart')) {
            return view('client.cart');
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }

    public function updateQty(Request $request){
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        // dd($request->all());
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect('/cart');
    }

    public function removeItem($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect('/cart');
    }


    public function checkout() {
        return view('client.checkout');
    }

    public function login() {
        return view('client.login');
    }

    public function singup() {
        return view('client.singup');
    }

}
