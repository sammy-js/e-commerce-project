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
   </head>
   <body>
      
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <div class="container">
          <div class="row mt-5">
            <div class="col-sm-8 mx-auto">
              <div class="card" style="width:50%;padding:20px;margin-bottom:15px">
                <div>
                <a href="{{url('/')}}" class="btn btn-primary">Back</a>
                </div>
                <br>
                {{-- Error Handling --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{url('/initiatepush')}}">
                    @csrf
                   
                        <div class="card-header" style="font-size:25px;font-weight:bold;text-align:center;color:green">Lipa Na Mpesa</div>
                        <div class="card-body">
                             
                             <div style="color:blue;font-weight:bold">Total Amount:Sh.{{$totalprice}}</div>
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="number" name="phonenumber" class="form-control" id="phone_number"
                                placeholder="0791xxxx78" aria-describedby="emailHelp" required>
                        
                            <label for="_amount" class="form-label">Amount:</label>
                            <input type="number" name="amount" class="form-control" placeholder="10"
                                id="_amount" value={{$totalprice}}>
                        
                            <input type="submit" class="btn btn-success" value="Process Payment">
                        
                        </div>
                   
                   </form>
                </div>
            </div>
        </div>
    </div>
     
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://sleezytechs.com/" target="_blank">SleezyTechs</a>
         
         </p>
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