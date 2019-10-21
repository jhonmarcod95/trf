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
                                        <a href="show-pdf/{{$approved_request->id}}"  class="btn btn-info btn-sl" target="_1"><i class='pe-7s-monitor'></i> View</a>
                                        @if($approved_request->date_booked != null)
                                        <a data-toggle="modal" data-target="#reference{{$approved_request->id}}"  class="btn btn-danger btn-sl" target="_1">✓ Reference Number</a>
                                        @else
                                        <a data-toggle="modal" data-target="#reference{{$approved_request->id}}"  class="btn btn-success btn-sl" target="_1">✓ Reference Number</a>
                                        @endif
                                    </td>
                                </tr>
                                @include('reference')
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


