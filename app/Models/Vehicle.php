<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_number',
        'vehicle_type',
        'total_seats',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_seats' => 'integer',
        ];
    }

    public function seats(): HasMany
    {
        return $this->hasMany(VehicleSeat::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function getVehicleNameAttribute(): string
    {
        return "{$this->vehicle_type} - {$this->vehicle_number}";
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    public function isUnderMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }
}
