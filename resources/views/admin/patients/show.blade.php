@extends('layouts.admin')
@section('title', 'Detail Pasien')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Detail Pasien</h2>
                <div class="text-secondary">Informasi lengkap pasien yang telah didiagnosis</div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-person-badge me-2 text-primary"></i>Data Pasien</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div
                            style="width:60px;height:60px;background:var(--tblr-primary);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700">
                            {{ strtoupper(substr($patient->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold fs-4">{{ $patient->name }}</div>
                            <div class="text-secondary">{{ $patient->gender }}</div>
                        </div>
                    </div>
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-secondary ps-0" width="45%">ID</td>
                            <td>#{{ $patient->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Usia</td>
                            <td>{{ $patient->age }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Jenis Kelamin</td>
                            <td>{{ $patient->gender }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Telepon</td>
                            <td>{{ $patient->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Alamat</td>
                            <td>{{ $patient->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Dibuat</td>
                            <td>{{ $patient->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-clipboard2-pulse me-2 text-primary"></i>Hasil Diagnosis Terakhir
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary">Diagnosis</label>
                            <div class="form-control-plaintext fw-semibold">{{ $patient->diagnosis ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary">Nilai Belief</label>
                            <div class="form-control-plaintext fw-semibold">
                                {{ $patient->belief_value ? number_format($patient->belief_value * 100, 2) . '%' : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
