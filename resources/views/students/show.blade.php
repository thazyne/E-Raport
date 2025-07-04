@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Siswa</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>NISN:</strong> {{ $student->nisn }}</p>
            <p><strong>Nama:</strong> {{ $student->nama }}</p>
            <p><strong>Alamat:</strong> {{ $student->alamat }}</p>
            <p><strong>Kelas:</strong> {{ $student->kelas }}</p>
            <p><strong>Semester:</strong> {{ $student->semester }}</p>
            <p><strong>Tahun Masuk:</strong> {{ $student->tahun_masuk }}</p>
            <a href="{{ route('students.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
