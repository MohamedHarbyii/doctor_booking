<?php

namespace App\Http\Resources;

use App\BookingStatus;
use Database\Seeders\BookingSeeder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'patient'=>new PatientResource($this->whenLoaded('patient')),
            'doctor'=>new DoctorResource($this->whenLoaded('available_time',function(){
                return $this->available_time->doctor;
            })),
            'status'=>$this->status
        ];
    }
}
