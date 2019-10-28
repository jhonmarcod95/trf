@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Request</p>
            </a>
        </li>
    </ul>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <td>Requestor </td>
                                <td>Destination</td>
                                <td width='20%'>Status</td>
                                <td width='200px'>Action</td>
                            </thead>
                            <tbody>
                                @foreach($pending_requests as $pending_request)
                                <tr>
                                    <td>{{$pending_request->name}}</td>
                                    <td>{{$pending_request->destination}}</td>
                                    <td>
                                        @if($pending_request->status == 1)
                                            Pending For Approval
                                        @elseif($pending_request->status == 2)
                                            Approved
                                        @elseif($pending_request->status == 3)
                                            Cancelled
                                        @endif
                                    </td>
                                    <td>
                                            <a href="show-pdf/{{$pending_request->id}}"  class="btn btn-info btn-sm" target="_1"><i class='pe-7s-monitor'></i> View</a>
                                            @if($pending_request->status == 2)
                                                @if($pending_request->date_booked != null)
                                            
                                                    <a data-toggle="modal" data-target="#reference{{$pending_request->id}}"  class="btn btn-success btn-sm" target="_1">✓ Reference Number</a>
                                                    @else
                                                    <a data-toggle="modal" data-target="#reference{{$pending_request->id}}"  class="btn btn-danger btn-sm" target="_1">X Reference Number</a>
                                                @endif
                                            @endif
                                            @include('referenceView')
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


