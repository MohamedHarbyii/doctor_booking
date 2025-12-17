<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = ['status','available_time_id','patient_id'];
    protected $with = ['patient','available_time.doctor'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function available_time()
    {
        return $this->belongsTo(Available_time::class);
    }


}
