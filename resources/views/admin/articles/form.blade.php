@extends('layouts.admin')
@section('title', isset($article->id) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">{{ isset($article->id) ? 'Edit Artikel' : 'Tambah Artikel' }}</h2>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form method="POST"
                action="{{ isset($article->id) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($article->id))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title', $article->title ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" class="form-control" rows="8" required>{{ old('content', $article->content ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Upload file gambar. Format yang didukung: JPG, JPEG, PNG, WEBP.</div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
