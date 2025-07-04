<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        return view('student.dashboard', compact('student'));
    }

    public function profile()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile', compact('student'));
    }

    public function raport(Request $request)
    {
        $student = Auth::guard('student')->user();
        $semester = $request->get('semester');
        $tahun_ajaran = $request->get('tahun_ajaran');
        $query = \App\Models\Grade::with('subject')
            ->where('student_id', $student->id);
        if ($semester) {
            $query->where('semester', $semester);
        }
        if ($tahun_ajaran) {
            $query->where('tahun_ajaran', $tahun_ajaran);
        }
        $grades = $query->get();
        $semesterList = ['Ganjil', 'Genap'];
        $tahunList = ['2023/2024', '2024/2025', '2025/2026'];
        return view('student.raport', compact('student', 'grades', 'semesterList', 'tahunList', 'semester', 'tahun_ajaran'));
    }

    public function showUpdatePassword()
    {
        return view('student.update_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $student = Auth::guard('student')->user();
        $student->password = Hash::make($request->password);
        $student->save();
        return back()->with('success', 'Password berhasil diupdate.');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }

    public function exportRaportPdf(Request $request)
    {
        $student = Auth::guard('student')->user();
        $semester = $request->get('semester');
        $tahun_ajaran = $request->get('tahun_ajaran');
        $query = \App\Models\Grade::with('subject')
            ->where('student_id', $student->id);
        if ($semester) {
            $query->where('semester', $semester);
        }
        if ($tahun_ajaran) {
            $query->where('tahun_ajaran', $tahun_ajaran);
        }
        $grades = $query->get();
        $safeNama = preg_replace('/[^A-Za-z0-9_-]/', '_', $student->nama);
        $safeSemester = $semester ? preg_replace('/[^A-Za-z0-9_-]/', '_', $semester) : 'all';
        $safeTahun = $tahun_ajaran ? preg_replace('/[^A-Za-z0-9_-]/', '_', $tahun_ajaran) : 'all';
        $filename = 'raport-'.$safeNama.'-'.$safeSemester.'-'.$safeTahun.'.pdf';
        $pdf = \PDF::loadView('student.raport_pdf', compact('student', 'grades', 'semester', 'tahun_ajaran'));
        return $pdf->download($filename);
    }

    public function exportRaportExcel(Request $request)
    {
        $student = Auth::guard('student')->user();
        $semester = $request->get('semester');
        $tahun_ajaran = $request->get('tahun_ajaran');
        $query = \App\Models\Grade::with('subject')
            ->where('student_id', $student->id);
        if ($semester) {
            $query->where('semester', $semester);
        }
        if ($tahun_ajaran) {
            $query->where('tahun_ajaran', $tahun_ajaran);
        }
        $grades = $query->get();
        $safeNama = preg_replace('/[^A-Za-z0-9_-]/', '_', $student->nama);
        $safeSemester = $semester ? preg_replace('/[^A-Za-z0-9_-]/', '_', $semester) : 'all';
        $safeTahun = $tahun_ajaran ? preg_replace('/[^A-Za-z0-9_-]/', '_', $tahun_ajaran) : 'all';
        $filename = 'raport-'.$safeNama.'-'.$safeSemester.'-'.$safeTahun.'.xlsx';
        return Excel::download(new \App\Exports\RaportExport($student, $grades, $semester, $tahun_ajaran), $filename);
    }

    public function exportProfilePdf()
    {
        $student = Auth::guard('student')->user();
        $pdf = \PDF::loadView('student.profile_pdf', compact('student'));
        $safeNama = preg_replace('/[^A-Za-z0-9_-]/', '_', $student->nama);
        return $pdf->download('profil-'.$safeNama.'.pdf');
    }

    public function exportProfileExcel()
    {
        $student = Auth::guard('student')->user();
        return Excel::download(new \App\Exports\ProfileExport($student), 'profil-'.preg_replace('/[^A-Za-z0-9_-]/', '_', $student->nama).'.xlsx');
    }
}
