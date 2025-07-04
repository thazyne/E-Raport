@extends('layouts.app')
@section('content')
<div class="container" style="max-width:400px;">
    <h1>Update Password</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('student.update_password.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
    </form>
</div>
@endsection
