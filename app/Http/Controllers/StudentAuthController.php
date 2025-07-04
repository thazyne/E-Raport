<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $student = Student::where('email', $request->email)->first();
        if ($student && \Hash::check($request->password, $student->password)) {
            Auth::guard('student')->login($student);
            return redirect()->route('student.dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
}
