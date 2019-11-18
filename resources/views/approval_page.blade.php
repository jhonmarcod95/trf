
{{-- edit Laborer --}}
<div class="modal fade" id="pending_request{{$pending_request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Request</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method="POST" action="approve-request/{{$pending_request->id}}"  onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" >
                    <div class='row' >
                        <div class='col-md-6'>
                            <div class="form-group">
                                Requestor Name:
                                {{$pending_request->name}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-6'>
                            <div class="form-group">
                                Traveler Name:
                                {{$pending_request->traveler_name}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-6'>
                            <div class="form-group">
                                Company:
                                {{$pending_request->company_name}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-6'>
                            <div class="form-group">
                                Destination:
                                {{$pending_request->destination}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-2'>
                            <div class="form-group">
                                From :
                                {{date ("M. j, Y",strtotime($pending_request->date_from))}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                To :
                                {{date ("M. j, Y",strtotime($pending_request->date_to))}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-12'>
                            <div class="form-group">
                                Purpose of Travel :
                                {{$pending_request->purpose_of_travel}}
                            </div>
                        </div>
                    </div>
                    <div class='row' >
                        <div class='col-md-2'>
                            <div class="form-group">
                                Budget Line Code:
                                {{$pending_request->budget_code_line}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                Budget Approved:
                                {{$pending_request->budget_code_approved}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                Budget Available:
                                {{$pending_request->budget_available}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                GL Account:
                                {{$pending_request->gl_account}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                Cost Center:
                                {{$pending_request->cost_center}}
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <hr>
                    <div class='row border'    >
                        <div class='col-md-1'>
                            <div class="form-group">
                                Origin
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class="form-group">
                                Destination
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                Date of Travel
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                Baggage Allowance
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                Reason
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                Flight Time
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group"> 
                                Baggage approval
                            </div>
                        </div>
                    </div>
                    <hr>
                    @foreach($pending_request->baggageAllowance as $baggage_allowance )
                    <div class='row border'>
                        <div class='col-md-1'>
                            <div class="form-group">
                                
                                {{$baggage_allowance->originInfo->destination}}
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class="form-group">
                                
                                {{$baggage_allowance->destinationInfo->destination}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                {{date ("M. j, Y",strtotime($baggage_allowance->date_of_travel))}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                @if($baggage_allowance->baggage_allowance == null)
                                0 KG
                                @else
                                {{$baggage_allowance->baggage_allowance}} KG
                                @endif
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                {{$baggage_allowance->reason}}
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                {{date('h:i a',strtotime($baggage_allowance->time_appointment))}}
                            </div>
                        </div>
                        @if(($baggage_allowance->baggage_allowance != 0) || ($baggage_allowance->baggage_allowance != null))
                        <div class='col-md-2'>
                            <div class="form-group">                     
                                <select name='action[{{$baggage_allowance->id}}]' class='form-control' required>
                                    <option value=""></option>
                                    <option value="Approve">Approve</option>
                                    <option value="Disapprove">Disapprove</option>
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary" >   Approve</button>
                </div>
                
            </form>
        </div>
    </div>
</div>