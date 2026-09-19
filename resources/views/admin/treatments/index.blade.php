@extends('layouts.admin')
@section('title', 'Data Treatment')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Data Treatment</h2>
                <div class="text-secondary">Kelola penanganan untuk setiap penyakit</div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.treatments.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Treatment
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
                            <th>Penyakit</th>
                            <th>Judul Tindakan</th>
                            <th>Penanganan Pertama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($treatments as $index => $treatment)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $treatment->disease->name ?? '-' }}</td>
                                <td>{{ $treatment->action_title }}</td>
                                <td>{{ Str::limit($treatment->first_step_handling, 80) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.treatments.edit', $treatment) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.treatments.destroy', $treatment) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus data treatment ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">Belum ada data treatment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
