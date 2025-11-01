<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'vehicle_id',
        'departure_time',
        'price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime:H:i:s',
            'price' => 'decimal:2',
        ];
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function days(): HasMany
    {
        return $this->hasMany(ScheduleDay::class);
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

    public function getDaysListAttribute(): string
    {
        if ($this->relationLoaded('days') && $this->days->isNotEmpty()) {
            $dayMap = [
                'monday' => 'Senin',
                'tuesday' => 'Selasa',
                'wednesday' => 'Rabu',
                'thursday' => 'Kamis',
                'friday' => 'Jumat',
                'saturday' => 'Sabtu',
                'sunday' => 'Minggu',
            ];

            return $this->days->pluck('day_of_week')->map(function ($day) use ($dayMap) {
                return $dayMap[$day] ?? $day;
            })->join(', ');
        }

        // Fallback to query the database if relation not loaded
        $days = $this->days()->pluck('day_of_week');
        if ($days->isNotEmpty()) {
            $dayMap = [
                'monday' => 'Senin',
                'tuesday' => 'Selasa',
                'wednesday' => 'Rabu',
                'thursday' => 'Kamis',
                'friday' => 'Jumat',
                'saturday' => 'Sabtu',
                'sunday' => 'Minggu',
            ];

            return $days->map(function ($day) use ($dayMap) {
                return $dayMap[$day] ?? $day;
            })->join(', ');
        }

        return '';
    }

    public function availableSeats()
    {
        return $this->seats()->where('status', 'available')->count();
    }

    public function isBookable(): bool
    {
        return $this->status === 'active' && ! $this->tripManifest;
    }

    public function scopeActiveToday(Builder $query): Builder
    {
        return $query->whereHas('days', function ($q) {
            $q->where('day_of_week', strtolower(now()->format('l')));
        })->where('status', 'active');
    }

    public function scopeActiveOnDay(Builder $query, string $day): Builder
    {
        return $query->whereHas('days', function ($q) use ($day) {
            $q->where('day_of_week', strtolower($day));
        })->where('status', 'active');
    }
}
