@extends('layouts.app')
@section('content')
<div class="collapse navbar-collapse">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">EDIT TRAVEL REQUEST </h4>
                            <small><i>LFHR-F-001 rev. 00 Effective date: 01 July 2013</i></small>
                        </div>
                        @include('error')
                        <div class="content">
                            <form method='POST' action='' target="" onsubmit='show()'>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        Company Name:
                                        <select  name='company_name'  class="chosen1 form-control" width='100%'  autocomplete="off"  required>
                                            <option value='{{$users_request->company_name}}'>{{$company_name->company_name}}</option>
                                            @foreach($companies as $company)
                                            <option value='{{$company->id}}'>{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Requestor Name:
                                        <input type='text' class="form-control"  name='requestor_name' value='{{ Auth::user()->name }}'  readonly>
                                    </div>
                                    <div class="col-md-2">
                                        Date Request:
                                        <input type='date' class="form-control"  name='date_request'  value="{{ date('Y-m-d') }}"  autocomplete="off"  readonly>
                                        <input type='hidden' class="form-control"  name='user_id'  value="{{ Auth::user()->id }}"  autocomplete="off"  readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Traveler Name:
                                        <input type='name' class="form-control"  name='traveler_name' value='{{$users_request->traveler_name}}' autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Contact Number:
                                        <input type='number' class="form-control" maxlength="11" name='contact_number'  value='{{$users_request->contact_number}}'  autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Birthdate:
                                        <input type='date' class="form-control"  name='birthdate' value='{{$users_request->birth_date}}'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Purpose of Travel:
                                        <input type='text' class="form-control" value="{{$users_request->purpose_of_travel}}" name='purpose_of_travel'   autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                        Destination:
                                        <select  name='destination'  class="chosen1 form-control"  autocomplete="off"  required>
                                            <option value='{{$users_request->destination}}'>{{$destination_name->destination.'('.$destination_name->code.')'}}</option>
                                            @foreach($destinations as $destination)
                                            <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Baggage Allowance:
                                        <select  name='kg'  class="form-control"  autocomplete="off"  required>
                                            <option  value='0' @if($users_request->baggage_allowance == 0) selected="selected" @endif>0 Kg</option>
                                            <option value='20' @if($users_request->baggage_allowance == 20) selected="selected" @endif>20 Kg</option>
                                            <option value='32' @if($users_request->baggage_allowance == 32) selected="selected" @endif>32 Kg</option>
                                            <option value='40' @if($users_request->baggage_allowance == 40) selected="selected" @endif>40 Kg</option>
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
                                        <input type='text' class="form-control"  name='budget_line_code' value="{{$users_request->budget_code_line}}" autocomplete="off"  required>
                                    </div>
                                    <div class="col-md-2">
                                        Budget Approved:
                                        <input type='text' class="form-control"  name='budget_approved' value="{{$users_request->budget_code_approved}}" autocomplete="off">
                                    </div>
                                    <div class="col-md-2">
                                        Budget Available:
                                        <input type='text' class="form-control"  name='budget_available' value="{{$users_request->budget_available}}" autocomplete="off">
                                    </div>
                                    <div class="col-md-3">
                                        GL Account:
                                        <input type='text' class="form-control"  name='gl_account' value="{{$users_request->gl_account}}"  autocomplete="off">
                                    </div>
                                    <div class="col-md-3">
                                        Cost Center:
                                        <input type='text' class="form-control"  name='cost_center' value="{{$users_request->cost_center}}"   autocomplete="off" >
                                    </div>
                                </div>
                                <table id="form_table" class="table table-bordered field_wrapper">
                                    <tr class='case'>
                                        <th>ORIGIN:</th>
                                        <th>DESTINATION:</th>
                                        <th>Date of Travel</th>
                                        <th colspan='2'>Appointment Time </th>
                                    </tr>
                                    @foreach($origin_list as $key => $value)
                                    <tr class='case'>
                                        <td style='width:30%;'>
                                            <select  name='origin[]'  class="chosen1 form-control"  autocomplete="off"  required>
                                                {{-- <option value='{{$value->origin}}'>{{$origin_new_new[$key][0]->destination.'('.$origin_new_new[$key][0]->code.')'}}</option> --}}
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}' {{ ($destination->id == $value->origin) ? 'selected="selected"' : '' }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style='width:30%;'>
                                            <select  name='destinationall[]'  class="chosen1 form-control"  autocomplete="off"  required>
                                                {{-- <option value='{{$value->destination}}'>{{$destination_new_new[$key][0]->destination.'('.$destination_new_new[$key][0]->code.')'}}</option> --}}
                                                @foreach($destinations as $destination)
                                                <option value='{{$destination->id}}' {{ ($destination->id == $value->destination) ? 'selected="selected"' : '' }}>{{$destination->destination.'('.$destination->code.')'}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input value='{{$value->date_of_travel}}' class="form-control travel_date" type='date' name='date_of_travel[]' required/></td>
                                        <td colspan='2'><input value='{{$value->time_appointment}}' class="form-control" type='time' name='appointment[]' required/></td>
                                    </tr>
                                    @endforeach
                                </table>
                                <button type="button" class='btn btn-success addmore'>+ add new origin</button><br>  
                                <div class="header">
                                    <small>**HRD to file Approved Official Business Authorization (OBA) in Payroll Clerk File</small>
                                    <br><small>***ETD Origin minimum of two (2) hours from appointment time at destination</small>
                                    <br><small>****Miscellaneous Other Charges, if any like ASP, CCF</small>
                                </div>
                                <a href="{{ URL::previous() }}" onclick='show()' class="btn btn-info  btn-danger pull-right">Cancel</a>
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
                                    var data = "<tr id='data' class='case'>";
                                        data += "<td style='width:30%;'><select  name='origin[]' class='chosen form-control'  autocomplete='off'  ><option value=''>Choose Origin</option>@foreach($destinations as $destination)<option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td style='width:30%;'><select  name='destinationall[]'  class='form-control chosen'  data-live-search='true' autocomplete='off' ><option value=''>Choose Destination</option>@foreach($destinations as $destination) <option value='{{$destination->id}}'>{{$destination->destination.'('.$destination->code.')'}}</option>@endforeach</select></td><td><input  onkeydown='return false'   class='form-control travel_date' type='date' min='"+ maxDate + "' name='date_of_travel[]' required/></td><td colspan='1'><input class='form-control' type='time' name='appointment[]' required/></td><td align='center' style='border:0;'><a  href='javascript:void(0);' class='removeButton'><img width='20px' height='20px' src='{{URL::asset('login_css/remove.png')}}'/></a></td></tr>";
                                        $('#form_table').append(data);
                                        count++;
                                        $(".chosen").chosen();
                                    });
                                    $('#form_table').on('click', '.removeButton', function(){
                                        $("#data").remove();
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
                                $(".chosen").chosen();
                                $(".chosen1").chosen();
                            </script>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        
        
        