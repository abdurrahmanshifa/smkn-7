 <!-- Latest Events Section Start -->
@php
     $pegawai = App\Helpers\FunctionHelper::pegawai();
@endphp
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
               <div id="rs-team" class="rs-team style1 orange-color pt-94 pb-100 md-pt-64 md-pb-70 white-bg">
                    <div class="row">
                         @foreach($pegawai as $val)
                         <div class="col-lg-5 col-sm-6 mb-30">
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
     </div>
</div>
<!-- Blog Section End -->  