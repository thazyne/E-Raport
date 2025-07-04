<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'nisn' => $row['nisn'],
            'nama' => $row['nama'],
            'email' => $row['email'] ?? $row['nisn'] . '@student.sch.id',
            'password' => Hash::make($row['password'] ?? $row['nisn']),
            'alamat' => $row['alamat'] ?? '',
            'kelas' => $row['kelas'],
            'tahun_masuk' => $row['tahun_masuk'] ?? date('Y'),
        ]);
    }
}