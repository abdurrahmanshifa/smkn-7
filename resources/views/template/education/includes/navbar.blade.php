<!--Full width header Start-->
<div class="full-width-header home8-style4 main-home">
     <!--Header Start-->
     <header id="rs-header" class="rs-header">
          <!-- Menu Start -->
          <div class="menu-area menu-sticky ">
               <div class="container">
                    <div class="row y-middle">
                         <div class="col-lg-2">
                              <div class="logo-cat-wrap">
                              <div class="logo-part">
                                   <a href="{{ url('/') }}">
                                        <img class="normal-logo" src="{{ url('show-file/logo/'.@$logo->logo_utama) }}">
                                        <img class="sticky-logo" src="{{ url('show-file/logo/'.@$logo->logo_utama) }}">
                                   </a>
                              </div>
                              </div>
                         </div>
                         <div class="col-lg-10 text-right">
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

          <!-- Canvas Menu start -->
          <nav class="right_menu_togle hidden-md">
               <div class="close-btn">
                    <div id="nav-close">
                         <div class="line">
                              <span class="line1"></span><span class="line2"></span>
                         </div>
                    </div>
               </div>
               <div class="canvas-logo">
                    <a href="index.html"><img src="{{ asset('educavo') }}/images/dark-logo.png" alt="logo"></a>
               </div>
               <div class="offcanvas-text">
                    <p>We denounce with righteous indige nationality and dislike men who are so beguiled and demo  by the charms of pleasure of the moment data com so blinded by desire.</p>
               </div>
               <div class="offcanvas-gallery">
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/1.jpg"><img src="{{ asset('educavo') }}/images/gallery/1.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/2.jpg"><img src="{{ asset('educavo') }}/images/gallery/2.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/3.jpg"><img src="{{ asset('educavo') }}/images/gallery/3.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/4.jpg"><img src="{{ asset('educavo') }}/images/gallery/4.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/5.jpg"><img src="{{ asset('educavo') }}/images/gallery/5.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                         <a class="image-popup" href="{{ asset('educavo') }}/images/gallery/6.jpg"><img src="{{ asset('educavo') }}/images/gallery/6.jpg" alt=""></a>
                    </div>
               </div>
               <div class="map-img">
                    <img src="{{ asset('educavo') }}/images/map.jpg" alt="">
               </div>
               <div class="canvas-contact">
                    <ul class="social">
                         <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                         <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                         <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
               </div>
          </nav>
          <!-- Canvas Menu end -->
     </header>
     <!--Header End-->
</div>
<!--Full width header End-->