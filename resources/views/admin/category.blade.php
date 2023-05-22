<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css') 
    <style>
     .div_center{
      text-align:center;
      padding-top:40px;
     }
     .center{
      text-align:center;
      width:50%;
      margin:auto;
      margin-top:30px;
      border:solid 2px green;
     }
     .t_head{
      padding-bottom:10px;  
      color:blue;
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
        <!-- partial -->
     <div class="main-panel">
       <!-- content-wrapper -->
        <div class="content-wrapper">
        
          @if(session()->has('message'))
          
           <div class="alert alert-success" >
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
           </div>
          @endif

          <div class="div_center">
          <h2>Add Category</h2>
          <form action="{{url('/add_category')}}" method="POST">
            @csrf

            <input type="text" name="categoryname" placeholder="Write Category Name">
            <input type="submit" name="submit" class="btn btn-success" value="Add Category">
          </form>
          </div>

          <table class="center">
           
            <tr class="t_head">
            <td>Category_Name</td>
            <td>Action</td>
            </tr>
           @foreach($categorydata as $data)
            <tr>
              <td>{{$data -> category_name}}</td>
              <td>
              <a href="{{url('delete_category',$data->id)}}" onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
    </div>
    @include('admin.script')
    </body>
</html>