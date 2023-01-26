<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Wing;
use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingEntryController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    // index page
    public function index(Request $request)
    {    
        $cars = Car::all();
        $parkings = Parking::with('car','wing')->paginate(5);
        $wings = Wing::all();
        return view('parking-entry', [
            'cars' => $cars,
            'wings' => $wings,
            'parkings' => $parkings
        ]);
        
    }

}
