@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Approved Request</p>
            </a>
        </li>
    </ul>
</div>
</div>
</nav>		
<div class='row col-md-12'>
        @if(session()->has('status'))
        <div class="alert alert-success fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
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
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <td>Traveler</td>
                                <td>Company</td>
                                <td>Destination</td>
                                <td>From</td>
                                <td>To</td>
                                <td>Purpose</td>
                                <td>Approved By</td>
                                <td>Action</td>
                                
                            </thead>
                            <tbody>
                                @foreach($approved_requests as $approved_request)
                                <tr>
                                    <td>{{$approved_request->traveler_name}}</td>
                                    <td>{{$approved_request->company_name}}</td>
                                    <td>{{$approved_request->destination}}</td>
                                    <td>{{date ("M j, Y",strtotime($approved_request->date_from))}}</td>
                                    <td>{{date ("M j, Y",strtotime($approved_request->date_to))}}</td>
                                    <td>{{$approved_request->purpose_of_travel}}</td>
                                    <td>{{$approved_request->name}}</td>
                                    <td>
                                        <a href="show-pdf/{{$approved_request->id}}"  class="btn btn-info btn-sl" target="_blank"><i class='pe-7s-monitor'></i> View</a>
                                        <a href="#cancel_request{{$approved_request->id}}"  data-toggle="modal"  class="btn btn-danger btn-sm"><span class="pe-7s-close"></span>
                                            Cancel
                                        </a>
                                        @include('cancel_modal')
                                        {{-- @if($approved_request->date_booked != null)
                                        <a data-toggle="modal" data-target="#reference{{$approved_request->id}}"  class="btn btn-danger btn-sl" target="_1">Reference Number</a>
                                        @else
                                        <a data-toggle="modal" data-target="#reference{{$approved_request->id}}"  class="btn btn-success btn-sl" target="_1">Reference Number</a>
                                        @endif --}}
                                        <a data-toggle="modal" data-target="#reference{{$approved_request->id}}"  class="btn btn-danger btn-sl" target="_1">Reference Number</a>
                                        @include('reference')
                                    </td>
                                </tr>
                                {{-- @include('reference') --}}
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


