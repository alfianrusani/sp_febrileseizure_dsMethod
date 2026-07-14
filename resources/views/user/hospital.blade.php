@extends('layouts.user')
@section('title', $hospital->name)

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-hospital me-2"></i>{{ $hospital->name }}</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('hospitals.index') }}">Rumah Sakit</a></li>
                    <li class="breadcrumb-item active">{{ $hospital->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section style="background:#fff">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow p-4" style="border-radius:12px">
                        <h2 style="font-family:'Raleway',sans-serif;font-weight:800;color:#1a1a2e">{{ $hospital->name }}
                        </h2>
                        <p class="text-muted">{{ $hospital->created_at->format('d M Y') }}</p>
                        <div style="color:#555;line-height:1.8">
                            <p><strong>Alamat:</strong><br>{{ nl2br(e($hospital->address)) }}</p>
                            @if (!empty($hospital->contact_number))
                                <p><strong>Telepon:</strong> {{ $hospital->contact_number }}</p>
                            @endif
                            @if (!empty($hospital->google_maps_link))
                                <p><a class="btn btn-outline-primary" href="{{ $hospital->google_maps_link }}"
                                        target="_blank">Buka di Google Maps</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-3 rounded-3" style="background:var(--light-bg)">
                        <h5 style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Cari Rumah Sakit Lain
                        </h5>
                        <form action="{{ route('hospitals.index') }}" method="get" class="mt-3">
                            <div class="input-group">
                                <input type="search" name="q" value="" placeholder="Cari nama atau alamat"
                                    class="form-control">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
