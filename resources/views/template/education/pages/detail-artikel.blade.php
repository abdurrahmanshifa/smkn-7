 <!-- Latest Events Section Start -->
 @php
     $detail = App\Helpers\FunctionHelper::detail_artikel($id[0]);
@endphp

@section('slider')
     @include('template.education.includes.headline-detail')
@endsection

<!-- Blog Section Start -->
<div class="container">
     <div class="row">
          <div class="col-lg-4 col-md-12 order-last">
               <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
                    <div class="row">
                         @include('template.education.includes.widget')
                    </div> 
               </div>
          </div>
          <div class="col-lg-8 pr-50">
               <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
                    <div class="blog-deatails">
                         <div class="bs-img">
                              <a href="javascript:void(0);">
                                   <img src="{{url('storage/artikel/'.$detail->cover)}}" alt="">
                              </a>
                         </div>
                         <div class="blog-full">
                              <ul class="single-post-meta">
                                   <li>
                                        <span class="p-date"> <i class="fa fa-calendar-check-o"></i> {{ App\Helpers\DateHelper::tglIndSingkat($detail->tanggal) }} </span>
                                   </li> 
                                   <li>
                                        <span class="p-date"> <i class="fa fa-user-o"></i> {{ $detail->user->name }} </span>
                                   </li> 
                                   <li class="Post-cate">
                                        <div class="tag-line">
                                             <i class="fa fa-book"></i>
                                             <a href="{{ url('kategori/'.$detail->kategori->id) }}">{{$detail->kategori->name}}</a>
                                        </div>
                                   </li>
                                   <li class="post-comment"> <i class="fa fa-eye"></i> {{ $detail->view }}</li>
                              </ul>
                              <h2 class="title mb-40">
                                   <a href="javascript:void(0);">{{ $detail->judul }}</a>
                              </h2>
                              <div class="blog-desc" style="text-align:justify">
                                   @php
                                        echo $detail->isi_artikel
                                   @endphp
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Blog Section End -->  