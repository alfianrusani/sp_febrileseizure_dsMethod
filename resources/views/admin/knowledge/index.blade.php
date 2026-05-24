@extends('layouts.admin')
@section('title', 'Basis Pengetahuan')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title"><i class="bi bi-diagram-3 me-2 text-success"></i>Basis Pengetahuan</h2>
                <div class="text-secondary">Kelola relasi antara gejala dan penyakit</div>
            </div>
        </div>
    </div>

    <div class="alert alert-info mt-3">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Petunjuk:</strong> Pilih penyakit, lalu centang gejala-gejala yang terkait. Klik <strong>Simpan</strong>
        untuk memperbarui basis pengetahuan.
    </div>

    <form action="{{ route('admin.knowledge.update') }}" method="POST" id="knowledgeForm">
        @csrf

        {{-- Disease Tabs --}}
        <ul class="nav nav-tabs mt-3" id="diseaseTabs">
            @foreach ($diseases as $i => $disease)
                <li class="nav-item">
                    <a class="nav-link {{ $i === 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $disease->id }}">
                        <span
                            class="badge {{ $disease->code === 'P1' ? 'bg-blue' : 'bg-red' }} text-white me-2">{{ $disease->code }}</span>
                        {{ $disease->name }}
                        <span class="badge bg-warning text-white ms-2">{{ $disease->symptoms->count() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach ($diseases as $i => $disease)
                <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="tab-{{ $disease->id }}">
                    <div class="card border-top-0" style="border-radius:0 0 8px 8px">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="card-title mb-0">{{ $disease->name }}</h3>
                                <small class="text-secondary">Pilih gejala yang terkait dengan penyakit ini</small>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    onclick="toggleAll({{ $disease->id }}, true)">
                                    <i class="bi bi-check-all me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    onclick="toggleAll({{ $disease->id }}, false)">
                                    <i class="bi bi-x-lg me-1"></i>Batal Semua
                                </button>
                                <button type="submit" name="disease_id" value="{{ $disease->id }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-save me-1"></i>Simpan Penyakit Ini
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($symptoms as $symptom)
                                    <div class="col-lg-6">
                                        <div class="kb-card p-3 rounded h-100"
                                            style="cursor:pointer;transition:.15s;border-color:#dee2e6!important"
                                            id="kbcard-{{ $disease->id }}-{{ $symptom->id }}"
                                            onclick="toggleKbCard({{ $disease->id }}, {{ $symptom->id }})">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input kb-check-{{ $disease->id }}"
                                                    type="checkbox" name="symptom_ids[]" value="{{ $symptom->id }}"
                                                    id="kb-{{ $disease->id }}-{{ $symptom->id }}" style="cursor:pointer"
                                                    {{ $disease->symptoms->contains('id', $symptom->id) ? 'checked' : '' }}
                                                    onclick="event.stopPropagation()">
                                                <label class="form-check-label w-100" style="cursor:pointer">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <div class="font-weight-medium" style="font-size:13px">
                                                                {{ $symptom->name }}</div>
                                                            <div class="d-flex gap-2 mt-1">
                                                                <span class="badge bg-warning text-white"
                                                                    style="font-size:10px">{{ $symptom->code }}</span>
                                                                <small class="text-secondary">Densitas:
                                                                    <strong>{{ $symptom->density }}</strong></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    {{-- Summary Table --}}
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title"><i class="bi bi-table me-2 text-primary"></i>Ringkasan Basis Pengetahuan</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-vcenter mb-0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Gejala</th>
                            <th>Densitas</th>
                            @foreach ($diseases as $d)
                                <th class="text-center">{{ $d->code }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="font-size:13px">
                        @foreach ($symptoms as $symptom)
                            <tr>
                                <td class="text-center"><span
                                        class="badge bg-warning text-white">{{ $symptom->code }}</span></td>
                                <td>{{ $symptom->name }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width:40px;height:4px">
                                            <div class="progress-bar bg-primary"
                                                style="width:{{ $symptom->density * 100 }}%"></div>
                                        </div>
                                        {{ $symptom->density }}
                                    </div>
                                </td>
                                @foreach ($diseases as $d)
                                    <td class="text-center">
                                        @if ($d->symptoms->contains('id', $symptom->id))
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                        @else
                                            <i class="bi bi-x-circle text-secondary fs-5"></i>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Highlight checked cards on load
        document.querySelectorAll('.form-check-input[type=checkbox]').forEach(cb => {
            if (cb.checked) highlightCard(cb.closest('.kb-card'), true);
            cb.addEventListener('change', function() {
                highlightCard(this.closest('.kb-card'), this.checked);
            });
        });

        function highlightCard(card, checked) {
            if (!card) return;
            card.style.borderColor = checked ? 'var(--tblr-primary)' : '#dee2e6';
            card.style.background = checked ? '#e8f1fd' : '';
        }

        function toggleKbCard(diseaseId, symptomId) {
            const cb = document.getElementById(`kb-${diseaseId}-${symptomId}`);
            const card = document.getElementById(`kbcard-${diseaseId}-${symptomId}`);
            cb.checked = !cb.checked;
            highlightCard(card, cb.checked);
        }

        function toggleAll(diseaseId, checked) {
            document.querySelectorAll(`.kb-check-${diseaseId}`).forEach(cb => {
                cb.checked = checked;
                highlightCard(cb.closest('.kb-card'), checked);
            });
        }
    </script>
@endpush
