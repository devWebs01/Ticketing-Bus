<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TripManifest extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'manifest_number',
        'departure_time_actual',
        'arrival_time_actual',
        'total_passengers',
        'total_revenue',
        'notes',
        'status',
        'staff_notes',
        'driver_id',
        'conductor_id',
    ];

    protected function casts(): array
    {
        return [
            'departure_time_actual' => 'datetime',
            'arrival_time_actual' => 'datetime',
            'total_revenue' => 'decimal:2',
        ];
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function conductor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'conductor_id');
    }

    public function getManifestStatusTextAttribute(): string
    {
        return match ($this->status) {
            'prepared' => 'Disiapkan',
            'active' => 'Berjalan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    public function canBeActivated(): bool
    {
        return $this->status === 'prepared' && $this->schedule->date->isToday();
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
