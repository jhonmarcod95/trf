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
                        @include('error')
                        <div class="content">
                            <form method='POST' action='save-new-request' target="" onsubmit="show()">
                                {{ csrf_field() }}
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        Company Name:
                                        <select  name='company_name'  class="chosen1 form-control" width='100%'  autocomplete="off">
                                            <option value=''></option>
                                            @foreach($companies as $company)
                                            <option value='{{$company->id}}' {{ (Input::old("company_name") == $company->id ? "selected":"") }}>{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Requestor Name:
                                        <input type='text' class="form-control"     name='requestor_name' value='{{ Auth::user()->name }}'  readonly>
                                    </div>
                                    <div class="col-md-2">
                                        Date Request:
                                        <input type='date'  class="form-control"  name='date_request'  value="{{ date('Y-m-d') }}"  autocomplete="off"  readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Traveler Name:
                                        <input type='name' class="form-control"  value="{{ old('traveler_name') }}"  name='traveler_name' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Contact Number:
                                        <input id="contact_number" type="number" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        Birthdate:
                                        <input id='date_birth' type='date' value="{{ old('birthdate') }}" class="form-control"  name='birthdate'   autocomplete="off"  required>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Purpose of Travel:
                                        {{-- <select  name='purpose_of_travel'  class="chosen form-control"  autocomplete="off"  required>
                                            <option value='Meeting With Client'>Meeting With Client</option>
                                            <option value='B'>B</option>
                                            <option value='C'>C</option>
                                            <option value='D'>D</option>
                                        </select> --}}
                                        <input type='text' class="form-control"  value="{{ old('purpose_of_travel') }}" name='purpose_of_travel'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Destination: </h6>
                                        <select  name='destination'  class="chosen1 form-control"  autocomplete="off"  >
                                            <option value=''>Choose Destination</option>
                                            @foreach($destinations as $destination)
                                            <option value='{{$destination->id}}' {{ (Input::old("destination") == $destination->id ? "selected":"") }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Baggage Allowance: </h6>
                                        <select  name='kg'  class="form-control"  autocomplete="off"  required>
                                            <option value='0' {{ (Input::old("kg") == 0 ? "selected":"") }} >0 Kg</option>
                                            <option value='20' {{ (Input::old("kg") == 20 ? "selected":"") }}>20 Kg</option>
                                            <option value='32' {{ (Input::old("kg") == 32 ? "selected":"") }}>32 Kg</option>
                                            <option value='40'  {{ (Input::old("kg") == 40 ? "selected":"") }}>40 Kg</option>
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
                                        <input type='text' class="form-control"  value="{{ old('budget_line_code') }}"  name='budget_line_code' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Budget Approved:
                                        <input type='text' class="form-control" value="{{ old('budget_approved') }}" name='budget_approved' autocomplete="off" >
                                    </div>
                                    <div class="col-md-2">
                                        Budget Available:
                                        <input type='text' class="form-control"  value="{{ old('budget_available') }}" name='budget_available' autocomplete="off" >
                                    </div>
                                    <div class="col-md-3">
                                        GL Account:
                                        <input type='text' class="form-control" value="{{ old('gl_account') }}" name='gl_account' autocomplete="off" >
                                    </div>
                                    <div class="col-md-3">
                                        Cost Center:
                                        <input type='text' class="form-control" value="{{ old('cost_center') }}" name='cost_center' autocomplete="off" >
                                    </div>
                                </div>
                                <table id="form_table" class="table table-bordered field_wrapper">
                                    <tr class='case'>
                                        <th>ORIGIN:</th>
                                        <th>DESTINATION:</th>
                                        <th>Date of Travel</th>
                                        <th colspan='2'>Appointment Time</th>
                                    </tr>
                                    <tr class='case'>
                                        <td>
                                            <select  name='origin[]'  class="chosen form-control"  autocomplete="off" >
                                                <option value=''>Choose Origin</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}'  {{ (Input::old("origin.0") == $destination->id ? "selected":"") }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  name='destinationall[]'  class="chosen form-control"  autocomplete="off" >
                                                <option value=''>Choose Destination</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}' {{ (Input::old("destinationall.0") == $destination->id ? "selected":"") }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input id='origin_date' onkeydown='return false' value="{{ old('date_of_travel.0') }}"  class="form-control" type='date' name='date_of_travel[]' required/></td>
                                        <td colspan='2'><input id='appointment' class="form-control" type='time' value="{{ old('appointment.0') }}"  name='appointment[]' required/></td>
                                    </tr>
                                    <tr class='case'>
                                        <td style='width:30%;'>
                                            <select  name='origin[]'  class="chosen form-control"  autocomplete="off"  >
                                                <option value=''>Choose Origin</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}' {{ (Input::old("origin.1") == $destination->id ? "selected":"") }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style='width:30%;'>
                                            <select  name='destinationall[]'  class="chosen form-control"  autocomplete="off"  >
                                                <option value=''>Choose Destination</option>
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}' {{ (Input::old("destinationall.1") == $destination->id ? "selected":"") }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input id='destination' value="{{ old('date_of_travel.1') }}"    onkeydown='return false' class="form-control travel_date" type='date' name='date_of_travel[]' required/></td>
                                        <td colspan='2'><input id='appointment2' class="form-control" type='time'  value="{{ old('appointment.1') }}" name='appointment[]' required/></td>
                                    </tr>
                                </table>
                                <button type="button" id='add_more' class='btn btn-success addmore'>+ add new origin</button><br>  
                                <div class="header">
                                    <small>**HRD to file Approved Official Business Authorization (OBA) in Payroll Clerk File</small>
                                    <br><small>***ETD Origin minimum of two (2) hours from appointment time at destination</small>
                                    <br><small>****Miscellaneous Other Charges, if any like ASP, CCF</small>
                                </div>
                                <a href="{{ URL::previous() }}" onclick="show()" class="btn btn-info  btn-danger pull-right">Cancel</a>
                                <button type="submit"  class="btn btn-info btn-fill pull-right">Submit</button> 
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $(".addmore").on('click', function () {
                                    
                                    var dtToday = new Date();
                                    var month = dtToday.getMonth() + 1;
                                    var day = dtToday.getDate();
                                    var year = dtToday.getFullYear();
                                    if(month < 10)
                                    month = '0' + month.toString();
                                    if(day < 10)
                                    day = '0' + day.toString();
                                    var maxDate = year + '-' + month + '-' + day;
                                    $('body .travel_date').attr('min', maxDate);
                                    
                                    
                                    
                                    var count = $('table tr').length;
                                    if( count == 10)
                                    {
                                        document.getElementById("add_more").disabled = true;
                                    }
                                    var data = "<tr id='data' class='case'>";
                                        data += "<td style='width:30%;'><select  name='origin[]' class='chosen form-control'  autocomplete='off'  ><option value=''>Choose Origin</option>@foreach($destinations as $destination)<option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td style='width:30%;'><select  name='destinationall[]'  class='form-control chosen'  data-live-search='true' autocomplete='off' ><option value=''>Choose Destination</option>@foreach($destinations as $destination) <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td><input  onkeydown='return false'   class='form-control travel_date' type='date' min='"+ maxDate + "' name='date_of_travel[]' required/></td><td colspan='1'><input class='form-control' type='time' name='appointment[]' required/></td><td align='center' style='border:0;'><a  href='javascript:void(0);' class='removeButton'><img width='20px' height='20px' src='{{URL::asset('login_css/remove.png')}}'/></a></td></tr>";
                                        $('#form_table').append(data);
                                        count++;
                                        $(".chosen").chosen();
                                    });
                                    $('#form_table').on('click', '.removeButton', function(){
                                        $("#data").remove();
                                        document.getElementById("add_more").disabled = false;
                                    });
                                    function addZero(i) {
                                        if (i < 10) {
                                            i = "0" + i;
                                        }
                                        return i;
                                    }
                                    $(function(){
                                        var dtToday = new Date();
                                        var h = addZero(dtToday.getHours());
                                        var new_h = addZero(dtToday.getHours() + 2);
                                        var m = addZero(dtToday.getMinutes());
                                        time = h + ":" + m ;
                                        new_time = new_h + ":" + m;
                                        var from_date = '';
                                        var to_date = '';
                                        var new_to_date = '';
                                        var new_from_date = '';
                                        if(h >= 22)
                                        {
                                            var dtToday = new Date(Date.now()+24*60*60*1000);
                                        }
                                        else
                                        {
                                            var dtToday = new Date();
                                        }
                                        var month = dtToday.getMonth() + 1;
                                        var day = dtToday.getDate();
                                        var year = dtToday.getFullYear();
                                        if(month < 10)
                                        month = '0' + month.toString();
                                        if(day < 10)
                                        day = '0' + day.toString();
                                        var maxDate = year + '-' + month + '-' + day;
                                        $('body .travel_date').attr('min', maxDate);
                                        $('#origin_date').attr('min', maxDate);
                                        $('#date_birth').attr('max', maxDate);
                                        $('#origin_date').change(function(){
                                            //Date in full format alert(new Date(this.value));
                                            origin_date = new Date(this.value);
                                            var year=origin_date.getFullYear();
                                            var month=((origin_date.getMonth() + 1) < 10 ? '0' : '') + (origin_date.getMonth() + 1); //getMonth is zero based;
                                            var day=(origin_date.getDate() < 10 ? '0' : '') + origin_date.getDate();
                                            new_from_date=year+"-"+month+"-"+day;
                                            $('#appointment').val('')
                                            $('#appointment').attr('min',null)
                                            if(new_from_date == maxDate)
                                            {
                                                $('#appointment').val('')
                                                $('#appointment').attr('min',new_time)
                                            }
                                            if(new_from_date){
                                                $('body .travel_date').attr('min', new_from_date)
                                            }
                                        });
                                        $('#destination').change(function(){
                                            //Date in full format alert(new Date(this.value));
                                            origin_date = new Date(this.value);
                                            var year=origin_date.getFullYear();
                                            var month=((origin_date.getMonth() + 1) < 10 ? '0' : '') + (origin_date.getMonth() + 1); //getMonth is zero based;
                                            var day=(origin_date.getDate() < 10 ? '0' : '') + origin_date.getDate();
                                            new_from_date=year+"-"+month+"-"+day;
                                            $('#appointment2').val('')
                                            $('#appointment2').attr('min',null)
                                            if(new_from_date == maxDate)
                                            {
                                                $('#appointment2').attr('min',new_time)
                                            }
                                        });
                                    });
                                });
                            </script>
                            <script >
                                $(".chosen1").chosen();
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
        
        
        