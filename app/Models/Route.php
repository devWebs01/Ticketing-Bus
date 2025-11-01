<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin',
        'destination',
        'estimated_duration_hours',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function getSchedulesCountAttribute(): int
    {
        return $this->schedules()->count();
    }

    public function getRouteNameAttribute(): string
    {
        return "{$this->origin} → {$this->destination}";
    }

    public function getDurationTextAttribute(): string
    {
        return $this->estimated_duration_hours.' jam';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCities($query, string $origin, string $destination)
    {
        return $query->where('origin', $origin)
            ->where('destination', $destination);
    }
}
