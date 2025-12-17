<?php

namespace App\Services\DatabaseServices;

use App\Models\Available_time;

class AvailableTimeDB
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public static function add($data)
    {

        return Available_time::create($data);

    }

    public static function get_time(Available_time $available_time)
    {
        return $available_time->get();
    }

    public static function update(Available_time $available_time, $data)
    {

        $available_time->update($data);

        return $available_time;
    }

    // public static function update_booking_status(Available_time $available_time,$status) {
    //   $available_time->is_booked=$status;
    //   $available_time->save();
    // }
    public static function delete(Available_time $available_time)
    {
        $available_time->delete();
    }
}
