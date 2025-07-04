@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Dashboard Siswa</h1>
    
    <div>
        <strong>Selamat datang, {{ $student->nama }}</strong>
    </div>
</div>
@endsection
