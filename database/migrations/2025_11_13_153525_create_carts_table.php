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
    public function up(): void {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->json('user_data')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->string('status')->nullable()->default(Status::PENDING->value);
            $table->json('items')->nullable()->default(null);
            $table->integer('total_items')->nullable()->default(0);
            $table->string('coupon_code')->nullable()->default(null);
            $table->decimal('sub_total', 15)->nullable()->default(0);
            $table->decimal('discount', 15)->nullable()->default(0);
            $table->decimal('delivery', 15)->nullable()->default(0);
            $table->decimal('processing_fee', 15)->nullable()->default(0);
            $table->decimal('total', 15)->nullable()->default(0);
            $table->decimal('weight', 15)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
