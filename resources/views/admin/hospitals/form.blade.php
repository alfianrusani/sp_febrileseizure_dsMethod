@extends('layouts.admin')
@section('title', isset($hospital->id) ? 'Edit Rumah Sakit' : 'Tambah Rumah Sakit')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">{{ isset($hospital->id) ? 'Edit Rumah Sakit' : 'Tambah Rumah Sakit' }}</h2>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form method="POST"
                action="{{ isset($hospital->id) ? route('admin.hospitals.update', $hospital) : route('admin.hospitals.store') }}">
                @csrf
                @if (isset($hospital->id))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label class="form-label">Nama Rumah Sakit</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $hospital->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" rows="4" required>{{ old('address', $hospital->address ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="contact_number" class="form-control"
                        value="{{ old('contact_number', $hospital->contact_number ?? '') }}">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.hospitals.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
