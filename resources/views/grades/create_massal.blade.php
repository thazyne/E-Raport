@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Input Nilai/Rapor Massal</h1>
    <form action="{{ route('grades.store') }}" method="POST" id="nilaiForm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="student_id" class="form-label">Siswa</label>
                <select name="student_id" class="form-control" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                <select name="tahun_ajaran" class="form-control" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="semester" class="form-label">Semester</label>
                <select name="semester" class="form-control" required>
                    <option value="">Pilih Semester</option>
                    @foreach($semesterList as $smt)
                        <option value="{{ $smt }}">{{ $smt }}</option>
                    @endforeach
                </select>
            </div>
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
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->nama_mapel }}</td>
                    <td><input type="number" name="nilai[{{ $subject->id }}]" class="form-control nilai-input" min="0" max="100"></td>
                    <td><input type="text" class="form-control predikat-input" readonly></td>
                    <td><input type="text" class="form-control deskripsi-input" readonly></td>
                    <td><textarea name="komentar_guru[{{ $subject->id }}]" class="form-control" rows="2" placeholder="Komentar untuk {{ $subject->nama_mapel }}..."></textarea></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Simpan Semua Nilai</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script>
function getPredikat(nilai) {
    if (nilai >= 90) return 'A';
    if (nilai >= 80) return 'B';
    if (nilai >= 70) return 'C';
    if (nilai >= 60) return 'D';
    return 'E';
}
function getDeskripsi(nilai) {
    if (nilai >= 90) return 'Sangat Baik';
    if (nilai >= 80) return 'Baik';
    if (nilai >= 70) return 'Cukup';
    if (nilai >= 60) return 'Kurang';
    return 'Sangat Kurang';
}
document.querySelectorAll('.nilai-input').forEach(function(input, idx) {
    input.addEventListener('input', function() {
        var nilai = parseInt(this.value) || 0;
        var row = this.closest('tr');
        row.querySelector('.predikat-input').value = getPredikat(nilai);
        row.querySelector('.deskripsi-input').value = getDeskripsi(nilai);
    });
});
</script>
@endsection
