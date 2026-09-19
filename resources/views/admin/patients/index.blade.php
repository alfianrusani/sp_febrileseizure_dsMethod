@extends('layouts.admin')
@section('title', 'Data Pasien')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Data Pasien</h2>
                <div class="text-secondary">Daftar pasien yang telah menjalani diagnosis</div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Cari Nama Pasien</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Masukkan nama pasien">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-vcenter card-table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Diagnosis</th>
                            <th>Belief</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td class="text-center">#{{ $patient->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $patient->name }}</div>
                                </td>
                                <td>{{ $patient->age }}</td>
                                <td>{{ $patient->gender }}</td>
                                <td>{{ $patient->phone ?? '-' }}</td>
                                <td>{{ $patient->address ? Str::limit($patient->address, 30) : '-' }}</td>
                                <td>{{ $patient->diagnosis ?? '-' }}</td>
                                <td>{{ $patient->belief_value ? number_format($patient->belief_value * 100, 2) . '%' : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.patients.show', $patient) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-secondary py-4">Belum ada data pasien.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $patients->links() }}
    </div>
@endsection
