@include('layouts.app1')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>View Account</p>
            </a>
            
        </li>
    </ul>
</div>
</div>
</nav>
@include('error')

@if(session()->has('status'))
<div class='row col-md-12'>
    <div class="alert alert-success fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>  {{session()->get('status')}}</strong>
    </div>
</div>
@endif
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class='row'>
                            <div class="col-md-2">
                                <h4 class="title">
                                    User Profile
                                </h4>
                            </div>
                            <div class="col-md-2">
                                <button type="button" data-toggle="modal" data-target="#change-password"  class="btn btn-info btn-fill">
                                    Change Password 
                                </button>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-2">
                                <button type="button" data-toggle="modal" data-target="#edit-profile"  class="btn btn-success btn-fill">
                                    Edit Profile
                                </button>
                            </div>
                        </div>     
                    </div>
                    <div class="content">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    Name
                                    <input  type="text" class="form-control" name="name" value="{{$users->name }}" readonly >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    E-Mail Address
                                    <input  type="email" class="form-control" name="email" value="{{$users->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    Department
                                    <input  type="text" class="form-control" name="department" value="@if($department != null){{$department->department_name}} @endif" readonly >
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    Employee ID
                                    <input type="text" class="form-control" name="employee_id"  value="{{$users->employee_id }}" readonly >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Contact Number
                                    <input  type="number" class="form-control" name="contact_number"  value="{{$users->contact_number }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    Birth Date
                                    <input type="date" class="form-control" name="birth_date" value="{{$users->birth_date }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    Company
                                    <input  type="text" class="form-control" name="birth_date" value="@if($company_edit != null){{$company_edit->company_name }}@endif" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Approver
                                    @if($approver == null)
                                    <input  type="text" class="form-control" name="birth_date" value="" readonly>
                                    @else
                                    <input type="text" class="form-control" value='{{$approver->name}}' name="birth_date" value="" readonly>
                                    @endif
                                </div>
                            </div>
                            @if(Auth::user()->role == 3)
                            <div class="col-md-3">
                                <div class="form-group">
                                    Requestor
                                    <select  name=''  class="chosen form-control" width='100%'  autocomplete="off"  required>
                                        @if($requestor_list->isEmpty())
                                        <option value=''>No Data Found</option>
                                        @endif
                                        @foreach($requestor_list as $requestor)
                                        <option value=''>{{$requestor->name}}</option>
                                        @endforeach
                                    </select> </div>
                                </div>
                            </div>
                            @endif
                            @include('account_modal')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script >
    $(".chosen").chosen();
</script>
