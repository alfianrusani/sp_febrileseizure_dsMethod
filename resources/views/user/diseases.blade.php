@extends('layouts.user')
@section('title', 'Informasi Penyakit')

@section('content')
<div class="page-hero">
  <div class="container">
    <h1><i class="bi bi-hospital me-2"></i>Informasi Penyakit</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Penyakit</li>
      </ol>
    </nav>
  </div>
</div>

{{-- Overview --}}
<section style="background:#fff">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Febrile Seizure (Kejang Demam)</h2>
      <p>Kelainan neuropatik paling sering terjadi pada anak usia 6 bulan sampai 5 tahun</p>
    </div>
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <div class="p-4 rounded-3" style="background:#e8f1fd">
          <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">
            <i class="bi bi-info-circle text-primary me-2"></i>Apa itu Kejang Demam?
          </h5>
          <p style="color:#555;font-size:14px;line-height:1.9;margin:0">
            Febrile Seizure (kejang demam) merupakan kondisi kejang yang terjadi akibat kenaikan
            suhu tubuh secara drastis, umumnya pada anak usia <strong>6 bulan hingga 5 tahun</strong>.
            Insiden puncak berada pada usia <strong>18 bulan</strong> dan dapat hilang saat anak
            berusia 8 tahun. Suhu rektal yang memicu kejang umumnya melebihi <strong>38°C</strong>.
          </p>
        </div>
        <div class="row g-3 mt-1">
          <div class="col-6">
            <div class="p-3 rounded-3 text-center" style="background:#fff3f3">
              <i class="bi bi-thermometer-high text-danger fs-2 mb-2 d-block"></i>
              <div style="font-weight:700;font-size:13px;color:#1a1a2e">Suhu Pemicu</div>
              <div style="color:#e84545;font-weight:800;font-size:20px">&gt; 38°C</div>
              <small class="text-muted">Suhu rektal</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 rounded-3 text-center" style="background:#e8f4fd">
              <i class="bi bi-calendar-heart text-primary fs-2 mb-2 d-block"></i>
              <div style="font-weight:700;font-size:13px;color:#1a1a2e">Usia Rentan</div>
              <div style="color:#106eea;font-weight:800;font-size:20px">6–60 bln</div>
              <small class="text-muted">6 bln – 5 tahun</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
          Faktor Penyebab
        </h5>
        @php
        $causes = [
          ['icon'=>'thermometer-high','color'=>'#e84545','title'=>'Demam Tinggi','desc'=>'Kenaikan suhu tubuh secara drastis melebihi 38°C.'],
          ['icon'=>'shield-exclamation','color'=>'#f39c12','title'=>'Pasca Imunisasi','desc'=>'Demam setelah imunisasi DPT (Difteri, Pertusis, Tetanus) dan campak.'],
          ['icon'=>'bug','color'=>'#e74c3c','title'=>'Toksin Mikroorganisme','desc'=>'Efek toksin dari mikroorganisme yang menginfeksi tubuh.'],
          ['icon'=>'heart-pulse','color'=>'#9b59b6','title'=>'Respons Alergi / Imunitas','desc'=>'Gangguan imunitas akibat infeksi tertentu.'],
          ['icon'=>'droplet','color'=>'#3498db','title'=>'Gangguan Elektrolit','desc'=>'Perubahan keseimbangan cairan dan elektrolit dalam tubuh.'],
        ];
        @endphp
        <div class="d-flex flex-column gap-3">
          @foreach($causes as $c)
          <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background:var(--light-bg)">
            <div style="width:42px;height:42px;border-radius:50%;background:{{ $c['color'] }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;flex-shrink:0">
              <i class="bi bi-{{ $c['icon'] }}"></i>
            </div>
            <div>
              <div style="font-weight:700;font-size:14px;color:#1a1a2e">{{ $c['title'] }}</div>
              <small style="color:#777">{{ $c['desc'] }}</small>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Two Types --}}
<section style="background:var(--light-bg)">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Dua Jenis Kejang Demam</h2>
      <p>Perbedaan antara Kejang Demam Sederhana dan Kompleks</p>
    </div>
    <div class="row g-4">
      {{-- P1 --}}
      <div class="col-lg-6">
        <div class="card border-0 shadow" style="border-radius:16px;overflow:hidden;height:100%">
          <div style="background:linear-gradient(135deg,#106eea,#0d58c0);padding:28px;color:#fff">
            <div class="d-flex align-items-center gap-3">
              <span class="badge" style="background:rgba(255,255,255,.25);font-size:14px;padding:8px 16px">P1</span>
              <h4 style="font-family:'Raleway',sans-serif;font-weight:700;margin:0">Kejang Demam Sederhana</h4>
            </div>
            <p class="mt-2 mb-0" style="opacity:.85;font-size:14px">~80% dari seluruh kasus kejang demam</p>
          </div>
          <div class="card-body p-4">
            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">Karakteristik:</h6>
            <ul class="check-list ps-0 mb-4" style="font-size:14px;color:#555">
              <li>Berlangsung kurang dari 15 menit</li>
              <li>Bersifat menyeluruh (generalized / tonik-klonik)</li>
              <li>Tidak berulang dalam periode 24 jam</li>
              <li>Tidak meninggalkan gejala sisa</li>
              <li>Pasien langsung sadar setelah kejang</li>
              <li>Melibatkan otot wajah dan pernapasan</li>
            </ul>
            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">Gejala Utama:</h6>
            <div class="d-flex flex-wrap gap-2">
              @foreach(['Demam ringan berulang','Kejang <15 menit','Flu','Batuk berat','Mual saat demam','Ruam di kulit','Mimisan','Gusi berdarah'] as $g)
              <span class="badge" style="background:#e8f1fd;color:#106eea;font-size:12px;padding:6px 10px">{{ $g }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      {{-- P2 --}}
      <div class="col-lg-6">
        <div class="card border-0 shadow" style="border-radius:16px;overflow:hidden;height:100%">
          <div style="background:linear-gradient(135deg,#e84545,#c0392b);padding:28px;color:#fff">
            <div class="d-flex align-items-center gap-3">
              <span class="badge" style="background:rgba(255,255,255,.25);font-size:14px;padding:8px 16px">P2</span>
              <h4 style="font-family:'Raleway',sans-serif;font-weight:700;margin:0">Kejang Demam Kompleks</h4>
            </div>
            <p class="mt-2 mb-0" style="opacity:.85;font-size:14px">Memerlukan pemeriksaan dan penanganan lanjutan</p>
          </div>
          <div class="card-body p-4">
            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">Karakteristik:</h6>
            <ul class="check-list ps-0 mb-4" style="font-size:14px;color:#555">
              <li>Berlangsung lebih dari 15 menit</li>
              <li>Dapat terjadi lebih dari sekali dalam 24 jam</li>
              <li>Bersifat fokal (hanya satu sisi tubuh)</li>
              <li>Disertai abnormalitas status neurologis</li>
              <li>Kehilangan kesadaran lebih lama</li>
              <li>Risiko kematian 2× lipat bila &lt; 1 tahun</li>
            </ul>
            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">Gejala Utama:</h6>
            <div class="d-flex flex-wrap gap-2">
              @foreach(['Kejang >15 menit','Demam tinggi seharian','Demam naik-turun','Perut kembung','Sesak nafas','Kehilangan kesadaran','Kehijauan feses','Nafsu makan menurun'] as $g)
              <span class="badge" style="background:#fff3f3;color:#e84545;font-size:12px;padding:6px 10px">{{ $g }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section id="cta">
  <div class="container text-center">
    <i class="bi bi-clipboard-pulse fs-1 mb-3 d-block"></i>
    <h3 class="mb-3">Cek Kondisi Anak Anda Sekarang</h3>
    <p style="opacity:.9;margin-bottom:30px">Gunakan sistem pakar kami untuk mendapatkan gambaran awal diagnosa kejang demam.</p>
    <a href="{{ route('diagnosis.create') }}" class="btn btn-cta btn-lg rounded-pill px-5">
      <i class="bi bi-clipboard-pulse me-2"></i>Mulai Konsultasi
    </a>
  </div>
</section>
@endsection
