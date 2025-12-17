<?php

namespace App\Services\DatabaseServices;

use App\Models\Booking;

class BookingDB
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store($data)
    {
        $patient = PatientDB::get_current_patient();
        $data['status'] = 'pending';
        $booking = $patient->bookings()->create($data);

        return $booking;
    }

    public static function GetPatientBooking()
    {
        $patient = PatientDB::get_current_patient();
        return $booking=$patient->bookings()->get();



    }
    public static function update(Booking $booking,$data) {
        $booking->updateOrFail($data);
        return $booking;

    }
    public static function delete(Booking $booking) {
        $booking->deleteOrFail();

    }
}
