<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'tahun_pelajaran')) {
                $table->dropColumn('tahun_pelajaran');
            }
            if (!Schema::hasColumn('students', 'tahun_masuk')) {
                $table->string('tahun_masuk')->nullable()->after('semester');
            }
            if (!Schema::hasColumn('students', 'email')) {
                $table->string('email')->unique()->nullable()->after('nama');
            }
            if (!Schema::hasColumn('students', 'password')) {
                $table->string('password')->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'tahun_masuk')) {
                $table->dropColumn('tahun_masuk');
            }
            if (Schema::hasColumn('students', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('students', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};
