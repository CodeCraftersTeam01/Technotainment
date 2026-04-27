<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaPartner extends Model
{
    /** @use HasFactory<\Database\Factories\MediaPartnerFactory> */
    use HasFactory;

    protected $table = 'media_partners';
    protected $primaryKey = 'media_partner_id';

    protected $fillable = [
        'media_partner_name',
        'media_partner_logo',
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
                $query->where('media_partner_name', 'like', '%' . $search . '%')
            );
        $query
            ->when(
                $filters['status'] ?? false,
                fn($query, $status) =>
                $query->whereHas('event', fn($query) => $query->where('event_status', $status))
            );
    }
}
