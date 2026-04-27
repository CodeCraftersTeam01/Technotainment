<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'announcement_id' => $this->announcement_id,
            'announcement_title' => $this->announcement_title,
            'announcement_photo' => $this->announcement_photo,
            'announcement_description' => $this->announcement_description,
            'competition_id' => $this->competition_id,
            'event' => new EventResource($this->event),
        ];
    }
}
