@php
     $banner = App\Helpers\FunctionHelper::banner(3);
     $tautan = App\Helpers\FunctionHelper::tautan(4);
@endphp
<!-- Slider Section Start -->
<div class="rs-slider style1">
     <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
          @foreach($banner as $key => $val)
               <div class="slider-content" style="background: url({{ asset('storage/banner/'.$val->images)}});background-size: cover;background-position: center;background-repeat: no-repeat;">
                    <div class="container">
                         <h1 class="sl-title white-color wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms">
                              @if($val->judul != null)
                                   {{$val->judul}}
                              @endif
                         </h1>
                         <div class="sl-sub-title white-color wow bounceInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
                              @if($val->deskripsi != null)
                                   {{ $val->deskripsi }}
                              @endif
                         </div>
                         @if($val->link != null)
                              <div class="sl-btn wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                                   <a class="readon2 banner-style" target="_blank" href="{{$val->link}}">Selengkapnya</a>
                              </div>
                         @endif
                    </div>
               </div>
          @endforeach
     </div>
</div>
<!-- Slider Section End -->

<!-- Services Section Start -->
<div class="rs-services style1">
     <div class="row no-gutter">
          @foreach($tautan as $val)
               <div class="col-lg-3 col-md-6">
                    <div class="service-item overly" style="--my-color-var: {{$val->bg_color}};">
                         <img src="{{ asset('storage/tautan/bg')}}/{{$val->bg_img}}" alt="">
                         <div class="content-part">
                              <img src="{{ asset('storage/tautan/icon')}}/{{$val->icon}}" alt="">
                              <h4 class="title"><a href="{{$val->url}}">{{ $val->judul }}</a></h4>
                         </div>
                    </div>
               </div>
          @endforeach
     </div>
</div>
<!-- Services Section End -->  