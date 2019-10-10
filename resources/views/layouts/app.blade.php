<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/login_css/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="{{ asset('/login_css/assets/css/animate.min.css')}}" rel="stylesheet'"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('/login_css/assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('/login_css/assets/css/demo.css')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ asset('/login_css/assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link href="{{ asset('/login_css/style.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('/login_css/jquery-2.1.1.min.js')}}"></script>
    <script src="{{ asset('/login_css/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('jquery.min.js')}}"></script>
    
    <style>
        .content input[type="search"] {
            width:300px;
        }      
        .dataTables_filter {
            float: right;
        }
        .pagination
        {
            float: right;
        }
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
            background-size:200px 120px;
        }
    </style>
    <script src="{{ asset('/login_css/jquery.js')}}"></script>
    <script src="{{ asset('/login_css/choosen.js')}}"></script>
</head>
<body>
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    <div class="wrapper">
        @yield('content')
    </div>
    <script type = "text/javascript">
        function show() {
            document.getElementById("myDiv").style.display="block";
        }
    </script>
    <script src="{{ asset('/inside_css/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ asset('/inside_css/assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
</body>
</html>
