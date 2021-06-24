 <!-- Latest Events Section Start -->
@php 
     $download = App\Helpers\FunctionHelper::download();
     $i=1;
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
          <div class="col-lg-8  md-mb-50">
               <div class="intro-section pt-94 pb-100 md-pt-64 md-pb-70">
                    <div class="intro-info-tabs">
                         <div class="tab-content tabs-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="prod-faq" role="tabpanel" aria-labelledby="prod-faq-tab">
                                   <div class="content">
                                        <div id="accordion3" class="accordion-box">
                                             <div class="card accordion block">
                                                  <div class="card-header" id="headingSeven">
                                                       <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                                                 File Management
                                                            </button>
                                                       </h5>
                                                  </div>

                                                  <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordion3">
                                                       <div class="card-body acc-content current">
                                                            @foreach($download as $val)
                                                            <div class="content">
                                                                 <div class="clearfix">
                                                                      <div class="pull-left">
                                                                           <a class="play-icon" href=" {{ url('download/'.$val->id) }}" target="_blank">
                                                                                <i class="fa fa-download"></i>
                                                                                {{ $val->name }}
                                                                           </a>
                                                                           <p style="margin-left:57px;">
                                                                                {{$val->keterangan}}
                                                                           </p>
                                                                      </div>
                                                                      <div class="pull-right">
                                                                           <div class="minutes">
                                                                                {{ $val->download}} Download
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            @endforeach
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>                                              
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Blog Section End -->  