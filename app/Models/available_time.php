<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Available_time extends Model
{
    protected $table = 'doctor_schedules';

    // 2. الحقول المسموح بتعديلها (Mass Assignment)
    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'is_booked',
        'is_active',
    ];

    protected $casts = [
        'is_booked' => 'boolean',
        'is_active' => 'boolean',
        'date' => 'date', // عشان يرجعلك Carbon Instance تقدر تلعب بالتاريخ براحتك
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value;

        if ($value) {
            $this->attributes['day_name'] = Carbon::parse($value)->format('l');
        }
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
