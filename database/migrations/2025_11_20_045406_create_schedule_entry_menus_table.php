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
        Schema::create('schedule_entry_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_item_id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('student_id');
            $table->date('date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('product');
            $table->string('school');
            $table->string('grade');
            $table->string('color');
            $table->json('allergies')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_entry_menus');
    }
};
