<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'timeline_id' => $this->timeline_id,
            'timeline_name' => $this->timeline_name,
            'timeline_description' => $this->timeline_description,
            'timeline_start' => $this->timeline_start,
            'timeline_end' => $this->timeline_end,
            'competition' => new CompetitionResource($this->competition),
        ];
    }
}
