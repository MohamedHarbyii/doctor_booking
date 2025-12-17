<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailableTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            
            // تحسين شكل التاريخ والوقت
            'date' => $this->date, // 2026-03-03
            'day_name' => $this->day_name, // Tuesday
            
            // تحويل الوقت من 24h لـ 12h (AM/PM) عشان العرض
            'start_time' => Carbon::parse($this->start_time)->format('h:i A'), 
            'end_time' => Carbon::parse($this->end_time)->format('h:i A'),

            // حالات الحجز (Boolean)
            'is_booked' => (bool) $this->is_booked,
            'is_active' => (bool) $this->is_active,

            // لو عايز ترجع بيانات الدكتور المرتبط بالوقت ده (Nested Resource)
            // دي هتشتغل بس لو انت عامل with('doctor') في الكنترولر
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
        ];
    }
}
