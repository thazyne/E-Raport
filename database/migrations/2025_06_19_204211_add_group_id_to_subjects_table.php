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
        Schema::table('subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'group_id')) {
                $table->unsignedBigInteger('group_id')->nullable()->after('id');
                $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            }
            if (Schema::hasColumn('subjects', 'kelompok')) {
                $table->dropColumn('kelompok');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'kelompok')) {
                $table->string('kelompok')->nullable();
            }
            if (Schema::hasColumn('subjects', 'group_id')) {
                $table->dropForeign(['group_id']);
                $table->dropColumn('group_id');
            }
        });
    }
};
