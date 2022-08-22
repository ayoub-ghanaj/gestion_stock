<?php

namespace App\Http\Controllers;

use App\Models\operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class operationController extends Controller
{
    //

    public function store(Request $request) {
        $formFields = $request->validate([
            'cargo_id' => 'required',
            'type' => 'required',
            'ammount' => 'required',
        ]);

        $formFields['description'] = Auth::user()->name;
        $formFields['user_id'] = auth()->id();
        $formFields['status'] = '1';


        operation::create($formFields);

        return redirect()->back();
    }


}
