@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Destination List</p>
            </a>
            
        </li>
    </ul>
</div>
</div>
</nav>
<div class='row col-md-12'>
    <div class = 'col-md-6'>
        <a href='#new_destination'  data-toggle="modal"  ><button type="button" data-target="#addnew" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-plus"></i> New Destination</button></a>
    </div>
    @if(Session::has('message'))
    <div class="alert alert-success fade in col-md-6" style='margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> {{Session::get('message')}}</strong>
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
                            <td>ID</td>
                            <td>Destination</td>
                            <td>Code</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            
                            @foreach($destinations as $destination)
                            <tr>
                                <td>{{$destination->id}}</td>
                                <td>{{$destination->destination}}</td>
                                <td>{{$destination->code}}</td>
                                {{-- <td><a href="edit-destination/{{$destination->id}}"  class="btn btn-danger">
                                    <span class="pe-7s-edit"></span>
                                    Edit</a>
                                </td> --}}
                                <td>
                                    <a href="#destination_edit{{$destination->id}}" data-toggle="modal"  class="btn btn-danger">
                                        <span class="pe-7s-edit"></span>
                                        Edit
                                    </a>
                                    @include('destination_modal')
                                </td>
                            </tr>
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


