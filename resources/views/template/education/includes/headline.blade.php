<!-- Breadcrumbs Start -->
@php 
     $kategori = App\Helpers\FunctionHelper::detailkategori($id);
@endphp
<div class="rs-breadcrumbs breadcrumbs-overlay">
     <div class="breadcrumbs-img">
     <img src="{{ asset('educavo') }}/images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
     </div>
     <div class="breadcrumbs-text">
     <h1 class="page-title">
          @if(isset($kategori))
               @php 
                    echo @$kategori->name;
               @endphp
          @else 
               {{ strtoupper(strtolower(str_replace('-',' ',$page))) }}
          @endif
     </h1>
     <ul>
          <li>
               <a class="active" href="{{ url('/') }}">BERANDA</a>
          </li>
          
               @if(isset($kategori))
                    <li>
                         <a class="active" href="javascript:void(0);"> KATEGORI </a>
                    </li>
                    <li>
                         {{ $kategori->name }}
                    </li>
               @else 
                    <li>
                         {{ strtoupper(strtolower(str_replace('-',' ',$page))) }}
                    </li>
               @endif
          
     </ul>
     </div>
</div>
<!-- Breadcrumbs End -->