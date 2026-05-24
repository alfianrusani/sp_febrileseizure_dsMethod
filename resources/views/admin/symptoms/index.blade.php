@extends('layouts.admin')
@section('title', 'Data Gejala')

@section('content')
<div class="page-header pt-4">
  <div class="row align-items-center">
    <div class="col">
      <h2 class="page-title"><i class="bi bi-thermometer-half me-2 text-danger"></i>Data Gejala</h2>
      <div class="text-secondary">Kelola daftar gejala penyakit kejang demam</div>
    </div>
    <div class="col-auto">
      <a href="{{ route('admin.symptoms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Gejala
      </a>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header">
    <div class="input-group" style="max-width:300px">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="tableSearch" class="form-control" placeholder="Cari gejala...">
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-vcenter" id="symptomTable">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="8%">Kode</th>
            <th>Nama Gejala</th>
            <th>Densitas</th>
            <th width="20%">Kode Penyakit</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($symptoms as $i => $s)
          <tr>
            <td class="text-secondary text-center">{{ $i + 1 }}</td>
            <td><span class="badge bg-warning text-white">{{ $s->code }}</span></td>
            <td class="font-weight-medium">{{ $s->name }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="progress" style="width:50px;height:6px;border-radius:50px">
                  <div class="progress-bar bg-primary" style="width:{{ $s->density * 100 }}%;border-radius:50px"></div>
                </div>
                <small class="text-secondary">{{ $s->density }}</small>
              </div>
            </td>
            <td class="text-center">
              @foreach($s->diseases as $d)
                <span class="badge {{ $d->code === 'P1' ? 'bg-blue' : 'bg-red' }} text-white me-1" style="font-size:10px">
                  {{ $d->code }}
                </span>
              @endforeach
            </td>
            <td class="text-center">
              <a href="{{ route('admin.symptoms.edit', $s->id) }}" class="btn btn-sm btn-ghost-primary">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.symptoms.destroy', $s->id) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin hapus gejala ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-ghost-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center text-secondary py-5">Belum ada data gejala.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer text-secondary">
    Total: <strong>{{ $symptoms->count() }}</strong> gejala terdaftar
  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('tableSearch').addEventListener('input', function () {
  const q = this.value.toLowerCase();
  document.querySelectorAll('#symptomTable tbody tr').forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
});
</script>
@endpush
