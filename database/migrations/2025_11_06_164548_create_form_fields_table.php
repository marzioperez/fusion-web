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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('name');
            $table->string('slug')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->json('link')->nullable()->default(null);
            $table->json('options')->nullable()->default(null);
            $table->longText('content')->nullable()->default(null);
            $table->string('default_value')->nullable()->default(null);
            $table->integer('order_column')->nullable()->default(0);
            $table->boolean('show')->nullable()->default(true);
            $table->boolean('required')->nullable()->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
