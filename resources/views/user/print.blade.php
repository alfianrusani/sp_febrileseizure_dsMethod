<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Diagnosa — {{ $diagnosis->patient_name }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
  <style>
    body { font-family: 'Segoe UI', sans-serif; font-size: 13px; color: #333; background: #fff; }
    .header-bar { background: #106eea; color: #fff; padding: 20px 30px; margin-bottom: 20px; }
    .section-label { font-weight: 700; color: #106eea; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; border-bottom: 2px solid #106eea; padding-bottom: 4px; margin-bottom: 12px; }
    table td { padding: 6px 10px; }
    .result-box { border: 2px solid #106eea; border-radius: 8px; padding: 16px; background: #e8f1fd; }
    @media print {
      .no-print { display: none !important; }
      body { margin: 0; }
      .header-bar { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
      .result-box { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
  </style>
</head>
<body>
  <div class="no-print mb-3 text-center pt-3">
    <button onclick="window.print()" class="btn btn-primary btn-sm me-2">🖨 Cetak</button>
    <button onclick="window.close()" class="btn btn-secondary btn-sm">✕ Tutup</button>
  </div>

  <div class="header-bar">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="mb-0" style="font-weight:800">LAPORAN DIAGNOSA PENYAKIT</h4>
        <div style="opacity:.8;font-size:12px">Sistem Pakar Kejang Demam — Metode Dempster-Shafer</div>
        <div style="opacity:.8;font-size:12px">STMIK Triguna Dharma</div>
      </div>
      <div class="text-end">
        <div style="font-size:11px;opacity:.8">No. Laporan</div>
        <div style="font-weight:700;font-size:16px">#{{ str_pad($diagnosis->id, 6, '0', STR_PAD_LEFT) }}</div>
        <div style="font-size:11px;opacity:.8">{{ $diagnosis->diagnosis_date->format('d F Y') }}</div>
      </div>
    </div>
  </div>

  <div class="container" style="max-width:700px">

    {{-- Patient Data --}}
    <div class="mb-4">
      <div class="section-label">Data Pasien</div>
      <table class="w-100">
        <tr><td width="30%" class="text-muted">Nama Pasien</td><td>: <strong>{{ $diagnosis->patient_name }}</strong></td></tr>
        <tr><td class="text-muted">Jenis Kelamin</td><td>: {{ $diagnosis->gender }}</td></tr>
        <tr><td class="text-muted">Tanggal Lahir</td><td>: {{ $diagnosis->birth_date->format('d F Y') }}</td></tr>
        <tr><td class="text-muted">Usia</td><td>: {{ $diagnosis->age_months }} bulan</td></tr>
        @if($diagnosis->phone)<tr><td class="text-muted">No. Telepon</td><td>: {{ $diagnosis->phone }}</td></tr>@endif
        @if($diagnosis->address)<tr><td class="text-muted">Alamat</td><td>: {{ $diagnosis->address }}</td></tr>@endif
        <tr><td class="text-muted">Tanggal Diagnosa</td><td>: {{ $diagnosis->diagnosis_date->format('d F Y') }}</td></tr>
      </table>
    </div>

    {{-- Selected Symptoms --}}
    <div class="mb-4">
      <div class="section-label">Gejala yang Dipilih</div>
      <ol style="padding-left:18px">
        @foreach($selectedSymptoms as $symptom)
          <li>{{ $symptom->name }} <small class="text-muted">({{ $symptom->code }}, densitas: {{ $symptom->density }})</small></li>
        @endforeach
      </ol>
    </div>

    {{-- Result --}}
    <div class="mb-4">
      <div class="section-label">Hasil Diagnosa</div>
      @if($diagnosis->disease)
      <div class="result-box">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div style="font-size:11px;color:#666;text-transform:uppercase;letter-spacing:1px">Didiagnosa dengan</div>
            <h5 class="mb-0 mt-1" style="color:#106eea;font-weight:700">{{ $diagnosis->disease->name }}</h5>
            <small class="text-muted">Kode: {{ $diagnosis->disease->code }}</small>
          </div>
          <div class="text-center">
            <div style="font-size:32px;font-weight:800;color:#106eea">{{ round($diagnosis->belief_value * 100, 2) }}%</div>
            <small class="text-muted">Tingkat Keyakinan</small>
          </div>
        </div>
        <hr>
        <p style="font-size:12px;margin:0;color:#555">{{ $diagnosis->disease->description }}</p>
      </div>
      @else
      <p class="text-muted">Tidak ada diagnosis pasti yang dapat ditentukan dari gejala yang dipilih.</p>
      @endif
    </div>

    {{-- Treatment --}}
    @if($diagnosis->disease && $diagnosis->disease->treatment)
    <div class="mb-4">
      <div class="section-label">Rekomendasi Penanganan</div>
      <div style="font-size:12px;line-height:1.8;white-space:pre-line;color:#444">{{ $diagnosis->disease->treatment }}</div>
    </div>
    @endif

    {{-- DS Values --}}
    <div class="mb-4">
      <div class="section-label">Nilai Dempster-Shafer</div>
      <table class="table table-sm table-bordered">
        <tr><td>Nilai Belief Bel(X)</td><td><strong>{{ $diagnosis->belief_value }}</strong></td></tr>
        <tr><td>Nilai Plausibility Pls(X)</td><td><strong>{{ round(1 - $diagnosis->belief_value, 4) }}</strong></td></tr>
        <tr><td>Jumlah Gejala Dipilih</td><td><strong>{{ $selectedSymptoms->count() }}</strong></td></tr>
      </table>
    </div>

    <div class="mt-5 pt-3" style="border-top:1px solid #ddd">
      <div class="row">
        <div class="col-6">
          <small class="text-muted">Dicetak pada: {{ now()->format('d F Y H:i') }} WIB</small>
        </div>
        <div class="col-6 text-end">
          <small class="text-muted">Sistem Pakar Kejang Demam — STMIK Triguna Dharma</small>
        </div>
      </div>
      <p class="text-center mt-3" style="font-size:11px;color:#999">
        ⚠ Hasil diagnosa ini bersifat sebagai referensi awal. Konsultasikan selalu kepada dokter spesialis anak.
      </p>
    </div>
  </div>
</body>
</html>
