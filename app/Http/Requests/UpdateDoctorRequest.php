<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends UpdateUserRequest
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
        $doctorId = $this->route('doctor');
        return array_merge([
            'session_price' => ['sometimes', 'numeric', 'min:0'],
            
            'license_number' => [
                'sometimes', 
                'string', 
                'max:255', 
                // مهم جداً: استثناء الدكتور الحالي من فحص التكرار عند التعديل
                Rule::unique('doctors', 'license_number')->ignore($doctorId),
            ],
            
            'experience_years' => ['nullable', 'integer', 'min:0'],
            
            'bio' => ['nullable', 'string', 'max:1000'],
        ],$this->user_rules());
    }
}
