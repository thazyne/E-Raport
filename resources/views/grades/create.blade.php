@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Input Nilai/Rapor</h1>
    <form action="{{ route('grades.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Siswa</label>
            <select name="student_id" class="form-control" required>
                <option value="">Pilih Siswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Mata Pelajaran</label>
            <select name="subject_id" class="form-control" required>
                <option value="">Pilih Mapel</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" value="{{ old('semester') }}" required>
        </div>
        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran') }}" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" class="form-control" value="{{ old('nilai') }}" required>
        </div>
        <div class="mb-3">
            <label for="predikat" class="form-label">Predikat</label>
            <input type="text" name="predikat" class="form-control" value="{{ old('predikat') }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
