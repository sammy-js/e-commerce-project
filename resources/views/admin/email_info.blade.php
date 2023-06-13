<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css') 

  <style>
    label{
        display: inline-block;
        width: 200px;
        font-size: 18px;
        font-weight: bold;
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
       <!-- content-wrapper -->
         <div class="content-wrapper">

            <h1 style="text-align:center;font-size:25px;">Send Email to {{$order->email}}</h1>

            <form action="{{url('send_user_email',$order->id)}}" method="POST">

            @csrf

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Greeting :</label>

                <input type="text" name="greeting">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Firstline :</label>

                <input type="text" name="firstline">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Body :</label>

                <input type="text" name="body">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Button Name :</label>

                <input type="text" name="button">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Url :</label>

                <input type="text" name="url">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
                <label for="">Email Lastline</label>

                <input type="text" name="lastline">
            </div>

            <div style="padding-left: 35%;padding-top:30px;">
            <input type="submit" value="Send Email" class="btn btn-primary">
            </div>
            
            </form>
         </div>
        </div>
          
         @include('admin.script')
  </body>
</html>