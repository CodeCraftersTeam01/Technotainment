<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    /** @use HasFactory<\Database\Factories\AchievementFactory> */
    use HasFactory;

    protected $table = 'achievements';
    protected $primaryKey = 'achievement_id';

    protected $fillable = [
        'achievement_name',
        'achievement_price',
        'achievement_description',
        'competition_id',
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }
}
