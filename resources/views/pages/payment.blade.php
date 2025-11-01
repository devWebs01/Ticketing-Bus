<x-guest-layout>

@section('title', 'Pembayaran - E-Ticketing')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('checkout', $schedule_id) }}" class="text-blue-600 hover:text-blue-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Pembayaran</h1>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="flex items-center text-green-600">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                        <span class="ml-2 text-sm font-medium">Pilih Kursi</span>
                    </div>
                    <div class="w-16 h-0.5 bg-green-600 mx-2"></div>
                    <div class="flex items-center text-green-600">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                        <span class="ml-2 text-sm font-medium">Data Penumpang</span>
                    </div>
                    <div class="w-16 h-0.5 bg-green-600 mx-2"></div>
                    <div class="flex items-center text-blue-600">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                        <span class="ml-2 text-sm font-medium">Pembayaran</span>
                    </div>
                    <div class="w-16 h-0.5 bg-gray-300 mx-2"></div>
                    <div class="flex items-center text-gray-400">
                        <div class="w-8 h-8 bg-gray-300 text-white rounded-full flex items-center justify-center text-sm font-semibold">4</div>
                        <span class="ml-2 text-sm font-medium">Konfirmasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Timer -->
    <div class="bg-orange-50 border-b border-orange-200">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-center space-x-2">
                <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-semibold text-orange-800">Selesaikan pembayaran dalam <span id="payment-timer">59:45</span></span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Payment Methods -->
            <div class="lg:col-span-2">
                <form id="payment-form" class="space-y-6">
                    <!-- Payment Method Selection -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-4">Pilih Metode Pembayaran</h2>

                        <div class="space-y-4">
                            <!-- Virtual Account -->
                            <div class="payment-option">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" value="bca_va" class="mr-4" checked>
                                    <div class="flex items-center flex-1">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-blue-600 font-bold">BCA</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold">Virtual Account BCA</h4>
                                            <p class="text-sm text-gray-600">Bayar melalui ATM, Internet Banking, atau Mobile Banking BCA</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="payment-option">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" value="mandiri_va" class="mr-4">
                                    <div class="flex items-center flex-1">
                                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-yellow-700 font-bold">Mandiri</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold">Virtual Account Mandiri</h4>
                                            <p class="text-sm text-gray-600">Bayar melalui ATM, Internet Banking, atau Livin' Mandiri</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- E-Wallet -->
                            <div class="payment-option">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" value="gopay" class="mr-4">
                                    <div class="flex items-center flex-1">
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-green-700 font-bold">GoPay</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold">GoPay</h4>
                                            <p class="text-sm text-gray-600">Bayar menggunakan saldo GoPay</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="payment-option">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" value="ovo" class="mr-4">
                                    <div class="flex items-center flex-1">
                                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-purple-700 font-bold">OVO</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold">OVO</h4>
                                            <p class="text-sm text-gray-600">Bayar menggunakan saldo OVO</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Credit Card -->
                            <div class="payment-option">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" value="credit_card" class="mr-4">
                                    <div class="flex items-center flex-1">
                                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold">Kartu Kredit/Debit</h4>
                                            <p class="text-sm text-gray-600">Visa, Mastercard, JCB</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Credit Card Form (Hidden by default) -->
                    <div id="credit-card-form" class="bg-white rounded-lg shadow-md p-6 hidden">
                        <h2 class="text-xl font-bold mb-4">Detail Kartu Kredit</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kartu</label>
                                <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Expired Date</label>
                                    <input type="text" name="card_expiry" placeholder="MM/YY" maxlength="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                    <input type="text" name="card_cvv" placeholder="123" maxlength="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemegang Kartu</label>
                                <input type="text" name="card_holder" placeholder="John Doe" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Installment Options -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Opsi Cicilan</label>
                                <select name="installment" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="full">Bayar Penuh</option>
                                    <option value="3">Cicilan 3 Bulan</option>
                                    <option value="6">Cicilan 6 Bulan</option>
                                    <option value="12">Cicilan 12 Bulan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-4">Informasi Penagihan</h2>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="same-as-passenger" checked class="mr-2">
                                <span class="text-sm text-gray-700">Sama dengan data penumpang</span>
                            </label>
                        </div>

                        <div id="billing-form" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="billing_name" value="John Doe" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="billing_email" value="john@example.com" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                                    <input type="tel" name="billing_phone" value="08123456789" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <input type="text" name="billing_address" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100" placeholder="Alamat lengkap">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h3 class="text-xl font-bold mb-4">Ringkasan Pembayaran</h3>

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
                            Executive Class • Kursi 1A
                        </div>
                    </div>

                    <!-- Passenger Info -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Penumpang</h4>
                        <div class="text-sm text-gray-600">
                            <p>John Doe</p>
                            <p>1A • Dewasa</p>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t pt-4 mb-6">
                        <h4 class="font-semibold mb-3">Rincian Pembayaran</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Tiket (1x)</span>
                                <span>Rp 120.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya layanan</span>
                                <span>Rp 5.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Asuransi</span>
                                <span>Rp 15.000</span>
                            </div>
                            <div class="flex justify-between text-red-600">
                                <span>Diskon (PROMO10)</span>
                                <span>-Rp 14.500</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-green-600 mt-4 pt-4 border-t">
                            <span>Total Pembayaran</span>
                            <span>Rp 125.500</span>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div id="payment-instructions" class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran</h4>
                        <div id="bca-va-instructions" class="text-sm text-blue-700 space-y-1">
                            <p>1. Buka aplikasi atau website BCA</p>
                            <p>2. Pilih menu Transfer</p>
                            <p>3. Pilih ke Rekening BCA Virtual Account</p>
                            <p>4. Masukkan nomor VA: <strong>8806081234567890</strong></p>
                            <p>5. Masukkan jumlah pembayaran: <strong>Rp 125.500</strong></p>
                            <p>6. Konfirmasi pembayaran</p>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    <button id="pay-button" class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 transition duration-200 font-semibold mb-3">
                        Bayar Sekarang
                    </button>

                    <!-- Cancel Button -->
                    <a href="{{ route('checkout', $schedule_id) }}" class="w-full bg-gray-200 text-gray-700 py-3 px-4 rounded-md hover:bg-gray-300 transition duration-200 font-semibold text-center inline-block">
                        Batalkan
                    </a>

                    <!-- Security Info -->
                    <div class="mt-6 text-center text-xs text-gray-600">
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pembayaran aman dan terenkripsi</span>
                        </div>
                        <p>Transaksi Anda dilindungi oleh keamanan berlapis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal (Hidden by default) -->
    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Pembayaran Berhasil!</h3>
                <p class="text-gray-600 mb-6">Terima kasih, pembayaran Anda telah kami terima. E-tiket akan dikirim ke email Anda.</p>
                <a href="/booking/12345/success" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-semibold inline-block">
                    Lihat E-Tiket
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript for payment handling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment timer
            let timeLeft = 3545; // 59:45 in seconds
            const timerElement = document.getElementById('payment-timer');

            const timer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    alert('Waktu pembayaran habis. Silakan lakukan pemesanan kembali.');
                    window.location.href = `/checkout/{{$schedule_id}}`;
                }

                timeLeft--;
            }, 1000);

            // Payment method handler
            document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const creditCardForm = document.getElementById('credit-card-form');
                    const paymentInstructions = document.getElementById('payment-instructions');

                    if (this.value === 'credit_card') {
                        creditCardForm.classList.remove('hidden');
                        paymentInstructions.innerHTML = `
                            <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran</h4>
                            <div class="text-sm text-blue-700">
                                <p>Isi form kartu kredit dengan data yang benar dan klik "Bayar Sekarang"</p>
                                <p>Transaksi akan diproses secara aman dan langsung</p>
                            </div>
                        `;
                    } else {
                        creditCardForm.classList.add('hidden');
                        updatePaymentInstructions(this.value);
                    }
                });
            });

            function updatePaymentInstructions(method) {
                const instructions = document.getElementById('payment-instructions');
                const instructionsHtml = {
                    'bca_va': `
                        <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran BCA VA</h4>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p>1. Buka aplikasi atau website BCA</p>
                            <p>2. Pilih menu Transfer</p>
                            <p>3. Pilih ke Rekening BCA Virtual Account</p>
                            <p>4. Masukkan nomor VA: <strong>8806081234567890</strong></p>
                            <p>5. Masukkan jumlah pembayaran: <strong>Rp 125.500</strong></p>
                            <p>6. Konfirmasi pembayaran</p>
                        </div>
                    `,
                    'mandiri_va': `
                        <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran Mandiri VA</h4>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p>1. Buka aplikasi Livin' atau ATM Mandiri</p>
                            <p>2. Pilih menu Pembayaran</p>
                            <p>3. Pilih Multi Payment</p>
                            <p>4. Masukkan kode perusahaan: <strong>8806</strong></p>
                            <p>5. Masukkan nomor VA: <strong>081234567890</strong></p>
                            <p>6. Masukkan jumlah: <strong>Rp 125.500</strong></p>
                        </div>
                    `,
                    'gopay': `
                        <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran GoPay</h4>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p>1. Buka aplikasi GoJek</p>
                            <p>2. Pilih menu Bayar</p>
                            <p>3. Scan QR Code atau masukkan nomor VA</p>
                            <p>4. Konfirmasi pembayaran: <strong>Rp 125.500</strong></p>
                            <p>5. Masukkan PIN GoPay Anda</p>
                        </div>
                    `,
                    'ovo': `
                        <h4 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran OVO</h4>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p>1. Buka aplikasi OVO</p>
                            <p>2. Pilih menu Transfer</p>
                            <p>3. Scan QR Code atau pilih ke rekening</p>
                            <p>4. Masukkan jumlah: <strong>Rp 125.500</strong></p>
                            <p>5. Konfirmasi dan masukkan PIN OVO</p>
                        </div>
                    `
                };

                instructions.innerHTML = instructionsHtml[method] || instructionsHtml['bca_va'];
            }

            // Billing information toggle
            document.getElementById('same-as-passenger').addEventListener('change', function() {
                const billingForm = document.getElementById('billing-form');
                const inputs = billingForm.querySelectorAll('input');

                if (this.checked) {
                    inputs.forEach(input => {
                        input.disabled = true;
                        input.classList.add('bg-gray-100');
                    });
                } else {
                    inputs.forEach(input => {
                        input.disabled = false;
                        input.classList.remove('bg-gray-100');
                    });
                }
            });

            // Payment form submission
            document.getElementById('pay-button').addEventListener('click', function() {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

                if (paymentMethod === 'credit_card') {
                    // Validate credit card form
                    const cardNumber = document.querySelector('input[name="card_number"]').value;
                    const cardExpiry = document.querySelector('input[name="card_expiry"]').value;
                    const cardCvv = document.querySelector('input[name="card_cvv"]').value;
                    const cardHolder = document.querySelector('input[name="card_holder"]').value;

                    if (!cardNumber || !cardExpiry || !cardCvv || !cardHolder) {
                        alert('Mohon lengkapi semua data kartu kredit');
                        return;
                    }
                }

                // Simulate payment processing
                this.disabled = true;
                this.textContent = 'Memproses pembayaran...';

                setTimeout(() => {
                    // Show success modal
                    document.getElementById('success-modal').classList.remove('hidden');
                    clearInterval(timer);
                }, 2000);
            });

            // Format card number input
            document.querySelector('input[name="card_number"]')?.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s/g, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formattedValue;
            });

            // Format expiry date input
            document.querySelector('input[name="card_expiry"]')?.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.slice(0, 2) + '/' + value.slice(2, 4);
                }
                e.target.value = value;
            });

            // CVV input - numbers only
            document.querySelector('input[name="card_cvv"]')?.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        });
    </script>
</div>
@endsection
</x-guest-layout>
