<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelompok', 'keterangan'];

    public function subjects() {
        return $this->hasMany(Subject::class);
    }
}
