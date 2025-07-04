<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['nama_mapel' => 'Matematika', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Bahasa Indonesia', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Bahasa Inggris', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Ilmu Pengetahuan Alam', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Ilmu Pengetahuan Sosial', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Pendidikan Agama', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Pendidikan Kewarganegaraan', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Seni Budaya', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Pendidikan Jasmani', 'peminatan' => null, 'group_id' => 1],
            ['nama_mapel' => 'Fisika', 'peminatan' => 'IPA', 'group_id' => 2],
            ['nama_mapel' => 'Kimia', 'peminatan' => 'IPA', 'group_id' => 2],
            ['nama_mapel' => 'Ekonomi', 'peminatan' => 'IPS', 'group_id' => 3],
        ];
        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
