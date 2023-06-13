<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="150" height="100" src="{{asset('/images/logo.jpg')}}" alt="#" />SLEEZYTECHS</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="about.html">About</a></li>
                              <li><a href="testimonial.html">Testimonial</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/products')}}">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#contacts">Contact</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/show_cart')}}">
                          
                                 CART    
                               <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border  border-light rounded-circle">
                                   <span class="visually-hidden"></span>
                               </span>
                             
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/show_order')}}">Order</a>
                        </li>
                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                          <form action="{{route('logout')}}" class="inline" method="post">
                           @csrf
                           <button type="submit" class="btn btn-primary">
                              {{_('Logout')}}
                           </button>
                          </form>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('login') }}" id='logincss' >Login</a>
                        </li>
                        
                        <li class="nav-item">
                           <a class="btn btn-primary" href="{{ route('register') }}" >Register</a>
                        </li>
                        @endif
                        @endauth
                     </ul>
                  </div>
               </nav>
            </div>
         </header>