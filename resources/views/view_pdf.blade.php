<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New-Travel-Request</title>
    <style>
        .wrapword{
            white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
            white-space: -webkit-pre-wrap; /*Chrome & Safari */ 
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            white-space: pre-wrap;       /* css-3 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
            word-break: break-all;
            white-space: normal;
        }
        h6{
            padding:0px;
            margin:0px;
        }
        .border{
            border:ridge;
            text-align:center;
        }
        .aligntop {vertical-align:top;}
    </style>
</head>
<body>
    <table cellspacing='0'  width="100%"  >
        <tr>
            <td class="wrapword" colspan='2' >
                <b>TRAVEL REQUEST FORM</b>
                <br>
                <h6><i>LFHR-F-001 rev. 00 Effective date: 01 July 2013</i></h6>
            </td>
            @if(date('Y') == '2019')
            @php
            $length = strlen($data_list[0]->trf_number);
            if($length == 1)
            {
                $reference_id = "00".$data_list[0]->trf_number;
            }
            elseif($length == 2)
            {
                $reference_id = "0".$data_list[0]->trf_number;
            }
            
            else
            {
                $reference_id = $data_list[0]->trf_number;
            }
            @endphp
            @else
            @php
            $length = strlen($data_list[0]->trf_number);
            
            if($length == 1)
            {
                $reference_id = "0000".$data_list[0]->trf_number;
            }
            elseif($length == 2)
            {
                $reference_id = "000".$data_list[0]->trf_number;
            }
            elseif($length == 3)
            {
                $reference_id = "00".$data_list[0]->trf_number;
            }
            elseif($length == 4)
            {
                $reference_id = "0".$data_list[0]->trf_number;
            }
            else
            {
                $reference_id = $data_list[0]->trf_number;
            }
            @endphp
            @endif
            <td class="wrapword" colspan='2' >
                <b>TRF-{{date('Y',strtotime($data_list[0]->created_at))}}-{{$reference_id}}</b>
                
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Company Name: {{ $data_list[0]->company_name}}
            </td>
            <td colspan='2'>
                Birth Date: {{date ("F j, Y",strtotime($data_list[0]->birth_date))}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Request Date:  {{date ("F j, Y",strtotime($data_list[0]->request_date))}}
            </td>
            <td colspan='2'>
                Contact Number: {{ $data_list[0]->contact_number}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Traveler Name:  {{ $data_list[0]->traveler_name}}
            </td>
            <td  colspan='2'>
                Dates of Travel : {{date ("M. j, Y",strtotime($data_list[0]->date_from))}} - {{date ("M. j, Y",strtotime($data_list[0]->date_to))}}
            </td>
        </tr>
        <tr>
            <td colspan='2'  width='50%' class="aligntop">
                Request By: {{ $data_list[0]->name}}
            </td>
            <td colspan='2'  class="aligntop">
                Destination: {{ $data_list[0]->destination}}
            </td>
        </tr>
        <tr>
            <td colspan='2'  width='50%' class="aligntop">
                Purpose of Travel:  {{ $data_list[0]->purpose_of_travel}}
            </td>
            @if($data_list[0]->baggage_allowance != null)
            <td colspan='2'  class="aligntop">
                Baggage Allowance: {{ $data_list[0]->baggage_allowance}} Kg
            </td>
            @endif
        </tr>
    </table>
    <br>
    <table  width='100%'  class="wrapword">
        <tr  class="wrapword">
            <td style="vertical-align:top">
                <table  cellspacing='0'  width="100%" height="100%">
                    <tr>
                        <td class="wrapword">
                            <b>TRAVEL PLAN REQUESTED
                            </td>
                        </tr>
                        <tr>
                            <td class="wrapword">
                                Budget Line Code: {{ $data_list[0]->budget_code_line}}
                            </td>
                        </tr>
                        <tr>
                            <td class="wrapword">
                                Budget Approved: {{ $data_list[0]->budget_code_approved}}
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="wrapword">
                                Budget Available:  {{ $data_list[0]->budget_available}}
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="wrapword">
                                GL Account: {{ $data_list[0]->gl_account}}
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="wrapword">
                                Cost Center:  {{ $data_list[0]->cost_center}}
                            </td>
                        </tr>
                        <tr>
                                <td class="wrapword">
                                   Approved By:  @if($data_list[0]->approveBy != null){{$data_list[0]->approveBy->name}}@endif
                                </td>
                            </tr>
                    </table>
                </td>
                <td class="wrapword" style="vertical-align:top" >
                    <table border='1' cellspacing='0'  width="100%"  class="wrapword">
                        <tr class="wrapword" style='padding:0px;margin:0px'>
                            <td>
                                Origin-Destination
                            </td>
                            <td>
                                Date of Travel
                            </td>
                            <td>
                                Baggage
                            </td>
                            <td>
                                Flight Time
                            </td>
                        </tr>
                        @foreach($origin as $key => $value)
                        <tr class="wrapword" style='padding:0px;margin:0px'>
                            <td>
                                {{$origing_new_new[$key][0]->destination. ' To ' .$value->destination}}
                            </td>
                            <td>
                                {{date ("F j, Y",strtotime($value->date_of_travel))}}
                            </td>
                            <td>
                                @if($value->status == "Approve")
                                    @if($value->baggage_allowance == null)
                                    0 KG
                                    @else
                                    {{$value->baggage_allowance}} KG
                                    @endif
                                @else
                                    0 KG
                                @endif
                            <td>
                                {{date('h:i a',strtotime($value->time_appointment))}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="wrapword">
                    <h6>**HRD to file Approved Official Business Authorization (OBA) in Payroll Clerk File</h6>
                    <h6>***ETD Origin minimum of two (2) hours from appointment time at destination</h6>
                    <h6>****Miscellaneous Other Charges, if any like ASP, CCF</h6>
                </td>
            </tr>
        </table>
    </body>
    </html>
    
    
    