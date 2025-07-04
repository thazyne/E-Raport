@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Raport Siswa</h1>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $student->nama }}<br>
        <strong>Kelas:</strong> {{ $student->kelas }}<br>
        <strong>Tahun Masuk:</strong> {{ $student->tahun_masuk }}
    </div>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
            <select name="semester" class="form-control">
                <option value="">Pilih Semester</option>
                @foreach($semesterList as $s)
                    <option value="{{ $s }}" {{ (request('semester') == $s) ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <select name="tahun_ajaran" class="form-control">
                <option value="">Pilih Tahun Ajaran</option>
                @foreach($tahunList as $t)
                    <option value="{{ $t }}" {{ (request('tahun_ajaran') == $t) ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>
    @if(request('semester') && request('tahun_ajaran') && isset($grades) && count($grades))
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Predikat</th>
                    <th>Deskripsi</th>
                    <th>Komentar Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->subject->nama_mapel ?? '-' }}</td>
                    <td>{{ $g->nilai }}</td>
                    <td>{{ $g->predikat }}</td>
                    <td>{{ $g->deskripsi }}</td>
                    <td>
                        @if($g->komentar_guru)
                            <div class="text-primary small">{{ $g->komentar_guru }}</div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(request('semester') && request('tahun_ajaran'))
            <div class="alert alert-warning mt-4">Data nilai tidak ditemukan.</div>
        @endif
        <a href="{{ route('student.raport.pdf', request()->all()) }}" class="btn btn-success" target="_blank">Cetak PDF</a>
        <a href="{{ route('student.raport.excel', request()->all()) }}" class="btn btn-info">Export Excel</a>
        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
