<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'work_title' => $this->work_title,
            'work' => $this->work,
            'work_link' => $this->work_link,
            'work_abstract' => $this->work_abstract,
            'work_proposal' => $this->work_proposal,
            'work_ppt' => $this->work_ppt,
            'work_original' => $this->work_original,
            'team_id' => $this->team_id,
            'team' => new TeamResource($this->team),
        ];
    }
}
