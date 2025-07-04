<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfileExport implements FromArray, WithHeadings
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function array(): array
    {
        return [[
            $this->student->nis ?? $this->student->nisn,
            $this->student->nama,
            $this->student->email,
            $this->student->alamat,
            $this->student->kelas,
            $this->student->tahun_masuk,
            $this->student->created_at ? $this->student->created_at->format('Y-m-d') : '-',
        ]];
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
            'Email',
            'Alamat',
            'Kelas',
            'Tahun Masuk',
            'Tanggal Registrasi',
        ];
    }
}
