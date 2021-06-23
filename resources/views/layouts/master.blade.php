<!DOCTYPE html>
<html lang="en">
<head>
	@yield('title')
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	@include('includes.head')
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">
		<!-- navbar header -->
		@include('includes.navbar')
	
	<!--========== END app navbar -->

	@include('includes.sidebar')

	<!-- APP MAIN ==========-->
	<main id="app-main" class="app-main">
		<div class="wrap">
			@yield('content')
		</div><!-- .wrap -->
		<!-- APP FOOTER -->
		<div class="wrap p-t-0">
			@include('includes.footer')
		</div>
	<!-- /#app-footer -->
	</main>
	<!--========== END app main -->
	<!-- APP CUSTOMIZER -->
	@yield('modal')
	<script>
		var URL = '{{ url("/") }}';
	</script>
	<!-- build:js ../assets/js/core.min.js -->
	@include('includes.javascript')

	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		</script>
	@yield('script')
</body>
</html>