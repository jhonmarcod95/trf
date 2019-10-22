@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>New Account</p>
            </a>
            
        </li>
    </ul>
</div>
</div>
</nav>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Register New Account</h4>
                    </div>
                    <div class="content">
                        <form  method="POST" action="">
                            {{ csrf_field() }}
                            @if(session()->has('status'))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    {{session()->get('status')}}
                                    
                                </div>
                            </div>
                            @endif
                            @include('error')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Name
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        E-Mail Address
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        User Type
                                        <select id="user_type" class="chosen form-control" placeholder="" name="user_type" >
                                            <option >Select Role</option>
                                            @foreach($roles as $role)
                                            <option value='{{$role->id}}'>{{$role->role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Employee ID
                                        <input id="employee_id" type="text" class="form-control" name="employee_id" value="{{ old('employee_id') }}"  >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        Contact Number
                                        <input id="contact_number" type="number" class="form-control" name="contact_number" value="{{ old('contact_number') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Birth Date
                                        <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Company
                                        <select  name='company_name'  class="chosen form-control" width='100%'  autocomplete="off"  required>
                                            <option value=''></option>
                                            @foreach($companies as $company)
                                            <option value='{{$company->id}}'>{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Approver
                                        <select  name='approver'  class="chosen form-control" width='100%'  autocomplete="off"  >
                                            <option value=''>Select Approver</option>
                                            @foreach($accounts as $account)
                                            <option value='{{$account->id}}'>{{$account->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Department
                                        <select  name='department'  class="chosen form-control" width='100%'  autocomplete="off"  >
                                            <option value=''>Select Department</option>
                                            @foreach($departments as $department)
                                            <option value='{{$department->id}}'>{{$department->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">Password
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        <p style="font-size:9px;color:red">Passwords must be at least 8 characters long.
                                            <br>Passwords must contain:
                                            <br> minimum of 1 lower case letter [a-z] 
                                            <br> minimum of 1 upper case letter [A-Z] 
                                            <br> minimum of 1 numeric character [0-9]
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Confirm Password
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="col-md-6" style='float:right;'>
                                    
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-fill pull-right">Register </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script >
    $(".chosen").chosen();
</script>
@endsection


