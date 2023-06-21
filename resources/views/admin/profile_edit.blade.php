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
                <h4 class="mb-0 text-white p-2"><b>Profile Settings</b></h4>
            </div> 
            <div class="card-body">
                <form action="{{url('edit_account_confirm',$profile->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Profile Name :</label>
                        <input type="text" name="profileName" class="form-control text-white" value="{{$profile->profile_name}}">
                    </div>
                    <div class="mb-3">
                        <label>Current Image :</label>
                        <img style="width:100px;height:100px;" src="/product/{{$profile->image}}" alt="">
                    </div>
                    <div class="mb-3">
                        <label>Change Image Here :</label>
                        <input type="file" name="profileImage" class="form-control">
                    </div>
                    <div class="mb-3 text-end">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>


        </div>
        </div>
          
         @include('admin.script')
  </body>
</html>