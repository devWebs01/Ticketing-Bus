<?php

use function Livewire\Volt\{state};
use App\Models\Schedule;
use function Laravel\Folio\name;

name('schedules.detail');

state(['schedule']);

$increment = fn() => $this->count++;

?>

<x-guest-layout>
    <x-slot name="title">Data Penumpang - E-Ticketing</x-slot>
    @volt
        <div>
            <div class="container py-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="mb-3 text-primary">{{ $schedule->route_name }}</h3>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Kota Asal:</strong> {{ ucfirst($schedule->departure_city) }}</p>
                                <p class="mb-1"><strong>Kota Tujuan:</strong> {{ ucfirst($schedule->arrival_city) }}</p>
                                <p class="mb-1"><strong>Durasi Perjalanan:</strong> {{ $schedule->route->duration_text }}
                                </p>
                                <p class="mb-1"><strong>Hari Operasional:</strong> {{ $schedule->days_list ?: '-' }}</p>
                                <p class="mb-1"><strong>Status Jadwal:</strong>
                                    <span
                                        class="badge {{ $schedule->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($schedule->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Jam Berangkat:</strong>
                                    {{ $schedule->departure_time?->format('H:i') }}</p>
                                <p class="mb-1"><strong>Jam Tiba (estimasi):</strong>
                                    {{ optional($schedule->departure_time)->addHours($schedule->route?->estimated_duration_hours ?? 0)->format('H:i') }}
                                </p>
                                <p class="mb-1"><strong>Harga Tiket:</strong>
                                    Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                </p>
                                <p class="mb-1"><strong>Kursi Tersedia:</strong> {{ $schedule->availableSeats() }}</p>
                            </div>
                        </div>

                        <hr>

                        {{-- Detail kendaraan --}}
                        <h5 class="mt-4">Informasi Kendaraan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor Kendaraan:</strong> {{ $schedule->vehicle?->vehicle_number ?? '-' }}</p>
                                <p><strong>Tipe Kendaraan:</strong> {{ ucfirst($schedule->vehicle?->vehicle_type ?? '-') }}
                                </p>
                                <p><strong>Total Kursi:</strong> {{ $schedule->vehicle?->total_seats ?? '-' }}</p>
                                <p><strong>Status Kendaraan:</strong>
                                    <span
                                        class="badge
                            @if ($schedule->vehicle?->status === 'active') bg-success
                            @elseif($schedule->vehicle?->status === 'maintenance') bg-warning
                            @else bg-secondary @endif">
                                        {{ ucfirst($schedule->vehicle?->status ?? '-') }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if ($schedule->vehicle?->notes)
                                    <p><strong>Catatan:</strong> {{ $schedule->vehicle->notes }}</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        {{-- Kursi --}}
                        <h5 class="mt-4">Daftar Kursi</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($schedule->seats as $seat)
                                <span
                                    class="badge
                        @if ($seat->status === 'available') bg-success
                        @elseif($seat->status === 'booked') bg-danger
                        @else bg-secondary @endif">
                                    {{ $seat->seat_number }}
                                </span>
                            @endforeach
                        </div>

                        <hr>

                        {{-- Tombol aksi --}}
                        <div class="row justify-items-between mt-4">
                            <div class="col-md-6">
                                <a href="{{ route('search') }}" class="btn btn-link">← Kembali ke Jadwal</a>

                            </div>
                            <div class="col-md-6 text-end">
                                @if ($schedule->isBookable())
                                    <a href="#" class="btn btn-primary">
                                        Pesan Tiket
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>Tidak tersedia</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endvolt

</x-guest-layout>
