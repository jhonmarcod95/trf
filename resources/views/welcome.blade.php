<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Laravel</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
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
            text-align: center;
            color:white;
            padding:50px;
        }
        .background-color{
            background:rgba(1,1,1,0.5);
            
        }
        
        .title {
            font-size: 84px;
        }
        
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 15px;
            border: 2px solid #73AD21;
            padding: 20px; 
            width: 200px;
            height: 150px; 
            color:white;
        }
        .links > a:hover {
            background-color: grey;
        }
        
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        
        
        <div class="content background-color">
            <div class="title m-b-md">
                Online Travel Portal 
            </div>
            
            <div class="links">
                <a href="{{ url('/new-request') }}" target="_">New Request</a>
                <a href="{{ url('/#')}}"  target="_">Request Status</a>
                <a href="{{ url('/inbox') }}" target="_">Inbox</a>
                <a href="">Manual</a>
                @if (Route::has('login'))
                @auth
                <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}"  method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endauth
            </div>
            
        </div>
        @endif
    </div>
</div>
</body>
</html>
