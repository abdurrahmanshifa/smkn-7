<!--Full width header Start-->
<div class="full-width-header header-style2">
     <!--Header Start-->
     <header id="rs-header" class="rs-header">
          <!-- Topbar Area Start -->
          <div class="topbar-area">
               <div class="container">
                    <div class="row y-middle">
                         <div class="col-md-7">
                              <ul class="topbar-contact">
                                   <li>
                                        <i class="flaticon-email"></i>
                                        <a href="mailto:{{$kontak->email}}">
                                             {{$kontak->email}}
                                        </a>
                                   </li>
                                   <li>
                                        <i class="flaticon-call"></i>
                                        <a href="tel:{{$kontak->telp}}">
                                             {{$kontak->telp}}
                                        </a>
                                   </li>
                              </ul>
                         </div>
                         <div class="col-md-5 text-right">
                              <ul class="topbar-right">
                                   <li class="login-register">
                                        <i class="fa fa-sign-in"></i>
                                        <a href="{{url('login')}}">
                                             Masuk
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Topbar Area End -->

          <!-- Menu Start -->
          <div class="menu-area menu-sticky">
               <div class="container">
                    <div class="row y-middle">
                         <div class="col-lg-3">
                              <div class="logo-cat-wrap">
                                   <div class="logo-part pr-90">
                                        <a class="dark-logo" href="index.html">
                                             <img class="normal-logo" src="{{ url('show-file/logo/'.@$logo->logo_utama) }}">
                                        </a>
                                        <a class="light-logo" href="index.html">
                                             <img class="normal-logo" src="{{ url('show-file/logo/'.@$logo->logo_utama) }}">
                                        </a>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-9 text-right">
                              <div class="rs-menu-area">
                                   <div class="main-menu">
                                        @include('template.education.includes.sidebar')
                                   </div> <!-- //.main-menu -->
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Menu End -->
     </header>
     <!--Header End-->
</div>
<!--Full width header End-->
