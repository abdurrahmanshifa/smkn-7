 <!-- Latest Events Section Start -->
 @php
     $galeri_foto = App\Helpers\FunctionHelper::foto();
     $detail = App\Helpers\FunctionHelper::detail_jurusan($id[0]);
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
               <div id="rs-team" class="rs-team style1 orange-color pt-94 pb-100 md-pt-64 md-pb-70 white-bg">
                    <div class="row">
                         
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Blog Section End -->  