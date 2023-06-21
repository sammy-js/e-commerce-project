<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css') 
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

        <div style="width:50%;margin:auto;" class="card">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white p-2"><b>Change Password</b></h4>
            </div> 
            <div class="card-body">
                <form action="{{url('change_password_confirm')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Current Password :</label>
                        <input type="text"  name="current_password" class="form-control text-white">
                    </div>
                    <div class="mb-3">
                        <label>New Password :</label>
                        <input type="text" name="password" class="form-control text-white">
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password :</label>
                        <input type="text" name="password_confirmation" class="form-control text-white">
                    </div>
                    <div class="mb-3 text-end">
                        <br>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
        </div>
          
         @include('admin.script')
  </body>
</html>