<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeline extends Model
{
    /** @use HasFactory<\Database\Factories\TimelineFactory> */
    use HasFactory;

    protected $table = 'timelines';
    protected $primaryKey = 'timeline_id';

    protected $fillable = [
        'timeline_name',
        'timeline_description',
        'timeline_start',
        'timeline_end',
        'competition_id',
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }
}
