@extends('layouts.admin')
@section('title', isset($treatment->id) ? 'Edit Treatment' : 'Tambah Treatment')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">{{ isset($treatment->id) ? 'Edit Treatment' : 'Tambah Treatment' }}</h2>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form method="POST"
                action="{{ isset($treatment->id) ? route('admin.treatments.update', $treatment) : route('admin.treatments.store') }}">
                @csrf
                @if (isset($treatment->id))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Penyakit</label>
                    <select name="disease_id" class="form-select" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach ($diseases as $disease)
                            <option value="{{ $disease->id }}"
                                {{ old('disease_id', $treatment->disease_id ?? '') == $disease->id ? 'selected' : '' }}>
                                {{ $disease->code }} - {{ $disease->name }}
                            </option>
                        @endforeach
                    </select>

                    @php
                        $selectedDiseaseId = old('disease_id', $treatment->disease_id ?? null);
                        $existingTreatmentForDisease = $selectedDiseaseId
                            ? \App\Models\Treatment::where('disease_id', $selectedDiseaseId)
                                ->when(isset($treatment->id), function ($query) use ($treatment) {
                                    return $query->where('id', '!=', $treatment->id);
                                })
                                ->first()
                            : null;
                    @endphp

                    @if (!isset($treatment->id) && $existingTreatmentForDisease)
                        <div class="form-text text-danger mt-2">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Penyakit ini sudah memiliki treatment. Gunakan fitur edit untuk memperbarui data yang ada.
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Tindakan</label>
                    <input type="text" name="action_title" class="form-control"
                        value="{{ old('action_title', $treatment->action_title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penanganan Pertama</label>
                    <textarea name="first_step_handling" class="form-control" rows="6" required>{{ old('first_step_handling', $treatment->first_step_handling ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Obat Penanganan</label>
                    <textarea name="medicine" class="form-control" rows="6" required>{{ old('medicine', $treatment->medicine ?? '') }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.treatments.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
