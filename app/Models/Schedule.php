<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'departure_time',
        'date',
        'price',
        'total_seats',
        'status',
        'vehicle_number',
        'vehicle_type',
    ];

    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
            'date' => 'date',
            'price' => 'decimal:2',
        ];
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
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

    public function getDepartureCityAttribute(): string
    {
        return $this->route?->origin ?? '';
    }

    public function getArrivalCityAttribute(): string
    {
        return $this->route?->destination ?? '';
    }

    public function getRouteNameAttribute(): string
    {
        return $this->route?->route_name ?? '';
    }

    public function getDayOfWeekAttribute(): string
    {
        if ($this->date) {
            $dayMap = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin', 
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];
            return $dayMap[date('l', strtotime($this->date))] ?? date('l', strtotime($this->date));
        }
        return '';
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
