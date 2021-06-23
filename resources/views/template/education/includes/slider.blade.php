<!-- Slider Section Start -->
<div class="rs-slider main-home">
     <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
          @php
               $banner = App\Helpers\FunctionHelper::banner(3);
          @endphp
          @foreach($banner as $key => $val)
          <div class="slider-content" style="background: url({{ asset('storage/banner/'.$val->images)}});background-size: cover;background-position: center;background-repeat: no-repeat;">
               <div class="container">
                    <div class="content-part">
                         <div class="content-bg">
                              @if($val->judul != null)
                                   <div class="sl-sub-title">
                                        {{$val->judul}}
                                   </div>
                              @endif
                              @if($val->deskripsi != null)
                                   <p class="sl-title">
                                        {{ $val->deskripsi }}
                                   </p>
                              @endif
                              @if($val->link != null)
                                   <div class="sl-btn">
                                        <a class="readon orange-btn main-home" style="font-size:12px;" href="{{$val->link}}">Selengkapnya</a>
                                   </div>
                              @endif
                         </div>
                    </div>
               </div>
          </div>
          @endforeach
     </div>
</div>
<!-- Slider Section End -->    