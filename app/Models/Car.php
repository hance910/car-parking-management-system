<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
        'plate_name',
        'plate_number',
        'driver_phonenumber',
    ];

    public function park()
    {
        return $this->hasMany(Parking::class, 'parking_id', 'parking_id');
    }
}
