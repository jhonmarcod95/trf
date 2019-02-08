@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Employee List</p>
            </a>
            
        </li>
    </ul>
</div>
</div>
</nav>
<div class='row col-md-12'>
    <div class = 'col-md-6'>
        <a href='{{ url('/new-account') }}'><button type="button" data-target="#addnew" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> New Account</button></a>
    </div>
    @if(session()->has('status'))
    <div class="alert alert-success fade in col-md-6" style='margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>  {{session()->get('status')}}</strong>
    </div>
    @endif
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content table-responsive table-full-width">
                    
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <td>Employee ID</td>
                            <td>Name</td>
                            <td>Company</td>
                            <td>Role</td>
                            <td>Department</td>
                            <td>Email</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                            <tr>
                                <td>{{$account->employee_id}}</td>
                                <td>{{$account->name}}</td>
                                <td><span title='{{$account->company_name}}'>{{str_limit($account->company_name, 15)}}</span></td>
                                <td>{{$account->role}}</td>
                                <td>{{$account->department_name}}</td>
                                <td>{{$account->email}}</td>
                                @if($account->id == Auth::user()->id)
                                <td>
                                    
                                </td>
                                @else
                                @if($account->activate == 2)
                                <td>
                                    <a onclick='show()' href="activate-account/{{$account->id}}"  class="btn btn-success"> 
                                        <span class="pe-7s-power"></span>
                                        Activate
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a onclick='show()' href="edit-account/{{$account->id}}"  class="btn btn-info">
                                        <span class="pe-7s-edit"></span>
                                        Edit
                                    </a>
                                    <a  onclick='show()' href="reset-account/{{$account->id}}"  class="btn btn-success">
                                        <i class='pe-7s-refresh'></i> Reset
                                    </a>
                                    <a onclick='show()' href="deactivate-account/{{$account->id}}"  class="btn btn-danger">
                                        <span class="pe-7s-power"></span>
                                        Deactivate
                                    </a>
                                </td>
                                @endif
                                @endif
                                @endforeach
                                @include('error')
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('/datable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/datable/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        } );
    } );
</script>   
@endsection


