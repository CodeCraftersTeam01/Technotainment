<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkDeadline extends Model
{
    /** @use HasFactory<\Database\Factories\WorkDeadlineFactory> */
    use HasFactory;

    protected $table = 'work_deadlines';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'competition_id',
    ];

    protected $primaryKey = 'workdeadline_id';

    public function competitions(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }
}
