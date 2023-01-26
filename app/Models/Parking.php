<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Wing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'parking_number',
        'car_id',
        'wing_id',
    ];
    
    // has many cars
    public function car()
    {
        return  $this->belongsTo(Car::class,'car_id', 'car_id');
    }
    public function wing()
    {
        return $this->belongsTo(Wing::class,'wing_id','wing_id');
    }
}
