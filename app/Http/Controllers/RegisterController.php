<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{    
    public function __construct()
    {
        $this->middleware('guest');
    }
    //index
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Validate form data
        $this->validate($request, [
            'fullname' => 'required|max:25',
            'phonenumber' => 'required|max:10',
            'email' => 'required|email|max:25',
            'password' => 'required|confirmed|min:8'
        ]);

        // Store the user
        User::create([
            'full_name' => $request->fullname,
            'phone_number' => $request->phonenumber,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Redirect user
        return redirect()->route('login');
    }
}
