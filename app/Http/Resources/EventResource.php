<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'event_id' => $this->event_id,
            'event_name' => $this->event_name,
            'event_logo' => $this->event_logo,
            'event_theme' => $this->event_theme,
            'event_about' => $this->event_about,
            'event_description' => $this->event_description,
            'event_year' => $this->event_year,
            'event_status' => $this->event_status
        ];
    }
}
