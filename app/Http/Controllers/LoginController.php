<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{    
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate form date
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
;
        // sign user in
        if(auth()->attempt($request->only('email', 'password'), $request->remember)){
            $request->session()->regenerate();
            // redirect after successful login credentials
            return redirect()->intended('parking-entry');
            // dd(auth()->user());
        }
        return back()->with('error', 'invalid login details');

    }
    
}
