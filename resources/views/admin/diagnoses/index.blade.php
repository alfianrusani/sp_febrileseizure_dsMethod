@extends('layouts.admin')
@section('title', 'Laporan Diagnosa')

@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h2 class="page-title"><i class="bi bi-clipboard2-pulse me-2 text-primary"></i>Laporan Diagnosa</h2>
      <div class="text-secondary">Daftar seluruh hasil diagnosa pasien</div>
    </div>
  </div>
</div>

{{-- Filter --}}
<div class="card mt-3">
  <div class="card-header"><h3 class="card-title"><i class="bi bi-funnel me-2"></i>Filter</h3></div>
  <div class="card-body">
    <form method="GET" action="{{ route('admin.diagnoses.index') }}">
      <div class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label">Nama Pasien</label>
          <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama...">
        </div>
        <div class="col-md-3">
          <label class="form-label">Penyakit</label>
          <select name="disease_id" class="form-select">
            <option value="">-- Semua --</option>
            @foreach($diseases as $d)
              <option value="{{ $d->id }}" {{ request('disease_id') == $d->id ? 'selected' : '' }}>
                {{ $d->code }} — {{ $d->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">Dari Tanggal</label>
          <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-2">
          <label class="form-label">Sampai Tanggal</label>
          <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
          <button type="submit" class="btn btn-primary flex-fill">
            <i class="bi bi-search me-1"></i>Filter
          </button>
          <a href="{{ route('admin.diagnoses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-lg"></i>
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Table --}}
<div class="card mt-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0">Hasil: {{ $diagnoses->total() }} data</h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-vcenter">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Nama Pasien</th>
            <th width="8%">Gender</th>
            <th width="8%">Usia</th>
            <th width="8%">No. HP</th>
            <th>Diagnosa</th>
            <th width="10%">Keyakinan</th>
            <th width="10%">Tanggal</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($diagnoses as $i => $d)
          <tr>
            <td class="text-secondary text-center">{{ $diagnoses->firstItem() + $i }}</td>
            <td class="text-center">
              <div class="d-flex align-items-center gap-2">
                <div style="width:30px;height:30px;background:var(--tblr-primary);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0">
                  {{ strtoupper(substr($d->patient_name, 0, 1)) }}
                </div>
                <div class="font-weight-medium">{{ $d->patient_name }}</div>
              </div>
            </td>
            <td class="text-secondary small text-center">
              <i class="bi bi-{{ $d->gender === 'Laki-laki' ? 'gender-male text-primary' : 'gender-female text-danger' }}"></i>
              {{ $d->gender }}
            </td>
            <td class="text-secondary text-center">{{ $d->age_months }} bln</td>
            <td class="text-secondary small text-center ">{{ $d->phone ?? '—' }}</td>
            <td class="text-center">
              @if($d->disease)
                <span class="badge {{ $d->disease->code === 'P1' ? 'bg-blue' : 'bg-red' }} text-white me-1">
                  {{ $d->disease->code }}
                </span>
                <span style="font-size:12px">{{ $d->disease->name }}</span>
              @else
                <span class="text-secondary small">Tidak terdiagnosa</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex align-items-center gap-2">
                <div class="progress" style="width:50px;height:5px;border-radius:50px">
                  <div class="progress-bar {{ round($d->belief_value*100) >= 70 ? 'bg-green' : (round($d->belief_value*100) >= 40 ? 'bg-yellow' : 'bg-red') }}"
                       style="width:{{ round($d->belief_value * 100) }}%;border-radius:50px"></div>
                </div>
                <small class="{{ round($d->belief_value*100) >= 70 ? 'text-green' : 'text-secondary' }}">
                  {{ round($d->belief_value * 100, 1) }}%
                </small>
              </div>
            </td>
            <td class="text-secondary small text-center">{{ $d->diagnosis_date->format('d M Y') }}</td>
            <td class="text-center">
              <div class="d-flex gap-1">
                <a href="{{ route('admin.diagnoses.show', $d->id) }}" class="btn btn-sm btn-ghost-primary" title="Detail">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('diagnosis.print', $d->id) }}" target="_blank" class="btn btn-sm btn-ghost-secondary" title="Cetak">
                  <i class="bi bi-printer"></i>
                </a>
                <form action="{{ route('admin.diagnoses.destroy', $d->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus data diagnosa ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-ghost-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center text-secondary py-5">
              <i class="bi bi-inbox fs-1 d-block mb-2"></i>
              Tidak ada data diagnosa ditemukan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  @if($diagnoses->hasPages())
  <div class="card-footer d-flex align-items-center">
    <p class="m-0 text-secondary">
      Menampilkan <strong>{{ $diagnoses->firstItem() }}–{{ $diagnoses->lastItem() }}</strong>
      dari <strong>{{ $diagnoses->total() }}</strong> data
    </p>
    <div class="ms-auto">
      {{ $diagnoses->links() }}
    </div>
  </div>
  @endif
</div>
@endsection
