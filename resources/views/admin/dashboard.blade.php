@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <p class="card-text display-6">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Mapel</h5>
                    <p class="card-text display-6">{{ $totalSubjects }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Siswa Terbaru</div>
                <ul class="list-group list-group-flush">
                    @foreach($latestStudents as $student)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $student->nama }}
                            <span class="badge bg-primary">{{ $student->kelas }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Mapel Terbaru</div>
                <ul class="list-group list-group-flush">
                    @foreach($latestSubjects as $subject)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $subject->nama_mapel }}
                            <span class="badge bg-success">{{ $subject->group->nama_kelompok ?? '-' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div>
        Guard admin: {{ auth('admin')->check() ? 'YA' : 'TIDAK' }}
    </div>
</div>
@endsection
