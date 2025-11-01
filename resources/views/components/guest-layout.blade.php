<!DOCTYPE html>
<!-- Template name: Nova Template author: FreeBootstrap.net Author website: https://freebootstrap.net/ License: https://freebootstrap.net/license -->
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Nova Free Bootstrap Template for Agency &mdash; by FreeBootstrap.net' }}</title>

        <!-- ======= Google Font =======-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <!-- End Google Font-->

        <!-- ======= Styles =======-->
        <link href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/glightbox/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/aos/aos.css') }}" rel="stylesheet">
        <!-- End Styles-->

        <!-- ======= Theme Style =======-->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <!-- End Theme Style-->

        <!-- ======= Apply theme =======-->
        <script>
            // Apply the theme as early as possible to avoid flicker
            (function() {
                const storedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-bs-theme', storedTheme);
            })();
        </script>

        @livewireStyles

        @stack('styles')
    </head>

    <body>

        <!-- ======= Site Wrap =======-->
        <div class="site-wrap">

            <!-- Include Navbar -->
            <x-navbar />

            <!-- ======= Main =======-->
            <main>
                {{ $slot }}
            </main>

            <!-- Include Footer -->
            <x-footer />

        </div>

        <!-- ======= Back to Top =======-->
        <button id="back-to-top"><i class="bi bi-arrow-up-short"></i></button>
        <!-- End Back to top-->

        <!-- ======= Javascripts =======-->
        <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/gsap/gsap.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/isotope/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/glightbox/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendors/purecounter/purecounter.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/send_email.js') }}"></script>
        <!-- End JavaScripts-->

        @stack('scripts')
        @livewireScripts
    </body>

</html>
