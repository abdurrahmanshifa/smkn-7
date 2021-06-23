<!-- Footer Start -->
@php
     $populer = App\Helpers\FunctionHelper::artikelPopuler(2);
     $pengumuman = App\Helpers\FunctionHelper::artikelPengumuman(2);
@endphp
<footer id="rs-footer" class="rs-footer home9-style main-home">
     <div class="footer-top">
          <div class="container">
          <div class="row">
               <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <div class="footer-logo mb-30">
                         <a href="javascript:void(0);">
                              <img src="{{ url('show-file/logo/'.$logo->logo_alt) }}">
                         </a>
                    </div>
               </div>
               <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <h3 class="widget-title">Alamat</h3>
                    <ul class="address-widget">
                         <li>
                              <i class="flaticon-location"></i>
                              <div class="desc">
                              {{ $kontak->alamat }}
                              </div>
                         </li>
                         <li>
                              <i class="flaticon-call"></i>
                              <div class="desc">
                              <a href="javascript:void(0);">{{ @$kontak->telp }} - {{ @$kontak->fax }}</a>
                              </div>
                         </li>
                         <li>
                              <i class="flaticon-email"></i>
                              <div class="desc">
                              <a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a>
                              </div>
                         </li>
                    </ul>
               </div>
               <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">Berita Populer</h3>
                    @foreach($populer as $val)
                         <div class="recent-post mb-20 md-pb-0">
                              <div class="post-img" style="height:70px;width:70px;background: url({{url('storage/artikel/'.$val->cover)}});background-repeat: no-repeat;background-size: cover;background-position: center;margin-right: 15px;">
                              </div>
                              <div class="post-item">
                                   <div class="post-desc">
                                        <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}" title="{{ $val->judul }}">
                                             {{ $val->get_judulartikel }}
                                        </a>
                                   </div>
                                   <span class="post-date">
                                        <i class="fa fa-calendar"></i>
                                        {{ App\Helpers\DateHelper::tglIndSingkat($val->tanggal) }}
                                   </span>
                              </div>
                         </div> 
                    @endforeach
               </div>
               <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">Pengumuman Terbaru</h3>
                    @foreach($pengumuman as $val)
                         <div class="recent-post mb-20 md-pb-0">
                              <div class="post-img" style="height:70px;width:70px;background: url({{url('storage/artikel/'.$val->cover)}});background-repeat: no-repeat;background-size: cover;background-position: center;margin-right: 15px;">
                              </div>
                              <div class="post-item">
                                   <div class="post-desc">
                                        <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}" title="{{ $val->judul }}">
                                             {{ $val->get_judulartikel }}
                                        </a>
                                   </div>
                                   <span class="post-date">
                                        <i class="fa fa-calendar"></i>
                                        {{ App\Helpers\DateHelper::tglIndSingkat($val->tanggal) }}
                                   </span>
                              </div>
                         </div> 
                    @endforeach
               </div>
          </div>
          </div>
     </div>
     <div class="footer-bottom">
          <div class="container">                    
          <div class="row y-middle">
               <div class="col-lg-6 md-mb-20">
                    <div class="copyright">
                         <p>&copy; PT Sysable Teknologi Indonesia</p>
                    </div>
               </div>
          </div>
          </div>
     </div>
</footer>
<!-- Footer End -->