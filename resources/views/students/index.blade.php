@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pilih Tahun Masuk</h1>
    <form method="GET" action="" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-auto">
                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                <select name="tahun_masuk" id="tahun_masuk" class="form-control">
                    <option value="">Pilih Tahun Masuk</option>
                    @php
                        $tahunList = ['2023/2024', '2024/2025', '2025/2026'];
                    @endphp
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_masuk') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>
    @if(request('tahun_masuk'))
        <h2>Daftar Siswa Tahun Masuk {{ request('tahun_masuk') }}</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tahun Masuk</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->alamat }}</td>
                    <td>{{ $student->tahun_masuk }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
