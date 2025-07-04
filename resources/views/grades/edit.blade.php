@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Nilai/Rapor</h1>
    <form action="{{ route('grades.update', $grade->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="student_id" class="form-label">Siswa</label>
            <select name="student_id" class="form-control" required>
                <option value="">Pilih Siswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ (old('student_id', $grade->student_id) == $student->id) ? 'selected' : '' }}>{{ $student->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Mata Pelajaran</label>
            <select name="subject_id" class="form-control" required>
                <option value="">Pilih Mapel</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ (old('subject_id', $grade->subject_id) == $subject->id) ? 'selected' : '' }}>{{ $subject->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" value="{{ old('semester', $grade->semester) }}" required>
        </div>
        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', $grade->tahun_ajaran) }}" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" class="form-control" value="{{ old('nilai', $grade->nilai) }}" required>
        </div>
        <div class="mb-3">
            <label for="predikat" class="form-label">Predikat</label>
            <input type="text" name="predikat" class="form-control" value="{{ old('predikat', $grade->predikat) }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $grade->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="komentar_guru" class="form-label">Komentar Guru</label>
            <textarea name="komentar_guru" class="form-control" rows="3" placeholder="Tambahkan komentar atau saran untuk siswa...">{{ old('komentar_guru', $grade->komentar_guru) }}</textarea>
            <small class="form-text text-muted">Komentar ini akan ditampilkan di rapor siswa</small>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
