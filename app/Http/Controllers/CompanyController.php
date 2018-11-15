<?php

namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
     //
     public function company_list()
     {
         $company = Company::orderBy('company_name','asc')->get();
         
         return view('company_list')->with('companies', $company);
     }
     public function new_company()
     {
         return view('new_company');
     }
     public function edit_company($id)
     {
         $company = Company::findOrFail($id);
         return view('edit_company',['company' => $company ]);
     }
     public function save_edit_company(Request $request, $id)
     {
         $this->validate(request(),[
             'company_name' => 'required',
             ]    
         );
         $data =  Company::find($id);
         $input = $request->all();
         $data->fill($input)->save();
         $request->session()->flash('status', 'Successfully Update!');
         return redirect('/company-list');
     }
     public function save_new_company(Request $request)
     {
         $this->validate(request(),[
             'company_name' => 'required',
             ]    
         );
         $data = new Company;
         $data->company_name = $request->input('company_name');
         $data->save();
         $request->session()->flash('status', ''.$data->name.' Successfully Added!');
         return redirect('/company-list');
     }
}
