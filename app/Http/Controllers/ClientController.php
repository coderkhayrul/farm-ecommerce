<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class ClientController extends Controller
{
    public function home() {
        $sliders = Slider::get();
        $products = Product::get();
        return view('client.home', compact('sliders', 'products'));
    }

    public function shop() {
        $categories = Category::get();
        $products = Product::where('status',1)->get();

        return view('client.shop', compact('categories', 'products'));
    }

    public function view_by_cat($name) {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->get();
        return view('client.shop ', compact('categories'))->with('products', $products);
    }

    public function cart() {
        if (!Session::has('cart')) {
            return view('client.cart');
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
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

        if (!Session::has('client')) {

            return redirect('client_login');
        }

        if (!Session::has('cart')) {
            return back();
        }
        return view('client.checkout');
    }

    public function postcheckout(Request $request) {
        if(!Session::has('cart')){
            return Redirect('/cart');
            // , ['Products' => null]
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51IyMkAJ1VeIVckU3reASjOpbrTI52ZESWpI0q8zyt9k51VoEp5mY82YQKUAKzuB1hTrklnFw4lkUvlxqwdTUNWXb00miRhwJr7');
        try{
            $charg = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Product Payment Recipt"
            ));

            // GET ORDER INFO
            $order = new Order();
            $order->name = $request->name;
            $order->address = $request->address;
            $order->cart = serialize($cart);
            $order->payment_id = $charg->id;

            $order->save();

            // MAIL SENDING
            $orders = Order::where('payment_id', $charg->id)->get();
            $orders->transform(function($order, $key){
                $order->cart = unserialize($order->cart);
                return $order;
            });

            $email = Session::get('client')->email;

            Mail::to($email)->send(new SendMail($orders));


        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect('/checkout');
        }

        Session::forget('cart');
        // Session::put('success', 'Purchase accomplished successfully !');
        return redirect('/cart')->with('success', 'Purchase accomplished successfully !');
    }

    public function singup() {
        return view('client.singup');
    }

    public function createaccount(Request $request) {
        $this->validate($request, [
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:6',
        ]);
        $client = new Client();
        $client->email = $request->email;
        $client->password = bcrypt($request->password);

        $client->save();

        return back()->with('status', "Your Account has been created successfully");
    }

    public function login() {
        return view('client.login');
    }

    public function accessaccounts(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:6',
        ]);

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                Session::put('client', $client);
                return redirect('/shop');
                // return back()->with('status', "You'r Login Success");
            }else {
                return back()->with('error', 'Worng Password');
            }

        }else {
            return back()->with('error', 'You do not have an account! ');
        }

    }

    public function logout() {
        Session::forget('client');
        return back();
    }

}
