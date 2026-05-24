@extends('layouts.user')
@section('title', 'Konsultasi Diagnosa')

@section('content')
    {{-- Page Hero --}}
    <div class="page-hero">
        <div class="container">
            <h1><i class="bi bi-clipboard-pulse me-2"></i>Konsultasi Diagnosa</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <section>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong>Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('diagnosis.store') }}" method="POST" id="diagnosisForm">
                @csrf

                {{-- Step 1: Patient Data --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:16px">
                    <div class="card-header border-0 pt-4 px-4 pb-3" style="background:transparent">
                        <div class="d-flex align-items-center gap-3">
                            <div class="step-badge">1</div>
                            <div>
                                <h5 class="mb-0" style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">
                                    Data Pasien</h5>
                                <small class="text-muted">Isi informasi lengkap pasien</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="patient_name"
                                    class="form-control @error('patient_name') is-invalid @enderror"
                                    value="{{ old('patient_name') }}" placeholder="Masukkan nama lengkap" required>
                                @error('patient_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="birth_date"
                                    class="form-control @error('birth_date') is-invalid @enderror"
                                    value="{{ old('birth_date') }}" max="{{ date('Y-m-d') }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. Telepon</label>
                                <input type="tel" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                    placeholder="Contoh: 08123456789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="address" class="form-control" rows="2" placeholder="Alamat tempat tinggal pasien">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Step 2: Symptoms --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:16px">
                    <div class="card-header border-0 pt-4 px-4 pb-3" style="background:transparent">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="step-badge">2</div>
                                <div>
                                    <h5 class="mb-0"
                                        style="font-family:'Raleway',sans-serif;font-weight:700;color:#1a1a2e">Pilih Gejala
                                    </h5>
                                    <small class="text-muted">Centang semua gejala yang dialami anak (min. 1 gejala)</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill" id="selectedCount">0 dipilih</span>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-0">

                        {{-- Search --}}
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="symptomSearch" class="form-control" placeholder="Cari gejala...">
                        </div>

                        <div class="row g-3" id="symptomList">
                            @foreach ($symptoms as $symptom)
                                <div class="col-lg-6 symptom-item">
                                    <div class="symptom-card p-3 rounded-3 border border-2 h-100 position-relative"
                                        style="cursor:pointer;transition:.2s;border-color:#dee2e6!important"
                                        onclick="toggleSymptom(event, this, {{ $symptom->id }})">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input symptom-check" type="checkbox"
                                                name="symptom_ids[]" value="{{ $symptom->id }}"
                                                id="s{{ $symptom->id }}" style="cursor:pointer">
                                            <label class="form-check-label w-100" for="s{{ $symptom->id }}"
                                                style="cursor:pointer">
                                                <div class="d-flex align-items-start justify-content-between">
                                                    <div>
                                                        <div class="fw-semibold" style="font-size:14px;color:#1a1a2e">
                                                            {{ $symptom->name }}</div>
                                                        <div class="mt-1 d-flex align-items-center gap-2">
                                                            <span class="badge"
                                                                style="background:#e8f1fd;color:var(--primary);font-size:11px">{{ $symptom->code }}</span>
                                                            <small class="text-muted">Densitas:
                                                                {{ $symptom->density }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @error('symptom_ids')
                            <div class="text-danger mt-2 small"><i
                                    class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="card border-0 shadow-sm" style="border-radius:16px">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <strong style="font-size:14px">Catatan Penting</strong>
                                </div>
                                <p class="text-muted mb-0" style="font-size:13px">
                                    Hasil diagnosis ini merupakan perkiraan awal dan bukan pengganti diagnosis dokter.
                                    Selalu konsultasikan kondisi anak Anda kepada dokter spesialis anak.
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5" id="submitBtn">
                                    <i class="bi bi-search-heart me-2"></i>Mulai Diagnosa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function toggleSymptom(e, card, id) {
            // If the click originated on the checkbox itself, let native handling occur
            if (e.target && e.target.closest && e.target.closest('.symptom-check')) return;
            const cb = card.querySelector('.symptom-check');
            if (!cb) return;
            // trigger native click on checkbox so its change handler runs (updates styles/count)
            cb.click();
        }

        // Prevent double-toggle when clicking the checkbox itself
        document.querySelectorAll('.symptom-check').forEach(cb => {
            cb.addEventListener('click', e => e.stopPropagation());
            cb.addEventListener('change', function() {
                const card = this.closest('.symptom-card');
                if (this.checked) {
                    card.style.borderColor = 'var(--tblr-primary)';
                    card.style.background = '#e8f1fd';
                } else {
                    card.style.borderColor = '#dee2e6';
                    card.style.background = '';
                }
                updateCount();
            });
        });

        function updateCount() {
            const count = document.querySelectorAll('.symptom-check:checked').length;
            document.getElementById('selectedCount').textContent = count + ' dipilih';
            document.getElementById('selectedCount').className = count > 0 ?
                'badge bg-primary rounded-pill' :
                'badge bg-secondary rounded-pill';
        }

        // Search symptoms
        document.getElementById('symptomSearch').addEventListener('input', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.symptom-item').forEach(item => {
                const text = item.querySelector('.form-check-label').textContent.toLowerCase();
                item.style.display = text.includes(q) ? '' : 'none';
            });
        });

        // Loading state on submit
        document.getElementById('diagnosisForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
            btn.disabled = true;
        });
    </script>
@endpush
