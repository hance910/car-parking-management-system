<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Parking;
use App\Models\Payment;
use App\Models\Wing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarParkingDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    // Assign a car to a parking
    public function assign(Request $request)
    {
        // Validate inputs
        $this->validate($request, [
            'wing' => 'required',
            'plate_number' => 'required',
            'plate_name' => 'required',
            'park_number' => 'required'
        ]);
        // get wing id
        $wing = Wing::where('wing_id', $request->wing)->first();
        // get car id
        $car = Car::where('plate_number', $request->plate_number)->where('plate_name', $request->plate_name)->first();
        $parkings = Parking::with('car','wing')->get();

        foreach ($parkings as $parking) {
            // dd($parking->parking_number);
            if($parking->parking_number == $request->park_number && $parking->wing->wing_id == $request->wing && $parking->car->car_id == $car->car_id){
                return back()->with('error', 'This vehicle aleady in this parking');
            }
        }
        // Assign vehicle to a parking
        Parking::create([
            'parking_number' => $request->park_number,
            'wing_id' => $wing->wing_id,
            'car_id' => $car?->car_id,
        ]);
            // Back to the page
            return redirect()->back()->with('status', 'Vehicle assigned to a parking number' ." ". $request->park_number  ." ". $wing->wing_location );
    }

    // Store charges
    public function store(Request $request)
    {
        $money = 200*$request->money;
        Payment::create([
            'parking_id' => $request->parking_id,
            'paid_amount' => $money,
        ]);
        return redirect()->back()->with('status', 'Vehicle Cleared!');
    }
}
    

