<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css') 
  <style>
    .div_center{
        text-align:center;
        padding:40px;
    }
    .input_font{
      padding:10px;
      color:black;
      font-family:cursive;
    }
    label{
        display: inline-block;
        width: 200px;
    }
    .div_design{
      padding-bottom:20px;
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

         <div class="div_center">
          <h2>Edit Product</h2>
          <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
             <!-- enctype="multipart/form-data" is necessary becoz of image -->
            @csrf

           <div class="div_design">
            <label for="title">Product Title:</label>
            <input type="text" class="input_font" name="title" placeholder="Write Product Title" required="" value="{{$product->title}}">
            </div>

           <div class="div_design">
            <label for="description">Product Description:</label>
            <input type="text" class="input_font" name="description" placeholder="Write Product Description" required="" value="{{$product->description}}">
            </div>

           <div class="div_design">
            <label for="price">Product Price:</label>
            <input type="number" class="input_font"  name="price" placeholder="Write Product Price" required="" value="{{$product->price}}">
            </div>

           <div class="div_design">
            <label for="dis_price">Discount Price:</label>
            <input type="number" class="input_font" name="dis_price" placeholder="Write Discount Price" value="{{$product->discount_price}}" >
            </div>

           <div class="div_design">
            <label for="quantity">Product Quantity:</label>
            <input type="number" class="input_font" min="0" name="quantity" placeholder="Write Product Quantity" required="" value="{{$product->quantity}}">
            </div>

           <div class="div_design">
            <label for="category">Product Category:</label>
            <select name="category">
                <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                @foreach($category as $category)
                <option value="">{{$category->category_name}}</option>
                @endforeach
            </select>
            </div>

            <div class="div_design">
            <label for="image">Current Product Image:</label>
            <img height="100px" width="100px" src="/product/{{$product->image}}" >
            </div>

           <div class="div_design">
            <label for="image">Change Product Image:</label>
            <input type="file"  name="image" >
            </div>

            <div>
            <input type="submit" class="btn btn-primary" name="submit" value="Update Product">
            </div>
            </form>
            </div>
        </div>
     </div>
         @include('admin.script')
  </body>
</html>