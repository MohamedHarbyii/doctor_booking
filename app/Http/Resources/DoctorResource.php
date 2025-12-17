<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'speciality' => SpecialityResource::
            collection($this->whenLoaded('specialities')),
            'info' => new UserResource($this->whenLoaded('user')),
            'license number' => $this->license_number,
            'experience year' => $this->experience_years,
            'bio' => $this->bio,
            'session_price' => $this->session_price,
            'available-time' => AvailableTimeResource::collection(
                $this->whenLoaded('available_time')),
                

        ];
    }
}
