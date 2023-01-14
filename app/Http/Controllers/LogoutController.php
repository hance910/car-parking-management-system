<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    
    public function logout(Request $request){
        // Log the user out
       auth()->logout();

    // Redirect the user
    return redirect()->route('login');
    }
}
