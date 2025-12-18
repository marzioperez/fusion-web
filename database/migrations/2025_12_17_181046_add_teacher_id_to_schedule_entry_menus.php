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
        Schema::table('schedule_entry_menus', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id')->nullable()->default(null)->after('grade_id');
            $table->string('teacher_name')->nullable()->default(null)->after('grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_entry_menus', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
            $table->dropColumn('teacher_name');
        });
    }
};
