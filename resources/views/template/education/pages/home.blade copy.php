 <!-- Latest Events Section Start -->
 @php
     $event = App\Helpers\FunctionHelper::event(5);
     $profil = App\Helpers\FunctionHelper::profil();
     $artikel = App\Helpers\FunctionHelper::artikel();
     $pegawai = App\Helpers\FunctionHelper::pegawai();
     $galeri_foto = App\Helpers\FunctionHelper::foto();
@endphp
<!-- About Section Start -->
<div id="rs-about" class="rs-about bg-wrap pt-100 style1 orange-color pb-50 md-pb-70">
     <div class="container">
          <div class="row">
               <div class="col-lg-4 order-last">
                    <div class="notice-bord style1 orange-color">
                         <h4 class="title">Event</h4>
                         <ul>
                              @foreach($event as $val)
                                   <li class="">
                                        <div class="date">
                                             @php 
                                             $tgl = explode('-', $val->tanggal_mulai);
                                             $hari = explode(' ',$tgl[2]);
                                             @endphp
                                             <span>{{ $hari[0] }}</span> {{  strtoupper(App\Helpers\DateHelper::bulanSingkatInd($tgl[1])) }}
                                        </div>
                                        <div class="desc">
                                             {{ @$val->nama }}
                                        </div>
                                   </li>
                              @endforeach
                         </ul>
                    </div>
               </div>
               <div class="col-lg-8 pr-50 md-pr-15">
                    <div class="about-part">
                         <div class="sec-title mb-40">
                              <div class="sub-title primary ">
                                   {{ $profil->kategori->name}}
                              </div>
                              <h2 class="title ">
                              {{ $profil->judul}}
                              </h2>
                              <br>
                              <div class="desc ">
                                   @php echo $profil->isi_artikel; @endphp
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

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
               <div class="col-md-12">
                    <div id="pagination" class="pagination-area orange-color text-center mt-30 md-mt-0">
                         {{$artikel->links(('vendor.pagination.custom'))}}
                    </div>
               </div>
               
          </div>
     </div>
</div>
<!-- Blog Section End -->

<!-- Team Section Start -->
<div id="rs-team" class="rs-team style1 orange-color pt-94 pb-100 md-pt-64 md-pb-70 white-bg">
     <div class="container">  
          <div class="sec-title3 text-center mb-50">
               <div class="sub-title"> Pegawai </div>
               <h2 class="title">Staff & Guru</h2>
          </div>
          <div class="row mb-35">
               @foreach($pegawai as $val)
               <div class="col-lg-4 col-sm-6 mb-30">
                    <div class="team-item">
                         <div  style="height:400px;background: url({{ url('storage/pegawai/'.$val->foto) }});background-repeat: no-repeat;background-size: cover;background-position: top;"></div>
                         <div class="content-part">
                              <h4 class="name">
                                   <a href="javascript:void(0);">{{ $val->nama}}</a>
                              </h4>
                              <span class="designation">
                              {{ $val->datajabatan->name }}
                              </span>
                         </div>
                    </div>
               </div>
               @endforeach
          </div>
     </div>
</div>
<!-- Team Section End -->

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