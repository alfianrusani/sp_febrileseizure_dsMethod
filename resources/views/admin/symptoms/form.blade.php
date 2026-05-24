@extends('layouts.admin')
@section('title', $symptom->exists ? 'Edit Gejala' : 'Tambah Gejala')

@section('content')
<div class="page-header pt-4">
  <div class="row align-items-center">
    <div class="col">
      <h2 class="page-title">{{ $symptom->exists ? 'Edit Gejala' : 'Tambah Gejala' }}</h2>
    </div>
    <div class="col-auto">
      <a href="{{ route('admin.symptoms.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
      </a>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-body">
        <form action="{{ $symptom->exists ? route('admin.symptoms.update', $symptom->id) : route('admin.symptoms.store') }}"
              method="POST">
          @csrf
          @if($symptom->exists) @method('PUT') @endif

          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label required">Kode Gejala</label>
              <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                     value="{{ old('code', $symptom->code) }}" placeholder="Contoh: G01" maxlength="10">
              @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
              <label class="form-label required">Nama Gejala</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $symptom->name) }}" placeholder="Deskripsi gejala">
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
              <label class="form-label required">
                Nilai Densitas
                <span class="text-secondary ms-1" style="font-size:12px">(0.0 – 1.0)</span>
              </label>
              <div class="row align-items-center g-3">
                <div class="col-md-5">
                  <input type="number" name="density" id="densityInput"
                         class="form-control @error('density') is-invalid @enderror"
                         value="{{ old('density', $symptom->density ?? 0.5) }}"
                         min="0" max="1" step="0.1">
                  @error('density')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-7">
                  <div class="d-flex align-items-center gap-2">
                    <input type="range" class="form-range" id="densityRange"
                           min="0" max="1" step="0.1"
                           value="{{ old('density', $symptom->density ?? 0.5) }}">
                    <span id="densityLabel" class="badge bg-primary" style="min-width:40px">
                      {{ old('density', $symptom->density ?? 0.5) }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="mt-2 p-3 rounded" style="background:#f8f9fa;font-size:12px;color:#777">
                <strong>Panduan nilai densitas:</strong><br>
                0.1–0.3 = Gejala umum / lemah &nbsp;|&nbsp;
                0.4–0.6 = Gejala sedang &nbsp;|&nbsp;
                0.7–0.9 = Gejala kuat / spesifik
              </div>
            </div>
          </div>

          <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-lg me-2"></i>{{ $symptom->exists ? 'Perbarui' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.symptoms.index') }}" class="btn btn-outline-secondary">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card">
      <div class="card-header"><h3 class="card-title">Referensi Nilai Densitas</h3></div>
      <div class="card-body p-0">
        <table class="table table-vcenter mb-0">
          <thead><tr><th>Gejala</th><th>Densitas</th></tr></thead>
          <tbody style="font-size:13px">
            <tr><td>Demam ringan berulang</td><td><span class="badge bg-secondary text-white">0.2</span></td></tr>
            <tr><td>Flu / Batuk berat</td><td><span class="badge bg-secondary text-white">0.3–0.4</span></td></tr>
            <tr><td>Mual, Pilek, Mencret</td><td><span class="badge bg-yellow text-dark">0.5</span></td></tr>
            <tr><td>Demam naik-turun</td><td><span class="badge bg-orange text-white">0.7</span></td></tr>
            <tr><td>Demam tinggi seharian</td><td><span class="badge bg-red text-white">0.8</span></td></tr>
            <tr><td>Kejang berlangsung lama</td><td><span class="badge bg-red text-white">0.9</span></td></tr>
            <tr><td>Kehilangan kesadaran lama</td><td><span class="badge bg-red text-white">0.9</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
const densityInput = document.getElementById('densityInput');
const densityRange  = document.getElementById('densityRange');
const densityLabel  = document.getElementById('densityLabel');

densityRange.addEventListener('input', function () {
  densityInput.value = this.value;
  densityLabel.textContent = this.value;
});
densityInput.addEventListener('input', function () {
  densityRange.value = this.value;
  densityLabel.textContent = this.value;
});
</script>
@endpush
