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

      <!-- sweetalert cdn link -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- sweetalert cdn link ends-->
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

   @include('sweetalert::alert')

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
                    <!--NOTE: must include event in the brackets -->
                   <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('remove_product',$cart->id)}}">Remove</a>
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
            <a href="{{url('mpesastk',$totalprice)}}"  class="btn btn-success">Lipa Na Mpesa</a>
         </div>
        
      </div>

      <script>
        /*ev is the shortform of event*/
        function confirmation(ev){
            /*will prevent the removing of the product first*/
            ev.preventDefault();

            /*href="url('remove_product',$cart->id)" is stored in urlToRedirect variable*/
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            /*swal is a function that is used to display a sweetalert message*/
            swal({
                title: "Are you sure to remove this product?",
                text: "You Will Not be able To Revert This!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
        }
      </script>
      
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