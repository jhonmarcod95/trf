<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Input;
use Validator;
use IlluminateSupportFacadesValidator;
use IlluminateFoundationBusDispatchesJobs;
use IlluminateRoutingController as BaseController;
use IlluminateFoundationValidationValidatesRequests;
use IlluminateFoundationAuthAccessAuthorizesRequests;
use IlluminateFoundationAuthAccessAuthorizesResources;
use IlluminateHtmlHtmlServiceProvider;
use Redirect;
use App\Company;
use App\User;
use App\User_approver;
use App\User_request;
class AccountController extends Controller
{
    //
    public function login()
    {  
        if (!Auth::user()){
            return view('login');
        }
        else{
            if(auth()->user()->role!=1){
                $pending_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
                ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
                ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
                ->where('requestor_id','=',auth()->user()->id)
                ->where('status','=','1')
                ->get();
                return view('show',['pending_requests' => $pending_requests ]);
            }
            else
            {
                $company = Company::orderBy('company_name','asc')->get();
                return view('company_list')->with('companies', $company);
            }
        }
    }
    public function show(Request $request)
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
            return Redirect::to('inbox')
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
                $pending_requests= User_request::leftJoin('companies', 'user_requests.company_name', '=', 'companies.id')
                ->leftJoin('destinations', 'user_requests.destination', '=', 'destinations.id')
                ->select('user_requests.*', 'destinations.destination', 'companies.company_name')
                ->where('requestor_id','=',auth()->user()->id)
                ->where('status','=','1')
                ->get();
                return view('show',['pending_requests' => $pending_requests ]);
            } 
            else {
                // send back all errors to the login form
                // validation not successful, send back to form 
                $request->session()->flash('status', 'Sorry, the email and password you entered do not match.');
                return Redirect::to('inbox');
            }
        }
    }
    public function change_password()
    {
        return view('change_password');
    }
    public function new_account()
    {
        $accounts = User::where('role','=','3')->orderBy('name','asc')->get();
        $companies = Company::orderBy('company_name','asc')->get(['id','company_name']);
        return view('new_account',array
        (
            'companies' => $companies,
            'accounts' => $accounts
        )); 
    }
    public function employee_list()
    {
        $accounts = User::leftJoin('companies', 'users.company_name', '=', 'companies.id')
        ->leftJoin('roles', 'users.role', '=', 'roles.id')
        ->select('users.*', 'companies.company_name', 'roles.role')
        ->get();
        return view('employee_list')->with('accounts', $accounts);
    }
    public function save_change_password(Request $request)
    {
        $this->validate(request(),[
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            ]    
        ); 
        $id = $request->input('id');
        $data =  User::find($id);
        $data->password = bcrypt($request->input('password'));
        $data->save();
        $request->session()->flash('status', ''.$data->name.' Successfully Updated Your Password!');
        return redirect('/change-password');
        
    }
    public function save_new_account(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'user_type' => 'required',
            'employee_id' => 'required|string|numeric|unique:users',
            'contact_number' => 'required|string|numeric',
            'birth_date' => 'required',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            ]    
        );
        
        $data = new User;
        $data->name =$request->name;
        $data->email =$request->email;
        $data->role =$request->user_type;
        $data->employee_id =$request->employee_id;
        $data->contact_number =$request->contact_number;
        $data->birth_date =$request->birth_date;
        $data->company_name =$request->company_name;
        $data->password =bcrypt($request->password);
        $data->register = 1;
        $data->activate = 1;
        
        $data->save();
        $id = User::all()->last();
        if($request->approver!=null){
            $data1 = new User_approver;
            $data1->user_id = $id->id;
            $data1->approver_id = $request->approver;
            $data1->save();
        }
        $request->session()->flash('status', ''.$data->name.' Successfully Added!');
        return redirect('/employee-list');
        
    }
    public function deactivate_account(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if($users) {
            $users->activate = 2;
            $users->save();
        }
        $request->session()->flash('status', ''.$users->name.' Successfully Deactivated!');
        return redirect('/employee-list');
    }
    public function activate_account(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if($users) {
            $users->activate = 1;
            $users->save();
        }
        $request->session()->flash('status', ''.$users->name.' Successfully Activated!');
        return redirect('/employee-list');
    }
    public function reset_account(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if($users) {
            $users->password = bcrypt('123456');
            $users->save();
        }
        $request->session()->flash('status', ''.$users->name.' Successfully Reset(123456)!');
        return redirect('/employee-list');
    }
    public function edit_account($id)
    {
        
        $accounts = User::where('role','=','3')
        ->where('id','!=',auth()->user()->id)
        ->orderBy('name','asc')
        ->get();
       
        
        $approver = User_approver::where('user_id','=',$id)->get();

        dd($users->company_name);
        $companies = Company::orderBy('company_name','asc')
        ->get(['id','company_name']);
        $users = User::findOrFail($id);
        return view('edit_account',['destination' => $destination ]);
    }
}
