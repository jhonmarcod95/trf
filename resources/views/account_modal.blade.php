
{{-- change password --}}
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
            <form  method='POST' action='change-password' onsubmit='show()' >
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
    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class='row'>
                        <div class='col-md-10'>
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        </div>
                        <div class='col-md-2'>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <style>
                    #company_chosen
                    {
                        width: 100% !important;
                    }
                    #department_chosen
                    {
                        width: 100% !important;
                    }
                    #approver_chosen
                    {
                        width: 100% !important;
                    }
                </style>
                <form  method='POST' action='save-edit-profile' onsubmit='show()' >
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class='row'>
                            <div class='col-md-4'>
                                <label style="position:relative; top:7px;">Name:</label>
                                <input type='text'  class="form-control" value='{{auth()->user()->name}}'  name='name' id='name' required>
                            </div>
                            <div class='col-md-4'>
                                <label style="position:relative; top:7px;">Email:</label>
                                <input type='email'  class="form-control" value='{{auth()->user()->email}}'  name='email' id='email' required>
                            </div>
                            <div class='col-md-4'>
                                <label style="position:relative; top:7px;">Department:</label>
                                <select id='department'  name='department_name'  class="chosen form-control" width='100%'  autocomplete="off"  required>
                                    @foreach($departments as $department)
                                    <option value='{{$department->id}}'  {{ ($department->id == auth()->user()->department ? "selected":"") }}>{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-2'>
                                <label style="position:relative; top:7px;">Employee ID:</label>
                                <input type='text'  class="form-control" value='{{auth()->user()->employee_id}}'  name='employee_id' id='employee_id' required>
                            </div>
                            <div class='col-md-3'>
                                <label style="position:relative; top:7px;">Contact Number:</label>
                                <input type='text'  class="form-control" value='{{auth()->user()->contact_number}}'  name='contact_number' id='contact_number' placeholder="977xxxxxxxx" required>
                            </div>
                            <div class='col-md-7'>
                                <label style="position:relative; top:7px;">Company:</label>
                                <select id='company'  name='company_name'  class="chosen form-control" width='100%'  autocomplete="off"  required>
                                    @foreach($companies as $company)
                                    <option value='{{$company->id}}'  {{ ($company->id == auth()->user()->company_name ? "selected":"") }}>{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-3'>
                                <label style="position:relative; top:7px;">Birth Date:</label>
                                <input type='date'  class="form-control" value='{{auth()->user()->birth_date}}'  name='birth_date' id='birth_date' required>
                            </div>
                            
                            <div class='col-md-5'>
                                <label style="position:relative; top:7px;">Approver:</label>
                                <select id='approver'  name='approver'  class="chosen form-control" width='100%'  autocomplete="off" >
                                    <option value=''>Choose Approver</option>
                                    @foreach($accounts as $account)
                                    <option value='{{$account->id}}' @if($approver != null) {{ ($account->id == $approver->approver_id ? "selected":"") }} @endif>{{$account->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>