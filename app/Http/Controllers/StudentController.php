<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::query();
        if ($request->filled('tahun_masuk')) {
            $query->where('tahun_masuk', $request->tahun_masuk);
        }
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }
        $students = $query->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahunList = [
            '2023/2024',
            '2024/2025',
            '2025/2026',
        ];
        return view('students.create', compact('tahunList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:students',
            'nama' => 'required',
            'alamat' => 'nullable',
            'tahun_masuk' => 'required',
        ]);
        $tahun_masuk = substr($request->tahun_masuk, 0, 4);
        $tahun_sekarang = date('Y');
        $kelas = 10 + ($tahun_sekarang - $tahun_masuk);
        if ($kelas < 10) $kelas = 10;
        if ($kelas > 12) $kelas = 12;
        $data = $request->only(['nisn', 'nama', 'alamat', 'tahun_masuk']);
        $data['kelas'] = $kelas;
        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $tahunList = [
            '2023/2024',
            '2024/2025',
            '2025/2026',
        ];
        return view('students.edit', compact('student', 'tahunList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|unique:students,nisn,' . $id,
            'nama' => 'required',
            'alamat' => 'nullable',
            'tahun_masuk' => 'required',
        ]);
        $tahun_masuk = substr($request->tahun_masuk, 0, 4);
        $tahun_sekarang = date('Y');
        $kelas = 10 + ($tahun_sekarang - $tahun_masuk);
        if ($kelas < 10) $kelas = 10;
        if ($kelas > 12) $kelas = 12;
        $data = $request->only(['nisn', 'nama', 'alamat', 'tahun_masuk']);
        $data['kelas'] = $kelas;
        $student = Student::findOrFail($id);
        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Siswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
    public function kelas(Request $request)
    {
        // Ambil tahun dari tahun pelajaran, misal '2023/2024' -> 2023
        $tahun_masuk = substr($request->tahun_pelajaran, 0, 4);
        $tahun_sekarang = date('Y');
        $kelas = 10 + ($tahun_sekarang - $tahun_masuk);
    }
}
