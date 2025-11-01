<!-- ======= Header =======-->
<header class="fbs__net-navbar navbar navbar-expand-lg dark" aria-label="freebootstrap.net navbar">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Start Logo-->
        <a class="navbar-brand w-auto" href="{{ route('home') }}">
            <!-- If you use a text logo, uncomment this if it is commented-->
            <!-- E-Ticketing-->

            <!-- If you plan to use an image logo, uncomment this if it is commented-->

            <!-- logo dark--><img class="logo dark img-fluid" src="{{ asset('assets/images/logo-dark.svg') }}"
                alt="E-Ticketing">

            <!-- logo light--><img class="logo light img-fluid" src="{{ asset('assets/images/logo-light.svg') }}"
                alt="E-Ticketing">

        </a>
        <!-- End Logo-->

        <!-- Start offcanvas-->
        <div class="offcanvas offcanvas-start w-75" id="fbs__net-navbars" tabindex="-1"
            aria-labelledby="fbs__net-navbarsLabel">

            <div class="offcanvas-header">
                <div class="offcanvas-header-logo">
                    <!-- If you use a text logo, uncomment this if it is commented-->

                    <!-- h5#fbs__net-navbarsLabel.offcanvas-title Vertex-->

                    <!-- If you plan to use an image logo, uncomment this if it is commented-->
                    <a class="logo-link" id="fbs__net-navbarsLabel" href="{{ route('home') }}">

                        <!-- logo dark--><img class="logo dark img-fluid"
                            src="{{ asset('assets/images/logo-dark.svg') }}" alt="E-Ticketing">

                        <!-- logo light--><img class="logo light img-fluid"
                            src="{{ asset('assets/images/logo-light.svg') }}" alt="E-Ticketing"></a>

                </div>
                <button class="btn-close btn-close-black" type="button" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <div class="offcanvas-body align-items-lg-center">

                <ul class="navbar-nav nav me-auto ps-lg-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}"
                            href="{{ route('search') }}">
                            <i class="bi bi-search me-1"></i>Cari Tiket
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-ticket me-1"></i>Layanan <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('search') }}">Cari Jadwal</a></li>
                            <li><a class="dropdown-item" href="#">Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="#">Riwayat Perjalanan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Promo & Diskon</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-info-circle me-1"></i>Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-telephone me-1"></i>Kontak
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- End offcanvas-->

        <div class="ms-auto w-auto">

            <div class="header-social d-flex align-items-center gap-2">
                <!-- User Menu -->
                <div class="dropdown">
                    <a class="btn btn-outline-primary py-2 dropdown-toggle d-flex align-items-center" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i>
                        <span class="d-none d-md-inline">Akun Saya</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/admin"><i
                                    class="bi bi-box-arrow-in-right me-2"></i>Masuk</a></li>
                        <li><a class="dropdown-item" href="/admin"><i class="bi bi-person-plus me-2"></i>Daftar</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-clipboard-data me-2"></i>Pesanan
                                Saya</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a>
                        </li>
                    </ul>
                </div>

                <!-- Mobile Toggle -->
                <button class="fbs__net-navbar-toggler justify-content-center align-items-center ms-auto"
                    data-bs-toggle="offcanvas" data-bs-target="#fbs__net-navbars" aria-controls="fbs__net-navbars"
                    aria-label="Toggle navigation" aria-expanded="false">
                    <svg class="fbs__net-icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="21" x2="3" y1="6" y2="6"></line>
                        <line x1="15" x2="3" y1="12" y2="12"></line>
                        <line x1="17" x2="3" y1="18" y2="18"></line>
                    </svg>
                    <svg class="fbs__net-icon-close" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>

            </div>

        </div>
    </div>
</header>
<!-- End Header-->
