<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaPartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'media_partner_id' => $this->media_partner_id,
            'media_partner_name' => $this->media_partner_name,
            'media_partner_logo' => $this->media_partner_logo,
            'event' => new EventResource($this->event),
        ];
    }
}
