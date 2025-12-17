<?php

namespace App\Http\Requests;

use App\BookingStatus;
use App\Rules\BookingTimeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'available_time_id'=>['bail','required','exists:doctor_schedules,id',new BookingTimeRule()],
            // 'status'=>['nullable',Rule::enum(BookingStatus::class)]
        ];
        
    }
}
