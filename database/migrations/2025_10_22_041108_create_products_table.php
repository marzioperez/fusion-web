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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('status')->nullable()->default(Status::PUBLISHED->value);
            $table->decimal('price', 15)->nullable()->default(0);
            $table->decimal('offer_price', 15)->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
