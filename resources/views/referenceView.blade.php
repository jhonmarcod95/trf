
{{-- edit Laborer --}}
<div class="modal fade" id="reference{{$pending_request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Reference Number</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='reference/{{$pending_request->id}}' onsubmit='show()'>
                
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                Reference ID:
                                <input name='reference_id' value='{{$pending_request->reference_id}}' class='form-control' required>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                Amount:
                                <input name='amount' type='number' value='{{$pending_request->amount}}' placeholder='0.00' step='0.01' class='form-control' required>
                            </div>
                        </div>
                    </div> 
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                Date booked :
                                <input type='date' name='date_booked'  value='{{$pending_request->date_booked}}' max="{{date('Y-m-d')}}" class='form-control' required>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary" >Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
