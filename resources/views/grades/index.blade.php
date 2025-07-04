@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Nilai/Rapor</h1>
    <a href="{{ route('grades.create') }}" class="btn btn-primary mb-3">Input Nilai</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Detail Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php $siswaSudah = []; @endphp
            @foreach($grades as $grade)
                @if(!in_array($grade->student_id . '-' . $grade->semester . '-' . $grade->tahun_ajaran, $siswaSudah))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $grade->student->nama ?? '-' }}</td>
                        <td>{{ $grade->semester }}</td>
                        <td>{{ $grade->tahun_ajaran }}</td>
                        <td>
                            <a href="{{ route('grades.show', ['grade' => $grade->id]) }}" class="btn btn-info btn-sm">Detail Nilai</a>
                        </td>
                    </tr>
                    @php $siswaSudah[] = $grade->student_id . '-' . $grade->semester . '-' . $grade->tahun_ajaran; @endphp
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
