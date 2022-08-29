<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index() {
        if(Auth::check()){
            return view('profile.profile', [
                'garages' => garage::joinedata(Auth::user()->id),
                'user_name' => Auth::user()->name,
                'logo' => Auth::user()->image
            ]);
        }else{
            return redirect('/login');
        }
    }
    public function logo(Request $request) {
        $user = Auth::user();
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
            $path = public_path().'/storage/users_logos';
            $uplaod = $file->move($path,$fileName);
            $formFields['image'] = "storage/users_logos/".$fileName;
        }
        else{
            return redirect()->back();
        }

        $user->update($formFields);
        return back()->with('message', 'profile updated successfully!');
    }
}
