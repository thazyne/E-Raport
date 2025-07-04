<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $tahunList = ['2023/2024', '2024/2025', '2025/2026'];
        $semesterList = ['Ganjil', 'Genap'];
        return view('grades.create_massal', compact('students', 'subjects', 'tahunList', 'semesterList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|integer',
        ]);
        $student_id = $request->student_id;
        $tahun_ajaran = $request->tahun_ajaran;
        $semester = $request->semester;
        foreach ($request->nilai as $subject_id => $nilai) {
            if ($nilai !== null) {
                $predikat = $this->getPredikat($nilai);
                $deskripsi = $this->getDeskripsi($nilai);
                Grade::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'subject_id' => $subject_id,
                        'tahun_ajaran' => $tahun_ajaran,
                        'semester' => $semester,
                    ],
                    [
                        'nilai' => $nilai,
                        'predikat' => $predikat,
                        'deskripsi' => $deskripsi,
                    ]
                );
            }
        }
        return redirect()->route('grades.index')->with('success', 'Nilai berhasil disimpan.');
    }

    private function getPredikat($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 80) return 'B';
        if ($nilai >= 70) return 'C';
        if ($nilai >= 60) return 'D';
        return 'E';
    }

    private function getDeskripsi($nilai)
    {
        if ($nilai >= 90) return 'Sangat Baik';
        if ($nilai >= 80) return 'Baik';
        if ($nilai >= 70) return 'Cukup';
        if ($nilai >= 60) return 'Kurang';
        return 'Sangat Kurang';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::with(['student'])->findOrFail($id);
        $allGrades = Grade::with(['subject'])
            ->where('student_id', $grade->student_id)
            ->where('semester', $grade->semester)
            ->where('tahun_ajaran', $grade->tahun_ajaran)
            ->get();
        return view('grades.show', [
            'grade' => $grade,
            'allGrades' => $allGrades
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'nilai' => 'required|integer',
            'predikat' => 'nullable',
            'deskripsi' => 'nullable',
        ]);
        $grade = Grade::findOrFail($id);
        $grade->update($request->all());
        return redirect()->route('grades.index')->with('success', 'Nilai berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
