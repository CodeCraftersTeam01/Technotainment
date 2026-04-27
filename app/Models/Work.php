<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;

    protected $table = 'works';

    protected $primaryKey = 'work_id';

    protected $fillable = [
        'work_title',
        'work',
        'work_link',
        'work_abstract',
        'work_proposal',
        'work_ppt',
        'work_original',
        'team_id',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    public function scopeFilter($query, array $filters): void
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query->whereHas('team', fn($query) => $query->where('team_name', 'like', '%' . $search . '%'))
            );
        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->whereHas('team.competition', fn($query) => $query
                    ->where('competition_status', $status)
                    ->where('competition_type', 'Non-E-sports'))
            );
        $query
            ->when(
                $filters['competition_slug'] ?? false,
                fn($query, $slug) =>
                $query->whereHas('team.competition', fn($query) => $query->where('slug', $slug))
            );
    }
}
