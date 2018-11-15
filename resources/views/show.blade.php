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
</div>
</div>
</nav>		
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
                                <td>From</td>
                                <td>To</td>
                                <td>Purpose</td>
                                <td>Action</td>
                            </thead>
                            <tbody>
                                
                                @foreach($pending_requests as $pending_request)
                                <tr>
                                    <td>{{$pending_request->traveler_name}}</td>
                                    <td>{{$pending_request->company_name}}</td>
                                    <td>{{$pending_request->destination}}</td>
                                    <td>{{$pending_request->date_from}}</td>
                                    <td>{{$pending_request->date_to}}</td>
                                    <td>{{$pending_request->purpose_of_travel}}</td>
                                    <td>
                                        <a href=""  class="btn btn-info btn-sl">
                                            <i class='pe-7s-edit'></i> Edit
                                        </a>
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


