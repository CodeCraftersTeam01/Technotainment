<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SponsorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sponsor_id' => $this->sponsor_id,
            'sponsor_name' => $this->sponsor_name,
            'sponsor_logo' => $this->sponsor_logo,
            'event' => new EventResource($this->event),
        ];
    }
}
