
{{-- edit Laborer --}}
<div class="modal fade" id="reference{{$approve->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
            <form  method='POST' action='reference/{{$approve->id}}' onsubmit='show()' enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='booking-reference' id='booking-reference{{$approve->id}}'>
                        <div class='row' id='1'>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    Reference ID:
                                    <input name='reference_id[]'  type='text' value='' class='form-control' required>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    Amount:
                                    <input name='amount[]' type='number' value='' placeholder='0.00' step='0.01' class='form-control' required>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    Date booked :
                                    <input type='date' name='date_booked[]'  value='' max="{{date('Y-m-d')}}" class='form-control' required>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    File Ticket:
                                    <input type='file' name='file_upload[]'  value=''  class='form-control' required>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    OR :
                                    <input type='file' name='file_upload_or[]'  value=''  class='form-control' required>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    Type :
                                    <select class='form-control' placeholder='type' name='type[]' required>
                                        <option value=''></option>
                                        <option value='Cebu Pacific'>Cebu Pacific</option>
                                        <option value='Philippine Airlines'>Philippine Airlines</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <button type="button"  onclick='newBookingRef({{$approve->id}})' class='btn btn-success addmore'>+ add new booking reference</button> 
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary" >Save</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
<script>
    function newBookingRef(id)
    {
        var idBookingRef = $("#booking-reference"+id).children().last().attr('id');
        var idBookingRef = parseInt(idBookingRef) + 1;
        var newBookingReference = "<div class='row' id='"+idBookingRef+"'>";
            newBookingReference += "<div class='col-md-2'><div class='form-group'> Reference ID: <input name='reference_id[]'  class='form-control' required>  </div></div>";
            newBookingReference += "<div class='col-md-2'><div class='form-group'>  Amount:  <input name='amount[]' type='number' value='' placeholder='0.00' step='0.01' class='form-control' required>  </div></div>";
            newBookingReference += "<div class='col-md-2'><div class='form-group'> Date booked : <input type='date' name='date_booked[]'  value='' max='{{date('Y-m-d')}}' class='form-control' required> </div></div>";
            newBookingReference += "<div class='col-md-2'><div class='form-group'>  File Ticket: <input type='file' name='file_upload[]'  value=''  class='form-control' required></div></div>";
            newBookingReference += "<div class='col-md-2'><div class='form-group'>  OR: <input type='file' name='file_upload_or[]'  value=''  class='form-control' required></div></div>";
            newBookingReference += "<div class='col-md-1'><div class='form-group'> Type : <select class='form-control' placeholder='type' name='type[]' required><option value=''></option>  <option value='Cebu Pacific'>Cebu Pacific</option><option value='Philippine Airlines'>Philippine Airlines</option></select></div></div><div class='col-md-1'><div class='form-group'>	&nbsp; <span class='form-control' ><a  onclick='removeRef("+idBookingRef+")' href='#' class='text-danger'>X</a></span><div></div></div>";
            $("#booking-reference"+id).append(newBookingReference); 
    }
    function removeRef(id)
    {
        $("#"+id).remove();
    }
</script>