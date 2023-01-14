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
    ];


    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }
}
