<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs breadcrumbs-overlay">
     <div class="breadcrumbs-img">
     <img src="{{ asset('educavo') }}/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
     </div>
     <div class="breadcrumbs-text white-color">
     <h1 class="page-title">DETAIL {{ strtoupper(strtolower(str_replace('-',' ',$page))) }}</h1>
     <ul>
          <li>
               <a class="active" href="{{ url('/') }}">BERANDA</a>
          </li>
          <li>{{ strtoupper(strtolower(str_replace('-',' ',$page))) }}</li>
          <li>{{ strtoupper($detail->judul) }}</li>
     </ul>
     </div>
</div>
<!-- Breadcrumbs End -->