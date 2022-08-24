<?php

namespace App\Http\Controllers;

use App\Models\cargo;
use App\Models\operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class cargoController extends Controller
{
    public function store(Request $request) {
        $formFields = $request->validate([
            'cargo_count' => 'required',
            'cargo_name' => 'required',
            'cargo_price' => 'required',
            'garage_id' => 'required',
        ]);

        $formFields['cargo_price'] = '1';

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = public_path().'/storage/cargos_logos';
            $uplaod = $file->move($path,$fileName);
            $formFields['cargo_logo'] = "storage/cargos_logos/".$fileName;
        }

        $formFields_opera['user_id'] = auth()->id();
        $formFields_opera['description']= 'Initial Stock';
        $formFields_opera['type']= 'creation';
        $formFields_opera['ammount']= $formFields['cargo_count'];
        //dd($formFields);
        //dd($formFields_opera);
        $cargo = cargo::create($formFields);
        $formFields_opera['cargo_id']= $cargo->id;
        operation::create($formFields_opera);
        return redirect()->back();
    }

    public function show(cargo $cargo){
        $users = cargo::getusers($cargo->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
        if(in_array(["id"=> Auth::user()->id],$users,true) && $cargo->cargo_status != '0'){
            return view('cargo.show', [
                'user' => Auth::user(),
                'cargo' => cargo::onedata($cargo->id),
                'operations' => operation::get_cargo_opr($cargo->id),
            ]);
        }else{
            return redirect('/garages');
        }
        }else{
            return redirect('/garages');
        }
    }

    public function destroy(Request $request) {
        $users = cargo::getadminsusers(request()->get('cargo_id'));
        $users =  json_decode(json_encode($users), true);
        if(in_array(["id"=> Auth::user()->id],$users,true)){
            $cargoid = request()->get('cargo_id');
            $cargo = cargo::find($cargoid);
            $formFields["cargo_status"] = "0";
            $cargo->update($formFields);
        }
        return back()->with('message', 'garage deleted successfully!');
    }
}
