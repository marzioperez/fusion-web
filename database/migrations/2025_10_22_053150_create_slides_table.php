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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('content')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->integer('order_column')->default(0);
            $table->boolean('show')->nullable()->default(true);
            $table->foreignId('image_desktop_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('image_mobile_id')->nullable()->constrained('media')->nullOnDelete();
            $table->unsignedBigInteger('slider_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
