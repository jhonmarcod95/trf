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
                Company Name: {{$company_name}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Requested Date: {{date ("M j, Y",strtotime($date_request))}}
            </td>
            <td colspan='1'>
                Employee Number: {{$employee_id}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Requestor: {{$requestor_name}}
            </td>
            
            <td colspan='1'>
                Birth Date: {{date ("M j, Y",strtotime($birthdate))}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Purpose of Travel: {{$purpose_of_travel}}
            </td>
            <td colspan='1'>
                Contact Number: {{$contact_number}}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Destination: {{$destination}}
            </td>
            
            <td colspan='1'>
                From: {{date ("M j, Y",strtotime($date_from))}} To: {{date ("M j, Y",strtotime($date_to))}}
            </td>
        </tr>
        <tr>
            <td colspan='3'>
                Baggage Allowance: {{$kg}} KG
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
                            Budget Line Code: {{$budget_line_code}}
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapword">
                            Budget Approved: {{$budget_approved}}
                        </td>
                        
                    </tr>
                    <tr>
                        <td class="wrapword">
                            Budget Available: {{$budget_available}}
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapword">
                            GL Account: {{$gl_account}}
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapword">
                            Cost Center: {{$cost_center}}
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
                        <h6>{{$value." - ".$destinationall["$key"]}}</h6>
                        </td>
                        <td>
                            <h6>{{date ("M j, Y",strtotime($date_from))}} To: {{date ("M j, Y",strtotime($date_of_travel[$key]))}}</h6>
                        </td>
                        <td>
                            <h6>{{$appointment[$key]}}</h6>
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


