<?php

namespace App\Http\Controllers;
use App\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    //
    public function destination_list()
    {
        $destinations = Destination::orderBy('destination','asc')->get();
        
        return view('destination_list')->with('destinations', $destinations);
    }
    public function new_destination()
    {
        return view('new_destination');
    }
    public function edit_destination($id)
    {
        $destination = Destination::findOrFail($id);
        return view('edit_destination',['destination' => $destination ]);
    }
    public function save_edit_destination(Request $request, $id)
    {
        $this->validate(request(),[
            'destination' => 'required',
            'code' => 'required',
            ]    
        );
        $data =  Destination::find($id);
        $input = $request->all();
        $data->fill($input)->save();
        $request->session()->flash('status', 'Successfully Update!');
        return redirect('/destination-list');
    }
    public function save_new_destination(Request $request)
    {
        $this->validate(request(),[
            'destination' => 'required',
            'code' => 'required',
            ]    
        );
        $data = new Destination;
        $data->destination = $request->input('destination');
        $data->code = $request->input('code');
        $data->save();
        $request->session()->flash('message', ''.$data->name.' Successfully Added!');
        return redirect('/destination-list');
    }
}
