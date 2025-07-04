@extends('layouts.app')
@section('content')
<div class="container" style="max-width:400px;">
    <h2 class="mb-4">Login Siswa</h2>
    <form method="POST" action="{{ route('student.login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
