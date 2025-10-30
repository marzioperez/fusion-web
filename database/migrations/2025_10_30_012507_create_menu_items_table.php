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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->nullable()->default(null);
            $table->string('type')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->boolean('open_in_new_window')->nullable()->default(false);
            $table->boolean('style_button')->nullable()->default(false);
            $table->boolean('anchor_button')->nullable()->default(false);
            $table->integer('order_column')->default(0);
            $table->boolean('show')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
