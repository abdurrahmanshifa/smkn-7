<div class="mobile-menu">
     <a class="rs-menu-toggle">
     <i class="fa fa-bars"></i>
     </a>
</div>
<nav class="rs-menu">
     <ul class="nav-menu">
          @php
               print \App\Helpers\MenuHelper::menu(0,$h="");
          @endphp
     </ul> <!-- //.nav-menu -->
</nav>  