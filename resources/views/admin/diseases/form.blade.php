@extends('layouts.admin')
@section('title', $disease->exists ? 'Edit Penyakit' : 'Tambah Penyakit')

@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h2 class="page-title">{{ $disease->exists ? 'Edit Penyakit' : 'Tambah Penyakit' }}</h2>
    </div>
    <div class="col-auto">
      <a href="{{ route('admin.diseases.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
      </a>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-body">
    <form action="{{ $disease->exists ? route('admin.diseases.update', $disease->id) : route('admin.diseases.store') }}"
          method="POST">
      @csrf
      @if($disease->exists) @method('PUT') @endif

      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label required">Kode Penyakit</label>
          <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                 value="{{ old('code', $disease->code) }}" placeholder="Contoh: P1" maxlength="10">
          @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-8">
          <label class="form-label required">Nama Penyakit</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $disease->name) }}" placeholder="Nama lengkap penyakit">
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" class="form-control" rows="4"
                    placeholder="Deskripsi singkat tentang penyakit...">{{ old('description', $disease->description) }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Rekomendasi Penanganan</label>
          <textarea name="treatment" class="form-control" rows="8"
                    placeholder="Langkah-langkah penanganan...">{{ old('treatment', $disease->treatment) }}</textarea>
          <small class="text-secondary">Dapat menggunakan format poin dengan tanda •</small>
        </div>
      </div>

      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-check-lg me-2"></i>{{ $disease->exists ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ route('admin.diseases.index') }}" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
