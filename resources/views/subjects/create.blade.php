@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mata Pelajaran</h1>
    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_mapel" class="form-label">Nama Mapel</label>
            <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel') }}" required>
        </div>
        <div class="mb-3">
            <label for="group_id" class="form-label">Kelompok</label>
            <select name="group_id" class="form-control" required onchange="showKeterangan()">
                <option value="">Pilih Kelompok</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" data-keterangan="{{ $group->keterangan }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->nama_kelompok }}</option>
                @endforeach
            </select>
            <small id="keterangan-group" class="form-text text-muted mt-1"></small>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script>
function showKeterangan() {
    var select = document.querySelector('select[name=group_id]');
    var selected = select.options[select.selectedIndex];
    var keterangan = selected.getAttribute('data-keterangan') || '';
    document.getElementById('keterangan-group').innerText = keterangan;
}
document.addEventListener('DOMContentLoaded', showKeterangan);
document.querySelector('select[name=group_id]').addEventListener('change', showKeterangan);
</script>
@endsection
