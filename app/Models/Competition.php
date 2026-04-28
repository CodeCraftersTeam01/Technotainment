<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    /** @use HasFactory<\Database\Factories\CompetitionFactory> */
    use HasFactory;

    protected $table = 'competitions';
    protected $primaryKey = 'competition_id';
    protected $fillable = [
        'competition_type',
        'slug',
        'competition_name',
        'competition_end_date',
        'competition_logo',
        'competition_second_logo',
        'competition_third_logo',
        'competition_description',
        'competition_information',
        'competition_instance_level',
        'competition_guide_book',
        'competition_status',
        'competition_fee',
        'competition_view_template',
        'event_id',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'competition_id', 'competition_id')->orderBy('achievement_name', 'asc');
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class, 'competition_id', 'competition_id')->orderBy('created_at', 'asc');
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'competition_id', 'competition_id');
    }

    /**
     * Scope a query search
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query->where('competition_name', 'like', '%' . $search . '%')
            );

        $query
            ->when(
                $filters['event'] ?? false,
                fn($query, $event) =>
                $query->whereHas('event', fn($query) => $query->where('event_name', 'like', '%' . $event . '%'))
            );

        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->where('competition_status', $status)
            );

        $query
            ->when(
                $filters['type'] ?? false,
                fn($query, $type) =>
                $query->where('competition_type', $type)
            );
        $query
            ->when(
                $filters['event_status'] ?? false,
                fn($query, $eventStatus) =>
                $query->whereHas('event', fn($query) => $query->where('event_status', $eventStatus))
            );
    }
}
