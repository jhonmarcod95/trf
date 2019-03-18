<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
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
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            font-family: 'Nunito', sans-serif;  
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-image: url("{{ asset('/images/background2.jpg')}}");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            color:white;
            margin:25px;
            width: 700px;
        }
        .background-color{
            background:rgba(1,1,1,0.5);
        }
        .title {
            font-size: 35px;
        }
        .form-control {
            border-radius: 7px;
            border: 2px solid #73AD21;
            padding: 7px; 
            width: 200px;
            color:black;
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
        .chosen-search
        {
            color:black;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
    
</head>
<body>
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    
    <div class="flex-center position-ref full-height">
        
        <div class="content background-color">
            @include('error')
            @if(session()->has('status'))
            <div class='row col-md-12'>
                <div class="alert alert-success fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>  {{session()->get('status')}}</strong>
                </div>
            </div>
            @endif
            @if(session()->has('notstatus'))
            <div class='row col-md-12'>
                <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>  {{session()->get('notstatus')}}</strong>
                </div>
            </div>
            @endif
            <form  method="POST" action="">
                {{ csrf_field() }}
                <div class="content">
                                <div class="row">
                                    <div class="col-md-12" style='text-align:center;padding-bottom:10px;'>
                                        <span class='title' >Sign Up<span>
                                        </div>
                                    </div>
                                    <div class="row border">
                                        <div class="col-md-3 border">
                                            <div class="form-group">
                                                E-Mail
                                                <input id="email" type="email" class="form-control border" name="email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Employee ID
                                                <input id="employee_id" type="text" class="form-control" name="employee_id"   value="{{ old('employee_id') }}" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Name
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Approver
                                                <select  name='approver'  class="chosen form-control" width='100%'   required>
                                                    <option value=''>Select Approver</option>
                                                    @foreach($accounts as $account)
                                                    <option value='{{$account->id}}'{{ (old('approver') == $account->id ? "selected":"") }}>{{$account->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Contact Number
                                                <input id="contact_number"  type="number" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Birth Date
                                                <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Company
                                                <select  name='company_name' style='width:200px'   class="chosen form-control"  required>
                                                    <option value=''></option>
                                                    @foreach($companies as $company)
                                                    <option value='{{$company->id}}' {{ (old('company_name') == $company->id ? "selected":"") }}>{{$company->company_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Department
                                                <select  name='department' style='width:200px'   class="chosen form-control"  required>
                                                    <option value=''></option>
                                                    @foreach($departments as $department)
                                                    <option value='{{$department->id}}' {{ (old('department') == $department->id ? "selected":"") }}>{{$department->department_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">Password
                                                <input id="password" type="password" class="form-control" name="password" required>
                                                <p style="font-size:9px;color:red;width:200px;background-color:white;border-radius: 7px;padding:5px">Passwords must be at least 8 characters long.
                                                    <br>Passwords must contain:
                                                    <br> minimum of 1 lower case letter [a-z] 
                                                    <br> minimum of 1 upper case letter [A-Z] 
                                                    <br> minimum of 1 numeric character [0-9]
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Confirm Password
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5" style='float:center;margin-left:25px;'>
                                            <div class="form-group">
                                                <a style='margin-left:5px'  class="btn btn-danger btn-fill pull-right" href="{{ url('/') }}" onclick = "show()">Home </a>
                                                <button type="submit" class="btn btn-info btn-fill pull-right" >Register </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="{{ asset('/inside_css/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
                    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
                    <script src="{{ asset('/inside_css/assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
                    <script src="{{ asset('/login_css/jquery.js')}}"></script>
                    <script src="{{ asset('/login_css/choosen.js')}}"></script> 
                    <script type = "text/javascript">
                        function show()
                        {
                            document.getElementById("myDiv").style.display="block";
                        }
                        function logout()
                        {
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        }
                    </script>
                    <script >
                        $(".chosen").chosen();
                    </script>
                </div>
            </form>
        </div>
    </body>
    </html>
    