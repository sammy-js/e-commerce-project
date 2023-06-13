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
      <link rel="shortcut icon" href="{{asset('/images/favicon.jpg')}}" type="">
      <title>SleezyTechs Outfits</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
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
         <table class="mb-5">
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Product Quantity</th>
                <th class="th_deg">Product Price</th>
                <th class="th_deg">Payment Status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Product Image</th>
                <th class="th_deg">Action</th>
            </tr>
             
            @foreach($order as $order)
            <tr>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td>
                    <img style="height:150px;width:150px;" src="/product/{{$order->image}}" >
                </td>
                <td>
                    @if($order->delivery_status == 'processing')
                    <a href="{{url('cancel_order',$order->id)}}" onclick="return confirm('Are You Sure To Cancel This Order!!')" class="btn btn-danger">Cancel</a>
                    @else
                    <p style="color:blue">Not Allowed</p>
                    @endif
                </td>
                
            </tr>


            @endforeach
         </table>


        
      </div>
      
      <!-- jQuery (javascript cdn link) -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script> 
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>