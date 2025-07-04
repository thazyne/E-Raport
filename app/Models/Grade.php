<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'subject_id', 'semester', 'tahun_ajaran', 'nilai', 'predikat', 'deskripsi'
    ];

    public function student() {
        return $this->belongsTo(\App\Models\Student::class);
    }
    public function subject() {
        return $this->belongsTo(\App\Models\Subject::class);
    }
}
