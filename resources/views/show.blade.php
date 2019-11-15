@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Pending Request</p>
            </a>
        </li>
    </ul>
    <a href="{{ url('/new-request') }}"  onclick = "show()" class="btn btn-success btn-sm"><span class="pe-7s-plus"></span>
        New Request
    </a>
</div>
</div>
</nav>	
<div class='row col-md-12'>
    @if(session()->has('status'))
    <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('status')}}</strong>
    </div>
    @endif
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <td>Traveler</td>
                                <td>Company</td>
                                <td>Destination</td>
                                <td width='12%'>From</td>
                                <td width='12%'>To</td>
                                <td width='20%'>Purpose</td>
                                <td width='200px'>Action</td>
                            </thead>
                            <tbody>
                                @foreach($pending_requests as $key => $pending_request)
                                <tr>
                                    <td>{{$pending_request->traveler_name}}</td>
                                    <td>{{$pending_request->company_name}}</td>
                                    <td>{{$pending_request->destination}}</td>
                                    <td>{{date ("M. j, Y",strtotime($pending_request->date_from))}}</td>
                                    <td>{{date ("M. j, Y",strtotime($pending_request->date_to))}}</td>
                                    <td>{{$pending_request->purpose_of_travel}}</td>
                                    <td>
                                        {{-- <a href="edit-request/{{$pending_request->id}}"  class="btn btn-info btn-sl btn-sm" onclick='show()'>
                                            <i class='pe-7s-edit'></i> Edit
                                        </a> --}}
                                             <a href="show-pdf/{{$pending_request->id}}"  class="btn btn-info btn-sl btn-sm" target="_blank"><i class='pe-7s-monitor'></i> View</a>
                                       
                                        <a href="#cancel_request{{$pending_request->id}}"  data-toggle="modal"  class="btn btn-danger btn-sm"><span class="pe-7s-close"></span>
                                            Cancel
                                        </a>
                                        @include('modal')
                                    </td>
                                </tr>
                                @endforeach
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


