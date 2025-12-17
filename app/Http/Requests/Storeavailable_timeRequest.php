<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storeavailable_timeRequest extends FormRequest
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
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            // specific format often helps (e.g. H:i or H:i:s)
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            // 'is_active' => ['boolean'],

            // Optional: You usually calculate this automatically in the Controller/Model
            // so you might not need to validate it coming from the frontend.

        ];
    }
}
