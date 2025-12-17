<?php

namespace App\Models;

use App\Policies\DoctorPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * @property int $id
 * @property int $user_id
 * @property string $available_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\DoctorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereAvailableTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Doctor extends User
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory,Authorizable;

    protected $fillable = ['user_id',
    'session_price','license_number',
    'experience_years','bio'

];
protected $with = ['specialities','user','available_time'];
protected $policies=[
    Doctor::class=>DoctorPolicy::class
];
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'doctor_speciality');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function available_time()
    {
        return $this->hasMany(Available_time::class);
    }
    public function bookings() {
        $this->available_time()->booking();
    }
}
