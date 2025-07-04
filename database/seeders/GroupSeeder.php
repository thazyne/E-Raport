<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['id' => 1, 'nama_kelompok' => 'A', 'keterangan' => 'Umum'],
            ['id' => 2, 'nama_kelompok' => 'B', 'keterangan' => 'Peminatan IPA'],
            ['id' => 3, 'nama_kelompok' => 'C', 'keterangan' => 'Peminatan IPS'],
        ];
        foreach ($groups as $group) {
            Group::updateOrCreate(['id' => $group['id']], $group);
        }
    }
}
