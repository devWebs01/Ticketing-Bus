<?php

use function Livewire\Volt\{state};
use App\Models\Schedule;
use function Laravel\Folio\name;

name('search');

state([
    'schedules' => Schedule::get(),
]);

?>

<x-guest-layout>
    <x-slot name="title">Hasil Pencarian - E-Ticketing</x-slot>
    @volt
        <div>

            <div class="container py-4">
                <div class="row">
                    <!-- Filter Sidebar -->
                    <div class="col-lg-3">
                        <div class="bg-white rounded shadow-sm p-4 position-sticky" style="top: 20px;">
                            <h5 class="mb-4">Filter</h5>

                            <!-- Time Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Jam Berangkat</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="morning" checked>
                                    <label class="form-check-label" for="morning">
                                        Pagi (00:00 - 12:00)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="afternoon">
                                    <label class="form-check-label" for="afternoon">
                                        Siang (12:00 - 18:00)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="night">
                                    <label class="form-check-label" for="night">
                                        Malam (18:00 - 24:00)
                                    </label>
                                </div>
                            </div>

                            <!-- Vehicle Type Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Tipe Kendaraan</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="executive" checked>
                                    <label class="form-check-label" for="executive">
                                        Executive
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="business" checked>
                                    <label class="form-check-label" for="business">
                                        Business
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="economy">
                                    <label class="form-check-label" for="economy">
                                        Economy
                                    </label>
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Rentang Harga</h6>
                                <input type="range" class="form-range" min="0" max="500000" id="priceRange">
                                <div class="d-flex justify-content-between text-dark small">
                                    <span>Rp 0</span>
                                    <span>Rp 500.000</span>
                                </div>
                            </div>

                            <!-- Seat Availability Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Kursi Tersedia</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="available-seats" checked>
                                    <label class="form-check-label" for="available-seats">
                                        Ada kursi kosong
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section -->
                    <div class="col-lg-9">
                        <!-- Sort Options -->
                        <div class="bg-white rounded shadow-sm p-3 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark">Menampilkan <strong>8</strong> jadwal tersedia</span>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-dark small">Urutkan:</span>
                                    <select class="form-select form-select-sm" style="width: auto;">
                                        <option>Harga Terendah</option>
                                        <option>Harga Tertinggi</option>
                                        <option>Keberangkatan Terawal</option>
                                        <option>Keberangkatan Terakhir</option>
                                        <option>Durasi Terpendek</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Cards -->
                        <div class="gap-3">
                            @foreach ($schedules as $schedule)
                                <div class="card border mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="row align-items-center mb-3">
                                                    {{-- Waktu dan kota asal --}}
                                                    <div class="col-auto">
                                                        <h4 class="mb-1">
                                                            {{ $schedule->departure_time?->format('H:i') ?? '-' }}
                                                        </h4>
                                                        <p class="text-dark small mb-0">
                                                            {{ ucfirst($schedule->departure_city) }}
                                                        </p>
                                                    </div>

                                                    {{-- Icon arah perjalanan --}}
                                                    <div class="col">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div class="flex-grow border-top border-2 border-secondary">
                                                            </div>
                                                            <div class="px-3">
                                                                <svg style="width: 24px; height: 24px;" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="flex-grow border-top border-2 border-secondary">
                                                            </div>
                                                        </div>

                                                        <p class="text-center text-dark small mt-2">
                                                            {{ $schedule->route?->estimated_duration_hours ?? '-' }} jam
                                                        </p>
                                                    </div>

                                                    {{-- Kota tujuan --}}
                                                    <div class="col-auto text-end">
                                                        <h4 class="mb-1">
                                                            {{ $schedule->arrival_time
                                                                ? $schedule->arrival_time->format('H:i')
                                                                : optional($schedule->departure_time)->addHours($schedule->route?->estimated_duration_hours ?? 0)->format('H:i') }}
                                                        </h4>
                                                        <p class="text-dark small mb-0">
                                                            {{ ucfirst($schedule->arrival_city) }}
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- Fasilitas kendaraan --}}
                                                <div class="d-flex flex-wrap gap-2 mb-3">
                                                    <span class="badge bg-success">
                                                        {{ ucfirst($schedule->vehicle?->vehicle_type ?? 'Tidak diketahui') }}
                                                    </span>

                                                </div>

                                                {{-- Hari Operasional --}}
                                                @if ($schedule->days->isNotEmpty())
                                                    <p class="text-primary small mb-0">
                                                        <i class="bi bi-calendar-week"></i>
                                                        Operasional: {{ $schedule->days_list }}
                                                    </p>
                                                @endif
                                            </div>

                                            {{-- Harga & tombol pilih --}}
                                            <div class="col-md-4 text-end">
                                                <p class="text-dark small mb-1">Harga per orang</p>
                                                <h4 class="text-success mb-2">Rp
                                                    {{ number_format($schedule->price, 0, ',', '.') }}</h4>
                                                <p class="text-dark small mb-3">
                                                    {{ $schedule->availableSeats() }} kursi tersedia
                                                </p>
                                                <a href="{{ route('schedules.detail', ['Schedule' => $schedule->id]) }}"
                                                    class="btn btn-primary">
                                                    Pilih
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Empty State (Hidden for demo) -->
                        @if (false)
                            <div class="bg-white rounded shadow-sm p-5 text-center">
                                <svg style="width: 64px; height: 64px;" class="text-dark mx-auto mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h-.01M12 12v0m0 0h0">
                                    </path>
                                </svg>
                                <h3 class="h5 mb-2">Tidak ada jadwal tersedia</h3>
                                <p class="text-dark mb-4">Coba ubah tanggal atau rute pencarian Anda</p>
                                <button class="btn btn-primary">
                                    Ubah Pencarian
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endvolt
</x-guest-layout>
