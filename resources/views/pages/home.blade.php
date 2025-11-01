<?php

use function Laravel\Folio\name;

name('users.index');

?>

<x-guest-layout>

    <!-- ======= Hero =======-->
    <section class="hero__v6 section" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="row">
                        <div class="col-lg-11"><span class="hero-subtitle text-uppercase" data-aos="fade-up"
                                data-aos-delay="0">Solusi Perjalanan Modern</span>
                            <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="100">Pesan Tiket Bus
                                Antar Kota dengan Mudah dan Cepat</h1>
                            <p class="hero-description mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="200">Nikmati
                                kemudahan memesan tiket bus secara online dengan sistem yang aman, efisien, dan
                                user-friendly untuk perjalanan Anda.
                            </p>
                            <div class="cta d-flex gap-2 mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="300">
                                class="btn" href="#">Pesan Tiket Sekarang</a><a class="btn btn-white-outline"
                                    href="#">Lihat Jadwal
                                    <svg class="lucide lucide-arrow-up-right" xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewbox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M7 7h10v10"></path>
                                        <path d="M7 17 17 7"></path>
                                    </svg></a></div>
                            <div class="logos mb-4" data-aos="fade-up" data-aos-delay="400"><span
                                    class="logos-title text-uppercase mb-4 d-block">Dipercaya oleh ribuan
                                    penumpang</span>
                                <div class="logos-images d-flex gap-4 align-items-center"><img
                                        class="img-fluid js-img-to-inline-svg"
                                        src="{{ asset('assets/images/logo/actual-size/logo-air-bnb__black.svg') }}"
                                        alt="Company 1" style="width: 110px;"><img
                                        class="img-fluid js-img-to-inline-svg"
                                        src="{{ asset('assets/images/logo/actual-size/logo-ibm__black.svg') }}"
                                        alt="Company 2" style="width: 80px;"><img class="img-fluid js-img-to-inline-svg"
                                        src="{{ asset('assets/images/logo/actual-size/logo-google__black.svg') }}"
                                        alt="Company 3" style="width: 110px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img"><img class="img-card img-fluid"
                            src="{{ asset('assets/images/card-expenses.png') }}" alt="Image card" data-aos="fade-down"
                            data-aos-delay="600"><img class="img-main img-fluid rounded-4"
                            src="{{ asset('assets/images/hero-img-1-min.jpg') }}" alt="Hero Image" data-aos="fade-in"
                            data-aos-delay="500"></div>
                </div>
            </div>
        </div>
        <!-- End Hero-->
    </section>
    <!-- End Hero-->
    <!-- ======= About =======-->
    <section class="about__v4 section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <div class="row justify-content-end">
                        <div class="col-md-11 mb-4 mb-md-0"><span class="subtitle text-uppercase mb-3"
                                data-aos="fade-up" data-aos-delay="0">Tentang Kami</span>
                            <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">Platform pemesanan tiket bus
                                terpercaya untuk perjalanan Anda yang nyaman dan aman</h2>
                            <div data-aos="fade-up" data-aos-delay="200">
                                <p>Didirikan dengan visi merevolusi industri transportasi antar kota, kami adalah
                                    platform pemesanan tiket bus online terdepan yang memberikan solusi perjalanan
                                    yang inovatif dan aman.
                                </p>
                                <p>Platform kami yang modern memastikan proses pemesanan Anda cepat, aman, dan mudah
                                    dikelola, memberdayakan Anda untuk merencanakan perjalanan dengan percaya diri
                                    dan kenyamanan maksimal.</p>
                            </div>
                            <h4 class="small fw-bold mt-4 mb-3" data-aos="fade-up" data-aos-delay="300">Nilai dan
                                Visi Utama</h4>
                            <ul class="d-flex flex-row flex-wrap list-unstyled gap-3 features" data-aos="fade-up"
                                data-aos-delay="400">
                                <li class="d-flex align-items-center gap-2"><span
                                        class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span
                                        class="text">Inovasi</span></li>
                                <li class="d-flex align-items-center gap-2"><span
                                        class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span
                                        class="text">Keamanan</span></li>
                                <li class="d-flex align-items-center gap-2"><span
                                        class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span
                                        class="text">Kemudahan
                                        Pengguna</span></li>
                                <li class="d-flex align-items-center gap-2"><span
                                        class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span
                                        class="text">Transparansi</span>
                                </li>
                                <li class="d-flex align-items-center gap-2"><span
                                        class="icon rounded-circle text-center"><i
                                            class="bi bi-check"></i></span><span class="text">Pelayanan
                                        Terbaik</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-wrap position-relative"><img class="img-fluid rounded-4"
                            src="{{ asset('assets/images/about_2-min.jpg') }}"
                            alt="FreeBootstrap.net image placeholder" data-aos="fade-up" data-aos-delay="0">
                        <div class="mission-statement p-4 rounded-4 d-flex gap-4" data-aos="fade-up"
                            data-aos-delay="100">
                            <div class="mission-icon text-center rounded-circle"><i class="bi bi-lightbulb fs-4"></i>
                            </div>
                            <div>
                                <h3 class="text-uppercase fw-bold">Misi Kami</h3>
                                <p class="fs-5 mb-0">Misi kami adalah memberdayakan setiap orang dengan menyediakan
                                    layanan pemesanan tiket bus yang aman, efisien, dan mudah digunakan untuk
                                    perjalanan yang lebih baik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About-->
    <!-- ======= Features =======-->
    <section class="section features__v2" id="features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-lg-flex p-5 rounded-4 content" data-aos="fade-in" data-aos-delay="0">
                        <div class="row">
                            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <div class="h-100 flex-column justify-content-between d-flex">
                                            <div>
                                                <h2 class="mb-4">Mengapa Memilih Kami</h2>
                                                <p class="mb-5">Rasakan kemudahan memesan tiket bus dengan
                                                    platform yang aman, efisien, dan mudah digunakan. Sistem modern
                                                    kami memastikan setiap transaksi Anda aman, cepat, dan mudah
                                                    dikelola, memberdayakan Anda untuk merencanakan perjalanan
                                                    dengan percaya diri dan kenyamanan maksimal.</p>
                                            </div>
                                            <div class="align-self-start">
                                                class="glightbox btn btn-play d-inline-flex align-items-center gap-2"
                                                href="https://www.youtube.com/watch?v=DQx96G4yHd8"
                                                data-gallery="video"><i class="bi bi-play-fill"></i> Tonton
                                                Video</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row justify-content-end">
                                    <div class="col-lg-11">
                                        <div class="row">
                                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="0">
                                                <div class="icon text-center mb-4"><i class="bi bi-phone fs-4"></i>
                                                </div>
                                                <h3 class="fs-6 fw-bold mb-3">Pemesanan Online 24/7</h3>
                                                <p>Pesan tiket kapan saja, di mana saja dengan tampilan responsif di
                                                    berbagai perangkat.</p>
                                            </div>
                                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                                <div class="icon text-center mb-4"><i
                                                        class="bi bi-ticket-perforated fs-4"></i>
                                                </div>
                                                <h3 class="fs-6 fw-bold mb-3">E-Ticket Instan</h3>
                                                <p>Dapatkan e-ticket langsung setelah pembayaran dengan
                                                    kemudahan check-in.</p>
                                            </div>
                                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                                                <div class="icon text-center mb-4"><i class="bi bi-headset fs-4"></i>
                                                </div>
                                                <h3 class="fs-6 fw-bold mb-3">Customer Support</h3>
                                                <p>Layanan pelanggan 24/7 melalui chat, email, telepon, dan pusat
                                                    bantuan lengkap.</p>
                                            </div>
                                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                                                <div class="icon text-center mb-4"><i
                                                        class="bi bi-shield-check fs-4"></i></div>
                                                <h3 class="fs-6 fw-bold mb-3">Pembayaran Aman</h3>
                                                <p>Berbagai metode pembayaran dengan enkripsi data dan sistem
                                                    keamanan terjamin.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features-->

    <!-- ======= How it works =======-->
    <section class="section howitworks__v1" id="how-it-works">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 text-center mx-auto"><span class="subtitle text-uppercase mb-3"
                        data-aos="fade-up" data-aos-delay="0">Cara Pemesanan</span>
                    <h2 data-aos="fade-up" data-aos-delay="100">Mudah dan Cepat</h2>
                    <p data-aos="fade-up" data-aos-delay="200">Platform kami dirancang untuk membuat pemesanan
                        tiket bus Anda menjadi sederhana dan efisien. Ikuti langkah mudah berikut:</p>
                </div>
            </div>
            <div class="row g-md-5">
                <div class="col-md-6 col-lg-3">
                    <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative"
                        data-aos="fade-up" data-aos-delay="0">
                        <div data-aos="fade-right" data-aos-delay="500"><img class="arch-line"
                                src="{{ asset('assets/images/arch-line.svg') }}"
                                alt="FreeBootstrap.net image placeholder"></div><span
                            class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">1</span>
                        <div>
                            <h3 class="fs-5 mb-4">Pilih Rute & Jadwal</h3>
                            <p>Cari rute perjalanan Anda dan pilih jadwal keberangkatan yang sesuai dengan kebutuhan
                                Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="step-card reverse text-center h-100 d-flex flex-column justify-content-start position-relative">
                        <div data-aos="fade-right" data-aos-delay="1100"><img class="arch-line reverse"
                                src="{{ asset('assets/images/arch-line-reverse.svg') }}"
                                alt="FreeBootstrap.net image placeholder"></div><span
                            class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">2</span>
                        <h3 class="fs-5 mb-4">Pilih Kursi</h3>
                        <p>Pilih kursi favorit Anda dari denah kursi yang tersedia secara real-time.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
                    <div
                        class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative">
                        <div data-aos="fade-right" data-aos-delay="1700"><img class="arch-line"
                                src="{{ asset('assets/images/arch-line.svg') }}"
                                alt="FreeBootstrap.net image placeholder"></div><span
                            class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">3</span>
                        <h3 class="fs-5 mb-4">Isi Data & Bayar</h3>
                        <p>Lengkapi data penumpang dan lakukan pembayaran melalui berbagai metode yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1800">
                    <div
                        class="step-card last text-center h-100 d-flex flex-column justify-content-start position-relative">
                        <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">4</span>
                        <div>
                            <h3 class="fs-5 mb-4">Terima E-Ticket</h3>
                            <p>Dapatkan e-ticket langsung via email dan WhatsApp, siap untuk perjalanan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End How it works-->
    <!-- ======= Stats =======-->
    <section class="stats__v3 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-wrap content rounded-4" data-aos="fade-up" data-aos-delay="0">
                        <div class="rounded-borders">
                            <div class="rounded-border-1"></div>
                            <div class="rounded-border-2"></div>
                            <div class="rounded-border-3"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                            data-aos-delay="100">
                            <div class="stat-item">
                                <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="50"
                                        data-purecounter-duration="2">0</span><span>K+</span></h3>
                                <p class="mb-0">Penumpang Puas</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="stat-item">
                                <h3 class="fs-1 fw-bold"> <span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="100"
                                        data-purecounter-duration="2">0</span><span>+</span></h3>
                                <p class="mb-0">Rute Tersedia</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                            data-aos-delay="300">
                            <div class="stat-item">
                                <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="150"
                                        data-purecounter-duration="2">0</span><span>+</span>
                                </h3>
                                <p class="mb-0">Armada Bus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Stats-->

    <!-- End Contact-->
</x-guest-layout>
