@extends('layouts.admin')
@section('title', 'Data Penyakit')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title"><i class="bi bi-hospital me-2 text-primary"></i>Data Penyakit</h2>
                <div class="text-secondary">Kelola jenis-jenis penyakit kejang demam</div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.diseases.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Penyakit
                </a>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="8%">Kode</th>
                            <th>Nama Penyakit</th>
                            <th>Deskripsi</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diseases as $i => $d)
                            <tr>
                                <td class="text-secondary text-center">{{ $i + 1 }}</td>
                                <td class="text-center"><span class="badge bg-warning text-white">{{ $d->code }}</span>
                                </td>
                                <td class="font-weight-medium text-center">{{ $d->name }}</td>
                                <td class="text-secondary" style="font-size:13px;max-width:300px">
                                    {{ Str::limit($d->description, 80) }}
                                </td>
                                <td class="text-center"><span
                                        class="badge bg-green text-white">{{ $d->diagnoses_count }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.diseases.edit', $d->id) }}"
                                        class="btn btn-sm btn-ghost-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.diseases.destroy', $d->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus penyakit ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-ghost-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-5">Belum ada data penyakit.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
