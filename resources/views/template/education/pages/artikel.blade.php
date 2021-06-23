 <!-- Latest Events Section Start -->
 @php
     $artikel = App\Helpers\FunctionHelper::artikel();
@endphp
<!-- Blog Section Start -->
<div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
     <div class="container">
          <div class="row">
               <div class="col-lg-4 col-md-12 order-last">
                    @include('template.education.includes.widget')
               </div>
               <div class="col-lg-8 pr-50">
                    <div class="row">
                         @foreach($artikel as $val)
                         <div class="col-lg-12 mb-70">
                              <div class="blog-item">
                                   <div class="blog-img" style="height:400px;background: url({{url('storage/artikel/'.$val->cover)}});background-repeat: no-repeat;background-size: cover;background-position: center;">
                                   </div>
                                   <div class="blog-content">
                                        <h3 class="blog-title">
                                             <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}" title="{{ $val->judul }}">
                                                  {{ $val->get_judulartikelsmall }}
                                             </a>
                                        </h3>
                                        <div class="blog-meta">
                                             <ul class="btm-cate">
                                                  <li>
                                                       <div class="blog-date">
                                                            <i class="fa fa-calendar-check-o"></i> 
                                                            {{ App\Helpers\DateHelper::tglIndSingkat($val->tanggal) }}
                                                       </div>
                                                  </li>
                                                  <li>
                                                       <div class="author">
                                                       <i class="fa fa-user-o"></i> {{ $val->user->name }}  
                                                       </div>
                                                  </li>   
                                                  <li>
                                                       <div class="tag-line">
                                                            <i class="fa fa-book"></i>
                                                            <a href="{{ url('kategori/'.$val->kategori->id) }}">{{$val->kategori->name}}</a> 
                                                       </div>
                                                  </li>
                                             </ul>
                                        </div>
                                        <div class="blog-desc" style="text-align:justify">
                                             {{$val->get_desc}}                                 
                                        </div>
                                        <div class="blog-button">
                                             <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}">Selengkapnya <i class="icon-angle-right"></i></a>
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
     </div>
</div>
<!-- Blog Section End -->  