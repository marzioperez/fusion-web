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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->default(null);
            $table->json('content')->nullable()->default(null);
            $table->boolean('is_home')->nullable()->default(false);
            $table->string('layout')->nullable()->default('components.layouts.app');
            $table->string('header_position')->nullable()->default('fixed');
            $table->string('status')->nullable()->default(Status::PUBLISHED->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
