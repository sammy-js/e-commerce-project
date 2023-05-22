<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css') 
  <style>
    .center{
        text-align:center;
        font-size:40px;
    }
    .t_position{
      text-align:center;
      width:80%;
      margin:auto;
      margin-top:30px;
      border:solid 3px white;
     }
     img{
        height:150px;
        width:150px;
        padding:10px;
     }
     .th_color{
        background-color:skyblue;
        font-family:cursive;
     }
     .th_deg{
      padding:10px;
     }
  </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header') 
     
     <div class="main-panel">
        <div class="content-wrapper">

           <!-- message -->
           @if(session()->has('message'))
          
          <div class="alert alert-success" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           {{session()->get('message')}}
          </div>
         @endif

            <h2 class="center">All Products</h2>

            <table class="t_position">
                <tr class="th_color">
                   <th class="th_deg">Product Title</th>
                   <th class="th_deg">Product Description</th>
                   <th class="th_deg">Product Quantity</th>
                   <th class="th_deg">Product Category</th>
                   <th class="th_deg">Product Price</th>
                   <th class="th_deg">Discount Price </th>
                   <th class="th_deg">Product Image</th>
                   <th class="th_deg">Delete</th>
                   <th class="th_deg">Edit</th>
                </tr>

                @foreach($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td>
                        <img src="/product/{{$product->image}}">
                    </td>
                    <td>
                      <a class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This')" href="{{url('/delete_product',$product->id)}}">Delete</a>
                    </td>
                    <td>
                      <a class="btn btn-primary" href="{{url('/update_product',$product->id)}}">Edit</a>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
          
         @include('admin.script')
  </body>
</html>