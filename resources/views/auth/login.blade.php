@extends('layouts.header')
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-15 p-b-50">
            <form class="login100-form validate-form" method="POST" action="" onsubmit="show()">
                {{ csrf_field() }}
                <div class="container-login100-form-btn m-b-50">
                    <h3>{{ config('app.name', 'Laravel') }}</h3>
                </div>
                <span class="login100-form-avatar">
                    <img src="{{URL::asset('/images/logo.png')}}" alt="AVATAR">
                 
                </span>
               
                <div class="wrap-input100 validate-input m-t-15 m-b-35" data-validate = "Enter username">
                    <input id="email" type="email"class="input100" name="email" value="{{ old('email') }}" required autofocus>
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input id="password" type="password"  class="input100" name="password" required>
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type='submit'  >
                        Login
                    </button>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style='color:red;'>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
