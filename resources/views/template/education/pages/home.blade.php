 <!-- Latest Events Section Start -->
 @php
     $event = App\Helpers\FunctionHelper::event();
     $profil = App\Helpers\FunctionHelper::profil();
     $artikel = App\Helpers\FunctionHelper::artikel();
     $pegawai = App\Helpers\FunctionHelper::pegawai();
     $galeri_foto = App\Helpers\FunctionHelper::foto();
     $tngApp = App\Helpers\FunctionHelper::tentangAplikasi();
     $jml = App\Helpers\FunctionHelper::jmlOrg();
     $jurusan = App\Helpers\FunctionHelper::jurusan();
     $ppdb = App\Helpers\FunctionHelper::informasiPpdb();
@endphp
<!-- About Section Start -->
<div id="rs-about" class="rs-about style2 pt-94 pb-100 md-pt-64 md-pb-70">
     <div class="container">
          <div class="row">
               <div class="col-lg-5 pr-65 md-pr-15 md-mb-50">
                    <div class="about-intro">
                         <div class="sec-title mb-40 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                              <h2 class="title mb-21 white-color">
                                   {{$tngApp->judul}}
                              </h2>
                              <div class="desc big white-color">
                                   {{$tngApp->get_desc}}
                              </div>
                         </div>
                         <div class="btn-part wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms">
                              <a class="readon2" href="{{ url('tentang/'.$tngApp->id) }}">Selangkapnya</a>
                         </div>
                    </div>
               </div>
               <div class="col-lg-7 lg-pl-0 ml--25 md-ml-0">
                    <div class="row rs-counter couter-area mb-40">
                         <div class="col-md-4">
                              <div class="counter-item one">
                                   <h2 class="number rs-count">
                                        {{$jml->siswa}}
                                   </h2>
                                   <h4 class="title mb-0">Siswa</h4>
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="counter-item two">
                              <h2 class="number rs-count">
                                   {{$jml->guru}}
                              </h2>
                              <h4 class="title mb-0">Guru</h4>
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="counter-item three">
                              <h2 class="number rs-count">
                                   {{$jml->staff}}
                              </h2>
                              <h4 class="title mb-0">Staff</h4>
                              </div>
                         </div>
                    </div>
                    <div class="row grid-area">
                         <div class="col-md-6 sm-mb-30">
                              <div class="image-grid">
                              <img src="{{ asset('educavo')}}/images/about/style2/grid1.jpg" alt="">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="image-grid">
                              <img src="{{ asset('educavo')}}/images/about/style2/grid2.jpg" alt="">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- About Section End -->

<!-- Degree Section Start -->
<div class="rs-degree style1 modify gray-bg pt-100 pb-70 md-pt-70 md-pb-40">
     <div class="container">
          <div class="row y-middle">
               <div class="col-lg-4 col-md-6 mb-30">
                    <div class="sec-title wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                         <div class="sub-title primary">Program Keahlian</div>
                         <h2 class="title mb-0">Beberapa Program Keahlian Yang Ada di Sekolah Ini</h2>
                    </div>
               </div>
               @foreach($jurusan as $val)
               <div class="col-lg-4 col-md-6 mb-30">
                    <div class="degree-wrap">
                         <img src="{{ asset('storage/jurusan')}}/{{$val->cover}}" alt="">
                         <div class="title-part">
                              <h4 class="title">{{$val->judul}}</h4>
                         </div>
                         <div class="content-part">
                              <h4 class="title">
                                   <a href="{{ url('jurusan/'.$val->id.'-'.$val->judul_slug) }}">
                                        {{$val->judul}}
                                   </a>
                              </h4>
                              <p class="desc">
                                   {{ $val->get_desc }}
                              </p>
                              <div class="btn-part">
                                   <a href="{{ url('jurusan/'.$val->id.'-'.$val->judul_slug) }}">
                                        Selengkapnya
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
               @endforeach
          </div>
     </div>
</div>
<!-- Degree Section End -->

@if($ppdb != null)
     <!-- CTA Section Start -->
     <div class="rs-cta style2">
          <div class="partition-bg-wrap home2" style="--bg-right: url({{ asset('storage/ppdb/'.$ppdb->bg_light)}});--bg-left: url({{ asset('storage/ppdb/'.$ppdb->bg_dark)}});">
               <div class="container">
                    <div class="row y-bottom">
                         <div class="col-lg-6 pb-50 md-pt-100 md-pb-100">
                              @if($ppdb->video_tutorial  != null)
                              <div class="video-wrap">
                                   <a class="popup-videos" href="{{ $ppdb->video_tutorial }}">
                                        <i class="fa fa-play"></i>
                                        <h4 class="title mb-0"><br>Play Video</h4>
                                   </a>
                              </div>
                              @endif
                         </div>
                         <div class="col-lg-6 pl-62 pt-134 pb-150 md-pl-15 md-pt-45 md-pb-50">
                              <div class="sec-title mb-40 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                                   <h2 class="title mb-16">{{ $ppdb->judul }}</h2>
                                   <div class="desc">
                                        @php echo $ppdb->deskripsi; @endphp
                                   </div>
                              </div>
                              <div class="btn-part wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms">
                                   <a class="readon2" href="{{ $ppdb->url }}">Selengkapnya</a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- CTA Section End -->
@endif

<!-- Latest Events Section Start -->
<div class="rs-latest-events style1 bg-wrap pt-100 md-pt-70 md-pb-70">
     <div class="container">
          <div class="row">
               <div class="col-lg-6 pr-65 pt-24 md-pt-0 md-pr-15 md-mb-30">
                    <div class="sec-title mb-42">
                         <div class="sub-title primary">Event Terbaru</div>
                         <h2 class="title mb-0">Daftar Kegiatan Event</h2>
                    </div>
                    <div class="single-img wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                         <img src="{{ asset('storage/event/'.$event[0]->foto)}}" alt="Event Image">
                    </div>
               </div>
               <div class="col-lg-6 lg-pl-0">
                    <div class="event-wrap">
                         @foreach($event as $val)
                         <div class="events-short mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                              <div class="date-part bgc1">
                                   @php 
                                   $tgl = explode('-', $val->tanggal_mulai);
                                   $hari = explode(' ',$tgl[2]);
                                   @endphp
                                   <span class="month">{{  strtoupper(App\Helpers\DateHelper::bulanSingkatInd($tgl[1])) }}</span>
                                   <div class="date">{{ $hari[0] }}</div>
                              </div>
                              <div class="content-part">
                                   <div class="categorie">
                                        <a href="#"> Event </a>
                                   </div>
                                   <h4 class="title mb-0">
                                        <a href="#">
                                             {{ @$val->nama }}
                                        </a>
                                   </h4>
                              </div>
                         </div>
                         @endforeach
                    </div>
               </div>
          </div>
     </div>
</div>
     <!-- Latest Events Section End -->

<!-- Blog Section Start -->
<div id="rs-blog" class="rs-blog main-home pb-100 pt-100 md-pt-70 md-pb-70">
     <div class="container">  
          <div class="sec-title3 text-center mb-50">
               <div class="sub-title"> Informasi </div>
               <h2 class="title">Berita & Pengumuman Terbaru</h2>
          </div>
          <div class="row mb-35">
               @foreach($artikel as $val)
               <div class="col-md-4 mb-50">
                    <div class="blog-item">
                         <div class="image-part" style="height:400px;background: url({{url('storage/artikel/'.$val->cover)}});background-repeat: no-repeat;background-size: cover;background-position: center;">
                         </div>
                         <div class="blog-content">
                              <ul class="blog-meta">
                                   <li>
                                        <i class="fa fa-user-o"></i> {{ $val->user->name }}
                                   </li>
                                   <li>
                                        <i class="fa fa-calendar"></i>  {{ App\Helpers\DateHelper::tglIndSingkat($val->tanggal) }}
                                   </li>
                              </ul>
                              <h3 class="title">
                                   <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}" title="{{ $val->judul }}">
                                        {{ $val->get_judulartikelsmall }}
                                   </a>
                              </h3>
                              <div class="desc" style="text-align:justify">
                                   {{$val->get_desc}}
                              </div>
                              <div class="btn-btm">
                                   <div class="cat-list">
                                        <ul class="post-categories">
                                             <li><a href="{{ url('kategori/'.$val->kategori->id) }}">{{$val->kategori->name}}</a></li>
                                        </ul>
                                   </div>
                                   <div class="rs-view-btn">
                                        <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}">Selengkapnya <i class="icon-angle-right"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div> 
               </div>
               @endforeach
          </div>
     </div>
</div>
<!-- Blog Section End -->

<!-- Events Section Start -->
<div class="rs-gallery pb-100 md-pt-70 md-pb-70">
     <div class="container">
          <div class="sec-title3 text-center mb-50">
               <div class="sub-title"> Gallery </div>
               <h2 class="title">Gallery Kegiatan Terbaru</h2>
          </div>
          <div class="row mb-35">
               @foreach($galeri_foto as $key => $val)
               <div class="col-lg-4 mb-30 col-md-6">
                    <div class="gallery-img">
                         <a class="image-popup"  href="{{ asset('storage/galeri-foto/'.$val->foto)}}">
                              <div  style="height:400px;background: url({{ asset('storage/galeri-foto/'.$val->foto)}});background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                         </a>
                    </div>
               </div>
               @endforeach
          </div>
     </div> 
</div>
<!-- Events Section End -->  