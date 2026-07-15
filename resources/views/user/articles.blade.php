@extends('layouts.user')
@section('title', 'Artikel')

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-journal-text me-2"></i>Artikel</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Artikel</li>
                </ol>
            </nav>
        </div>
    </div>

    <section style="background:#fff">
        <div class="container">
            <div class="section-title text-center mb-4">
                <h2>Artikel & Edukasi</h2>
                <p>Berbagai artikel terkait Febrile Seizure dan penanganannya</p>
            </div>

            <div class="row g-4">
                @forelse($articles as $article)
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card">
                            @php
                                $articleImage = $article->thumbnail ?? $article->image;
                            @endphp
                            @if (!empty($articleImage))
                                <img src="{{ asset('storage/' . $articleImage) }}" class="card-img-top"
                                    style="border-radius:12px;object-fit:cover;height:180px" alt="{{ $article->title }}">
                            @endif
                            <div class="card-body">
                                <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">
                                    {{ $article->title }}</h5>
                                <p class="text-muted" style="font-size:13px">{{ $article->created_at->format('d M Y') }}</p>
                                <p style="color:#777;font-size:14px;line-height:1.7">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->content ?? ($article->body ?? '')), 140) }}
                                </p>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-get-started">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="p-4 rounded text-center" style="background:var(--light-bg)">
                            <h5>Tidak ada artikel ditemukan</h5>
                            <p class="text-muted">Coba lagi nanti atau hubungi admin.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection
