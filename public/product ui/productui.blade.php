 <!----------------------->
    <!-- LISTING STYLING -->
    <!----------------------->
    <style>
        .body{
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            min-height: 100vh;
            margin-bottom:20px;
        }
        .cart-btn{
            cursor:pointer;
            display:flex;
            justify-content:flex-end;
            color:black;
            letter-spacing: 4px;
            text-decoration: underline;
        }
        .cart-btn:hover{
            font-size: 20px;
            color:rgb(124,252,0);
            text-decoration:none;
            transition: all 0.2s ease-in-out, transform 0.2s ease-in-out,opacity 0.2s ease-in-out; 
        }
        .product-inner-box .onsale .badge{
            background: #000;
            font-size: 12px;
            padding: 5px 14px;
            top:0px; 
            position: absolute;
            
        }
        .product-inner-box .onsale .badge:before{
            border-width: 10px 0px 0px 10px;
            border-color: transparent transparent transparent #000;
            content: "";
            position: absolute;
            right: -8px;
            width:0;
            bottom:0;
            border-style: solid;
        }
        .product-inner-box .onsale .badge:after{
            border-width: 10px 8px 0px 10px;
            border-color: #000 transparent  transparent ;
            content: "";
            position: absolute;
            right: -8px;
            width:0;
            top:0;
            border-style: solid;
        }
        .product-inner-box img{
            box-shadow: 0 33px 61px -29px rgb(0 0 0 / 26%);
            height: 250px;
            width: 100%;
            object-fit: contain; 
        }
        .product-inner-box .details-btn:hover{
            color:black;
            background-color:white;
            box-shadow: 0 33px 61px -29px rgb(0 0 0 / 26%);
            transition: all 0.2s ease-in-out, transform 0.2s ease-in-out,opacity 0.2s ease-in-out;
        }
       
    </style>
@extends('layout')
@section('content')

<div class="body">
  <div class="container">

    <div class="mb-5 mt-0">
    <h2 class="text-center font-wight-bold"><u>Featured Products</u></h2>
   </div>
   <div class="mb-5 items-end">
    <a class="cart-btn"><i class="fa-solid fa-cart-shopping"></i>CART</a>
   </div>

   <hr>

   <div class="row">

   @foreach($listing as $listing)
     <div class="col-sm-6 col-md-4 col-lg-4 mb-5">

        <!--product-inner-box start-->
        <div class="product-inner-box">
            <!--badge and image div in a card-->
            <div class="card">
               <!--badge div-->
              <div class="onsale position-absolute top-0 start-0 ">
                <span class="badge rounded-0  " ><i class="fa-solid fa-arrow-down"></i>{{$listing->discount_percentage}}%</span>
              </div>

              <!--image div-->
              <img src="/listing/{{$listing->image}}" class="img-fluid p-3" >

              </div> 
            <!-- end of badge and image div in a card-->
            
         <div class="row p-2">
          <form action="" method="post">
            <div class="row">
              <div class="col-md-4">
              <input style="width:60px" type="number" name="quantity" value="1" min="1">
              </div>
              <div class="col-md-8 mb-3">
              <a class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</a>
              </div>
            </div>
          </form>
              <a class="details-btn btn btn-secondary  rounded-pill"><i class="fa-solid fa-eye"></i>Product_details</a>   
         </div>
 
           <!-- product title and price section -->
           <div>
              <div>
                <h4>{{$listing->title}}</h4>
              </div>  

              <div class="row mb-5">
              @if($listing->discount_price!=null)
                 <h6 style="color:red" class="col-md-6">
                        Discount Price
                           <br>
                        Sh.{{$listing->discount_price}}
                  </h6>
                  <h6 style="text-decoration:line-through ;color:blue" class="col-md-6">
                           Price
                           <br>
                        Sh.{{$listing->price}}
                  </h6>
                  @else
                  <h6 style="color:blue" class="col-md-6">
                           Price
                           <br>
                        Sh.{{$listing->price}}
                  </h6>
                @endif
               </div>         
           </div>
            <!-- end of product title and price section -->
         </div>
   <!--end of product-inner-box-->

      </div>
      <!--end of col class-->

@endforeach      

   </div>
   <!--end of the row class-->

   <!-- pagination links -->
   <span style="padding-top:20px">
     {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
   </span>

 </div>  
</div>

@endsection