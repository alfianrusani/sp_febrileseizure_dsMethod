@extends('layouts.user')
@section('title', 'Tentang Sistem')

@section('content')
<div class="page-hero">
  <div class="container">
    <h1><i class="bi bi-info-circle me-2"></i>Tentang Sistem</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Tentang</li>
      </ol>
    </nav>
  </div>
</div>

<section style="background:#fff">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2 style="font-family:'Raleway',sans-serif;font-weight:800;color:#1a1a2e">Sistem Pakar Kejang Demam</h2>
        <p style="color:#777;line-height:1.9;font-size:15px">
          Sistem pakar ini dikembangkan oleh mahasiswa STMIK Triguna Dharma untuk mendiagnosis
          penyakit <strong>Febrile Seizure (Kejang Demam)</strong> pada anak menggunakan metode
          <strong>Dempster-Shafer</strong>. Sistem ini dirancang membantu orang tua dan tenaga medis
          mendapatkan gambaran awal kondisi anak secara cepat dan akurat.
        </p>
        <p style="color:#777;line-height:1.9;font-size:15px">
          Data gejala dan penyakit telah divalidasi oleh <strong>dr. Mansur Sinuhaji, Sp.A</strong>
          dari Rumah Sakit Advent Medan. Sistem ini dibangun menggunakan PHP, Laravel, dan MySQL.
        </p>
        <div class="row g-3 mt-2">
          <div class="col-6">
            <div class="p-3 rounded-3 text-center" style="background:#e8f1fd">
              <i class="bi bi-people-fill text-primary fs-2 mb-2 d-block"></i>
              <div style="font-weight:700;color:#1a1a2e">Validasi Pakar</div>
              <small class="text-muted">dr. Mansur Sinuhaji, Sp.A</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 rounded-3 text-center" style="background:#fff3f3">
              <i class="bi bi-mortarboard-fill text-danger fs-2 mb-2 d-block"></i>
              <div style="font-weight:700;color:#1a1a2e">Institusi</div>
              <small class="text-muted">STMIK Triguna Dharma</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card border-0 shadow" style="border-radius:16px">
          <div class="card-body p-4">
            <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
              <i class="bi bi-cpu text-primary me-2"></i>Metode Dempster-Shafer
            </h5>
            <p style="font-size:14px;color:#777;line-height:1.8">
              Metode Dempster-Shafer adalah teori matematika untuk pembuktian berdasarkan
              <strong>belief</strong> (fungsi keyakinan) dan <strong>plausibility</strong>
              (fungsi pemikiran yang masuk akal), yang bertujuan menggabungkan informasi terpisah
              untuk menentukan kemungkinan suatu peristiwa.
            </p>
            <div class="mt-3 p-3 rounded" style="background:#f8f9fa;font-family:monospace;font-size:13px">
              <div class="text-primary mb-2">// Rumus Kombinasi Dempster-Shafer</div>
              <div style="color:#555">
                m3(Z) = Σ<sub>X∩Y=Z</sub> m1(X)·m2(Y)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;──────────────────<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 − Σ<sub>X∩Y=∅</sub> m1(X)·m2(Y)
              </div>
            </div>
            <div class="row g-2 mt-3">
              <div class="col-6">
                <div class="p-2 rounded" style="background:#e8f1fd;font-size:13px">
                  <strong class="text-primary">Bel(X)</strong> = Σm(Y)<br>
                  <small class="text-muted">Belief — Tingkat Keyakinan</small>
                </div>
              </div>
              <div class="col-6">
                <div class="p-2 rounded" style="background:#fff3f3;font-size:13px">
                  <strong class="text-danger">Pls(X)</strong> = 1 − Bel(X)<br>
                  <small class="text-muted">Plausibility — Ketidakpastian</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Team --}}
<section style="background:var(--light-bg)">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Tim Pengembang</h2>
      <p>Penelitian dan pengembangan sistem pakar ini</p>
    </div>
    <div class="row g-4 justify-content-center">
      @php
      $team = [
        ['name'=>'Geby Sabella Mariana Hutagalung','role'=>'Peneliti Utama','icon'=>'person-circle','color'=>'#106eea'],
        ['name'=>'Hendryan Winata, S.Kom., M.Kom','role'=>'Pembimbing I','icon'=>'person-badge','color'=>'#2ecc71'],
        ['name'=>'Dr. Rudi Gunawan, SE., M.Si','role'=>'Pembimbing II','icon'=>'person-badge','color'=>'#e84545'],
      ];
      @endphp
      @foreach($team as $member)
      <div class="col-lg-4 col-md-6">
        <div class="feature-card text-center">
          <div style="width:70px;height:70px;border-radius:50%;background:{{ $member['color'] }};display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:32px;color:#fff">
            <i class="bi bi-{{ $member['icon'] }}"></i>
          </div>
          <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">{{ $member['name'] }}</h6>
          <p style="color:{{ $member['color'] }};font-size:14px;font-weight:600;margin:0">{{ $member['role'] }}</p>
          <small class="text-muted">STMIK Triguna Dharma</small>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Research Methodology --}}
<section style="background:#fff">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Metodologi Penelitian</h2>
      <p>Tahapan yang dilalui dalam pengembangan sistem ini</p>
    </div>
    <div class="row g-3 justify-content-center">
      @php
      $steps = [
        ['num'=>'1','title'=>'Identifikasi Masalah','desc'=>'Pencarian informasi dan perumusan solusi untuk mengatasi permasalahan diagnosis kejang demam pada anak.','icon'=>'search'],
        ['num'=>'2','title'=>'Pengumpulan Data','desc'=>'Observasi di RS Advent Medan dan wawancara langsung dengan dr. Mansur Sinuhaji, Sp.A.','icon'=>'clipboard-data'],
        ['num'=>'3','title'=>'Studi Pustaka','desc'=>'Memanfaatkan buku, jurnal, dan sumber relevan tentang sistem pakar dan metode Dempster-Shafer.','icon'=>'book'],
        ['num'=>'4','title'=>'Analisis Sistem','desc'=>'Penyesuaian fitur-fitur yang akan diterapkan dalam sistem berdasarkan kebutuhan pengguna.','icon'=>'diagram-3'],
        ['num'=>'5','title'=>'Rancangan Sistem','desc'=>'Pemodelan sistem menggunakan UML: use case diagram, activity diagram, dan class diagram.','icon'=>'pencil-square'],
        ['num'=>'6','title'=>'Pembangunan & Pengujian','desc'=>'Membangun aplikasi web PHP + MySQL dan menguji akurasi dengan data gejala tervalidasi.','icon'=>'code-slash'],
      ];
      @endphp
      @foreach($steps as $step)
      <div class="col-lg-4 col-md-6">
        <div class="d-flex gap-3 align-items-start p-3 rounded-3 h-100" style="background:var(--light-bg)">
          <div class="step-badge flex-shrink-0">{{ $step['num'] }}</div>
          <div>
            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">{{ $step['title'] }}</h6>
            <p style="color:#777;font-size:13px;margin:0;line-height:1.7">{{ $step['desc'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
