<?php

namespace App\Http\Controllers;

use App\Models\bills;
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
            'wearhouse_id' => 'required',
        ]);

//        $formFields['cargo_price'] = '1';

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            if(!getimagesize($file)){
                return redirect()->back();
            }
            $extension = $file->getClientOriginalExtension();
            if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif"){
                return redirect()->back();
            }
            $fileName = time().'.'.$extension;
            $path = public_path().'/storage/cargos_logos';
            $uplaod = $file->move($path,$fileName);
            $formFields['cargo_logo'] = "storage/cargos_logos/".$fileName;
        }

        $formFields_opera['user_id'] = auth()->id();
        $formFields_opera['type']= 'creation';
        $formFields_opera['ammount']= $formFields['cargo_count'];
        //dd($formFields);
        //dd($formFields_opera);
        $cargo = cargo::create($formFields);
        $formFields_opera['cargo_id']= $cargo->id;
        $formFields_bill["user_id"]= Auth::user()->id;
        $formFields_bill["title"]= "initial stock";
        $formFields_bill["description"]= "-";
        $formFields_bill["wearhouse_id"]= $formFields["wearhouse_id"];
        $formFields_bill["company_name"]= "-";
        $formFields_bill["bill_price"]= $formFields["cargo_price"] * $formFields["cargo_count"]   ;
        $formFields_bill["type"]= "ADD";
        $bill = bills::create($formFields_bill);
        $formFields_opera['bill_id']= $bill->id;
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
            return redirect('/wearhouses');
        }
        }else{
            return redirect('/wearhouses');
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
        return back()->with('message', 'wearhouse deleted successfully!');
    }
}
