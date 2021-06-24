 <!-- Latest Events Section Start -->
@php
     $kontak = App\Helpers\FunctionHelper::lokasi(); 
@endphp
<!-- Contact Section Start -->
<div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
     <div class="container">
          <div class="row contact-address-section">
               <div class=" col-lg-4 col-md-12 lg-pl-0 md-mb-30">
                    <div class="contact-info contact-address">
                         <div class="icon-part">
                              <i class="fa fa-map-marker"></i>
                         </div>
                         <div class="content-part" style="overflow: overlay;">
                              <h5 class="info-subtitle">Alamat</h5>
                              <h5 class="info-title" title="{{$kontak->alamat}}">
                                   {{$kontak->alamat}}
                              </h5>
                         </div>
                    </div>
               </div>
               <div class=" col-lg-4 col-md-12 md-mb-30">
                    <div class="contact-info contact-mail">
                         <div class="icon-part">
                              <i class="fa fa-envelope-o"></i>
                         </div>
                         <div class="content-part" style="overflow: overlay;">
                              <h5 class="info-subtitle">Email</h5>
                              <h5 class="info-title" title="{{$kontak->email}}">
                                   {{$kontak->email}}
                              </h5>
                         </div>
                    </div>
               </div>
               <div class=" col-lg-4 col-md-12 lg-pr-0">
                    <div class="contact-info contact-phone">
                         <div class="icon-part">
                              <i class="fa fa-user-o"></i>
                         </div>
                         <div class="content-part" style="overflow: overlay;">
                              <h5 class="info-subtitle">Nomor Telepon</h5>
                              <h5 class="info-title" title="{{$kontak->telp}}">
                                   {{$kontak->telp}}
                              </h5>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-5 md-mb-30">
                    <div class="contact-map2">
                         <iframe src="https://maps.google.com/maps?q={{$kontak->lat}},{{$kontak->long}}&hl=es&z=14&amp;output=embed"
                         >
                         </iframe>
                    </div>
               </div>
               <div class="col-lg-7 pl-30 lg-pl-15">
                    <div class="rs-quick-contact new-style">
                         <div class="inner-part mb-50">
                              <h2 class="title mb-15">Saran & Pesan</h2>
                              <p>Sampaikan saran dan pesan kepada kami. </p>
                         </div>
                         <div id="form-messages"></div>
                         <form id="contact-form" method="post">
                              <div class="row">
                              <div class="col-lg-6 mb-35 col-md-12">
                                   <input class="from-control" type="text" id="name" name="name" placeholder="Nama Lengkap" required="">
                              </div> 
                              <div class="col-lg-6 mb-35 col-md-12">
                                   <input class="from-control" type="text" id="email" name="email" placeholder="Alamat Email" required="">
                              </div>   
                              <div class="col-lg-6 mb-35 col-md-12">
                                   <input class="from-control" type="text" id="phone" name="phone" placeholder="Nomor Telepon" required="">
                              </div>   
                              <div class="col-lg-6 mb-35 col-md-12">
                                   <input class="from-control" type="text" id="subject" name="subject" placeholder="Subjek" required="">
                              </div>
                              
                              <div class="col-lg-12 mb-50">
                                   <textarea class="from-control" id="message" name="message" placeholder="Pesan" required=""></textarea>
                              </div>
                              </div>
                              <div class="form-group mb-0">
                                   <input class="btn-send" type="button" value="Kirim">
                              </div>       
                         </form>
                    </div>
               </div> 
          </div>
     </div>
     </div>
     <!-- Contact Section End --> 