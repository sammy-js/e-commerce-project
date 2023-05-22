<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function view_category(){
        $categorydata = category::all();

        return view('admin.category',compact('categorydata'));
    }

    public function add_category(Request $request){
        $data = new category;
        $data->category_name = $request->categoryname;

        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');
    }

    public function delete_category($id){
        $data = category::find($id);

        $data -> delete();

        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    public function view_product(){
        $category = category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $request){
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

    public function show_product(){ 
        $products = product::all();
        return view('admin.show_product',compact('products'));
    }

    public function delete_product($id){
        $product = product::find($id);

        $product->delete();

        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function update_product($id){
        $product = product::find($id);
        $category = category::all();
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request,$id){
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

    public function view_order(){
        $order = order::all();

        return view('admin.order',compact('order'));
    }

    public function delivered($id){
        $order = order::find($id);

        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";

        $order->save();

        return redirect()->back();
    }
}
