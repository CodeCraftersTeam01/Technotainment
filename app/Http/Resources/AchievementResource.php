<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'achievement_id' => $this->achievement_id,
            'achievement_name' => $this->achievement_name,
            'achievement_price' => $this->achievement_price,
            'achievement_description' => $this->achievement_description,
            'competition' => new CompetitionResource($this->competition),
        ];
    }
}
