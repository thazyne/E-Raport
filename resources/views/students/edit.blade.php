@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Siswa</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $student->nisn) }}" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $student->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $student->alamat) }}">
        </div>
        <div class="mb-3">
            <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
            <select name="tahun_masuk" class="form-control" required>
                <option value="">Pilih Tahun Masuk</option>
                @foreach($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ (old('tahun_masuk', $student->tahun_masuk) == $tahun) ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
