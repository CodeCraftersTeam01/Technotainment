<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'member_team_id' => $this->member_team_id,
            'member_team_name' => $this->member_team_name,
            'member_team_identity' => $this->member_team_identity,
            'member_team_role' => $this->member_team_role,
            'team' => new TeamResource($this->team),
        ];
    }
}
