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
      <style>
         *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   
}

p{
    font-size: 12px;
}
h1{
    font-family: Verdana, Geneva, Tahoma, sans-serif!important;
}
.bg-primary {
    background-color: #01d28e !important;
    font-family:Verdana, Geneva, Tahoma, sans-serif!important;

}
.form-control {
    height: 36px;
    background: #fff;
    color: rgba(0, 0, 0, 0.8);
    font-size: 14px;
    border-radius: 2px;
    box-shadow: none !important;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.contactForm .form-control {
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    padding: 0;
}


.form-control:focus,.form-control:active {
    border-color: #01d28e !important;
}
.form-label {
    color: #000;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.btn.btn-info {
    background: #01d28e !important;
    border-color: #01d28e !important;
    color: #fff;
    width: 100px;
    border-radius: 0!important;
    
}
.btn.btn-info:hover{
    background-color: #28a745!important;
}

.bi{
    font-size: 50px;
}
@media only screen and (max-width: 600px) {
    .container{
        width: 100%!important;
        padding-bottom: 207px!important;
    }
  }
      </style>
   </head>
   <body>

   @include('sweetalert::alert')
    
      <!-- header section strats -->
      @include('home.header')
      <!-- end header section -->
      
      <div class="container mt-5 shadow mb-5">
        <div class="row ">
            <div class="col-md-4 bg-primary p-5 text-white order-sm-first order-last">
                <h2>Let's get in touch</h2>
                <p>We're open for any suggestion or just to have a chat</p>
                <div class="d-flex mt-2">
                    <i class="bi bi-geo-alt"></i>
                    <p class="mt-3 ms-3"><b>Address :</b> Road 198 West 21th Street, Suite 721 Singapor WW 10016</p>
                </div>
                <div class="d-flex mt-2">
                    <i class="bi bi-telephone-forward"></i>
                    <p class="mt-4 ms-3"><b>Phone :</b> 0791085378</p>
                </div>
                <div class="d-flex mt-2">
                    <i class="bi bi-envelope"></i>
                    <p class="mt-4 ms-3"><b>Email :</b> sammybigman@gmail.com</p>
                </div>
                <div class="d-flex mt-2">
                    <i class="bi bi-youtube"></i>
                    <p class="mt-4 ms-3"><b>Website :</b> www.sleezytechs.com/</p>
                </div>
            </div>
            <div class="col-md-8 p-5 ">
                <h2>Get in touch</h2>
                <form action="{{url('contact_mail')}}" method="POST" class="row g-3 contactForm mt-4">
               
                 @csrf

                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name :</label>
                      <input type="text" class="form-control" name="firstName" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name :</label>
                      <input type="text" class="form-control" name="lastName" placeholder="Enter last name" required>
                    </div>
                    <div class="col-12">
                        <label for="emailAddress" class="form-label">Email Address :</label>
                        <input type="email" class="form-control" name="emailAddress" placeholder="enter email address" required>
                    </div>
                    <div class="col-12">
                      <label for="inputSubject" class="form-label">Subject :</label>
                      <input type="text" class="form-control" name="inputSubject" placeholder="Enter subject" required>
                    </div>
                    <div class="col-md-12">
                      <label for="inputMessage" class="form-label">Message :</label>
                      <textarea name="inputMessage"  cols="30" rows="7" placeholder="Message"></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-info mt-3">Send Message</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
      

     

      
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://sleezytechs.com/" target="_blank">SleezyTechs</a>
         
         </p>
      </div>
      
      <!--this script it prevents the website from refreshing and changing the scroll position of the activity -->
      <script>
         document.addEventListener("DOMContentLoaded",function(event){
            var scrollpos = localStorage.getItem('scrollpos');
            if(scrollpos) window.scrollTo(0, scrollpos);
         });

         window.onbeforeunload = function(e){
            localStorage.setItem('scrollpos', window.scrollY);
         };
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