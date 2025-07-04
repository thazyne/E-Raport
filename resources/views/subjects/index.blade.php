@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mata Pelajaran</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Tambah Mapel</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Kelompok</th>
                <th>Keterangan</th>
               
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->nama_mapel }}</td>
                <td>{{ $subject->group->nama_kelompok ?? '-' }}</td>
                <td>{{ $subject->group->keterangan ?? '-' }}</td>
            
                <td>
                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
