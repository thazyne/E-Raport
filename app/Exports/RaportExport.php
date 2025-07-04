<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RaportExport implements FromArray, WithHeadings
{
    protected $student;
    protected $grades;
    protected $semester;
    protected $tahun_ajaran;

    public function __construct($student, $grades, $semester, $tahun_ajaran)
    {
        $this->student = $student;
        $this->grades = $grades;
        $this->semester = $semester;
        $this->tahun_ajaran = $tahun_ajaran;
    }

    public function array(): array
    {
        $data = [];
        foreach ($this->grades as $grade) {
            $data[] = [
                $this->student->nis ?? $this->student->nisn,
                $this->student->nama,
                $grade->subject->nama ?? '-',
                $grade->nilai,
                $grade->semester,
                $grade->tahun_ajaran,
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Mata Pelajaran',
            'Nilai',
            'Semester',
            'Tahun Ajaran',
        ];
    }
}
