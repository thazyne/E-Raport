@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Profil Siswa</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>NISN:</strong> {{ $student->nisn }}</p>
            <p><strong>Nama:</strong> {{ $student->nama }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Alamat:</strong> {{ $student->alamat }}</p>
            <p><strong>Kelas:</strong> {{ $student->kelas }}</p>
            <p><strong>Tahun Masuk:</strong> {{ $student->tahun_masuk }}</p>
        </div>
    </div>
    <a href="{{ route('student.profile.pdf') }}" class="btn btn-success" target="_blank">Cetak PDF</a>
    <a href="{{ route('student.profile.excel') }}" class="btn btn-info">Export Excel</a>
    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
