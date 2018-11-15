@extends('layouts.app')
@section('content')
<div class="collapse navbar-collapse">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">TRAVEL REQUEST FORM</h4>
                            <small><i>LFHR-F-001 rev. 00 Effective date: 01 July 2013</i></small>
                        </div>
                        <div class="content">
                            <form method='POST' action='save-new-request' target="">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        Company Name:
                                        <select  name='company_name'  class="chosen form-control" width='100%'  autocomplete="off"  required>
                                            <option value=''></option>
                                            @foreach($companies as $company)
                                            <option value='{{$company->id}}'>{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        Date Request:
                                        <input type='date' class="form-control"  name='date_request'  value="{{ date('Y-m-d') }}"  autocomplete="off"  readonly>
                                        <input type='hidden' class="form-control"  name='user_id'  value="{{ Auth::user()->id }}"  autocomplete="off"  readonly>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Requestor Name:
                                        <input type='text' class="form-control"  name='requestor_name' value={{Auth::user()->name}}   autocomplete="off"  readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Traveler Name:
                                        <input type='name' class="form-control"  name='traveler_name' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        Birthdate:
                                        <input type='date' class="form-control"  name='birthdate'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        Purpose of Travel:
                                        <select  name='purpose_of_travel'  class="chosen form-control"  autocomplete="off"  required>
                                            <option value='Meeting With Client'>Meeting With Client</option>
                                            <option value='B'>B</option>
                                            <option value='C'>C</option>
                                            <option value='D'>D</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Contact Number:
                                        <input type='text' class="form-control" maxlength="11" name='contact_number'   autocomplete="off"  required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        Destination:
                                        &nbsp;<h6>&nbsp; </h6>
                                        <select  name='destination'  class="chosen form-control"  autocomplete="off"  required>
                                            <option value=''>Choose Destination</option>
                                            @foreach($destinations as $destination)
                                            <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Covering Dates of Travel
                                        <h6>From:</h6>
                                        <input type='date' class="form-control"  name='date_from'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        &nbsp;
                                        <h6>To:</h6>
                                        <input type='date' class="form-control"  name='date_to'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Baggage Allowance:
                                        &nbsp;<h6>&nbsp; </h6>
                                        <select  name='kg'  class="form-control"  autocomplete="off"  required>
                                            <option value='0'>0 Kg</option>
                                            <option value='20'>20 Kg</option>
                                            <option value='32'>32 Kg</option>
                                            <option value='40'>40 Kg</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5>TRAVEL PLAN REQUESTED</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Budget Line Code:
                                        <input type='text' class="form-control"  name='budget_line_code' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Budget Approved:
                                        <input type='text' class="form-control"  name='budget_approved' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Budget Available:
                                        <input type='text' class="form-control"  name='budget_available' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-3">
                                        GL Account:
                                        <input type='text' class="form-control"  name='gl_account' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-3">
                                        Cost Center:
                                        <input type='text' class="form-control"  name='cost_center' autocomplete="off"  required>
                                    </div>
                                </div>
                                
                                <table id="form_table" class="table table-bordered field_wrapper">
                                    <tr class='case'>
                                        <th>ORIGIN:</th>
                                        <th>DESTINATION:</th>
                                        <th>Date of Travel</th>
                                        <th colspan='2'>Appointment Time *** at Destination</th>
                                    </tr>
                                    <tr class='case'>
                                        <td>
                                            <select  name='origin[]'  class="chosen form-control"  autocomplete="off"  required>
                                                <option value=''>Choose Origin</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  name='destinationall[]'  class="chosen form-control"  autocomplete="off"  required>
                                                <option value=''>Choose Destination</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type='date' name='date_of_travel[]' required/></td>
                                        <td colspan='2'><input class="form-control" type='time' name='appointment[]' required/></td>
                                    </tr>
                                    <tr class='case'>
                                        <td style='width:30%;'>
                                            <select  name='origin[]'  class="chosen form-control"  autocomplete="off"  required>
                                                <option value=''>Choose Origin</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style='width:30%;'>
                                            <select  name='destinationall[]'  class="chosen form-control"  autocomplete="off"  required>
                                                <option value=''>Choose Destination</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type='date' name='date_of_travel[]' required/></td>
                                        <td colspan='2'><input class="form-control" type='time' name='appointment[]' required/></td>
                                    </tr>
                                </table>
                                <button type="button" class='btn btn-success addmore'>+ add new origin</button><br>  
                                <div class="header">
                                    <small>**HRD to file Approved Official Business Authorization (OBA) in Payroll Clerk File</small>
                                    <br><small>***ETD Origin minimum of two (2) hours from appointment time at destination</small>
                                    <br><small>****Miscellaneous Other Charges, if any like ASP, CCF</small>
                                </div>
                                <a href="{{ URL::previous() }}" class="btn btn-info  btn-danger pull-right">Cancel</a>
                                <button type="submit"  class="btn btn-info btn-fill pull-right">Submit</button> 
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $(".addmore").on('click', function () {
                                    var count = $('table tr').length;
                                    var data = "<tr id='data' class='case'>";
                                        data += "<td style='width:30%;'><select  name='origin[]'  class='chosen form-control'  autocomplete='off'  required><option value=''>Choose Origin</option>@foreach($destinations as $destination)<option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td style='width:30%;'><select  name='destinationall[]'  class='chosen form-control'  autocomplete='off'  required><option value=''>Choose Destination</option>@foreach($destinations as $destination) <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td><input class='form-control' type='date' name='date_of_travel[]' required/></td><td colspan='1'><input class='form-control' type='time' name='appointment[]' required/></td><td align='center' style='border:0;'><a  href='javascript:void(0);' class='removeButton'><img width='20px' height='20px' src='../public/login_css/remove.png'/></a></td></tr>";
                                        $('#form_table').append(data);
                                        count++;
                                    });
                                    $('#form_table').on('click', '.removeButton', function(){
                                        $("#data").remove();
                                    });
                                });
                            </script>
                            <script >
                                $(".chosen").chosen();
                            </script>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        
        
        