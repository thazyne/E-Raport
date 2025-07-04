@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Nilai Siswa</h1>
    <div class="mb-3">
        <strong>Nama Siswa:</strong> {{ $grade->student->nama ?? '-' }}<br>
        <strong>Semester:</strong> {{ $grade->semester }}<br>
        <strong>Tahun Ajaran:</strong> {{ $grade->tahun_ajaran }}
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
                <th>Komentar Guru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allGrades as $g)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $g->subject->nama_mapel ?? '-' }}</td>
                <td>{{ $g->nilai }}</td>
                <td>{{ $g->predikat }}</td>
                <td>{{ $g->deskripsi }}</td>
                <td>
                    @if($g->komentar_guru)
                        <div class="text-muted small">{{ $g->komentar_guru }}</div>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('grades.edit', $g->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('grades.destroy', $g->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
