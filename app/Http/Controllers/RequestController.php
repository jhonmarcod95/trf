<?php

namespace App\Http\Controllers;
use Redirect;
use Auth;
use Input;
use Validator;
use IlluminateSupportFacadesValidator;
use IlluminateFoundationBusDispatchesJobs;
use IlluminateRoutingController as BaseController;
use IlluminateFoundationValidationValidatesRequests;
use IlluminateFoundationAuthAccessAuthorizesRequests;
use IlluminateFoundationAuthAccessAuthorizesResources;
use IlluminateHtmlHtmlServiceProvider;
use Illuminate\Http\Request;
use PDF;
use Mail;
use App\Destination;
use App\Company;
use App\User_request;
use App\User_destination;
use App\User_approver;
use App\User;
use App\BookReference;
use App\Notifications\RequestNotif;
use App\Notifications\ForApprovalNotif;
use App\Notifications\ApproveNotif;
use App\Notifications\ApprovedBooking;
use App\Notifications\DisapproveNotif;
use App\Notifications\CancelRequest;
use App\Notifications\EditRequestNotif;


class RequestController extends Controller
{
    //
    public function login()
    {
        if (!Auth::user()){
            return view('login');
        }
        else{
            $companies = Company::orderBy('company_name','asc')->get(['id','company_name']);
            $destinations = Destination::orderBy('destination','asc')->get(['id','destination','code']);
            return view('form1',array
            (
                'companies' => $companies,
                'destinations' => $destinations
            )); 
        }
    }
    public function new_form(Request $request)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('new-request')
            ->withErrors($validator) // send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                
                $companies = Company::orderBy('company_name','asc')->get(['id','company_name']);
                $destinations = Destination::orderBy('destination','asc')->get(['id','destination','code']);
                return view('form1',array
                (
                    
                    'companies' => $companies,
                    'destinations' => $destinations
                )); 
                
            } 
            else {
                // send back all errors to the login form
                // validation not successful, send back to form 
                $request->session()->flash('status', 'Sorry, the email and password you entered do not match.');
                return Redirect::to('new-request');
            }
        }
    }
    public function for_approval()
    {
     
        
        $user_approver = User_approver::where('approver_id','=',auth()->user()->id)->get()->pluck('user_id');
    
        $userapprover = $user_approver->toArray();
  
        $pending_requests = User_request::
        with('baggageAllowance','baggageAllowance.destinationInfo','baggageAllowance.originInfo')
        ->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->leftJoin('users', 'user_requests.requestor_id', '=', 'users.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name', 'users.name')
        ->whereIn('requestor_id', $userapprover)
        ->where('status','=','1')
        ->get();
        return view('for_approval',['pending_requests' => $pending_requests ]);
    }
    public function cancelled_request()
    {
        $cancelled_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->leftJoin('users', 'user_requests.approved_by', '=', 'users.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name', 'users.name')
        ->where('requestor_id','=',auth()->user()->id)
        ->where('status','=','3')
        ->get();
        return view('cancelled_request',['cancelled_requests' => $cancelled_requests ]);
    }
    public function pending_list()
    {
        $pending_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
        ->where('requestor_id','=',auth()->user()->id)
        ->where('status','=','1')
        ->get();
        return view('show',['pending_requests' => $pending_requests ]);
    }
    public function approved()
    {
        $approved_requests= User_request::doesntHave('bookReferences')->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->leftJoin('users', 'user_requests.approved_by', '=', 'users.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name', 'users.name')
        ->where('requestor_id','=',auth()->user()->id)
        ->where('status','=','2')
        ->get();
        return view('approved',['approved_requests' => $approved_requests ]);
    }
    public function pdf ($id)
    {
        $data_list= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->leftJoin('users', 'user_requests.requestor_id', '=', 'users.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name', 'users.name')
        ->where('user_requests.id','=',$id)
        ->get();
        
        $origin_list= User_destination::leftJoin('destinations','user_destinations.destination','=','destinations.id')
        ->where('request_id','=',$id)
        ->get();
        foreach($origin_list as $origin){
            $origin_new = Destination::where('id',$origin->origin)
            ->get();
            $origing_new_new[]=$origin_new;
        }
        
        $pdf = PDF::loadView('view_pdf',array
        (
            'data_list' => $data_list,
            'origin' => $origin_list,
            'origing_new_new' =>$origing_new_new,
            
        ))->setPaper('letter', 'landscape');; 
        return $pdf->stream('trf.pdf');
    }
    public function save_new_request(Request $request)
    {   
        // dd($request->all());
        $this->validate(request(),[
            'company_name' => 'required',
            'date_request' => 'required',
            'birthdate' => 'required',
            'contact_number' => 'required|min:13|numeric',
            'purpose_of_travel' => 'required|max:255',
            'traveler_name' => 'required',
            'destination' => 'required',
            'kg' => 'required',
            'origin' => 'required|array|between:1,10',
            'origin.*' => 'required',
            'destinationall' => 'required|array|between:1,10',
            'destinationall.*' => 'required|different:origin.*',
            'budget_line_code' => 'required',
            'date_of_travel' => 'required|array|between:1,10',
            'appointment' => 'required|array|between:1,10',
            ] ,[
            'destinationall.*.different'    => 'Destination and Origin must be different.',
            'destinationall.*.required'    => 'Please check destination bellow. Destination is required',
            'origin.*.required'    => 'Please check origin bellow. Destination is required',]
        );

        
        foreach($request->input('origin') as $key => $origin)
        {
            if($key != 0)
            {
                $new_key = $key - 1 ;
                $this->validate(request(),[
                    'date_of_travel.'.$key => 'after_or_equal:date_of_travel.'.$new_key,
                    ] ,['date_of_travel.'.$key.'.after_or_equal' => 'Please Check Date of Travel Bellow. The Origin Date must be Equal or After the Next Date/s',]
                );
            }
        }
        $data = new User_request;
        $user_id=auth()->user()->id;
        $company_name=$request->input('company_name');
        $date_request=$request->input('date_request');
        $birthdate=$request->input('birthdate');
        $purpose_of_travel=$request->input('purpose_of_travel');
        $traveler_name=$request->input('traveler_name');
        $contact_number=$request->input('contact_number');
        $destination=$request->input('destination');
        $budget_line_code=$request->input('budget_line_code');
        $budget_approved=$request->input('budget_approved');
        $budget_available=$request->input('budget_available');
        $gl_account=$request->input('gl_account');
        $cost_center=$request->input('cost_center');
        $origins=$request->input('origin');
        $destinationalls=$request->input('destinationall');
        $date_of_travels=$request->input('date_of_travel');
        $appointments=$request->input('appointment');
        $firstEle = $date_of_travels[0];
        $lastEle = $date_of_travels[count($date_of_travels) - 1];
        $data->requestor_id = $user_id;
        $data->company_name = $company_name;
        $data->request_date = $date_request;
        $data->birth_date = $birthdate;
        $data->purpose_of_travel = $purpose_of_travel;
        $data->contact_number = $contact_number;
        $data->destination = $destination;
        $data->date_from = $firstEle;
        $data->date_to = $lastEle;
        $data->budget_code_line = $budget_line_code;
        $data->budget_code_approved = $budget_approved;
        $data->budget_available = $budget_available;
        $data->gl_account = $gl_account;
        $data->cost_center = $cost_center;
        $data->status = 1;
        $data->traveler_name = $traveler_name;
        $data->approved_by = 0;
        $data->save();
        $id = User_request::all()->last();
        foreach($origins as $key => $origin)
        {
            $data1 = new User_destination;
            $data1->origin = $origin;
            $data1->destination = $destinationalls[$key];
            $data1->date_of_travel = $date_of_travels[$key];
            $data1->time_appointment = $appointments[$key];
            $data1->baggage_allowance = $request->kg[$key];
            if (array_key_exists($key,$request->reason))
            {
                $data1->reason  = $request->reason[$key];
            }
            $data1->request_id = $id->id;
            $data1->save();
        }
        $user = auth()->user();
        $destination_name = Destination::where('id','=',$data->destination)->get();
        $new_destination = $destination_name[0]->destination;
        
        $approver1 = User_approver::where('user_id','=',auth()->user()->id)->get();
        if(!$approver1->isEmpty())
        {
            $approver= User::where('id','=',$approver1[0]->approver_id)->get();
            $approver[0]->notify(new ForApprovalNotif($data,  $new_destination));
        }
        $user->notify(new RequestNotif($data, $new_destination));
        return redirect('/pending-request');
    }
    public function approve_request(Request $request, $id)
    {
        $users_request = User_request::findOrFail($id);
        $user_id=$users_request->requestor_id;
        $user = User::findOrFail($user_id);
        if($users_request) {
            $users_request->status = 2;
            $users_request->approved_by = auth()->user()->id;
            $users_request->save();
        }
        $destination_name = Destination::where('id','=',$users_request->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $user->notify(new ApproveNotif($users_request,$new_destination));
        $user_book = User::where('cebu_email',1)->first();
        $user_book->notify(new ApprovedBooking($users_request,$new_destination));
        $request->session()->flash('status', ''.$users_request->traveler_name.' Request has been Approved!');
        return redirect('/for-approval');
    }
    public function disapprove_request($id)
    {
        $users_request = User_request::findOrFail($id);
        return view('disapproved_remarks',['users_request' => $users_request ]);
    }
    public function edit_request($id)
    {
        
        $company_name = User_request::leftJoin('companies','user_requests.company_name','=','companies.id')
        ->findOrFail($id);
        $destination_name = User_request::leftJoin('destinations','user_requests.destination','=','destinations.id')
        ->findOrFail($id);
        
        $users_request = User_request::findOrFail($id);
        $companies = Company::where('id' , '!=' , $users_request->company_name)
        ->orderBy('company_name','asc')
        ->get();
        
        $destinations = Destination::orderBy('destination','asc')
        ->get(['id','destination','code']);
        
        $origin_list = User_destination::where('request_id','=',$id)
        ->get();
        foreach($origin_list as $origin){
            $origin_new = Destination::where('id',$origin->origin)
            ->get();
            $destination_new = Destination::where('id',$origin->destination)
            ->get();
            $origin_new_new[]=$origin_new;
            $destination_new_new[]=$destination_new;
        }
        
        return view('edit_request',array
        (
            'companies' => $companies,
            'destinations' => $destinations,
            'users_request' => $users_request,
            'company_name' => $company_name,
            'destination_name' => $destination_name,
            'origin_list' => $origin_list,
            'origin_new_new' => $origin_new_new,
            'destination_new_new' => $destination_new_new,
            
        )); 
    }
    public function save_edit_request(Request $request, $id)
    {
        $this->validate(request(),[
            'company_name' => 'required',
            'date_request' => 'required',
            'birthdate' => 'required',
            'contact_number' => 'required|min:13|numeric',
            'purpose_of_travel' => 'required|max:255',
            'traveler_name' => 'required',
            'destination' => 'required',
            'kg' => 'required',
            'origin' => 'required|array|between:2,10',
            'destinationall' => 'required|array|between:2,10',
            'destinationall.*' => 'required|different:origin.*',
            'budget_line_code' => 'required',
            'date_of_travel' => 'required|array|between:2,10',
            'appointment' => 'required|array|between:2,10',
            ] ,['destinationall.*.different'    => 'Destination and Origin must be different.',]
        );
        foreach($request->input('origin') as $key => $origin)
        {
            if($key != 0)
            {
                $new_key = $key - 1 ;
                $this->validate(request(),[
                    'date_of_travel.'.$key => 'after_or_equal:date_of_travel.'.$new_key,
                    ] ,['date_of_travel.'.$key.'.after_or_equal' => 'Please Check Date of Travel Bellow. The Origin Date must be Equal or After the Next Date/s',]
                );
            }
        }
        $data =  User_request::find($id); 
        $company_name=$request->input('company_name');
        $date_request=$request->input('date_request');
        $birthdate=$request->input('birthdate');
        $purpose_of_travel=$request->input('purpose_of_travel');
        $traveler_name=$request->input('traveler_name');
        $contact_number=$request->input('contact_number');
        $destination=$request->input('destination');
        $baggage=$request->input('baggage');
        $kg=$request->input('kg');
        $budget_line_code=$request->input('budget_line_code');
        $budget_approved=$request->input('budget_approved');
        $budget_available=$request->input('budget_available');
        $gl_account=$request->input('gl_account');
        $cost_center=$request->input('cost_center');
        $origins=$request->input('origin');
        $destinationalls=$request->input('destinationall');
        $date_of_travels=$request->input('date_of_travel');
        $appointments=$request->input('appointment');
        $firstEle = $date_of_travels[0];
        $lastEle = $date_of_travels[count($date_of_travels) - 1];
        $data->company_name = $company_name;
        $data->request_date = $date_request;
        $data->birth_date = $birthdate;
        $data->purpose_of_travel = $purpose_of_travel;
        $data->contact_number = $contact_number;
        $data->destination = $destination;
        $data->date_from = $firstEle;
        $data->date_to = $lastEle;
        $data->baggage_allowance = $kg;
        $data->budget_code_line = $budget_line_code;
        $data->budget_code_approved = $budget_approved;
        $data->budget_available = $budget_available;
        $data->gl_account = $gl_account;
        $data->cost_center = $cost_center;
        $data->traveler_name = $traveler_name;
        $data->save();
        $delete_data = User_destination::where('request_id',$id)->get();
        foreach($delete_data as $delete_d){
            $delete_data1 = User_destination::find($delete_d->id);
            $delete_data1->delete();
        }
        foreach($origins as $key => $origin)
        {   
            $data1 = new User_destination;
            $data1->origin = $origin;
            $data1->destination = $destinationalls[$key];
            $data1->date_of_travel = $date_of_travels[$key];
            $data1->time_appointment = $appointments[$key];
            $data1->request_id = $id;
            $data1->save();
        }
        $user = auth()->user();
        $destination_name = Destination::where('id','=',$data->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $approver1 = User_approver::where('user_id','=',auth()->user()->id)->get();
        if(!$approver1->isEmpty()){
            $approver= User::where('id','=',$approver1[0]->approver_id)->get();
            $approver[0]->notify(new ForApprovalNotif($data,  $new_destination));
        }
        $user->notify(new EditRequestNotif($data, $new_destination));
        $request->session()->flash('status', ''.$data->traveler_name.' Request has been Updated');
        return redirect('/pending-request');
        
    }
    public function approved_history()
    {
        $approved_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
        ->where('approved_by','=',auth()->user()->id)
        ->where('status','=','2')
        ->get();
        return view('approved_history',['approved_requests' => $approved_requests ]);
    }
    public function disapproved_history()
    {
        $approved_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
        ->where('approved_by','=',auth()->user()->id)
        ->where('status','=','3')
        ->get();
        return view('disapproved_history',['approved_requests' => $approved_requests ]);
    }
    public function save_disapprove_request(Request $request, $id)
    {
        $remarks  = $request->remarks;
        $users_request = User_request::findOrFail($id);
        $user_id=$users_request->requestor_id;
        $user = User::findOrFail($user_id);
        if($users_request) {
            $users_request->status = 3;
            $users_request->remarks = $request->remarks;
            $users_request->approved_by = auth()->user()->id;
            $users_request->save();
        }
        $destination_name = Destination::where('id','=',$users_request->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $user->notify(new DisapproveNotif($users_request,$new_destination, $remarks));
        $request->session()->flash('status', ''.$users_request->traveler_name.' Request has been disapproved!');
        return redirect('/for-approval');
    }
    public function cancel_request($id)
    {
        $users_request = User_request::findOrFail($id);
        return view('cancel_remarks',['users_request' => $users_request ]);
    }
    public function save_cancel_request(Request $request, $id)
    {
        $remarks  = $request->remarks;
        $users_request = User_request::findOrFail($id);
        $user_id=$users_request->requestor_id;
        $user = User::findOrFail($user_id);
        if($users_request) {
            $users_request->status = 3;
            $users_request->remarks = $request->remarks;
            $users_request->approved_by = auth()->user()->id;
            $users_request->save();
        }
        $destination_name = Destination::where('id','=',$users_request->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $user->notify(new CancelRequest($users_request,$new_destination, $remarks));
        $request->session()->flash('status', ''.$users_request->traveler_name.' Request has been Cancelled!');
        return redirect('/pending-request');
    }
    public function save_for_approval(Request $request)
    {
        
        if($request->array)
        {
            foreach($request->array as $arr)
            {
                $users_request = User_request::findOrFail($arr);
                $user_id=$users_request->requestor_id;
                $user = User::findOrFail($user_id);
                if($users_request) {
                    $users_request->status = 2;
                    $users_request->approved_by = auth()->user()->id;
                    $users_request->save();
                }
                $destination_name = Destination::where('id','=',$users_request->destination)->get();
                $new_destination = $destination_name[0]->destination;
                $user->notify(new ApproveNotif($users_request,$new_destination));
            }
            $request->session()->flash('status', 'Request has been Approved!');
            return redirect('/for-approval');
        }
        else
        {
            $request->session()->flash('error', 'Please select atleast one checkbox!');
            return redirect('/for-approval');
        }
    }
    public function reference (Request $request,$requestID)
    {

        foreach($request->reference_id as $key => $reference_id)
        {
            $bookreference = new BookReference;
            $bookreference->request_id = $requestID;
            $bookreference->booking_id = $reference_id;
            $bookreference->booking_type = $request->type[$key];
            $bookreference->amount = $request->amount[$key];
            $bookreference->date_booked = $request->date_booked[$key];
            $bookreference->encode_by = auth()->user()->id;
            
            $original_name = str_replace(' ', '',$request->file_upload[$key]->getClientOriginalName());
            $name = time().'_'.$original_name;
            $request->file_upload[$key]->move(public_path().'/bookrefer/', $name);
            $file_name = '/bookrefer/'.$name;
            $original_name1 = str_replace(' ', '',$request->file_upload_or[$key]->getClientOriginalName());
            $name1 = time().'_'.$original_name1;
            $request->file_upload_or[$key]->move(public_path().'/bookor/', $name1);
            $file_name1 = '/bookor/'.$name1;
            $bookreference->upload_receipt = $file_name1;
            $bookreference->upload_file = $file_name;
            $bookreference->save();
        }
   

        $request->session()->flash('status','Successfully Enter reference number.');
        return back();
    }
    public function request()
    {
        $pending_requests = User_request::with('approverInfo','approverInfo.approver')
        ->leftJoin('users','user_requests.requestor_id','=','users.id')
        ->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name','users.name')
        ->where('status','1')
        ->orderBy('id','desc')
        ->get();
        $approves = User_request::doesntHave('bookReferences')
        ->leftJoin('users','user_requests.requestor_id','=','users.id')
        ->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name','users.name')
        ->where('status','2')
        ->orderBy('id','desc')
        ->get();
        return view('request',['pending_requests' => $pending_requests ,
        'approves' => $approves
        ]);
    }
    public function bookedRequest ()
    {
      
        if(auth()->user()->role == 1)
        {
        $bookedRequests = User_request::with('approverInfo','approverInfo.approver','bookReferences')
        ->whereHas('bookReferences')
        ->leftJoin('users','user_requests.requestor_id','=','users.id')
        ->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->leftJoin('users as user_approver','user_requests.approved_by','=','user_approver.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name','users.name','user_approver.name as user_approver_name')
        ->where('status','2')
        ->orderBy('id','desc')
        ->get();
        }
        else
        {
            $bookedRequests = User_request::with('approverInfo','approverInfo.approver','bookReferences')
            ->whereHas('bookReferences')
            ->leftJoin('users','user_requests.requestor_id','=','users.id')
            ->leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
            ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
            ->leftJoin('users as user_approver','user_requests.approved_by','=','user_approver.id')
            ->select('user_requests.*', 'destinations.destination', 'companies.company_name','users.name','user_approver.name as user_approver_name')
            ->where('status','2')
            ->where('requestor_id','=',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();
        }
        return view('view_booked_request',array(
            'booked_requests' => $bookedRequests,
        ));
    }
    public function bookedHistoryOutside(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $results = [];
        if($from)
        {
        $results = BookReference::with('travelInfo','travelInfo.approverInfo','travelInfo.userInfo','travelInfo.companyInfo','travelInfo.approverInfo.approver')->whereBetween('date_booked',[$from,$to])->get();
            // return ($results);
        }
        return view('outsideReport',array(
            'from' => $from,
            'to' => $to,
            'results' => $results,

        ));
    }
    public function bookedHistory(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $results = [];
        if($from)
        {
        $results = BookReference::with('travelInfo','travelInfo.approverInfo','travelInfo.userInfo','travelInfo.companyInfo','travelInfo.approverInfo.approver')->whereBetween('date_booked',[$from,$to])->get();
            // return ($results);
        }
        return view('view_booked_history',array(
            'from' => $from,
            'to' => $to,
            'results' => $results,

        ));
    }
    public function approveRequest(Request $request,$requestID)
    {
        if($request->action)
        {
            foreach($request->action as $key => $action)
            {
                $userDestination = User_destination::findOrfail($key);
                $userDestination->status = $action;
                $userDestination->action_by = auth()->user()->id;
            }
        }
        $users_request = User_request::findOrFail($requestID);
        $user_id=$users_request->requestor_id;
        $user = User::findOrFail($user_id);
        if($users_request) {
            $users_request->status = 2;
            $users_request->approved_by = auth()->user()->id;
            $users_request->save();
        }
        $destination_name = Destination::where('id','=',$users_request->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $user->notify(new ApproveNotif($users_request,$new_destination));
        $user_book = User::where('cebu_email',1)->first();
        $user_book->notify(new ApprovedBooking($users_request,$new_destination));
        $request->session()->flash('status', ''.$users_request->traveler_name.' Request has been Approved!');
        return redirect('/for-approval');
    }
}
