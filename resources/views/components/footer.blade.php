<!-- ======= Footer =======-->
<footer class="footer pt-5 pb-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h3 class="mb-3">{{ $setting->name ?? 'PT. Four Best Synergy' }}</h3>
        <p class="mb-4">Sistem pemesanan tiket bus online yang mudah dan cepat.</p>
      </div>
    </div>
    <div class="row justify-content-center mb-5">
      <div class="col-md-6 text-center quick-contact">
        <h4 class="mb-3">Kontak Kami</h4>
        <p class="d-flex justify-content-center mb-3">
          <i class="bi bi-geo-alt-fill me-3"></i>
          <span>{{ $setting->address ?? 'Alamat belum diatur' }}</span>
        </p>
        <p class="d-flex justify-content-center mb-3">
          <i class="bi bi-telephone-fill me-3"></i>
          <span>{{ $setting->phone ?? 'Telepon belum diatur' }}</span>
        </p>
      </div>
    </div>
    <div class="row credits pt-3">
      <div class="col-12 text-center">
        &copy; <script>document.write(new Date().getFullYear());</script> {{ $setting->name ?? 'PT. Four Best Synergy' }}.
        All rights reserved.
      </div>
    </div>
  </div>
</footer>
<!-- End Footer-->