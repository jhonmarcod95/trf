@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Change Password</p>
            </a>
            
        </li>
    </ul>
    
</div>
</div>
</nav>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Change Password :  {{ Auth::user()->name}}</h4>
                    </div>
                    <div class="content">
                        <form method='POST' action='' target="">
                          {{ csrf_field() }}
                          @if(session()->has('status'))
                            <div class="form-group">
                                <div class="alert alert-success">
                                    {{session()->get('status')}}
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        New Password
                                        <input type='password'  class="form-control"  name='password' id='password' required>
                                        {{-- <input type='hidden'  class="form-control"  name='id' id='id' value='{{Auth::user()->id}}'> --}}
                                        <input type='hidden'  class="form-control"  name='id' id='id' value='{{Auth::user()->id}}'>
                                    
                                        <p style="font-size:10px;color:red">Passwords must be at least 8 characters long.
                                            <br>Passwords must contain:
                                            <br> minimum of 1 lower case letter [a-z] 
                                            <br> minimum of 1 upper case letter [A-Z] 
                                            <br> minimum of 1 numeric character [0-9] </p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            Confirm Password
                                            <input type='password'  class="form-control"  name='password_confirmation' id='password_confirmation'  required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update </button>
                                <div class="clearfix"></div>
                                @include('error')
                            </form>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    
    @endsection
    
    