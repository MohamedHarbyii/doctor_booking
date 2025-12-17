<?php

namespace App\Rules;

use App\Models\Available_time;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BookingTimeRule implements ValidationRule
{
/**
 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
 */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $time=Available_time::find($value);
        if(!$time->is_active){$fail("this time isn't available for the doctor now");return;}
        if($time->is_booked){$fail("this time is booked");return;}
    }
}
