
{{-- New Destination --}}
<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='change-password' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">New Password:</label>
                    <input type='password'  class="form-control"  name='password' id='password' required>
                    {{-- <input type='hidden'  class="form-control"  name='id' id='id' value='{{Auth::user()->id}}'> --}}
                    <input type='hidden'  class="form-control"  name='id' id='id' value='{{Auth::user()->id}}'>
                    
                    <p style="font-size:10px;color:red">Passwords must be at least 8 characters long.
                        <br>Passwords must contain:
                        <br> minimum of 1 lower case letter [a-z] 
                        <br> minimum of 1 upper case letter [A-Z] 
                        <br> minimum of 1 numeric character [0-9] </p>
                        <label style="position:relative; top:7px;"> Confirm Password :</label>
                        <input type='password'  class="form-control"  name='password_confirmation' id='password_confirmation'  required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>