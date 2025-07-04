@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Siswa</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
        </div>
        <div class="mb-3">
            <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
            <select name="tahun_masuk" class="form-control" required>
                <option value="">Pilih Tahun Masuk</option>
                @foreach($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ old('tahun_masuk') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
