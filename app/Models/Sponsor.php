<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sponsor extends Model
{
    /** @use HasFactory<\Database\Factories\SponsorFactory> */
    use HasFactory;

    protected $table = 'sponsors';
    protected $primaryKey = 'sponsor_id';
    protected $fillable = [
        'sponsor_name',
        'sponsor_logo',
        'event_id'
    ];


    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query->where('sponsor_name', 'like', '%' . $search . '%')
            );
        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->whereHas('event', fn($query) => $query->where('event_status', $status))
            );
    }
}
