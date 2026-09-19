@extends('layouts.user')
@section('title', 'Kontak')

@section('content')
<div class="page-hero">
  <div class="container">
    <h1><i class="bi bi-envelope me-2"></i>Kontak</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Kontak</li>
      </ol>
    </nav>
  </div>
</div>

<section>
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-5">
        <h3 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Hubungi Kami</h3>
        <p style="color:#777;font-size:15px;line-height:1.8">
          Jika Anda memiliki pertanyaan, masukan, atau membutuhkan bantuan terkait sistem ini,
          jangan ragu untuk menghubungi kami.
        </p>
        <div class="d-flex flex-column gap-4 mt-4">
          <div class="d-flex gap-3 align-items-start">
            <div style="width:48px;height:48px;background:#e8f1fd;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);flex-shrink:0">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div>
              <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:4px">Alamat</h6>
              <p style="color:#777;font-size:14px;margin:0">
                STMIK Triguna Dharma<br>Jl. AH. Nasution No.73, Medan<br>Sumatera Utara 20143
              </p>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div style="width:48px;height:48px;background:#e8f1fd;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);flex-shrink:0">
              <i class="bi bi-telephone"></i>
            </div>
            <div>
              <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:4px">Telepon</h6>
              <p style="color:#777;font-size:14px;margin:0">+62 812-3456-7890</p>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div style="width:48px;height:48px;background:#e8f1fd;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);flex-shrink:0">
              <i class="bi bi-envelope"></i>
            </div>
            <div>
              <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:4px">Email</h6>
              <p style="color:#777;font-size:14px;margin:0">info@febrileseizure.id</p>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div style="width:48px;height:48px;background:#e8f1fd;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);flex-shrink:0">
              <i class="bi bi-clock"></i>
            </div>
            <div>
              <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:4px">Jam Operasional</h6>
              <p style="color:#777;font-size:14px;margin:0">Sistem tersedia 24 jam / 7 hari<br>Konsultasi langsung: Senin – Jumat, 08.00–17.00</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card border-0 shadow" style="border-radius:16px">
          <div class="card-body p-4 p-lg-5">
            <h4 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:24px">
              Kirim Pesan
            </h4>

            @if(session('contact_success'))
            <div class="alert alert-success">
              <i class="bi bi-check-circle me-2"></i>Pesan Anda berhasil dikirim. Terima kasih!
            </div>
            @endif

            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Nama Anda">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Email</label>
                  <input type="email" class="form-control" placeholder="email@example.com">
                </div>
                <div class="col-12">
                  <label class="form-label fw-semibold">Subjek</label>
                  <input type="text" class="form-control" placeholder="Perihal pesan Anda">
                </div>
                <div class="col-12">
                  <label class="form-label fw-semibold">Pesan</label>
                  <textarea class="form-control" rows="5" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary rounded-pill px-5">
                    <i class="bi bi-send me-2"></i>Kirim Pesan
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
