<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'seat_number',
        'seat_type',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function isDriverSeat(): bool
    {
        return $this->seat_type === 'driver';
    }

    public function isConductorSeat(): bool
    {
        return $this->seat_type === 'conductor';
    }

    public function isRegularSeat(): bool
    {
        return $this->seat_type === 'regular';
    }

    public function isVipSeat(): bool
    {
        return $this->seat_type === 'vip';
    }

    public function isBusinessSeat(): bool
    {
        return $this->seat_type === 'business';
    }
}
