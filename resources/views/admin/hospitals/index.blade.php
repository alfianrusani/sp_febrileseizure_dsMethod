@extends('layouts.admin')
@section('title', 'Data Rumah Sakit')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Data Rumah Sakit</h2>
                <div class="text-secondary">Kelola daftar rumah sakit yang tampil di website</div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.hospitals.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Rumah Sakit
                </a>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-vcenter card-table mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hospitals as $index => $hospital)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $hospital->name }}</td>
                                <td>{{ $hospital->address }}</td>
                                <td>{{ $hospital->contact_number ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.hospitals.edit', $hospital) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.hospitals.destroy', $hospital) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus rumah sakit ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">Belum ada data rumah sakit.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
