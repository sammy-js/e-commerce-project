<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.jpg" type="">
      <title>SleezyTechs Outfits</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
        .center{
            text-align:center;
            width:70%;
            margin: auto;
        }
        table,th,td{
            border:solid 2px grey;
            padding:10px;
        }
        .th_deg{
            font-size:20px;
            background-color:skyblue;
        }
      </style>
   </head>
   <body>
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         
         @if(session()->has('message'))
          
           <div class="alert alert-success" >
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
           </div>
          @endif

      <div class="center">
         <table>
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Product Quantity</th>
                <th class="th_deg">Product Price</th>
                <th class="th_deg">Product Image</th>
                <th class="th_deg">Action</th>
            </tr>
             
           <?php $totalprice = 0; ?>
            @foreach($cart as $cart)
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>Sh.{{$cart->price}}</td>
                <td>
                    <img style="height:150px;width:150px;" src="/product/{{$cart->image}}" >
                </td>
                <td>
                   <a class="btn btn-danger" onclick="return confirm('Are You Sure To Remove This?')" href="{{url('remove_product',$cart->id)}}">Remove</a>
                </td>
            </tr>

            <?php $totalprice = $totalprice + $cart->price; ?>

            @endforeach
         </table>

         <div style="font-size:20px;padding-top:10px;padding-bottom:30px;">
         <span style="font-size:25px;color:blue;font-weight:bold;"> Total Price:</span> Sh.{{$totalprice}}
         </div>

         <div style="padding-bottom:40px">
            <h2>Proceed To Order</h2>
            <a href="{{url('/cash_order')}}" class="btn btn-primary">Cash On Delivery</a>
            <a href="{{url('/mpesastk')}}"  class="btn btn-success">Lipa Na Mpesa</a>
         </div>
        
      </div>
      
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>