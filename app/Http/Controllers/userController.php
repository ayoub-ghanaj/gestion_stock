<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index(Request $request) {
        return json_encode(['users' => User::apidata($request->name,$request->wearhouse)]);
    }
    public function login(){
        if(!Auth::check()){
            return view('login.login');
        }else{
            return redirect('/');
        }
    }
    public function signup(){
        if(!Auth::check()){
        return view('signup.signup');
        }else{
            return redirect('/');
        }
    }
    public function store(Request $request){
        $formFields = $request->validate([
            "name" => ['required','min:3'],
            "email" => ['required','email', Rule::unique('users','email')],
            "password" => ['required','min:4']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user =  User::create($formFields);

        Auth::login($user);

        return redirect('/')->with('message','welcome new user');
    }
    public function create(){
        return view('signup.signup');
    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out!');

    }
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
