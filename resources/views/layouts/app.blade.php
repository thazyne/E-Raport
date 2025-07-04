<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #212529;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #495057;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        @if(auth('admin')->check())
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                                <span class="me-2">🏠</span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                                <span class="me-2">👨‍🎓</span> Manajemen Siswa
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('admin/subjects*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">
                                <span class="me-2">📚</span> Manajemen Mapel
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('admin/grades*') ? 'active' : '' }}" href="{{ route('grades.index') }}">
                                <span class="me-2">📝</span> Manajemen Nilai
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('admin/grades/create') ? 'active' : '' }}" href="{{ route('grades.create') }}">
                                <span class="me-2">➕</span> Input Nilai Massal
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="{{ url('/admin/logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Logout</button>
                            </form>
                        </li>
                        @elseif(auth('student')->check())
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                                <span class="me-2">🏠</span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('siswa/profil') ? 'active' : '' }}" href="{{ route('student.profile') }}">
                                <span class="me-2">👤</span> Profil Siswa
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('siswa/raport') ? 'active' : '' }}" href="{{ route('student.raport') }}">
                                <span class="me-2">📄</span> Raport
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('siswa/update-password') ? 'active' : '' }}" href="{{ route('student.update_password') }}">
                                <span class="me-2">🔒</span> Update Password
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Logout</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <main class="col-md-10 ms-sm-auto px-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
