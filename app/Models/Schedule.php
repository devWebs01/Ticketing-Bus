<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
        'date',
        'price',
        'total_seats',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
            'arrival_time' => 'datetime',
            'date' => 'date',
            'price' => 'decimal:2',
        ];
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function tripManifest(): HasOne
    {
        return $this->hasOne(TripManifest::class);
    }

    public function availableSeats()
    {
        return $this->seats()->where('status', 'available')->count();
    }

    public function isBookable(): bool
    {
        return $this->status === 'active' &&
               ! $this->tripManifest &&
               $this->date->isFuture();
    }
}
