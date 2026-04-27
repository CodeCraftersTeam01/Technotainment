<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $table = 'teams';
    protected $primaryKey = 'team_id';

    protected $fillable = [
        'team_name',
        'team_token',
        'team_logo',
        'team_email',
        'team_contact',
        'team_instance',
        'team_instance_name',
        'team_final_status',
        'team_invoice',
        'team_invoice_status',
        'competition_id',
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(MemberTeam::class, 'team_id', 'team_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'team_id', 'team_id');
    }

    public function scopeFilter($query, array $filters): void
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query->where('team_name', 'like', '%' . $search . '%')
            );
        $query
            ->when(
                $filters['type'] ?? false,
                fn($query, $type) =>
                $query->whereHas('competition', fn($query) => $query->where('competition_type', $type))
            );
        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->where('team_invoice_status', $status)
            );
        $query
            ->when(
                $filters['competition_status'] ?? false,
                fn($query, $status) =>
                $query->whereHas('competition', fn($query) => $query->where('competition_status', $status))
            );
    }
}
