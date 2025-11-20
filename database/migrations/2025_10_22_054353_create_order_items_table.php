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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();

            $table->unsignedInteger('product_id')->nullable()->default(null);
            $table->string('name');
            $table->string('label')->nullable()->default(null);
            $table->unsignedInteger('student_id')->nullable()->default(null);
            $table->string('student_name')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('menu_entry_id')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);

            $table->decimal('price', 15)->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('total', 15)->nullable()->default(0);

            $table->json('data')->nullable()->default(null);

            $table->string('status')->nullable()->default(Status::PENDING->value);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
