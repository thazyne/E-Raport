<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .profile-container { max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; padding: 30px; background: #f9f9f9; }
        .profile-header { text-align: center; margin-bottom: 30px; }
        .profile-header h2 { margin: 0; font-size: 2em; color: #2d3748; }
        .profile-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .profile-table th, .profile-table td { text-align: left; padding: 8px 12px; }
        .profile-table th { background: #edf2f7; color: #4a5568; width: 35%; }
        .profile-table tr:nth-child(even) { background: #f7fafc; }
        .profile-footer { text-align: right; color: #888; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Profil Siswa</h2>
        </div>
        <table class="profile-table">
            <tr>
                <th>NISN</th>
                <td>{{ $student->nisn }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $student->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $student->alamat }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $student->kelas }}</td>
            </tr>
            <tr>
                <th>Tahun Masuk</th>
                <td>{{ $student->tahun_masuk }}</td>
            </tr>
            <tr>
                <th>Tanggal Registrasi</th>
                <td>{{ $student->created_at ? $student->created_at->format('Y-m-d') : '-' }}</td>
            </tr>
        </table>
        <div class="profile-footer">
            Dicetak pada: {{ date('Y-m-d H:i') }}
        </div>
    </div>
</body>
</html>
