<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberTeam extends Model
{
    /** @use HasFactory<\Database\Factories\MemberTeamFactory> */
    use HasFactory;

    protected $table = 'member_teams';
    protected $primaryKey = 'member_team_id';
    protected $fillable = [
        'member_team_name',
        'member_team_identity',
        'member_team_role',
        'team_id'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
}
