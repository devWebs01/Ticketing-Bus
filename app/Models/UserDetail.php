<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    /** @use HasFactory<\Database\Factories\UserDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'phone',
        'address',
        'profile_image',
        'date_of_birth',
        'gender',
        'identity_number', 
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address ?? '';
    }

    public function getFormattedIdNumberAttribute(): string
    {
        // Format Indonesian KTP: 16 digits, separated as XXXX-XXXX-XXXX-XXXX
        $id = $this->identity_number;
        if (strlen($id) === 16) {
            return substr($id, 0, 4).'-'.substr($id, 4, 4).'-'.substr($id, 8, 4).'-'.substr($id, 12, 4);
        }

        return $id;
    }

    public function getAgeAttribute(): int
    {
        return $this->date_of_birth ? $this->date_of_birth->diffInYears(now()) : 0;
    }

    public function getFullNameAttribute(): string
    {
        return $this->user->name ?? '';
    }

    public function scopeByGender($query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeAdults($query)
    {
        return $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 17');
    }

    public function getIdentityTypeAttribute(): string
    {
        // For Indonesian context, determine if it's KTP (17+) or Kartu Pelajar
        $age = $this->age;
        if ($age >= 17) {
            return 'KTP';
        }

        return 'Kartu Pelajar';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isChecker(): bool
    {
        return $this->role === 'checker';
    }

    public function getRoleTextAttribute(): string
    {
        return match ($this->role) {
            'customer' => 'Pelanggan',
            'admin' => 'Administrator',
            'checker' => 'Petugas Tiket',
            default => 'Tidak Diketahui'
        };
    }

    public function getGenderTextAttribute(): string
    {
        return match ($this->gender) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => 'Tidak Diketahui'
        };
    }
}
