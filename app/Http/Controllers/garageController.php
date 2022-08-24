<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\cargo;
use App\Models\links;
use App\Models\garage;
use App\Models\operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class garageController extends Controller
{
    public function index(User $user) {
        if(Auth::check()){
            return view('garage.index', [
                'garages' => garage::joinedata(Auth::user()->id),
                'user' => Auth::user()->name,
                'user' => Auth::user()->logo
            ]);
        }else{
            return redirect('/login');
        }
    }

    public function indexapi(Request $request ) {
            return json_encode(['garages' => garage::joinedataapi($request->id)]);
    }

    public function show(garage $garage) {
        $users = garage::getusers($garage->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true) && $garage->status != 0){
                return view('garage.show', [
                    'user' => Auth::user(),
                    'garage' => $garage,
                    'link' => links::user_data($garage->id ,Auth::user()->id ),
                    'links' => links::data($garage->id),
                    'cargos' => cargo::data($garage->id),
                    'operations' => operation::get_gara_opr($garage->id),
                ]);
            }else{
                return redirect('/garages');
            }
        }else{
            return redirect('/garages');
        }
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'garage_name' => 'required',
            'garage_title' => 'required',
        ]);

        $formFields['creator_id'] = auth()->id();
        $formFields['status'] = '1';

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = public_path().'/storage/garages_logos';
            $uplaod = $file->move($path,$fileName);
            $formFields['garage_logo'] = "storage/garages_logos/".$fileName;
        }

        garage::create($formFields);

        return redirect()->back();
    }

    public function invite(Request $request) {
        $users = garage::getadminsusers(request()->get('garage_id'));
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true)){
            $formFields = $request->validate([
                'garage_id' => 'required',
                'user_id' => 'required',
                'rank' => 'required',
                'role' => 'required',
                'title' => 'required',
            ]);

            links::create($formFields);
            }
        }else{
            return redirect('/garages');
        }

        return redirect()->back();
    }
    // delete
    public function destroy(Request $request) {
        $users = garage::getadminsusers(request()->get('garage_id'));
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true)){
                $garage_id = request()->get('garage_id');
                $link = garage::find($garage_id);
                $formFields["status"] = "0";
                $link->update($formFields);
            }
        }else{
            return redirect('/garages');
        }
        return back()->with('message', 'garage deleted successfully!');
    }
}
