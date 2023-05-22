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
        height:100px;
        width:100px;
        padding:10px;
     }
     table,th,td{
            border:solid 2px grey;
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
            <h1 class="center">All Orders</h1>

            <table  class="t_position">
               <tr class="th_color">
                <th class="th_deg">Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">phone</th>
                <th class="th_deg">Address</th>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">price</th>
                <th class="th_deg">quantity</th>
                <th class="th_deg">Payment Status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Delivered</th>
               </tr>

               @foreach($order as $order)

               <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td>
                  <img src="/product/{{$order->image}}" >
                </td>
                <td>
                  @if($order->delivery_status == "processing")
                  <a href="/delivered/{{$order->id}}" class="btn btn-primary">
                    Delivered
                  </a>
                  @else
                  <h5 style="color:green">Delivered</h5>
                  @endif
                </td>
               </tr>
               @endforeach
            </table>
        </div>
      </div>
          
         @include('admin.script')
  </body>
</html>