<?php

use App\Enums\Status;
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
        Schema::create('request_registers', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable();
            $table->integer('step')->nullable()->default(1);
            $table->json('data');
            $table->json('students')->nullable()->default(null);
            $table->string('status')->nullable()->default(Status::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_registers');
    }
};
