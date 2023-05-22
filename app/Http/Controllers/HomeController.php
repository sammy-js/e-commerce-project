<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    public function index(){
        $products = Product::paginate(6);
     return view('home.userpage',compact('products'));
    }

    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype == '1'){
           return view('admin.home');
        }
        else{
            $products = Product::paginate(6);
     return view('home.userpage',compact('products'));
        }
       }

       public function product_details($id){
        $product = product::find($id);
        return view('home.product_details',compact('product'));
       }

       public function add_cart(Request $request,$id){

        if(Auth::id())
        {
            /*$user accessess the User info in the database*/
            $user = Auth::user();
            /*$product accessess the Product info in the database*/
            $product = product::find($id);

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if($product->discount_price!=null)
            {
                $cart->price = $product->discount_price * $request->quantity;;
            }
            else
            {
                $cart->price = $product->price * $request->quantity;;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;

            $cart->save();

            return redirect()->back();
        }
        else
        {
            return redirect()-> route('login');
        }
       }

       public function show_cart(){

        if(Auth::id())
        {
        /* $id will store the specific logged in user id*/
        $id = Auth::user()->id;
        
        /* $cart will store all the cart data but for a specific id*/
        $cart = cart::where('user_id','=',$id)->get();
        
        return view('home.show_cart',compact('cart'));
        }
        else
        {
            return redirect()-> route('login');
        }
   
       }

       public function remove_product($id){
        $cart = cart::find($id);

        $cart->delete();

        return redirect()->back();
       }

       /*function to move cart data to ordertable*/
       public function cash_order(){
        /*user variable will store the data of the logged in user*/
        $user = Auth::user();
        /*variable user will store the id data of the logged in user*/
        $userid = $user->id;
        /*$data will store carts table data where by the user_id of the carts table matches the logged in user id*/
        $data = cart::where('user_id','=',$userid)->get();
         
        foreach($data as $data){
            $order = new order;
            
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->product_title = $data->product_title;

            $order->payment_status = "cash on delivery";
            $order->delivery_status = "processing";

            $order->save();

            /* cart_id variable will store the id data of the carts table*/ 
            $cart_id = $data->id;
            /*cart variable  will store the cart data that is from a specific cart id*/
            $cart = cart::find($cart_id);

            $cart->delete();

        }
        return redirect()->back()->with('message','We Have Received Your Order.We will Connect With You Soon...');

       }

       public function mpesastk(){
        return view('home.mpesastk');
       }

}
