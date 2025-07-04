@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <p class="card-text display-6">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Mapel</h5>
                    <p class="card-text display-6">{{ $totalSubjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Nilai</h5>
                    <p class="card-text display-6">{{ $totalGrades }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Rata-rata Nilai</h5>
                    <p class="card-text display-6">{{ number_format($avgGrade, 1) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grade Distribution Chart -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Distribusi Predikat Nilai</div>
                <div class="card-body">
                    <canvas id="gradeChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Aktivitas Terbaru</div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @foreach($recentGrades as $grade)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong>{{ $grade->student->nama ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $grade->subject->nama_mapel ?? '-' }} - Nilai: {{ $grade->nilai }}</small>
                            </div>
                            <span class="badge bg-{{ $grade->predikat == 'A' ? 'success' : ($grade->predikat == 'B' ? 'primary' : ($grade->predikat == 'C' ? 'warning' : 'danger')) }}">
                                {{ $grade->predikat }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Latest Data -->
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
    
    <div class="mt-3">
        Guard admin: {{ auth('admin')->check() ? 'YA' : 'TIDAK' }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grade Distribution Chart
const ctx = document.getElementById('gradeChart').getContext('2d');
const gradeChart = new Chart(ctx, {
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
@endsection
