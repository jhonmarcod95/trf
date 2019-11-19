@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Booked Flights</p>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                          
                            <thead>
                                <td>TRF Number </td>
                                <td>Requestor </td>
                                <td>Traveler Name</td>
                                <td>Company</td>
                                <td>Destination</td>
                                <td>Approved By</td>
                                <td width='200px'>Action</td>
                            </thead>
                            <tbody>
                                
                                @foreach($booked_requests as $key => $bookedRequest)
                                @if(date('Y') == '2019')
                                @php
                                $length = strlen($bookedRequest->trf_number);
                                if($length == 1)
                                {
                                    $reference_id = "00".$bookedRequest->trf_number;
                                }
                                elseif($length == 2)
                                {
                                    $reference_id = "0".$bookedRequest->trf_number;
                                }
                                else
                                {
                                    $reference_id = $bookedRequest->trf_number;
                                }
                                @endphp
                                @else
                                @php
                                $length = strlen($bookedRequest->trf_number);
                                if($length == 1)
                                {
                                    $reference_id = "0000".$bookedRequest->trf_number;
                                }
                                elseif($length == 2)
                                {
                                    $reference_id = "000".$bookedRequest->trf_number;
                                }
                                elseif($length == 3)
                                {
                                    $reference_id = "00".$bookedRequest->trf_number;
                                }
                                elseif($length == 4)
                                {
                                    $reference_id = "0".$bookedRequest->trf_number;
                                }
                                else
                                {
                                    $reference_id = $bookedRequest->trf_number;
                                }
                                @endphp
                                @endif
                                <tr>
                                        <td width='130px;'>TRF-{{date('Y',strtotime($bookedRequest->created_at))}}-{{$reference_id}}</td>
                                    <td>{{$bookedRequest->name}}</td>
                                    <td>{{$bookedRequest->traveler_name}}</td>
                                    <td>{{$bookedRequest->company_name}}</td>
                                    <td>{{$bookedRequest->destination}}</td>
                                    <td>{{$bookedRequest->user_approver_name}}</td>
                                    <td>
                                      
                                        <a href="show-pdf/{{$bookedRequest->id}}"  class="btn btn-info btn-sm" target="_blank"><i class='pe-7s-monitor'></i> View</a>
                                        <a class="btn btn-success btn-sm" data-toggle="modal"  data-target="#referenceTicket{{$bookedRequest->id}}" ><i class='pe-7s-monitor'></i> View Ticket</a>
                                        @include('viewTicket')
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


