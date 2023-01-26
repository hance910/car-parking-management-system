<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    // POST REQUEST
    public function store(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'plate_name' => 'required',
            'plate_number' => 'required',
            'phone' => 'required|digits:10',
        ]);
        // Check the vehicle in Database
        $car = Car::where('plate_number', $request->plate_number)->where('plate_name', $request->plate_name)->exists();
        // Check if vehicle exists
        if($car){
            return back()->with('error', 'Car already register in database');
        }else{
            // It does not exist
            Car::create([
                'plate_number' => $request->plate_number,
                'plate_name' => $request->plate_name,
                'driver_phonenumber' => $request->phone,
            ]);
            return redirect('/parking-entry')->with('status', 'Register success!');
        }
    }
}
