@extends('layouts.app2')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Booked History</p>
            </a>
        </li>
    </ul>
</div>
</div>
</nav>	
<div class='row col-md-12'>
    @if(session()->has('status'))
    <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('status')}}</strong>
    </div>
    @endif
</div>


<div class="content">
    <div class="container-fluid">
        <form  method="GET" action="" onsubmit= "show()">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        From
                        <input type="date" value='{{$from}}' class="form-control" name="from"  id='from' required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        To
                        <input type="date" value='{{$to}}' class="form-control" name="to" id='to'  required>
                        
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-info btn-fill">Generate</button>
                    </div>
                </div>
            </div>
            
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="content table-responsive table-full-width">
                        @if($results != null)
                        <button  class="btn-sm btn-success  btn-fill" onclick="exportF(this)">Export to Excel</button>
                        
                        Period: <span id='period'> {{date('M d, Y',strtotime($from)).' - '.date('M d, Y',strtotime($to)) }} 
                            @endif
                            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                
                                <thead>
                                    <td width='150px;'>TRF Number </td>
                                    <td>Requestor </td>
                                    <td>Traveler Name</td>
                                    <td>Budget Code</td>
                                    <td>Company</td>
                                    <td>Approved By</td>
                                    <td>Reference Number</td>
                                    <td>Booked Date</td>
                                    <td>Amount</td>
                                    <td>Type</td>
                                    <td>Ticket</td>
                                    <td>Official Receipt</td>
                                    <td>TRF</td>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)   
                                    @if(date('Y') == '2019')
                                    @php
                                    $length = strlen($result->travelInfo->trf_number);
                                    if($length == 1)
                                    {
                                        $reference_id = "00".$result->travelInfo->trf_number;
                                    }
                                    elseif($length == 2)
                                    {
                                        $reference_id = "0".$result->travelInfo->trf_number;
                                    }
                                  
                                    else
                                    {
                                        $reference_id = $result->travelInfo->trf_number;
                                    }
                                    @endphp
                                    @else
                                    @php
                                    $length = strlen($result->travelInfo->trf_number);
                                    if($length == 1)
                                    {
                                        $reference_id = "0000".$result->travelInfo->trf_number;
                                    }
                                    elseif($length == 2)
                                    {
                                        $reference_id = "000".$result->travelInfo->trf_number;
                                    }
                                    elseif($length == 3)
                                    {
                                        $reference_id = "00".$result->travelInfo->trf_number;
                                    }
                                    elseif($length == 4)
                                    {
                                        $reference_id = "0".$result->travelInfo->trf_number;
                                    }
                                    else
                                    {
                                        $reference_id = $result->travelInfo->trf_number;
                                    }
                                    @endphp
                                    @endif
                                    <tr>
                                            <td width='130px;'>TRF-{{date('Y',strtotime($result->created_at))}}-{{$reference_id}}</td>
                                        <td>{{$result->travelInfo->userInfo->name}}</td>
                                        <td>{{$result->travelInfo->traveler_name}}</td>
                                        <td>{{$result->travelInfo->budget_code_line}}</td>
                                        <td>{{$result->travelInfo->companyInfo->company_name}}</td>
                                        <td>{{$result->travelInfo->approveBy->name}}</td>
                                        <td>{{$result->booking_id}}</td>
                                        <td>{{$result->date_booked}}</td>
                                        <td>{{$result->amount}}</td>
                                        <td>{{$result->booking_type}}</td>
                                        <td><a href='{{ URL::asset($result->upload_file) }}' target="_blank">Download</a></td>
                                        <td><a href='{{ URL::asset($result->upload_receipt) }}' target="_blank">Download</a></td>
                                        <td>   <a href="show-pdf/{{$result->travelInfo->id}}"  class="btn btn-info btn-sm" target="_blank"><i class='pe-7s-monitor'></i> View</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script>
        function exportF(elem) {
            // var company_name =  document.getElementById('company_name').innerHTML;  
            var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
                var textRange; var j = 0;
                tab = document.getElementById('example');//.getElementsByTagName('table'); // id of table
                if (tab==null) {
                    return false;
                }
                if (tab.rows.length == 0) {
                    return false;
                }
                
                for (j = 0 ; j < tab.rows.length ; j++) {
                    tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                    //tab_text=tab_text+"</tr>";
                }
                
                tab_text = tab_text + "</table>";
                tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
                tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
                tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
                
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");
                
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                {
                    txtArea1.document.open("txt/html", "replace");
                    txtArea1.document.write(tab_text);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs", true, period+".xls");
                }
                else                 //other browser not tested on IE 11
                //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
                try {
                    var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                    window.URL = window.URL || window.webkitURL;
                    link = window.URL.createObjectURL(blob);
                    a = document.createElement("a");
                    if (document.getElementById("caption")!=null) {
                        a.download=document.getElementById("caption").innerText;
                    }
                    else
                    {
                        a.download =  period;
                    }
                    
                    a.href = link;
                    
                    document.body.appendChild(a);
                    
                    a.click();
                    
                    document.body.removeChild(a);
                } catch (e) {
                }
                
                
                return false;
                //return (sa);
            }
        </script>
        <script src="{{ asset('/datable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('/datable/js/dataTables.bootstrap4.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "lengthMenu": [[-1], [ "All"]]
                } );
            } );
           
        </script>  
        @endsection
        
        
        