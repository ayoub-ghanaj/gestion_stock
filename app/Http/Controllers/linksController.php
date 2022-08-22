<?php

namespace App\Http\Controllers;

use App\Models\links;
use Illuminate\Http\Request;

class linksController extends Controller
{
    public function store(Request $request) {
        $formFields = $request->validate([
            'garage_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'rank' => 'required',
            'role' => 'required',
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

        links::create($formFields);

        return redirect()->back();
    }

    public function update(Request $request) {
        $linkid = request()->get('link_id');
        $link = links::find($linkid);
        $formFields = $request->validate([
            'title' => 'required',
            'rank' => 'required',
            'role' => 'required',
            'link_id' => 'required',
        ]);
        if($formFields["rank"] != "1"){
            $link->update($formFields);
        }
        return back()->with('message', 'profile updated successfully!');
    }
    public function destroy(Request $request) {
        $linkid = request()->get('link_id');
        $link = links::find($linkid);
        $link->delete();
        return back()->with('message', 'profile updated successfully!');
    }
}
