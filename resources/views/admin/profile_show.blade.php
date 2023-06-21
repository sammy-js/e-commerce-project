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
                <h4 class="mb-0 text-white p-2"><b>Profile Details</b></h4>
            </div> 

            <div class="card-body">

            @foreach($profile as $profile)
                    
                    <div class="mb-3">
                        <label class="text-primary">Profile Name :</label>
                        <p>{{$profile->profile_name}}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-primary">Current Image :</label>
                        <img style="width:100px;height:100px;" src="/product/{{$profile->image}}" alt="">
                    </div>
                    <div class="mb-3 text-end">
                        <br>
                        <a class="btn btn-primary" href="{{url('edit_account_setting',$profile->id)}}" >Edit Profile</a>
                    </div>
           @endforeach
            </div>

        </div>


        </div>
        </div>
          
         @include('admin.script')
  </body>
</html>