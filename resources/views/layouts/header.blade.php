<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/css/main.css')}}">
	<script src="{{ asset('jquery.min.js')}}"></script>
	<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none; 
			margin: 0; 
		}
		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
			opacity: .8;
		}
	</style>
</head>
<body>
	<div id = "myDiv" style="display:none;" class="loader">
	</div>
	@yield('content')
	
	
	<div id="dropDownSelect1"></div>
	<script type = "text/javascript">
		function show() {
			document.getElementById("myDiv").style.display="block";
		}
	</script>
	<script src="{{ asset('/login_css/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{ asset('/login_css/js/main.js')}}"></script>
</body>
</html>


