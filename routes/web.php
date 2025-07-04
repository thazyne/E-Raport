<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Admin;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Route login siswa
Route::get('/siswa/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/siswa/login', [StudentAuthController::class, 'login']);
Route::post('/siswa/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Contoh route dashboard admin (harusnya pakai middleware, akan dibuat setelah ini)
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $latestStudents = Student::latest()->take(5)->get();
        $latestSubjects = Subject::with('group')->latest()->take(5)->get();
        return view('admin.dashboard', compact('totalStudents', 'totalSubjects', 'latestStudents', 'latestSubjects'));
    })->name('admin.dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('grades', GradeController::class);
});

// Route dashboard & menu siswa (hanya untuk siswa yang login)
Route::middleware('auth:student')->prefix('siswa')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/profil', [StudentDashboardController::class, 'profile'])->name('student.profile');
    Route::get('/raport', [StudentDashboardController::class, 'raport'])->name('student.raport');
    Route::get('/update-password', [StudentDashboardController::class, 'showUpdatePassword'])->name('student.update_password');
    Route::post('/update-password', [StudentDashboardController::class, 'updatePassword'])->name('student.update_password.post');
    Route::post('/logout', [StudentDashboardController::class, 'logout'])->name('student.logout');
    Route::get('/raport/pdf', [StudentDashboardController::class, 'exportRaportPdf'])->name('student.raport.pdf');
    Route::get('/raport/excel', [StudentDashboardController::class, 'exportRaportExcel'])->name('student.raport.excel');
    Route::get('/profil/pdf', [StudentDashboardController::class, 'exportProfilePdf'])->name('student.profile.pdf');
    Route::get('/profil/excel', [StudentDashboardController::class, 'exportProfileExcel'])->name('student.profile.excel');
});
