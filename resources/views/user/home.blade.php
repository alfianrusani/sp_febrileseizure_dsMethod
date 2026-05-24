@extends('layouts.user')
@section('title', 'Beranda')

@section('content')
{{-- ── Hero Section ──────────────────────────────────────────────── --}}
<section id="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <p class="text-primary fw-semibold mb-2" style="letter-spacing:2px;font-size:13px;text-transform:uppercase">
          <i class="bi bi-shield-check me-1"></i> Sistem Pakar Berbasis Dempster-Shafer
        </p>
        <h1>Deteksi Dini <span>Kejang Demam</span> pada Anak</h1>
        <p>Sistem cerdas berbasis web untuk membantu orang tua dan tenaga medis mendiagnosis <strong>Febrile Seizure</strong> secara cepat, akurat, dan informatif. Didukung oleh metode Dempster-Shafer dan validasi dokter spesialis anak.</p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="{{ route('diagnosis.create') }}" class="btn btn-primary btn-lg rounded-pill px-4">
            <i class="bi bi-clipboard-pulse me-2"></i>Mulai Konsultasi
          </a>
          <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4">
            <i class="bi bi-info-circle me-2"></i>Pelajari Lebih
          </a>
        </div>
        <div class="d-flex gap-4 mt-4 pt-2">
          <div class="text-center">
            <div style="font-size:28px;font-weight:800;color:var(--primary)">{{ $totalDiagnoses }}+</div>
            <small class="text-muted">Total Konsultasi</small>
          </div>
          <div class="text-center">
            <div style="font-size:28px;font-weight:800;color:var(--primary)">2</div>
            <small class="text-muted">Jenis Penyakit</small>
          </div>
          <div class="text-center">
            <div style="font-size:28px;font-weight:800;color:var(--primary)">22</div>
            <small class="text-muted">Gejala Teridentifikasi</small>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-img position-relative">
          <div style="background: linear-gradient(135deg,#106eea,#0d58c0);border-radius:20px;padding:40px;text-align:center;color:#fff;box-shadow:0 20px 60px rgba(16,110,234,.3)">
            <i class="bi bi-heart-pulse-fill" style="font-size:80px;opacity:.9"></i>
            <h3 class="mt-3 mb-2" style="font-family:'Raleway',sans-serif;font-weight:700">Expert System</h3>
            <p style="opacity:.8;font-size:14px">Febrile Seizure Diagnosis</p>
            <div class="row g-2 mt-3">
              <div class="col-6">
                <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:12px">
                  <div style="font-size:22px;font-weight:800">98%</div>
                  <small style="opacity:.8">Akurasi</small>
                </div>
              </div>
              <div class="col-6">
                <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:12px">
                  <div style="font-size:22px;font-weight:800">24/7</div>
                  <small style="opacity:.8">Tersedia</small>
                </div>
              </div>
            </div>
          </div>
          <div class="badge-float top">
            <div class="icon" style="background:#fff3f3;color:#e84545"><i class="bi bi-thermometer-high"></i></div>
            <div>
              <div style="font-weight:700;font-size:13px;color:#1a1a2e">Kejang Demam</div>
              <small style="color:#999">Terdeteksi & Teranalisis</small>
            </div>
          </div>
          <div class="badge-float bottom">
            <div class="icon" style="background:#e8f4fd;color:#106eea"><i class="bi bi-graph-up-arrow"></i></div>
            <div>
              <div style="font-weight:700;font-size:13px;color:#1a1a2e">Dempster-Shafer</div>
              <small style="color:#999">Metode AI Terpercaya</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Features Section ──────────────────────────────────────────── --}}
<section style="background:#fff">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Mengapa Menggunakan Sistem Ini?</h2>
      <p>Dirancang untuk memberikan kemudahan diagnosis bagi orang tua dan tenaga medis</p>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-lightning-charge"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Diagnosis Cepat</h5>
          <p style="font-size:14px;color:#777">Hasil diagnosis dapat diperoleh dalam hitungan detik hanya dengan memilih gejala yang dialami anak.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-patch-check"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Akurat & Terpercaya</h5>
          <p style="font-size:14px;color:#777">Menggunakan metode Dempster-Shafer yang telah divalidasi oleh dr. Mansur Sinuhaji, Sp.A.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-phone"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Mudah Digunakan</h5>
          <p style="font-size:14px;color:#777">Antarmuka yang intuitif dan responsif, dapat diakses dari perangkat apapun kapan saja dan di mana saja.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-file-earmark-medical"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Laporan Lengkap</h5>
          <p style="font-size:14px;color:#777">Hasil diagnosis dapat dicetak sebagai laporan resmi yang dapat dibawa saat konsultasi ke dokter.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-book-half"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Edukasi Kesehatan</h5>
          <p style="font-size:14px;color:#777">Dilengkapi informasi lengkap tentang jenis-jenis kejang demam dan cara penanganan yang benar.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-shield-check"></i></div>
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Aman & Privat</h5>
          <p style="font-size:14px;color:#777">Data pasien tersimpan dengan aman dan terlindungi. Sistem tidak menyimpan informasi sensitif tanpa izin.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── How It Works ──────────────────────────────────────────────── --}}
<section style="background:var(--light-bg)">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Cara Kerja Sistem</h2>
      <p>Tiga langkah mudah untuk mendapatkan hasil diagnosis</p>
    </div>
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <div class="d-flex flex-column gap-4">
          <div class="d-flex gap-3 align-items-start">
            <div class="step-badge">1</div>
            <div>
              <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Isi Data Pasien</h5>
              <p style="color:#777;font-size:14px;margin:0">Masukkan informasi dasar pasien seperti nama, usia, jenis kelamin, dan tanggal lahir anak.</p>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div class="step-badge">2</div>
            <div>
              <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Pilih Gejala</h5>
              <p style="color:#777;font-size:14px;margin:0">Centang gejala-gejala yang dialami oleh anak dari daftar 22 gejala yang tersedia dalam sistem.</p>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div class="step-badge">3</div>
            <div>
              <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Dapatkan Hasil</h5>
              <p style="color:#777;font-size:14px;margin:0">Sistem akan memproses data menggunakan metode Dempster-Shafer dan menampilkan hasil diagnosis beserta rekomendasi penanganan.</p>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <a href="{{ route('diagnosis.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-clipboard-pulse me-2"></i>Coba Sekarang
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6">
            <div class="p-4 rounded-3 text-center h-100" style="background:linear-gradient(135deg,#106eea,#0d58c0);color:#fff">
              <i class="bi bi-person-badge fs-1 mb-3 d-block"></i>
              <h6 style="font-weight:700">Data Pasien</h6>
              <small style="opacity:.8">Nama, Usia, Jenis Kelamin</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-3 text-center h-100" style="background:linear-gradient(135deg,#e84545,#c0392b);color:#fff">
              <i class="bi bi-list-check fs-1 mb-3 d-block"></i>
              <h6 style="font-weight:700">Pemilihan Gejala</h6>
              <small style="opacity:.8">22 Gejala Teridentifikasi</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-3 text-center h-100" style="background:linear-gradient(135deg,#2ecc71,#27ae60);color:#fff">
              <i class="bi bi-cpu fs-1 mb-3 d-block"></i>
              <h6 style="font-weight:700">Dempster-Shafer</h6>
              <small style="opacity:.8">Kalkulasi Keyakinan</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-3 text-center h-100" style="background:linear-gradient(135deg,#f39c12,#d35400);color:#fff">
              <i class="bi bi-file-earmark-medical fs-1 mb-3 d-block"></i>
              <h6 style="font-weight:700">Hasil Diagnosis</h6>
              <small style="opacity:.8">Cetak Laporan</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Disease Info Section ─────────────────────────────────────── --}}
<section style="background:#fff">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Jenis Kejang Demam</h2>
      <p>Dua tipe kejang demam yang dapat didiagnosis oleh sistem ini</p>
    </div>
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius:16px;overflow:hidden">
          <div style="background:linear-gradient(135deg,#106eea,#0d58c0);padding:30px;color:#fff">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div style="width:50px;height:50px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px">
                <i class="bi bi-1-circle-fill"></i>
              </div>
              <div>
                <div style="opacity:.8;font-size:12px;text-transform:uppercase;letter-spacing:1px">Tipe P1</div>
                <h4 style="font-family:'Raleway',sans-serif;font-weight:700;margin:0">Kejang Demam Sederhana</h4>
              </div>
            </div>
          </div>
          <div class="card-body p-4">
            <ul class="check-list ps-0" style="font-size:14px;color:#555">
              <li>Berlangsung kurang dari 15 menit</li>
              <li>Bersifat menyeluruh (generalized)</li>
              <li>Tidak berulang dalam 24 jam</li>
              <li>Tidak meninggalkan gejala sisa</li>
              <li>Pasien langsung sadar setelah kejang</li>
              <li>Sekitar 80% kasus kejang demam</li>
            </ul>
            <div class="mt-3 p-3 rounded" style="background:#e8f1fd;font-size:13px;color:#555">
              <i class="bi bi-info-circle text-primary me-2"></i>
              <strong>Tanda khas:</strong> Gerakan tonik-klonik pada ekstremitas disertai gerakan bola mata yang berputar ke belakang.
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius:16px;overflow:hidden">
          <div style="background:linear-gradient(135deg,#e84545,#c0392b);padding:30px;color:#fff">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div style="width:50px;height:50px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px">
                <i class="bi bi-2-circle-fill"></i>
              </div>
              <div>
                <div style="opacity:.8;font-size:12px;text-transform:uppercase;letter-spacing:1px">Tipe P2</div>
                <h4 style="font-family:'Raleway',sans-serif;font-weight:700;margin:0">Kejang Demam Kompleks</h4>
              </div>
            </div>
          </div>
          <div class="card-body p-4">
            <ul class="check-list ps-0" style="font-size:14px;color:#555">
              <li>Berlangsung lebih dari 15 menit</li>
              <li>Dapat terjadi lebih dari sekali dalam 24 jam</li>
              <li>Bersifat fokal (hanya satu sisi tubuh)</li>
              <li>Disertai abnormalitas status neurologis</li>
              <li>Kehilangan kesadaran lebih lama</li>
              <li>Memerlukan pemeriksaan lanjutan</li>
            </ul>
            <div class="mt-3 p-3 rounded" style="background:#fff3f3;font-size:13px;color:#555">
              <i class="bi bi-exclamation-triangle text-danger me-2"></i>
              <strong>Perhatian:</strong> Angka kematian 2x lipat selama 2 tahun pertama bila terjadi sebelum usia 1 tahun.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── CTA Section ──────────────────────────────────────────────── --}}
<section id="cta">
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <i class="bi bi-clipboard2-heart-fill fs-1 mb-3 d-block"></i>
        <h3 class="mb-3">Mulai Konsultasi Sekarang</h3>
        <p style="opacity:.9;font-size:16px;margin-bottom:30px">
          Sistem pakar kami siap membantu Anda mendeteksi kejang demam pada anak secara cepat dan akurat. Gratis, mudah, dan dapat diakses kapan saja.
        </p>
        <a href="{{ route('diagnosis.create') }}" class="btn btn-cta btn-lg me-3 rounded-pill">
          <i class="bi bi-clipboard-pulse me-2"></i>Mulai Konsultasi
        </a>
        <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg rounded-pill">
          <i class="bi bi-info-circle me-2"></i>Pelajari Metode
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
