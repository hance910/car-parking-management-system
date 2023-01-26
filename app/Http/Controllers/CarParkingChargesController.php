<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use App\Models\Payment;
use Illuminate\Http\Request;

class CarParkingChargesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // return records of vehicle 
    public function index(Request $request)
    {
        $parkings = Parking::with('Parking', 'Car');
        $paid_vehicles = Payment::with('Car')->paginate(5);
        return view('auth.records', [
            'paid_vehicles' => $paid_vehicles,
            'parkings' => $parkings
        ]);
    }
}
