@extends('layouts.admin')
@section('title', 'Data Artikel')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Data Artikel</h2>
                <div class="text-secondary">Kelola artikel yang tampil di website</div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Artikel
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
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $index => $article)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->thumbnail ?? ($article->image ?? '-') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
