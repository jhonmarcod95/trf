@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Edit Account </p>
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
                        <h4 class="title">Edit Account of {{$users->name}}</h4>
                    </div>
                    <div class="content">
                        <form  method="POST" action="" onsubmit="show()">
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
                                        <input id="name" type="text" class="form-control" name="name" value="{{$users->name}}" required >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        E-Mail Address
                                        <input id="email" type="email" class="form-control" name="email" value="{{$users->email}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        User Type
                                        @if($users->role == 1)
                                        <select id="user_type" class="form-control" name="user_type" >
                                            <option value='1'>ADMIN</option>
                                            <option value='2'>USER</option>
                                            <option value='3'>APPROVER</option>
                                        </select>
                                        @elseif($users->role == 2)
                                        <select id="user_type" class="form-control" name="user_type" >
                                            <option value='2'>USER</option>
                                            <option value='1'>ADMIN</option>
                                            <option value='3'>APPROVER</option>
                                        </select>
                                        @else 
                                        <select id="user_type" class="form-control" name="user_type" >
                                            <option value='3'>APPROVER</option>
                                            <option value='1'>ADMIN</option>
                                            <option value='2'>USER</option>
                                        </select>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Employee ID
                                        <input id="employee_id" type="text" class="form-control" name="employee_id" value="{{$users->employee_id}}" >
                                    </div   >
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        Contact Number
                                        <input id="contact_number" type="number" class="form-control" name="contact_number" value="{{$users->contact_number}}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Birth Date
                                        <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{$users->birth_date}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Company
                                        <select  name='company_name'  class="chosen form-control" width='100%'  autocomplete="off"  >
                                            <option value=''></option>
                                            @if($company_edit != null)<option value='{{$users->company_name}}'>{{$company_edit->company_name}}</option>@endif
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
                                            @if($approver!=null)
                                            <option value='{{$approver->approver_id}}'>{{$approver->name}}</option>
                                            @else
                                            <option value=''>Choose Approver</option>
                                            @endif
                                            @foreach($accounts as $account)
                                            <option value='{{$account->id}}'>{{$account->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Department 
                                        <select id='department'  name='department_name'  class="chosen form-control" width='100%'  autocomplete="off"  >
                                         <option value=''> Select Department</option>
                                            @foreach($departments as $department)
                                                <option value='{{$department->id}}'  {{ ($department->id == auth()->user()->department ? "selected":"") }}>{{$department->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Save </button>
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