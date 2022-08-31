<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\bills;
use App\Models\cargo;
use App\Models\employers;
use App\Models\wearhouse;
use App\Models\operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class wearhouseController extends Controller
{
    public function index(User $user) {
        if(Auth::check()){
            return view('wearhouse.index', [
                'wearhouses' => wearhouse::joinedata(Auth::user()->id),
                'user' => Auth::user()->name,
                'user' => Auth::user()->logo
            ]);
        }else{
            return redirect('/login');
        }
    }

    public function indexapi(Request $request ) {
            return json_encode(['wearhouses' => wearhouse::joinedataapi($request->id)]);
    }

    public function show(wearhouse $wearhouse) {
        $users = wearhouse::getusers($wearhouse->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true) && $wearhouse->status != 0){
                return view('wearhouse.show', [
                    'user' => Auth::user(),
                    'wearhouse' => $wearhouse,
                    'link' => employers::user_data($wearhouse->id ,Auth::user()->id ),
                    'employers' => employers::data($wearhouse->id),
                    'cargos' => cargo::data($wearhouse->id),
                    //'operations' => operation::get_gara_opr($wearhouse->id),
                ]);
            }else{
                return redirect('/wearhouses');
            }
        }else{
            return redirect('/wearhouses');
        }
    }

    public function transaction(wearhouse $wearhouse) {
        $users = wearhouse::getusers($wearhouse->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true) && $wearhouse->status != 0){
                return view('transactions.index', [
                    'user' => Auth::user(),
                    'wearhouse' => $wearhouse,
                    'link' => employers::user_data($wearhouse->id ,Auth::user()->id ),
                    'cargos' => cargo::data($wearhouse->id),
                ]);
            }else{
                return redirect('/wearhouses');
            }
        }else{
            return redirect('/wearhouses');
        }
    }
    public function list(wearhouse $wearhouse) {
        $users = wearhouse::getusers($wearhouse->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true) && $wearhouse->status != 0){
                return view('transactions.list', [
                    'user' => Auth::user(),
                    'wearhouse' => $wearhouse,
                    'bills' => bills::list($wearhouse->id),
                ]);
            }else{
                return redirect('/wearhouses');
            }
        }else{
            return redirect('/wearhouses');
        }
    }
    public function bills_show(bills $bill) {
        $wearhouse =  wearhouse::find($bill->wearhouse_id);
        $users = wearhouse::getusers($wearhouse->id);
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true) && $wearhouse->status != 0){
                return view('transactions.show', [
                    'user' => Auth::user(),
                    'wearhouse' => wearhouse::find($bill->wearhouse_id),
                    'transaction' => bills::find($bill->id),
                    'operations' => operation::bill_ops($bill->id),
                ]);
            }else{
                return redirect('/wearhouses');
            }
        }else{
            return redirect('/wearhouses');
        }
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'wearhouse_name' => 'required',
            'wearhouse_title' => 'required',
        ]);

        $formFields['creator_id'] = auth()->id();
        $formFields['status'] = '1';

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
            $path = public_path().'/storage/wearhouses_logos';
            $uplaod = $file->move($path,$fileName);
            $formFields['wearhouse_logo'] = "storage/wearhouses_logos/".$fileName;
        }

        wearhouse::create($formFields);

        return redirect()->back();
    }

    public function invite(Request $request) {
        $users = wearhouse::getadminsusers(request()->get('wearhouse_id'));
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true)){
            $formFields = $request->validate([
                'wearhouse_id' => 'required',
                'user_id' => 'required',
                'rank' => 'required',
                'role' => 'required',
                'title' => 'required',
            ]);

            employers::create($formFields);
            }
        }else{
            return redirect('/wearhouses');
        }

        return redirect()->back();
    }
    public function store_bill(Request $request) {
        $users = wearhouse::getusers(request()->get('wearhouse_id'));
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true)){
            $formFields = $request->validate([
                'wearhouse_id' => 'required',
                'user_id' => 'required',
                'company_name' => 'required',
                'opt_type' => 'required',
                'title' => 'required',
                'description' => 'required',
                'ops_list' => 'required',
                'bill_price' => 'required',
            ]);
                if($formFields["opt_type"] == "2"){
                    $formFields["type"] = "take";
                }else{
                    $formFields["type"]= "add";
                }
                $array_ops = json_decode($formFields["ops_list"]);
                $bill = bills::create($formFields);
                foreach ($array_ops->cargos_list as $carg ){
                    if( $carg->ammount != null){
                        if($formFields["opt_type"] == "2"){
                            $newformfield["user_id"] = Auth::user()->id;
                            $newformfield["type"] = "take";
                            $newformfield["ammount"] = $carg->ammount;
                            $newformfield["cargo_id"] = $carg->id;
                            $newformfield["bill_id"] = $bill->id;
                        }else{
                            $newformfield["user_id"] = Auth::user()->id;
                            $newformfield["type"] = "add";
                            $newformfield["ammount"] = $carg->ammount;
                            $newformfield["cargo_id"] = $carg->id;
                            $newformfield["bill_id"] = $bill->id;
                        }
                        operation::create($newformfield );
                    }

                }
                return redirect()->back();
            }
        }else{
            return redirect('/wearhouses');
        }

        return redirect()->back();
    }
    // delete
    public function destroy(Request $request) {
        $users = wearhouse::getadminsusers(request()->get('wearhouse_id'));
        $users =  json_decode(json_encode($users), true);
        if(Auth::check()){
            if(in_array(["id"=> Auth::user()->id],$users,true)){
                $wearhouse_id = request()->get('wearhouse_id');
                $link = wearhouse::find($wearhouse_id);
                $formFields["status"] = "0";
                $link->update($formFields);
            }
        }else{
            return redirect('/wearhouses');
        }
        return back()->with('message', 'wearhouse deleted successfully!');
    }
}
