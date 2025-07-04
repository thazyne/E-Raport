@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Siswa</h1>
    
    <div class="alert alert-info">
        <h5>Selamat datang, {{ $student->nama }}</h5>
        <p class="mb-0">Kelas: {{ $student->kelas }} | NISN: {{ $student->nisn }}</p>
    </div>
    
    <!-- Performance Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Nilai</h5>
                    <p class="card-text display-6">{{ $totalGrades }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Rata-rata Nilai</h5>
                    <p class="card-text display-6">{{ $avgGrade ? number_format($avgGrade, 1) : '-' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Prestasi Terbaik</h5>
                    <p class="card-text display-6">{{ $gradeDistribution['A'] }}</p>
                    <small>Nilai A</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Grade Distribution Chart -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Distribusi Nilai Saya</div>
                <div class="card-body">
                    @if($totalGrades > 0)
                        <canvas id="studentGradeChart" width="400" height="200"></canvas>
                    @else
                        <div class="text-center text-muted">
                            <p>Belum ada data nilai</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Latest Grades -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Nilai Terbaru</div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse($latestGrades as $grade)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong>{{ $grade->subject->nama_mapel ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $grade->semester }} - {{ $grade->tahun_ajaran }}</small>
                                @if($grade->komentar_guru)
                                    <br><small class="text-primary">"{{ $grade->komentar_guru }}"</small>
                                @endif
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $grade->predikat == 'A' ? 'success' : ($grade->predikat == 'B' ? 'primary' : ($grade->predikat == 'C' ? 'warning' : 'danger')) }} fs-6">
                                    {{ $grade->nilai }}
                                </span><br>
                                <small class="text-muted">{{ $grade->predikat }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted">
                            <p>Belum ada nilai yang diinput</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row g-4 mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Menu Cepat</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('student.raport') }}" class="btn btn-primary">
                            <i class="fas fa-file-alt"></i> Lihat Raport
                        </a>
                        <a href="{{ route('student.profile') }}" class="btn btn-info">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                        <a href="{{ route('student.update_password') }}" class="btn btn-warning">
                            <i class="fas fa-key"></i> Ganti Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($totalGrades > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Student Grade Distribution Chart
const ctx = document.getElementById('studentGradeChart').getContext('2d');
const studentGradeChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['A', 'B', 'C', 'D', 'E'],
        datasets: [{
            data: [
                {{ $gradeDistribution['A'] }},
                {{ $gradeDistribution['B'] }},
                {{ $gradeDistribution['C'] }},
                {{ $gradeDistribution['D'] }},
                {{ $gradeDistribution['E'] }}
            ],
            backgroundColor: [
                '#28a745',
                '#007bff', 
                '#ffc107',
                '#fd7e14',
                '#dc3545'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>
@endif
@endsection
