<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'competition_id' => $this->competition_id,
            'slug' => $this->slug,
            'competition_name' => $this->competition_name,
            'competition_end_date' => $this->competition_end_date,
            'competition_logo' => $this->competition_logo,
            'competition_second_logo' => $this->competition_second_logo,
            'competition_third_logo' => $this->competition_third_logo,
            'competition_description' => $this->competition_description,
            'competition_information' => $this->competition_information,
            'competition_instance_level' => $this->competition_instance_level,
            'competition_guide_book' => $this->competition_guide_book,
            'competition_status' => $this->competition_status,
            'competition_fee' => $this->competition_fee,
            'event' => new EventResource($this->event_id),
            'achievements' => AchievementResource::collection($this->achievements),
            'timelines' => TimelineResource::collection($this->timelines),
            'announcements' => AnnouncementResource::collection($this->announcements),
        ];
    }
}
