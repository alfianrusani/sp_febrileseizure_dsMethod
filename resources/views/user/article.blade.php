@extends('layouts.user')
@section('title', $article->title)

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-file-earmark-text me-2"></i>{{ $article->title }}</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">{{ $article->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section style="background:#fff">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="card border-0 shadow" style="border-radius:12px;padding:20px">
                        @if (!empty($article->image))
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                style="width:100%;border-radius:8px;margin-bottom:16px;object-fit:cover;max-height:360px">
                        @endif
                        <h2 style="font-family:'Raleway',sans-serif;font-weight:800;color:#1a1a2e">{{ $article->title }}
                        </h2>
                        <div class="text-muted mb-3">{{ $article->created_at->format('d M Y') }}</div>
                        <div style="color:#555;line-height:1.9">
                            {!! $article->content ?? ($article->body ?? '') !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-3 rounded-3" style="background:var(--light-bg)">
                        <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Artikel Lainnya</h5>
                        <ul class="list-unstyled mt-3">
                            @foreach (\App\Models\Article::latest()->take(5)->get() as $item)
                                <li class="mb-3">
                                    <a href="{{ route('articles.show', $item->id) }}"
                                        style="color:#333;text-decoration:none">{{ \Illuminate\Support\Str::limit($item->title, 60) }}</a>
                                    <div class="text-muted" style="font-size:12px">{{ $item->created_at->format('d M Y') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
