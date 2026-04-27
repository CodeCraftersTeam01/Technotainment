<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'team_id' => $this->team_id,
            'team_name' => $this->team_name,
            'team_token' => $this->team_token,
            'team_logo' => $this->team_logo,
            'team_email' => $this->team_email,
            'team_contact' => $this->team_contact,
            'team_instance' => $this->team_instance,
            'team_instance_name' => $this->team_instance_name,
            'team_final_status' => $this->team_final_status,
            'team_invoice' => $this->team_invoice,
            'team_invoice_status' => $this->team_invoice_status,
            'competition' => new CompetitionResource($this->competition),
            'members' => MemberTeamResource::collection($this->members),
        ];
    }
}
