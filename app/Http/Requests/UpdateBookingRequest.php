<?php

namespace App\Http\Requests;

use App\BookingStatus;
use App\Rules\BookingTimeRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'available_time_id' => ['sometimes', 'exists:doctor_schedules,id', new BookingTimeRule],
            'status' => ['nullable', Rule::enum(BookingStatus::class)],
        ];
    }
}
