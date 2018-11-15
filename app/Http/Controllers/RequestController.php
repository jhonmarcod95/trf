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
use App\Notifications\RequestNotif;
use App\Notifications\ForApprovalNotif;
use App\Notifications\ApproveNotif;
use App\Notifications\DisapproveNotif;


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
            return view('form',array
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
                return view('form',array
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
        $pending_requests=[];
        $userapprover=[];
        $user_approver = User_approver::where('approver_id','=',auth()->user()->id)->get();
        if($user_approver){
            foreach($user_approver as $approver){
                $pending_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
                ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
                ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
                ->where('requestor_id','=', $approver->user_id)
                ->where('status','=','1')
                ->get();
            }
        }
        return view('for_approval',['pending_requests' => $pending_requests ]);
    }
    public function cancelled_request()
    {
        $cancelled_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
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
        $approved_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
        ->where('requestor_id','=',auth()->user()->id)
        ->where('status','=','2')
        ->get();
        return view('approved',['approved_requests' => $approved_requests ]);
    }
    public function pdf ($id)
    {
        $data_list= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
        ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
        ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
        ->where('user_requests.id','=',$id)
        ->get();

        $origin_list= User_destination::leftJoin('destinations as u1', 'user_destinations.destination', '=', 'u1.id')
        ->leftJoin('destinations as u2', 'user_destinations.origin', '=', 'u2.id')
        ->select('user_destinations.*', 'u1.destination' ,  'u2.destination')
        ->where('request_id','=',$id)
        ->get();

        $pdf = PDF::loadView('view_pdf',array
        (
            'data_list' => $data_list,
            'origin' => $origin_list
        )); 
        return $pdf->stream('trf.pdf');
    }
    public function save_new_request(Request $request)
    {
        $data = new User_request;
        $user_id=$request->input('user_id');
        $company_name=$request->input('company_name');
        $date_request=$request->input('date_request');
        $birthdate=$request->input('birthdate');
        $purpose_of_travel=$request->input('purpose_of_travel');
        $traveler_name=$request->input('traveler_name');
        $contact_number=$request->input('contact_number');
        $destination=$request->input('destination');
        $date_from=$request->input('date_from');
        $date_to=$request->input('date_to');
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
        
        $data->requestor_id = $user_id;
        $data->company_name = $company_name;
        $data->request_date = $date_request;
        $data->purpose_of_travel = $purpose_of_travel;
        $data->contact_number = $contact_number;
        $data->destination = $destination;
        $data->date_from = $date_from;
        $data->date_to = $date_to;
        $data->baggage_allowance = $kg;
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
            $data1->request_id = $id->id;
            $data1->save();
        }
        $user = auth()->user();
        $destination_name = Destination::where('id','=',$data->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $approver1 = User_approver::where('user_id','=',auth()->user()->id)->get();
        if($approver1){
        $approver= User::where('id','=',$approver1[0]->approver_id)->get();
       
        $approver[0]->notify(new ForApprovalNotif($data,  $new_destination));
        }
        
        $user->notify(new RequestNotif($data, $new_destination));
       
        return redirect('/pending-request');
    }
    public function approve_request($id)
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
        return redirect('/for-approval');
      

    }
    public function disapprove_request($id)
    {
        $users_request = User_request::findOrFail($id);
        $user_id=$users_request->requestor_id;
        $user = User::findOrFail($user_id);
        if($users_request) {
            $users_request->status = 3;
            $users_request->approved_by = auth()->user()->id;
            $users_request->save();
        }
        $destination_name = Destination::where('id','=',$users_request->destination)->get();
        $new_destination = $destination_name[0]->destination;
        $user->notify(new DisapproveNotif($users_request,$new_destination));
        return redirect('/for-approval');
    }
}
