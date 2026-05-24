@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <h2 class="page-title">Dashboard</h2>
      <div class="text-secondary mt-1">Selamat datang, {{ auth()->user()->name }}</div>
    </div>
    <div class="col-auto ms-auto">
      <div class="text-secondary">{{ now()->format('l, d F Y') }}</div>
    </div>
  </div>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mt-1">
  <div class="col-sm-6 col-lg-3">
    <div class="card stat-card">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="bg-primary text-white avatar">
              <i class="bi bi-hospital"></i>
            </span>
          </div>
          <div class="col">
            <div class="font-weight-medium">Total Penyakit</div>
            <div class="text-secondary small">Jenis penyakit terdaftar</div>
          </div>
          <div class="col-auto">
            <div style="font-size:28px;font-weight:700;color:var(--tblr-primary)">{{ $stats['diseases'] }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card stat-card">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="bg-red text-white avatar">
              <i class="bi bi-thermometer-half"></i>
            </span>
          </div>
          <div class="col">
            <div class="font-weight-medium">Total Gejala</div>
            <div class="text-secondary small">Gejala teridentifikasi</div>
          </div>
          <div class="col-auto">
            <div style="font-size:28px;font-weight:700;color:#e84545">{{ $stats['symptoms'] }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card stat-card">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="bg-green text-white avatar">
              <i class="bi bi-clipboard2-pulse"></i>
            </span>
          </div>
          <div class="col">
            <div class="font-weight-medium">Total Diagnosa</div>
            <div class="text-secondary small">Semua waktu</div>
          </div>
          <div class="col-auto">
            <div style="font-size:28px;font-weight:700;color:#2ecc71">{{ $stats['diagnoses'] }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card stat-card">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="bg-orange text-white avatar">
              <i class="bi bi-calendar-check"></i>
            </span>
          </div>
          <div class="col">
            <div class="font-weight-medium">Diagnosa Hari Ini</div>
            <div class="text-secondary small">{{ now()->format('d M Y') }}</div>
          </div>
          <div class="col-auto">
            <div style="font-size:28px;font-weight:700;color:#f39c12">{{ $stats['today'] }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mt-1">
  {{-- Recent Diagnoses --}}
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="bi bi-clock-history me-2 text-primary"></i>Diagnosa Terbaru</h3>
        <div class="card-options">
          <a href="{{ route('admin.diagnoses.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
      </div>
      <div class="card-body p-0">
        <style>
          .card-table th, .card-table td { text-align: center; vertical-align: middle; }
          .card-table td > .d-flex { justify-content: center; }
          .card-table td .avatar { margin: 0 auto; }
        </style>
        <div class="table-responsive">
          <table class="table table-hover table-vcenter card-table">
            <thead>
              <tr>
                <th>Pasien</th>
                <th>Usia</th>
                <th>Diagnosis</th>
                <th>Keyakinan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentDiagnoses as $d)
              <tr>
                <td>
                  <div class="d-flex">
                    <div class="avatar avatar-sm" style="background:var(--tblr-primary);color:#fff;border-radius:50%;font-size:12px;font-weight:700;width:32px;height:32px;display:flex;align-items:center;justify-content:center">
                      {{ strtoupper(substr($d->patient_name, 0, 1)) }}
                    </div>
                    <div>
                      <div class="font-weight-medium">{{ $d->patient_name }}</div>
                      <div class="text-secondary small">{{ $d->gender }}</div>
                    </div>
                  </div>
                </td>
                <td class="text-secondary">{{ $d->age_months }} bln</td>
                <td>
                  @if($d->disease)
                    <span class="badge {{ $d->disease->code === 'P1' ? 'bg-blue' : 'bg-red' }} badge-ds text-white">
                      {{ $d->disease->code }}
                    </span>
                  @else
                    <span class="badge bg-secondary badge-ds text-white">N/A</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="progress" style="width:60px;height:5px">
                      <div class="progress-bar bg-primary" style="width:{{ round($d->belief_value * 100) }}%"></div>
                    </div>
                    <small>{{ round($d->belief_value * 100, 1) }}%</small>
                  </div>
                </td>
                <td class="text-secondary small">{{ $d->diagnosis_date->format('d M Y') }}</td>
                <td>
                  <a href="{{ route('admin.diagnoses.show', $d->id) }}" class="btn btn-sm btn-ghost-primary">
                    <i class="bi bi-eye"></i>
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center text-secondary py-4">Belum ada data diagnosa.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Disease Distribution --}}
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header">
        <h3 class="card-title"><i class="bi bi-pie-chart me-2 text-primary"></i>Distribusi Diagnosa</h3>
      </div>
      <div class="card-body">
        @foreach($diseaseStats as $ds)
        <div class="mb-4">
          <div class="d-flex justify-content-between mb-1">
            <div>
              <span class="badge {{ $ds->code === 'P1' ? 'bg-blue' : 'bg-red' }} me-2 text-white" style="font-size:10px">{{ $ds->code }}</span>
              <small class="font-weight-medium">{{ $ds->name }}</small>
            </div>
            <small class="text-secondary">{{ $ds->diagnoses_count }}</small>
          </div>
          @php
            $total = $stats['diagnoses'] ?: 1;
            $pct = round(($ds->diagnoses_count / $total) * 100);
          @endphp
          <div class="progress" style="height:8px;border-radius:50px">
            <div class="progress-bar {{ $ds->code === 'P1' ? 'bg-primary' : 'bg-red' }}"
                 style="width:{{ $pct }}%;border-radius:50px"></div>
          </div>
          <small class="text-secondary">{{ $pct }}% dari total diagnosa</small>
        </div>
        @endforeach

        <hr>
        <div class="row text-center g-2 mt-2">
          <div class="col-6">
            <div class="p-3 rounded" style="background:#e8f1fd">
              <div style="font-size:22px;font-weight:700;color:var(--tblr-primary)">{{ $stats['diagnoses'] }}</div>
              <small class="text-secondary">Total</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 rounded" style="background:#fef0e7">
              <div style="font-size:22px;font-weight:700;color:#f39c12">{{ $stats['today'] }}</div>
              <small class="text-secondary">Hari Ini</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Quick Links --}}
<div class="row g-3 mt-1">
  <div class="col-12">
    <div class="card">
      <div class="card-header"><h3 class="card-title">Aksi Cepat</h3></div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <a href="{{ route('admin.diseases.create') }}" class="btn w-100 btn-outline-primary">
              <i class="bi bi-plus-circle me-2"></i>Tambah Penyakit
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ route('admin.symptoms.create') }}" class="btn w-100 btn-outline-danger">
              <i class="bi bi-plus-circle me-2"></i>Tambah Gejala
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ route('admin.knowledge.index') }}" class="btn w-100 btn-outline-success">
              <i class="bi bi-diagram-3 me-2"></i>Basis Pengetahuan
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ route('admin.diagnoses.index') }}" class="btn w-100 btn-outline-warning">
              <i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan Diagnosa
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
