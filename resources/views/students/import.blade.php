@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Import Data Siswa</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload File Excel/CSV</div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <form action="{{ route('students.process-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">File Excel/CSV</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            <small class="form-text text-muted">Format yang diterima: .xlsx, .xls, .csv</small>
                        </div>
                        <button type="submit" class="btn btn-success">Import Data</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Format File</div>
                <div class="card-body">
                    <p>File harus memiliki kolom berikut:</p>
                    <ul>
                        <li><strong>nisn</strong> - Nomor Induk Siswa Nasional</li>
                        <li><strong>nama</strong> - Nama lengkap siswa</li>
                        <li><strong>email</strong> - Email siswa (opsional)</li>
                        <li><strong>password</strong> - Password login (opsional)</li>
                        <li><strong>alamat</strong> - Alamat siswa (opsional)</li>
                        <li><strong>kelas</strong> - Kelas siswa</li>
                        <li><strong>tahun_masuk</strong> - Tahun masuk (opsional)</li>
                    </ul>
                    
                    <div class="mt-3">
                        <a href="{{ route('students.download-template') }}" class="btn btn-outline-primary btn-sm">
                            Download Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection