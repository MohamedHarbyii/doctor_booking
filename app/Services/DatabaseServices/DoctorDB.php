<?php

namespace App\Services\DatabaseServices;

use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorDB
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function all_doctors()
    {
        return
        Doctor::with('user', 'specialities','available_time')->
        cursorPaginate(30);
    }

    public static function add_doctor($data)
    {

        return DB::transaction(function () use ($data) {
            $user = UserDB::create($data);
            $user->assignRole('doctor');
            $data['user_id'] = $user->id;
            $doctor = Doctor::create($data);
            if (isset($data['speciality_id'])) {
                DoctorSpecialityDB::attach_speciality_to_doc($doctor, $data['speciality_id']);
            }
            return $doctor->load(['user','specialities']);
        });

    }

    public function update_doctor_speciality() {}

    public static function update_doctor(Doctor $doctor, $data)
    {
        UserDB::update($doctor->user,$data);
        $doctor->update($data);
        if(isset($data['speciality_id'])) {
            DoctorSpecialityDB::update_doctor_speciality($doctor,$data['speciality_id']);
        }
        return $doctor;
    }

    public static function delete_doctor(Doctor $doctor)
    {
        UserDB::delete($doctor->user);
        $doctor->delete();
    }
}
