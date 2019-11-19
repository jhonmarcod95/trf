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
                            Pending for Approval
                            <thead>
                                <td>Requestor </td>
                                <td>Traveler Name</td>
                                <td>Approver</td>
                                <td>Destination</td>
                                <td>Date Created </td>
                                <td width='200px'>Action</td>
                            </thead>
                            <tbody>
                                @foreach($pending_requests as $pending_request)
                                <tr>
                                    <td>{{$pending_request->name}}</td>
                                    <td>{{$pending_request->traveler_name}}</td>
                                    <td>@if($pending_request['approverInfo'] != null) {{$pending_request['approverInfo']->approver['name']}} @endif</td>
                                    <td>{{$pending_request->destination}}</td>
                                    <td>{{date('M. d, Y',strtotime($pending_request->created_at))}}</td>
                                    <td>
                                        <a href="show-pdf/{{$pending_request->id}}"  class="btn btn-info btn-sl" target="_blank"><i class='pe-7s-monitor'></i> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example1" class="table table-striped table-bordered" style="width:100%;">
                            Pending for Booking
                            <thead>
                                <td>TRF Number </td>
                                <td>Requestor </td>
                                <td>Traveler Name</td>
                                <td>Approved By</td>
                                <td>Date Approved</td>
                                <td width='200px'>Action</td>
                            </thead>
                            <tbody>
                                @foreach($approves as $approve)
                                @if(date('Y') == '2019')
                                @php
                                $length = strlen($approve->trf_number);
                                if($length == 1)
                                {
                                    $reference_id = "00".$approve->trf_number;
                                }
                                elseif($length == 2)
                                {
                                    $reference_id = "0".$approve->trf_number;
                                }
                              
                                else
                                {
                                    $reference_id = $approve->trf_number;
                                }
                                @endphp
                                @else
                                @php
                                $length = strlen($approve->trf_number);
                                if($length == 1)
                                {
                                    $reference_id = "0000".$approve->trf_number;
                                }
                                elseif($length == 2)
                                {
                                    $reference_id = "000".$approve->trf_number;
                                }
                                elseif($length == 3)
                                {
                                    $reference_id = "00".$approve->trf_number;
                                }
                                elseif($length == 4)
                                {
                                    $reference_id = "0".$approve->trf_number;
                                }
                                else
                                {
                                    $reference_id = $approve->trf_number;
                                }
                                @endphp
                                @endif
                                <tr>
                                    <td width='130px;'>TRF-{{date('Y',strtotime($approve->created_at))}}-{{$reference_id}}</td>
                                    <td>{{$approve->name}}</td>
                                    <td>{{$approve->traveler_name}}</td>
                                    <td>{{$approve->approveBy->name}}</td>
                                    <td>{{date('M. d, Y',strtotime($approve->updated_at))}}</td>
                                    <td>
                                        <a href="show-pdf/{{$approve->id}}"  class="btn btn-info btn-sm" target="_blank"><i class='pe-7s-monitor'></i> View</a>
                                        <a data-toggle="modal" data-target="#reference{{$approve->id}}"  class="btn btn-danger btn-sm" target="_1">Reference Number</a>
                                        @include('reference_admin')
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
    $(document).ready(function() {
        $('#example1').DataTable( {
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        } );
    } );
</script>   
@endsection


