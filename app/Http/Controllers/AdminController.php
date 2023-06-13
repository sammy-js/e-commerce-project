<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category(){
        if(Auth::id()){
            $categorydata = category::all();

            return view('admin.category',compact('categorydata'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function add_category(Request $request){
     if(Auth::id()){
        $data = new category;
        $data->category_name = $request->categoryname;

        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');
      }
    else
    {
        return redirect()->route('login');
    }
      
    }

    public function delete_category($id){
    if(Auth::id()){
        $data = category::find($id);

        $data -> delete();

        return redirect()->back()->with('message','Category Deleted Successfully');
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function view_product(){
     if(Auth::id()){

        $category = category::all();
        return view('admin.product',compact('category'));
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function add_product(Request $request){
     if(Auth::id()){

        $product = new product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
   
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message','Product Added Successfully');
       }
    else
    {
        return redirect()->route('login');
    }

    }

    public function show_product(){ 
    if(Auth::id()){   
        $products = product::all();
        return view('admin.show_product',compact('products'));
       }
    else
    {
        return redirect()->route('login');
    }
    
    }

    public function delete_product($id){
     if(Auth::id())
     {
        $product = product::find($id);

        $product->delete();

        return redirect()->back()->with('message','Product Deleted Successfully');
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function update_product($id){
    if(Auth::id())
     {
        $product = product::find($id);
        $category = category::all();
        return view('admin.update_product',compact('product','category'));
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function update_product_confirm(Request $request,$id){
    if(Auth::id())
     {
        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        
        $image = $request->image;
        
        /*if()=>to prevent an error when no image is selected during editing*/
       if($image){
          $imagename = time().'.'.$image->getClientOriginalExtension();
          $request->image->move('product',$imagename);

          $product->image = $imagename;
       }

        $product->save();

        return redirect()->back()->with('message','Product Updated Successfully');
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function view_order(){
    if(Auth::id())
     {
        $order = order::all();

        return view('admin.order',compact('order'));
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function delivered($id){
    if(Auth::id())
    {
        $order = order::find($id);

        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";

        $order->save();

        return redirect()->back();
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function search_data(Request $request){
    if(Auth::id())
     {
        $searchdata = $request->search;
        /*the double quotes in "%$searchdata%" are very important*/
        $order = order::where('name','LIKE',"%$searchdata%")->orWhere('product_title','LIKE',"%$searchdata%")->orWhere('phone','LIKE',"%$searchdata%")->get();

        return view('admin.order',compact('order'));
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function print_pdf($id){
    if(Auth::id())
     {
        $order = order::find($id);
        /*it will turn the order file into a PDF file*/
        $pdf = PDF::loadView('admin.pdf',compact('order'));

        return $pdf->download('Order_Details');
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function send_email($id){
  if(Auth::id())
     {
        $order = order::find($id);

        return view('admin.email_info',compact('order'));
    }
    else
    {
        return redirect()->route('login');
    }

    }

    public function send_user_email(Request $request,$id){
  if(Auth::id())
     {
        $order = order::find($id);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
            
        ];
        /*we call the Notification function and send a mail to te specific order email*/
        Notification::send($order,new SendEmailNotification($details));

        return redirect()->back();
    }
    else
    {
        return redirect()->route('login');
    }
    
    }
}

