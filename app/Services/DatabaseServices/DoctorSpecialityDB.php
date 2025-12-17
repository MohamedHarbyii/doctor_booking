<?php

namespace App\Services\DatabaseServices;

use App\Models\Doctor;

class DoctorSpecialityDB
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function attach_speciality_to_doc(Doctor $doctor, $specialities)
    {
        $doctor->specialities()->attach($specialities);
    }

    public static function update_doctor_speciality(Doctor $doctor, $specialities)
    {
        $doctor->specialities()->sync($specialities);
    }
}
