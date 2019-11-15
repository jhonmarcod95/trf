
{{-- cancel request --}}
<div class="modal fade" id="cancel_request{{$approved_request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Request</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST'  action='cancel-request/{{$approved_request->id}}'  onsubmit='show()'>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Remarks:</label>
                    <input type="text" name="remarks" placeholder="Remarks...." class="form-control" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- edit_company --}}
