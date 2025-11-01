<x-guest-layout>
    <x-slot name="title">Data Penumpang - E-Ticketing</x-slot>
    <div>
        <!-- Header -->
        <div class="bg-white shadow-sm border-b">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('schedules.seats', $schedule_id) }}" class="text-blue-600 hover:text-blue-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Data Penumpang & Kontak</h1>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="bg-white border-b">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="flex items-center text-green-600">
                            <div
                                class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                                1</div>
                            <span class="ml-2 text-sm font-medium">Pilih Kursi</span>
                        </div>
                        <div class="w-16 h-0.5 bg-green-600 mx-2"></div>
                        <div class="flex items-center text-blue-600">
                            <div
                                class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                                2</div>
                            <span class="ml-2 text-sm font-medium">Data Penumpang</span>
                        </div>
                        <div class="w-16 h-0.5 bg-gray-300 mx-2"></div>
                        <div class="flex items-center text-gray-400">
                            <div
                                class="w-8 h-8 bg-gray-300 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                                3</div>
                            <span class="ml-2 text-sm font-medium">Pembayaran</span>
                        </div>
                        <div class="w-16 h-0.5 bg-gray-300 mx-2"></div>
                        <div class="flex items-center text-gray-400">
                            <div
                                class="w-8 h-8 bg-gray-300 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                                4</div>
                            <span class="ml-2 text-sm font-medium">Konfirmasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <form id="checkout-form" class="space-y-6">
                        <!-- Contact Information -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold mb-4">Informasi Kontak</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input type="text" name="contact_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="John Doe">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                    <input type="email" name="contact_email" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="john@example.com">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP *</label>
                                    <input type="tel" name="contact_phone" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="08123456789">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Identitas
                                        (KTP/SIM) *</label>
                                    <input type="text" name="contact_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="3275012345670001">
                                </div>
                            </div>
                        </div>

                        <!-- Passenger Information -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold mb-4">Data Penumpang</h2>

                            <div id="passengers-container" class="space-y-4">
                                <!-- Passenger 1 (same as contact) -->
                                <div class="passenger-item border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="font-semibold">Penumpang 1</h3>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="same-as-contact" checked
                                                class="mr-2 text-blue-600">
                                            <label for="same-as-contact" class="text-sm text-gray-600">Sama dengan
                                                kontak</label>
                                        </div>
                                    </div>

                                    <div id="passenger-1-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                                *</label>
                                            <input type="text" name="passenger_name_1" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 passenger-name"
                                                placeholder="John Doe">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Identitas
                                                (KTP/SIM) *</label>
                                            <input type="text" name="passenger_id_1" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 passenger-id"
                                                placeholder="3275012345670001">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                                            <input type="tel" name="passenger_phone_1"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                placeholder="08123456789">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Usia</label>
                                            <select name="passenger_age_1"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="adult">Dewasa</option>
                                                <option value="child">Anak-anak (3-12 tahun)</option>
                                                <option value="infant">Bayi (< 3 tahun)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Seat Selection -->
                                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-blue-800">Kursi:</span>
                                            <span
                                                class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">1A</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Services -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold mb-4">Layanan Tambahan</h2>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div>
                                        <h4 class="font-semibold">Asuransi Perjalanan</h4>
                                        <p class="text-sm text-gray-600">Perlindungan selama perjalanan</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold mr-3">Rp 15.000</span>
                                        <input type="checkbox" name="insurance" class="insurance-checkbox">
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div>
                                        <h4 class="font-semibold">Extra Bagasi (+10kg)</h4>
                                        <p class="text-sm text-gray-600">Tambahan bagasi hingga 30kg total</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold mr-3">Rp 25.000</span>
                                        <input type="checkbox" name="extra_baggage" class="baggage-checkbox">
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div>
                                        <h4 class="font-semibold">Makanan Premium</h4>
                                        <p class="text-sm text-gray-600">Menu makanan spesial</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold mr-3">Rp 35.000</span>
                                        <input type="checkbox" name="premium_meal" class="meal-checkbox">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold mb-4">Syarat & Ketentuan</h2>

                            <div class="space-y-3">
                                <label class="flex items-start">
                                    <input type="checkbox" name="terms" required class="mt-1 mr-3 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat
                                            dan ketentuan</a> yang berlaku
                                    </span>
                                </label>

                                <label class="flex items-start">
                                    <input type="checkbox" name="privacy" required class="mt-1 mr-3 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Saya menyetujui <a href="#"
                                            class="text-blue-600 hover:underline">kebijakan privasi</a> dan penggunaan
                                        data pribadi
                                    </span>
                                </label>

                                <label class="flex items-start">
                                    <input type="checkbox" name="cancellation" required
                                        class="mt-1 mr-3 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Saya memahami dan menyetujui <a href="#"
                                            class="text-blue-600 hover:underline">kebijakan pembatalan</a>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                        <h3 class="text-xl font-bold mb-4">Ringkasan Pemesanan</h3>

                        <!-- Trip Details -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Jadwal #{{ $schedule_id }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold">Jakarta → Bandung</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                1 Nov 2025 • 07:00 - 10:30
                            </div>
                            <div class="text-sm text-gray-600">
                                Executive Class
                            </div>
                        </div>

                        <!-- Seat Info -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">Kursi Dipilih</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">1A</span>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="border-t pt-4 mb-6">
                            <h4 class="font-semibold mb-3">Rincian Harga</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Tiket (1x)</span>
                                    <span>Rp 120.000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Biaya layanan</span>
                                    <span>Rp 5.000</span>
                                </div>
                                <div id="insurance-cost" class="flex justify-between hidden">
                                    <span>Asuransi</span>
                                    <span>Rp 15.000</span>
                                </div>
                                <div id="baggage-cost" class="flex justify-between hidden">
                                    <span>Extra bagasi</span>
                                    <span>Rp 25.000</span>
                                </div>
                                <div id="meal-cost" class="flex justify-between hidden">
                                    <span>Makanan premium</span>
                                    <span>Rp 35.000</span>
                                </div>
                            </div>

                            <div class="flex justify-between text-xl font-bold text-green-600 mt-4 pt-4 border-t">
                                <span>Total</span>
                                <span>Rp <span id="total-price">125.000</span></span>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Promo</label>
                            <div class="flex">
                                <input type="text" name="promo_code"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan kode promo">
                                <button type="button"
                                    class="bg-gray-600 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 transition-colors">
                                    Pakai
                                </button>
                            </div>
                        </div>

                        <!-- Continue Button -->
                        <form action="{{ route('checkout.payment', $schedule_id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-semibold mb-3">
                                Lanjut ke Pembayaran
                            </button>
                        </form>

                        <!-- Info -->
                        <div class="text-center text-sm text-gray-600">
                            <p>Amankan kursi Anda sekarang!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for form handling -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const basePrice = 125000;
                const insurancePrice = 15000;
                const baggagePrice = 25000;
                const mealPrice = 35000;

                // Same as contact handler
                document.getElementById('same-as-contact').addEventListener('change', function() {
                    const passenger1Fields = document.getElementById('passenger-1-fields');
                    const contactFields = {
                        name: document.querySelector('input[name="contact_name"]'),
                        email: document.querySelector('input[name="contact_email"]'),
                        phone: document.querySelector('input[name="contact_phone"]'),
                        id: document.querySelector('input[name="contact_id"]')
                    };

                    if (this.checked) {
                        // Copy contact data to passenger
                        document.querySelector('input[name="passenger_name_1"]').value = contactFields.name
                            .value;
                        document.querySelector('input[name="passenger_phone_1"]').value = contactFields.phone
                            .value;
                        document.querySelector('input[name="passenger_id_1"]').value = contactFields.id.value;

                        // Disable passenger fields
                        passenger1Fields.querySelectorAll('input').forEach(input => {
                            if (input.name !== 'passenger_phone_1') {
                                input.disabled = true;
                            }
                        });
                    } else {
                        // Enable passenger fields
                        passenger1Fields.querySelectorAll('input').forEach(input => {
                            input.disabled = false;
                        });
                    }
                });

                // Contact fields change handler
                document.querySelectorAll('input[name^="contact_"]').forEach(input => {
                    input.addEventListener('input', function() {
                        if (document.getElementById('same-as-contact').checked) {
                            const passengerField = document.querySelector(
                                `input[name="passenger_${this.name.replace('contact_', '')}_1"]`);
                            if (passengerField) {
                                passengerField.value = this.value;
                            }
                        }
                    });
                });

                // Additional services price update
                function updateTotalPrice() {
                    let total = basePrice;

                    if (document.querySelector('.insurance-checkbox').checked) {
                        total += insurancePrice;
                        document.getElementById('insurance-cost').classList.remove('hidden');
                    } else {
                        document.getElementById('insurance-cost').classList.add('hidden');
                    }

                    if (document.querySelector('.baggage-checkbox').checked) {
                        total += baggagePrice;
                        document.getElementById('baggage-cost').classList.remove('hidden');
                    } else {
                        document.getElementById('baggage-cost').classList.add('hidden');
                    }

                    if (document.querySelector('.meal-checkbox').checked) {
                        total += mealPrice;
                        document.getElementById('meal-cost').classList.remove('hidden');
                    } else {
                        document.getElementById('meal-cost').classList.add('hidden');
                    }

                    document.getElementById('total-price').textContent = total.toLocaleString('id-ID');
                }

                document.querySelectorAll('.insurance-checkbox, .baggage-checkbox, .meal-checkbox').forEach(
                checkbox => {
                    checkbox.addEventListener('change', updateTotalPrice);
                });

                // Form validation
                document.getElementById('checkout-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Basic validation
                    const requiredFields = this.querySelectorAll('[required]');
                    let isValid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('border-red-500');
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });

                    if (!isValid) {
                        alert('Mohon lengkapi semua field yang wajib diisi');
                        return;
                    }

                    // Check terms and conditions
                    if (!document.querySelector('input[name="terms"]').checked ||
                        !document.querySelector('input[name="privacy"]').checked ||
                        !document.querySelector('input[name="cancellation"]').checked) {
                        alert('Anda harus menyetujui semua syarat dan ketentuan');
                        return;
                    }

                    // Submit form
                    window.location.href = `/checkout/{{ $schedule_id }}/payment`;
                });
            });
        </script>
    </div>
</x-guest-layout>
