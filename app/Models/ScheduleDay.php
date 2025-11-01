<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'day_of_week',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function isToday(): bool
    {
        return strtolower($this->day_of_week) === strtolower(now()->format('l'));
    }
}
