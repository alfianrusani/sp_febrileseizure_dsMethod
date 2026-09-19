@extends('layouts.user')
@section('title', 'Rumah Sakit')

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-hospital me-2"></i>Rumah Sakit</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Rumah Sakit</li>
                </ol>
            </nav>
        </div>
    </div>

    <section style="background:#fff">
        <div class="container">
            <div class="section-title d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>Rumah Sakit Rujukan</h2>
                    <p>Daftar rumah sakit yang relevan untuk penanganan</p>
                </div>
                <form action="{{ route('hospitals.index') }}" method="get" class="d-flex" style="gap:8px">
                    <input type="search" name="q" value="{{ old('q', $q ?? '') }}"
                        placeholder="Cari nama atau alamat" class="form-control" style="min-width:220px">
                    <button class="btn btn-primary">Cari</button>
                </form>
            </div>

            <div class="row g-4">
                @forelse($hospitals as $hospital)
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card">
                            <div class="card-body">
                                <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">
                                    {{ $hospital->name }}</h5>
                                <p class="text-muted" style="font-size:13px">
                                    {{ \Illuminate\Support\Str::limit($hospital->address, 120) }}</p>
                                @if (!empty($hospital->contact_number))
                                    <p><i class="bi bi-telephone text-primary"></i> {{ $hospital->contact_number }}</p>
                                @endif
                                <a href="{{ route('hospitals.show', $hospital->id) }}"
                                    class="btn btn-sm btn-get-started">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="p-4 rounded text-center" style="background:var(--light-bg)">
                            <h5>Tidak ada rumah sakit ditemukan</h5>
                            <p class="text-muted">Coba kata kunci lain.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $hospitals->links() }}
            </div>
        </div>
    </section>
@endsection
