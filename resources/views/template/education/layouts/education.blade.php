@php
    $kontak = App\Helpers\FunctionHelper::lokasi();
    $logo = App\Helpers\FunctionHelper::logo();
@endphp
<!DOCTYPE html>
<html lang="zxx">  
    <head>
        <!-- meta tag -->
        <meta charset="utf-8">
        @yield('title')
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('template.education.includes.head')
    </head>
    <body class="defult-home">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader orange-color">
            <div class="loader-container">
                <div class='loader-icon'>
                    <img src="{{ asset('educavo') }}/images/pre-logo1.png" alt="">
                </div>
            </div>
        </div>
        <!--Preloader area End here--> 

		<!-- Main content Start -->
        <div class="main-content">
            @include('template.education.includes.navbar')

            @yield('slider')                

            @yield('content')
     
        </div> 
        <!-- Main content End -->

        @include('template.education.includes.footer')

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->
        <script>
            var URL = '{{ url("/") }}';
        </script>
        @include('template.education.includes.javascript')
        @yield('footscript')
    </body>
</html>