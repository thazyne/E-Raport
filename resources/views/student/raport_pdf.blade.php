<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raport Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; color: #222; }
        .raport-container { max-width: 800px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #ddd; padding: 32px; }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 24px; }
        .info { margin-bottom: 24px; }
        .info strong { display: inline-block; width: 120px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { border: 1px solid #bbb; padding: 8px 12px; text-align: center; }
        th { background: #f0f0f0; color: #333; }
        tr:nth-child(even) { background: #f9f9f9; }
        .footer { text-align: right; font-size: 13px; color: #888; }
    </style>
</head>
<body>
    <div class="raport-container">
        <h2>RAPORT SISWA</h2>
        <div class="info">
            <div><strong>Nama</strong>: {{ $student->nama }}</div>
            <div><strong>Kelas</strong>: {{ $student->kelas }}</div>
            <div><strong>Tahun Masuk</strong>: {{ $student->tahun_masuk }}</div>
            @if(isset($semester) && $semester)
            <div><strong>Semester</strong>: {{ $semester }}</div>
            @endif
            @if(isset($tahun_ajaran) && $tahun_ajaran)
            <div><strong>Tahun Ajaran</strong>: {{ $tahun_ajaran }}</div>
            @endif
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Predikat</th>
                    <th>Deskripsi</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">Dicetak pada: {{ date('d-m-Y H:i') }}</div>
    </div>
</body>
</html>
