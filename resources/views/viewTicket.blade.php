
{{-- edit Laborer --}}
<div class="modal fade" id="referenceTicket{{$bookedRequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            
            <div class="modal-body" >
                @foreach($bookedRequest->bookReferences as $reference)
                <div class='row' >
                    <div class='col-md-2'>
                        <div class="form-group">
                            Reference ID:<br>
                            {{$reference->booking_id}}
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            Amount:<br>
                            {{$reference->amount}}
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            Date booked :<br>
                            {{$reference->date_booked}}
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            File Ticket:<br>
                            <a href='{{ URL::asset($reference->upload_file) }}' target='_blank'>Attachment</a>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            Official Receipt:<br>
                            <a href='{{ URL::asset($reference->upload_receipt) }}' target='_blank'>Attachment</a>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            Type :<br>
                            {{$reference->booking_type}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
