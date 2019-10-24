<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}">
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
        .orange{
            background-color: orange;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            color:black;
            border:black;
        }
        .red{
            background-color: red;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            border:black;
        }
        .green{
            background-color: green;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            border:black;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        body.modal-open div.modal-backdrop { 
            display:none; 
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
    <style>
        .content input[type="search"] {
            width:200px;
        }      
        .dataTables_filter {
            float: right;
            padding-right: 50px;
        }
        .dataTables_length {
            padding-left: 5px;
        }
        .pagination
        {
            float: right;
        }
        .logo1
        {
            color: white;
        }
        .logo1:hover
        {
            cursor : pointer;
            color: #FFFFFF;
            opacity: 1;
            background: rgba(255, 255, 255, 0.23);
            
        }
        /* The alert message box */
        
        /* The close button */
    </style>    
    <script src="{{ asset('/login_css/jquery.js')}}"></script>
    <script src="{{ asset('/login_css/choosen.js')}}"></script>
</head>
<body >
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    <div class="wrapper">
        <div class="sidebar"  data-image="{{ asset('/login_css/assets/img/sidebar-6.jpg')}}">
            <div class="sidebar-wrapper">
                <a  href="{{ url('/') }}" class='logo1'  onclick = "show()">
                    <div class="logo">
                        <img class="rounded-circle" src="{{URL::asset('/images/front-logo.png')}}" alt="profile Pic" height="40" width="45" >
                        Travel Portal
                    </div>
                </a>
                <ul class="nav">
                    @if(Auth::user()->role =='2')
                    <li>
                        <a href="{{ url('/pending-request') }}"  onclick = "show()">
                            <i class="pe-7s-plane"></i>
                            <p>Pending Request </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/approved') }}"  onclick = "show()">
                            <i class="pe-7s-check"></i>
                            <p>Approved </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/cancelled-request') }}"  onclick = "show()">
                            <i class="pe-7s-close-circle"></i>
                            <p>Cancelled</p>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ url('/travel-history') }}">
                            <i class="pe-7s-note"></i>
                            <p>Travel History</p>
                        </a>
                    </li> --}}
                    @elseif(Auth::user()->role =='3')
                    <li>
                        <a href="{{ url('/pending-request') }}"  onclick = "show()">
                            <i class="pe-7s-plane"></i>
                            <p>Pending Request </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/for-approval') }}"  onclick = "show()">
                            <i class="pe-7s-timer"></i>
                            <p>For Approval </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/approved') }}"  onclick = "show()">
                            <i class="pe-7s-check"></i>
                            <p>Approved </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/cancelled-request') }}"  onclick = "show()">
                            <i class="pe-7s-close-circle"></i>
                            <p>Cancelled</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/approved-history') }}"  onclick = "show()">
                            <i class="pe-7s-science"></i>
                            <p>Approved History</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/disapproved-history') }}"  onclick = "show()">
                            <i class="pe-7s-science"></i>
                            <p>Disapproved History</p>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ url('/travel-history') }}">
                            <i class="pe-7s-note"></i>
                            <p>Travel History</p>
                        </a>
                    </li> --}}
                    @elseif(Auth::user()->role =='1')
                    <li>
                        <a href="{{ url('/request') }}"  onclick = "show()">
                            <i class="pe-7s-plane"></i>
                            <p>All Request</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company-list') }}"  onclick = "show()">
                            <i class="pe-7s-note2"></i>
                            <p>Company List</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/destination-list') }}"  onclick = "show()">
                            <i class="pe-7s-note2"></i>
                            <p>Destination List</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/employee-list') }}"  onclick = "show()">
                            <i class="pe-7s-id"></i>
                            <p>Employee List</p>
                        </a>
                    </li>
                   
                    @endif
                    {{-- <li>
                        <a href="{{ url('/change-password') }}">
                            <i class="pe-7s-tools"></i>
                            <p>Change Password</p>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ url('/user-account') }}"  onclick = "show()">
                            <i class="pe-7s-id"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"  onclick="show(); logout();" >
                            <i class="pe-7s-cloud-upload"></i>
                            <p>Log Out</p>
                        </a>
                        @if(Auth::user())
                        <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--   Core JS Files   -->
                    <script src="{{ asset('/inside_css/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
                    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
                    <script src="{{ asset('/inside_css/assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
                    <script src="{{ asset('/login_css/jquery.js')}}"></script>
                    <script src="{{ asset('/login_css/choosen.js')}}"></script> 
                    @yield('content')
                    <script type = "text/javascript">
                        function show() {
                            document.getElementById("myDiv").style.display="block";
                        }
                        function logout(){
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        }
                    </script>
                </body>
                </html>
                