<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'event_name',
        'event_logo',
        'event_theme',
        'event_about',
        'event_description',
        'event_year',
        'event_status',
    ];

    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class, 'event_id', 'event_id');
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'event_id', 'event_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query->where('event_name', 'like', '%' . $search . '%')
            );
        
        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->where('event_status', $status)
            );
    }
}
