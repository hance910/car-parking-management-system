<?php

namespace App\Models;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_id',
        'paid_amount',
        'car_id'
    ];


    public function parking()
    {
        return $this->hasMany(Parking::class, 'parking_id');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
