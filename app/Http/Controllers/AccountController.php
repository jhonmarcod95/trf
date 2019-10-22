<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\EmployeeHr;
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
use App\Role;
use App\Department;
use DB;
use App\Employee;
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
        $departments = Department::orderBy('department_name','asc')->get();
        $roles = Role::orderBy('id','asc')->get();
        return view('new_account',array
        (
            'companies' => $companies,
            'departments' => $departments,
            'accounts' => $accounts,
            'roles' => $roles
        )); 
    }
    public function employee_list()
    {
        $accounts = User::leftJoin('companies', 'users.company_name', '=', 'companies.id')
        ->leftJoin('roles', 'users.role', '=', 'roles.id')
        ->leftJoin('departments', 'users.department', '=', 'departments.id')
        ->select('users.*', 'companies.company_name', 'roles.role', 'departments.department_name')
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
        return redirect('/user-account');
        
    }
    public function save_new_account(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'user_type' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            ]    
        );
        
        $data = new User;
        $data->name =$request->name;
        $data->email =$request->email;
        $data->role =$request->user_type;
        $data->department =$request->department;
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
        $request->session()->flash('status', ''.$users->name.' Successfully Reset new password->(123456)!');
        return redirect('/employee-list');
    }
    public function edit_account($id)
    {
        $users = User::findOrFail($id);
        $approver = User_approver::leftJoin('users', 'user_approvers.approver_id', '=', 'users.id')
        ->where('user_id','=',$id)->first();
        $departments = Department::orderBy('department_name','asc')->get();
        if($approver!=null){
            $accounts = User::where('role','=','3')
            ->where('id','!=',$approver->approver_id)
            ->where('id','!=',$id)
            ->orderBy('name','asc')
            ->get();
        }
        else
        {
            $accounts = User::where('role','=','3')
            ->where('id','!=',$id)
            ->orderBy('name','asc')
            ->get();
            $approver = [];
        }
        $company_edit= Company::where('id','=',$users->company_name)->first();
        $companies = Company::where('id','!=',$users->company_name)
        ->orderBy('company_name','asc')
        ->get(['id','company_name']);
        return view('edit_account',array (
            'companies' => $companies,
            'approver' => $approver,
            'users' => $users,
            'accounts' => $accounts,
            'company_edit' => $company_edit,
            'departments' => $departments,
        )); 
    }
    public function save_edit_account(Request $request, $id)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'user_type' => 'required',
         
            'email' => 'required|string|email|max:255',
            'email' => 'unique:users,email,'.$id
            ]    
        );
        
        $data =  User::find($id);

        $input = $request->all();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->user_type;
        $data->employee_id = $request->employee_id;
        $data->contact_number = $request->contact_number;
        $data->birth_date = $request->birth_date;
        $data->company_name = $request->company_name;
        $data->save();

        $data1 =  User_approver::where('user_id',$id)->first();
        if($data1!=null){
            if($request->approver != null){
                $data2 =  User_approver::find($data1->id);
                $approver = $request->approver;
                $data2->approver_id = $approver;
                $data2->save();
            }
            else
            {
                $delete_data = User_approver::find($data1->id);
                $delete_data->delete();
            }
        }
        else
        {
            if($request->approver != null){
                $data1 = new User_approver;
                $data1->user_id = $id;
                $data1->approver_id = $request->approver;
                $data1->save();
            }
        }
        $request->session()->flash('status', ''.$data->name.' Successfully Updated!');
        return redirect('/employee-list');
        
    }
    public function view_account()
    {
        $id=auth()->user()->id;
        $users =User::findOrFail($id);
  
        $approver = User_approver::leftJoin('users', 'user_approvers.approver_id', '=', 'users.id')
        ->where('user_id','=',$id)->first();
        // dd($approver);
        $company_edit = Company::where('id',$users->company_name)->first();
    
        $department = Department::where('id',$users->department)->first();
        $role= Role::findOrFail($users->role);
        $departments = Department::orderBy('department_name','asc')->get();
        $companies = Company::orderBy('company_name','asc')->get();
        $accounts = User::where('role','=','3')->orderBy('name','asc')->get();
     
        if(auth()->user()->role == 3)
        {
            $requestor_list=User_approver::leftJoin('users', 'user_approvers.user_id', '=', 'users.id')
            ->where('approver_id','=',$id)->get();
            return view('view_account',array (
                'requestor_list' => $requestor_list,
                'users' => $users,
                'company_edit' => $company_edit,
                'approver' => $approver,
                'department' => $department,
                'departments' => $departments,
                'companies' => $companies,
                'accounts' => $accounts,

            )); 
        }
        else
        {
            $requestor_list=User_approver::leftJoin('users', 'user_approvers.user_id', '=', 'users.id')
            ->where('approver_id','=',$id)->get();
            return view('view_account',array (
                'users' => $users,
                'company_edit' => $company_edit,
                'approver' => $approver,
                'department' => $department,
                'departments' => $departments,
                'companies' => $companies,
                'accounts' => $accounts,
            )); 
        }
    }
    public function save_edit_profile(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|numeric',
            'contact_number' => 'required|string|numeric',
            'birth_date' => 'required',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'email' => 'unique:users,email,'.Auth()->user()->id
            ]    
        );
        
        $data =  User::find(Auth()->user()->id);
        $input = $request->all();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->employee_id = $request->employee_id;
        $data->contact_number = $request->contact_number;
        $data->birth_date = $request->birth_date;
        $data->company_name = $request->company_name;
        $data->department = $request->department_name;
        $data->save();                                   
        $data1 =  User_approver::where('user_id',Auth()->user()->id)->first();
        if($data1 != null){
            if($request->approver != null){
                $data2 =  User_approver::find($data1->id);
                $approver = $request->approver;
                $data2->approver_id = $approver;
                $data2->save();
            }
            else
            {
                $delete_data = User_approver::find($data1->id);
                $delete_data->delete();
            }
        }
        else
        {
            if($request->approver != null){
                $data1 = new User_approver;
                $data1->user_id = Auth()->user()->id;
                $data1->approver_id = $request->approver;
                $data1->save();
            }
        }
        $request->session()->flash('status', 'Your Profile Successfully Updated!');
        return back();
        
    }
    public function sign_up()
    {
        $accounts = User::where('role','=','3')->orderBy('name','asc')->get();
        $companies = Company::orderBy('company_name','asc')->get(['id','company_name']);
        $departments = Department::orderBy('department_name','asc')->get();
        $roles = Role::orderBy('id','asc')->get();
        return view('sign_up',array
        (
            'companies' => $companies,
            'departments' => $departments,
            'accounts' => $accounts,
            'roles' => $roles
        )); 
    }
    public function save_sign_up(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|numeric|unique:users',
            'contact_number' => 'required|string|numeric',
            'birth_date' => 'required',
            'company_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            ]    
        );

        // $employee_number_v = $request->employee_id ; OPTION 1
        // $email_v = $request->email;
        // $results = EmployeeHr::select('call verification(\''.$email_v.'\',\''.$employee_number_v .'\')');
        // $results = DB::select('call verification(\'jovie.cano@amigoagro.com\',\'051168\')');
        // dd($results);

        $employee_list = Employee::leftJoin('users','employees.user_id','=','users.id')
        ->where('users.email',$request->email)
        ->where('employee_number',$request->employee_id)
        ->select('users.email as employee_name','employees.employee_number')
        ->get();
        
        if (!$employee_list->isEmpty())
        {
            $data = new User;
            $data->name =$request->name;
            $data->email =$request->email;
            $data->role = 2;
            $data->department =$request->department;
            $data->employee_id =$request->employee_id;
            $data->contact_number =$request->contact_number;
            $data->birth_date =$request->birth_date;
            $data->company_name =$request->company_name;
            $data->password =bcrypt($request->password);
            $data->register = 1;
            $data->activate = 1;
            
            $datsa->save();
            $id = User::all()->last();
            if($request->approver!=null){
                $data1 = new User_approver;
                $data1->user_id = $id->id;
                $data1->approver_id = $request->approver;
                $data1->save();
            }
            $request->session()->flash('status', 'Your Account Successfully Registered. '.$data->email);
            return back();
        }
        else
        {
            $request->session()->flash('notstatus', 'The information you entered is not valid! Please review your credentials.');
            return back();
        }
       
    }
}
