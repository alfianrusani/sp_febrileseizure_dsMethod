@extends('layouts.user')
@section('title', 'Hasil Diagnosa')

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-file-earmark-medical me-2"></i>Hasil Diagnosa</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('diagnosis.create') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active">Hasil</li>
                </ol>
            </nav>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row g-4">

                {{-- Result Card --}}
                <div class="col-lg-8">

                    {{-- Diagnosis Verdict --}}
                    @if ($diagnosis->disease)
                        <div class="card border-0 shadow mb-4" style="border-radius:16px;overflow:hidden">
                            <div
                                style="background:linear-gradient(135deg,{{ $diagnosis->disease->code === 'P1' ? '#106eea,#0d58c0' : '#e84545,#c0392b' }});padding:30px;color:#fff">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div
                                        style="width:60px;height:60px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px">
                                        <i
                                            class="bi bi-{{ $diagnosis->disease->code === 'P1' ? 'check-circle' : 'exclamation-triangle' }}-fill"></i>
                                    </div>
                                    <div>
                                        <div style="opacity:.8;font-size:13px;text-transform:uppercase;letter-spacing:1px">
                                            Hasil Diagnosa</div>
                                        <h3 style="font-family:'Raleway',sans-serif;font-weight:800;margin:0">
                                            {{ $diagnosis->disease->name }}</h3>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-4 mt-2">
                                    <div>
                                        <div style="opacity:.7;font-size:12px">Tingkat Keyakinan (Belief)</div>
                                        <div style="font-size:36px;font-weight:800">
                                            {{ round($diagnosis->belief_value * 100, 2) }}%</div>
                                    </div>
                                    <div style="flex:1">
                                        <div class="progress"
                                            style="height:10px;background:rgba(255,255,255,.3);border-radius:50px">
                                            <div class="progress-bar bg-white"
                                                style="width:{{ round($diagnosis->belief_value * 100, 2) }}%;border-radius:50px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h6
                                    style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">
                                    <i class="bi bi-info-circle text-primary me-2"></i>Deskripsi Penyakit
                                </h6>
                                <p style="color:#555;font-size:14px;line-height:1.8">{{ $diagnosis->disease->description }}
                                </p>

                                @php
                                    $treatment = $diagnosis->disease
                                        ?->treatments()
                                        ->where('disease_id', $diagnosis->disease_id)
                                        ->latest()
                                        ->first();
                                @endphp
                                @if ($treatment)
                                    <hr>
                                    <h6
                                        style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:12px">
                                        <i class="bi bi-heart-pulse text-danger me-2"></i>Rekomendasi Penanganan
                                    </h6>

                                    <div class="mb-3">
                                        <div class="fw-semibold text-dark">Penanganan Pertama</div>
                                        <div style="font-size:14px; color:#555; line-height:1.8; white-space:pre-line margin-top:-10px;">
                                            {{ $treatment->first_step_handling }}</div>
                                    </div>

                                    <div>
                                        <div class="fw-semibold text-dark">Obat Penanganan</div>
                                        <div style="font-size:14px; color:#555; line-height:1.8; white-space:pre-line margin-top:-10px;">
                                            {{ $treatment->medicine }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="card border-0 shadow mb-4" style="border-radius:16px">
                            <div class="card-body p-4 text-center">
                                <i class="bi bi-question-circle-fill text-warning" style="font-size:60px"></i>
                                <h4 class="mt-3" style="font-family:'Raleway',sans-serif">Tidak Ada Diagnosis Pasti</h4>
                                <p class="text-muted">Gejala yang dipilih tidak cukup untuk menentukan diagnosis. Silakan
                                    konsultasikan langsung dengan dokter.</p>
                            </div>
                        </div>
                    @endif

                    {{-- Selected Symptoms --}}
                    <div class="card border-0 shadow-sm" style="border-radius:16px">
                        <div class="card-header border-0 pt-4 px-4 pb-3" style="background:transparent">
                            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                                <i class="bi bi-list-check text-primary me-2"></i>Gejala yang Dipilih
                                <span class="badge bg-primary ms-2">{{ $selectedSymptoms->count() }}</span>
                            </h6>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="row g-2">
                                @foreach ($selectedSymptoms as $symptom)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 rounded" style="background:#e8f1fd">
                                            <i class="bi bi-check-circle-fill text-primary"></i>
                                            <div>
                                                <div style="font-size:13px;font-weight:600;color:#1a1a2e">
                                                    {{ $symptom->name }}</div>
                                                <div class="d-flex gap-2">
                                                    <small class="text-muted">{{ $symptom->code }}</small>
                                                    <small class="text-muted">• Densitas: {{ $symptom->density }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">

                    {{-- Patient Info --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius:16px">
                        <div class="card-header border-0 pt-4 px-4 pb-3" style="background:transparent">
                            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                                <i class="bi bi-person-badge text-primary me-2"></i>Data Pasien
                            </h6>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <table class="table table-borderless mb-0" style="font-size:14px">
                                <tr>
                                    <td class="text-muted ps-0" width="45%">Nama</td>
                                    <td class="fw-semibold">{{ $diagnosis->patient_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jenis Kelamin</td>
                                    <td>{{ $diagnosis->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tanggal Lahir</td>
                                    <td>{{ $diagnosis->birth_date->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Usia</td>
                                    <td>{{ $diagnosis->age_months }} bulan</td>
                                </tr>
                                @if ($diagnosis->phone)
                                    <tr>
                                        <td class="text-muted ps-0">Telepon</td>
                                        <td>{{ $diagnosis->phone }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-muted ps-0">Tgl Diagnosa</td>
                                    <td>{{ $diagnosis->diagnosis_date->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- DS Info --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius:16px">
                        <div class="card-body p-4">
                            <h6 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                                <i class="bi bi-cpu text-primary me-2"></i>Info Metode Dempster-Shafer
                            </h6>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Nilai Belief (Bel)</small>
                                    <small class="fw-semibold">{{ round($diagnosis->belief_value * 100, 2) }}%</small>
                                </div>
                                <div class="progress" style="height:6px">
                                    <div class="progress-bar bg-primary"
                                        style="width:{{ round($diagnosis->belief_value * 100, 2) }}%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Nilai Plausibility (Pls)</small>
                                    <small
                                        class="fw-semibold">{{ round((1 - $diagnosis->belief_value) * 100, 2) }}%</small>
                                </div>
                                <div class="progress" style="height:6px">
                                    <div class="progress-bar bg-warning"
                                        style="width:{{ round((1 - $diagnosis->belief_value) * 100, 2) }}%"></div>
                                </div>
                            </div>
                            <div class="p-3 rounded" style="background:#f8f9fa;font-size:12px;color:#777;line-height:1.7">
                                <strong>Bel(X)</strong> = Σm(Y): Tingkat kepercayaan terhadap hipotesis.<br>
                                <strong>Pls(X)</strong> = 1 − Bel(X): Tingkat ketidakpastian.
                            </div>
                        </div>
                    </div>

                    {{-- Warning --}}
                    <div class="alert border-0" style="background:#fff3cd;border-radius:12px">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                        <strong style="font-size:13px">Perhatian</strong>
                        <p class="mb-0 mt-1" style="font-size:12px;color:#555">
                            Hasil ini merupakan perkiraan awal. Selalu konsultasikan kondisi anak kepada dokter spesialis
                            anak untuk penanganan lebih lanjut.
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('diagnosis.print', $diagnosis->id) }}" target="_blank"
                            class="btn btn-primary rounded-pill">
                            <i class="bi bi-printer me-2"></i>Cetak Laporan
                        </a>
                        <a href="{{ route('diagnosis.create') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-arrow-repeat me-2"></i>Konsultasi Ulang
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-chat-dots-fill text-primary"></i>
                            <h4 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e;margin:0">Berikan
                                Umpan Balik</h4>
                        </div>
                        <p class="text-muted mb-4" style="margin:0">Masukkan pesan Anda terkait hasil diagnosa ini.</p>

                        @if (session('feedback_success'))
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>Terima kasih, pesan Anda berhasil dikirim.
                            </div>
                        @endif

                        <form action="{{ route('diagnosis.feedback.store', $diagnosis) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pesan</label>
                                <textarea name="comments" class="form-control @error('comments') is-invalid @enderror" rows="4"
                                    placeholder="Tuliskan pengalaman, pertanyaan, atau masukan Anda di sini..." required>{{ old('comments') }}</textarea>
                                @error('comments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <small class="text-muted">Form ini menggunakan data pasien yang sedang Anda lihat.</small>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-send me-2"></i>Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
