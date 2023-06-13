<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
           
               <!-- search product with pagination-->
               <div>

               <form action="{{url('search_product')}}" method="GET">

               @csrf

                  <input style="width:500px;" type="text" name="search" placeholder="Search For Product">
                  <input type="submit" name="" value="Search">
                  
               </form>

               </div>
              <!-- end search product with pagination-->

            </div>
            
            @if(session()->has('message'))
          
          <div class="alert alert-success" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           {{session()->get('message')}}
          </div>
            @endif

            <div class="row">
            
            <!--for pagination to work (foreach($product as $products)) the two variables should be different-->

            @foreach($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$product->id)}}" class="option1">
                           Product Details
                           </a>

                          <form action="{{url('add_cart',$product->id)}}" method="post">
                           @csrf
                           
                           <div class="row">

                            <div class="col-md-4">
                            <input style="width:100px" type="number" name="quantity" value="1" min="1">
                            </div>

                            <div class="col-md-4">
                            <input type="submit" class="option2" value="Add To Cart">
                            </div>

                           </div>
                          </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$product->image}}">
                     </div>
                     <div class="detail-box">
                        <h5>
                        {{$product->title}}
                        </h5>

                        @if($product->discount_price!=null)
                        <h6 style="color:red">
                           Discount price
                           <br>
                        Sh.{{$product->discount_price}}
                        </h6>
                       
                        <h6 style="text-decoration:line-through ;color:blue">
                           Price
                           <br>
                        Sh.{{$product->price}}
                        </h6>

                        @else

                        <h6 style="color:blue">
                           Price
                           <br>
                        Sh.{{$product->price}}
                        </h6>

                        @endif
                     </div>
                  </div>
               </div>

            @endforeach

            </div>
             
            <!-- pagination links -->
            <span style="padding-top:20px">
            {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
         </div>
      </section>