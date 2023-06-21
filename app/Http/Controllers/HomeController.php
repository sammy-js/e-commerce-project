<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use App\Mail\ContactMail;
use Mail;

class HomeController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $replys = reply::all();
     return view('home.userpage',compact('products','comment','replys'));
    }

    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype == '1'){
            $total_products = product::all()->count();
            $total_orders = order::all()->count();
            $total_customers = user::all()->count();
            $order = order::all();
            $total_revenue = 0;

            foreach($order as $order){
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = order::where('delivery_status','=','Delivered')->get()->count();
            $total_processing = order::where('delivery_status','=','processing')->get()->count();

           return view('admin.home',compact('total_products','total_orders','total_customers','total_revenue','total_delivered','total_processing'));
        }
        else{
            $products = Product::paginate(6);
            $comment = comment::all();
            $replys = reply::all();
     return view('home.userpage',compact('products','comment','replys'));
        }
       }

     
       public function product_details ($id){
        $product = product::find($id);
        return view('home.product_details',compact('product'));
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


       public function add_cart(Request $request,$id){

        if(Auth::id())
        {
            /*$user accessess the User info in the database*/
            $user = Auth::user();

            $userid = $user->id;
            /*$product accessess the Product info in the database*/
            $product = product::find($id);

            /*$product_exist_id will check whether there is a product with the similar id and if the similar product id belongs to the same user and if YES it will get the id from there*/
            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($product_exist_id  )
            {

                $cart = cart::find($product_exist_id)->first();

                $quantity = $cart->quantity;
                
                $cart->quantity = $quantity + $request->quantity;

                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }
                
                $cart->save();

                Alert::success('Product Added Successfully','We have added product to the cart');

                return redirect()->back();
            }
            else
            {
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $request->quantity; 
                   }       
                else
                {
                    $cart->price = $product->price * $request->quantity; 
                }
    
                $cart->image = $product->image;
                $cart->product_id = $product->id;
    
                $cart->quantity = $request->quantity;
    
                $cart->save();
    
                return redirect()->back()->with('message','Product Added Successfully');

            }


           
            
        }
        else
        {
            return redirect()-> route('login');
        }
   
       }

       public function remove_product($id){
        $cart = cart::find($id);

        $cart->delete();

        Alert::warning('Product Removed','You have Removed a Product From the Cart');

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

       public function mpesastk($totalprice){
        return view('home.mpesastk',compact('totalprice'));
       }

       public function token(){
        $consumerKey = '0AVKQNniX7tTJ25azSVNOVPg6yse7zLN' ;
        $consumerSecret = 'NQA9dOA0yfbYA57v';
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        
        $response = HTTP::withBasicAuth( $consumerKey , $consumerSecret)->get($url);
        return $response['access_token'];

    }

    public function initiate_push(Request $request){
        $phoneNumber = $request->input("phonenumber");
         if(substr($phoneNumber, 0, 3) == "254"){
            $phoneNumber = $request->input("phonenumber");
        }else{
            $phoneNumber = '254' . (int)$phoneNumber;
        };
        $accessToken = $this->token();
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $BusinessShortCode = 174379;
        $Timestamp = Carbon::now()->format('YdmHis');
        $password =base64_encode( $BusinessShortCode. $passkey.$Timestamp);
        $TransactionType = "CustomerPayBillOnline";
        $Amount = 1;
        $partyA = $phoneNumber ;
        $partyB = 174379;
        $callbackUrl = 'https://3f10-102-222-147-146.ngrok-free.app';
        $AccountReference = 'SLEEZYTECHS PAYMENTS';
        $TransactionDesc ='Payments for Goods';
        $stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $accessToken];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
$curl_post_data = array(
  //Fill in the request parameters with valid values
           'BusinessShortCode' => $BusinessShortCode,
            'Password' =>  $password,
            'Timestamp' =>  $Timestamp,
            'TransactionType' =>  $TransactionType,
            'Amount' => $Amount,
            'PartyA' =>  $partyA,
            'PartyB' => $partyB,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
//ECHO  RESPONSE
$data = json_decode($curl_response);

return $data;

       /*
        $response = Http::withToken($accessToken)->post($url,[
            'BusinessShortCode' => $BusinessShortCode,
            'Password' =>  $password,
            'Timestamp' =>  $Timestamp,
            'TransactionType' =>  $TransactionType,
            'Amount' => $Amount,
            'PartyA' =>  $partyA,
            'PartyB' => $partyB,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
        ]);
         
        return $response;
        */

    }

    public function show_order(){
        if(Auth::id())
        {
        /* $id will store the specific logged in user id*/
        $id = Auth::user()->id;
        
        /* $order will store all the cart data but for a specific id*/
        $order = order::where('user_id','=',$id)->get();
        
        return view('home.order',compact('order'));
        }
        else
        {
            return redirect()-> route('login');
        }
        
    }

    public function cancel_order($id){
        $order = order::find($id);

        $order->delivery_status = 'You Have Cancelled';

        $order->save();

        return redirect()->back();
    }

    public function add_comment(Request $request){
        if(Auth::id())
        {
            $comment = new comment;

            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();
        }
        else
        {
            return redirect()-> route('login');
        }
    }

    public function add_reply(Request $request){
        if(Auth::id())
        {
           $reply = new reply;

           $reply->name = Auth::user()->name;
           $reply->user_id = Auth::user()->id;
           $reply->comment_id = $request->commentId;
           $reply->reply = $request->reply;

           $reply->save();

           return redirect()->back();
        }
        else
        {
            return redirect()-> route('login');
        }
    }

    public function product_search(Request $request){
        $comment = comment::orderby('id','desc')->get();

        $replys = reply::all();

        $search_text = $request->search;

        /*we will be searching the product name that is similar to the name stored in $search_text variable*/
        $products = product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text")->paginate(10);
         
        return view('home.userpage',compact('products','comment','replys'));
    }

    public function product(){

        $products = Product::latest()->paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $replys = reply::all();

        return view('home.all_product',compact('products','comment','replys'));
    }

    public function search_product(Request $request){
        $comment = comment::orderby('id','desc')->get();

        $replys = reply::all();

        $search_text = $request->search;

        /*we will be searching the product name that is similar to the name stored in $search_text variable*/
        $products = product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text")->paginate(10);
         
        return view('home.all_product',compact('products','comment','replys'));
    }

    public function storeNewsletterEmail(Request $request){
 
        NewsletterSubscriber::create(['email'=>$request->email]);

        $mail_controller = new EmailController;
        $subscriber_message = Newsletter::where('action','NEWSLETTER_SUBSCRIPTION_CUSTOMER')->first();

        $admin_message = Newsletter::where('action','NEWSLETTER_SUBSCRIPTION_ADMIN')->first();

        if($subscriber_message){
            $mail_controller->sendEmail($subscriber_message->title, $subscriber_message->subject, $subscriber_message->body, $request->email );
        }

        if($admin_message){

            $admins = User::where('email','samm31701@gmail.com')->get();

            foreach($admins as $admin){
            $mail_controller->sendEmail($admin_message->title, $admin_message->subject, $admin_message->body, $admin->email ,'' ,'Admin');
            }
        }

        return redirect()->back();
 } 

 public function show_contact(){
    return view ('home.contact-us');
 }

 public function contact_mail_send(Request $request){
    Mail::to('sammysleezy254@gmail.com')->send(new ContactMail($request));

    return redirect()->back();
 }
 
}
