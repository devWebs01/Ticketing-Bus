<div>
    <h3 class="text-lg font-semibold mb-4">Pilih Kursi</h3>

    <div class="grid grid-cols-4 gap-2 mb-4">
        @foreach($seats as $seat)
            <button
                type="button"
                wire:click="selectSeat({{ $seat->id }})"
                class="p-3 border rounded-lg text-center transition-colors
                       {{ $selectedSeatId == $seat->id ? 'bg-blue-500 text-white border-blue-500' :
                          $seat->status === 'available' ? 'bg-green-100 border-green-300 hover:bg-green-200' :
                          'bg-red-100 border-red-300 cursor-not-allowed' }}"
                {{ $seat->status !== 'available' ? 'disabled' : '' }}
            >
                {{ $seat->seat_number }}
            </button>
        @endforeach
    </div>

    @if($selectedSeat)
        <div class="bg-blue-50 p-4 rounded-lg">
            <p class="font-semibold">Kursi Terpilih: {{ $selectedSeat->seat_number }}</p>
            <p>Harga: Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
        </div>
    @endif

    <div class="mt-4 flex gap-2">
        <button
            type="button"
            wire:click="bookSeat"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 disabled:opacity-50"
            {{ !$selectedSeat ? 'disabled' : '' }}
        >
            Pesan Tiket
        </button>
    </div>
</div>