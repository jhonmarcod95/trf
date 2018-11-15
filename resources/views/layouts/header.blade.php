<!DOCTYPE html>
<html lang="en">
<head>
	<title>LFUGGOC</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/login_css/css/main.css')}}">
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
        }
    </style>
</head>
<body>
	
	@yield('content')
	
	
	<div id="dropDownSelect1"></div>
	

	<script src="{{ asset('/login_css/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{ asset('/login_css/js/main.js')}}"></script>
</body>
</html>
	

