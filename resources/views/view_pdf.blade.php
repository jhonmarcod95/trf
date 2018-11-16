
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
    </style>
    
    
    
    
    
    
</head>
<body>
    <table cellspacing='0'  width="100%" >
        <tr>
            <td class="wrapword">
                TRAVEL REQUEST FORM<br>
                <h6><i>LFHR-F-001 rev. 00 Effective date: 01 July 2013</i>
                </h6>
            </td>
            <td colspan='2'>
                
            </td>
            
        </tr>
        
        <tr>
            <td colspan='3'>
                Company Name: {{ $data_list[0]->company_name}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Request Date:  {{date ("M j, Y",strtotime($data_list[0]->request_date))}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Traveler Name:  {{ $data_list[0]->traveler_name}}
            </td>
            
            <td colspan='1'>
                Birth Date: {{date ("M j, Y",strtotime($data_list[0]->birth_date))}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Purpose of Travel:  {{ $data_list[0]->purpose_of_travel}}
            </td>
            <td colspan='1'>
                Contact Number:{{ $data_list[0]->contact_number}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Destination: {{ $data_list[0]->destination}}
            </td>
            
            <td colspan='1'>
                From: {{date ("M j, Y",strtotime($data_list[0]->date_from))}} To: {{date ("M j, Y",strtotime($data_list[0]->date_to))}}
            </td>
        </tr>
        <tr>
            <td colspan='3'>
                Baggage Allowance:{{ $data_list[0]->baggage_allowance}} KG
            </td >
            
        </tr>
    </table>
    <br>
    <table  width='100%'  class="wrapword">
        <tr  class="wrapword">
            <td style="vertical-align:top">
                <table  cellspacing='0'  width="100%" height="100%">
                    <tr>
                        <td class="wrapword">
                            TRAVEL PLAN REQUESTED
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
                    
                </table>
            </td>
            <td class="wrapword" style="vertical-align:top" >
                <table border='1' cellspacing='0'  width="100%"  class="wrapword">
                    <tr class="wrapword" style='padding:0px;margin:0px'>
                        <td>
                            <h6>ORIGIN-DESTINATION</h6>
                        </td>
                        <td>
                            <h6>Date of Travel</h6>
                        </td>
                        <td>
                            <h6>Apointment Time *** at Destination</h6>
                        </td>
                    </tr>
                    @foreach($origin as $key => $value)
                    <tr class="wrapword" style='padding:0px;margin:0px'>
                        <td>
                            <h6>{{$origing_new_new[$key][0]->destination. ' To ' .$value->destination}} </h6>
                        </td>
                        <td>
                            <h6>{{date ("M j, Y",strtotime($value->date_of_travel))}}</h6>
                        </td>
                        <td>
                            <h6>{{$value->time_appointment}} </h6>
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


