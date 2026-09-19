@extends('layouts.admin')
@section('title', 'Detail Diagnosa')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Detail Diagnosa</h2>
                <div class="text-secondary">No. #{{ str_pad($diagnosis->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="col-auto d-flex gap-2">
                <a href="{{ route('diagnosis.print', $diagnosis->id) }}" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-printer me-2"></i>Cetak Laporan
                </a>
                <a href="{{ route('admin.diagnoses.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-3 g-3">
        {{-- Patient Card --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-person-badge me-2 text-primary"></i>Data Pasien</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div
                            style="width:60px;height:60px;background:var(--tblr-primary);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700">
                            {{ strtoupper(substr($diagnosis->patient_name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-weight-medium fs-4">{{ $diagnosis->patient_name }}</div>
                            <div class="text-secondary">{{ $diagnosis->gender }}</div>
                        </div>
                    </div>
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-secondary ps-0" width="45%">Tanggal Lahir</td>
                            <td class="font-weight-medium">{{ $diagnosis->birth_date->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Usia</td>
                            <td>{{ $diagnosis->age_months }} bulan ({{ floor($diagnosis->age_months / 12) }} thn
                                {{ $diagnosis->age_months % 12 }} bln)</td>
                        </tr>
                        @if ($diagnosis->phone)
                            <tr>
                                <td class="text-secondary ps-0">No. HP</td>
                                <td>{{ $diagnosis->phone }}</td>
                            </tr>
                        @endif
                        @if ($diagnosis->address)
                            <tr>
                                <td class="text-secondary ps-0">Alamat</td>
                                <td>{{ $diagnosis->address }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-secondary ps-0">Tgl Diagnosa</td>
                            <td>{{ $diagnosis->diagnosis_date->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary ps-0">Dibuat</td>
                            <td class="text-secondary small">{{ $diagnosis->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- DS Values --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-cpu me-2 text-primary"></i>Nilai Dempster-Shafer</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-secondary">Belief — Bel(X)</small>
                            <small
                                class="font-weight-medium text-primary">{{ round($diagnosis->belief_value * 100, 2) }}%</small>
                        </div>
                        <div class="progress" style="height:8px;border-radius:50px">
                            <div class="progress-bar bg-primary"
                                style="width:{{ round($diagnosis->belief_value * 100) }}%;border-radius:50px"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-secondary">Plausibility — Pls(X)</small>
                            <small class="font-weight-medium">{{ round((1 - $diagnosis->belief_value) * 100, 2) }}%</small>
                        </div>
                        <div class="progress" style="height:8px;border-radius:50px">
                            <div class="progress-bar bg-orange"
                                style="width:{{ round((1 - $diagnosis->belief_value) * 100) }}%;border-radius:50px"></div>
                        </div>
                    </div>
                    <div class="row g-2 mt-1">
                        <div class="col-6">
                            <div class="p-2 rounded text-center" style="background:#e8f1fd">
                                <div style="font-size:20px;font-weight:700;color:var(--tblr-primary)">
                                    {{ $diagnosis->belief_value }}</div>
                                <small class="text-secondary">Bel(X)</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded text-center" style="background:#fef0e7">
                                <div style="font-size:20px;font-weight:700;color:#f39c12">{{ $selectedSymptoms->count() }}
                                </div>
                                <small class="text-secondary">Gejala Dipilih</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diagnosis Result + Symptoms --}}
        <div class="col-lg-8">
            {{-- Result --}}
            @if ($diagnosis->disease)
                <div class="card" style="overflow:hidden">
                    <div
                        style="background:linear-gradient(135deg,{{ $diagnosis->disease->code === 'P1' ? '#106eea,#0d58c0' : '#e84545,#c0392b' }});padding:24px;color:#fff">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width:50px;height:50px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px">
                                <i
                                    class="bi bi-{{ $diagnosis->disease->code === 'P1' ? 'check-circle' : 'exclamation-triangle' }}-fill"></i>
                            </div>
                            <div class="flex-fill">
                                <div style="opacity:.8;font-size:12px;text-transform:uppercase;letter-spacing:1px">Hasil
                                    Diagnosa</div>
                                <h3 style="font-weight:800;margin:4px 0">{{ $diagnosis->disease->name }}</h3>
                            </div>
                            <div class="text-center">
                                <div style="font-size:36px;font-weight:800">{{ round($diagnosis->belief_value * 100, 2) }}%
                                </div>
                                <small style="opacity:.8">Tingkat Keyakinan</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary" style="font-size:14px;line-height:1.8">
                            {{ $diagnosis->disease->description }}</p>
                        @if ($diagnosis->disease->treatment)
                            <hr>
                            <h6 class="font-weight-medium mb-2"><i
                                    class="bi bi-heart-pulse text-danger me-2"></i>Rekomendasi Penanganan</h6>
                            <div style="font-size:13px;color:#555;line-height:1.9;white-space:pre-line">
                                {{ $diagnosis->disease->treatment }}</div>
                        @endif
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-question-circle text-warning" style="font-size:50px"></i>
                        <h4 class="mt-3">Tidak Ada Diagnosis Pasti</h4>
                        <p class="text-secondary">Gejala tidak cukup untuk diagnosis. Diperlukan konsultasi dokter langsung.
                        </p>
                    </div>
                </div>
            @endif

            {{-- Selected Symptoms --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-list-check me-2 text-primary"></i>Gejala yang Dipilih
                        <span class="badge bg-primary ms-2">{{ $selectedSymptoms->count() }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach ($selectedSymptoms as $symptom)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-2 p-2 rounded"
                                    style="background:#e8f1fd;font-size:13px">
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    <div>
                                        <div class="font-weight-medium">{{ $symptom->name }}</div>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-secondary text-white"
                                                style="font-size:10px">{{ $symptom->code }}</span>
                                            <small class="text-secondary">Densitas: {{ $symptom->density }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Feedbacks --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-chat-dots me-2 text-primary"></i>Feedback Pasien
                        <span class="badge bg-primary ms-2">{{ $diagnosis->feedbacks->count() }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($diagnosis->feedbacks->isEmpty())
                        <div class="text-secondary text-center py-3">
                            <i class="bi bi-info-circle me-2"></i>Belum ada feedback dari pasien untuk diagnosis ini.
                        </div>
                    @else
                        <div class="d-flex flex-column gap-3">
                            @foreach ($diagnosis->feedbacks as $feedback)
                                <div class="border rounded p-3" style="background:#f8fbff">
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <div>
                                            <div class="fw-semibold">{{ $feedback->patient_name }}</div>
                                            <small class="text-secondary">ID Pasien / Diagnosis:
                                                #{{ $feedback->diagnosis_id ?? $diagnosis->id }}</small>
                                        </div>
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="bi bi-star-fill me-1"></i>{{ $feedback->rating }}/5
                                        </span>
                                    </div>
                                    <div class="text-secondary" style="font-size:14px;line-height:1.7">
                                        {{ $feedback->comments }}
                                    </div>
                                    <div class="mt-2 text-secondary small">
                                        <i class="bi bi-clock me-1"></i>{{ $feedback->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
