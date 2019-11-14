@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>For Approval</p>
            </a>
        </li>
    </ul>
</div>
</div>
</nav>	
<form  method="POST" action="" onsubmit="show()">
    {{ csrf_field() }}
    <div class='row col-md-12'>
        <div class="col-md-5" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
            {{-- <input type='submit' name='action' class="btn btn-success" value='Approve'> --}}
        </div>
        @if(session()->has('status'))
        <div class="alert alert-success fade in col-md-6" style='margin-top:10px;float:right'>
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>{{session()->get('status')}}</strong>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger fade in col-md-6" style='margin-top:10px;float:right'>
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>{{session()->get('error')}}</strong>
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
                                    <td>
                                        {{-- <input type="checkbox" id="select_all" /> --}}
                                    </td>
                                    <td>Requestor</td>
                                    <td>Traveler</td>
                                    <td>Company</td>
                                    <td>Destination</td>
                                    <td width='12%'>From</td>
                                    <td width='12%'>To</td>
                                    <td width='15%'>Purpose</td>
                                    <td width='280px'>Action</td>
                                    
                                </thead>
                                
                                <tbody>
                                    
                                 
                                    @foreach($pending_requests as $key => $pending_request)
                                    <tr>
                                        <td>
                                            {{-- <input class="checkbox1" type="checkbox" name="array[]" value='{{$pending_request->id}}' > --}}
                                        </td>
                                        <td>{{$pending_request->name}}</td>
                                        <td>{{$pending_request->traveler_name}}</td>
                                        <td>{{$pending_request->company_name}}</td>
                                        <td>{{$pending_request->destination}}</td>
                                        <td>{{date ("M. j, Y",strtotime($pending_request->date_from))}}</td>
                                        <td>{{date ("M. j, Y",strtotime($pending_request->date_to))}}</td>
                                        <td width='15%'>{{$pending_request->purpose_of_travel}}</td>
                                        <td>
                                        {{-- <a href="show-pdf/{{$pending_request->id}}"  class="btn btn-info btn-sl btn-sm" target="_{{$key+1}}"><i class='pe-7s-monitor'></i> View</a> --}}
                                            {{-- <a href="approve-request/{{$pending_request->id}}" data-toggle="modal"  data-target="#referenceTicket{{$bookedRequest->id}}"   class="btn btn-success btn-sm" > <span class="pe-7s-check"></span>Approve</a> --}}
                                            <a data-toggle="modal"  data-target="#pending_request{{$pending_request->id}}"   class="btn btn-success btn-sm" > <span class="pe-7s-check"></span>Approve</a>
                                            <a href="#disapprove{{$pending_request->id}}"   data-toggle="modal" class="btn btn-danger btn-sm"><span class="pe-7s-close"></span>Disapprove</a>
                                            @include('modal')
                                            @include('approval_page')
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
</form>
<script src="{{ asset('/datable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/datable/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        } );
    } );
</script>   
<SCRIPT language="javascript">
    var select_all = document.getElementById("select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("checkbox1"); //checkbox items
    
    //select all checkboxes
    select_all.addEventListener("change", function(e){
        for (i = 0; i < checkboxes.length; i++) { 
            checkboxes[i].checked = select_all.checked;
        }
    });
    
    
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
		//uncheck "select all", if one of the listed checkbox item is unchecked
		if(this.checked == false){
			select_all.checked = false;
		}
		//check "select all" if all checkbox items are checked
		if(document.querySelectorAll('.checkbox1:checked').length == checkboxes.length){
			select_all.checked = true;
		}
	});
}
</SCRIPT>
<script>
    function validateForm() {
        var x = document.forms["myForm"]["remarks"].value;
        if (x == "") {
            alert("Remarks must be filled out");
            return false;
        }
        else
        {
            show();
        }
    }
</script>

@endsection


