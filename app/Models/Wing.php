<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wing extends Model
{
    use HasFactory;

    protected $fillable = [
        'wing_location',
    ];

    public function park()
    {
        return $this->hasMany(Parking::class, 'parking_id', 'parking_id');
    }
}
