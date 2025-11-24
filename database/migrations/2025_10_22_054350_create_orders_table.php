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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cart_id')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->integer('number')->nullable()->default(null);

            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);

            $table->string('status')->nullable()->default(Status::PENDING->value);
            $table->string('payment_status')->nullable()->default(Status::PENDING->value);

            $table->decimal('sub_total', 15)->nullable()->default(0);
            $table->decimal('discount', 15)->nullable()->default(0);
            $table->decimal('credits', 15)->nullable()->default(0);
            $table->decimal('delivery', 15)->nullable()->default(0);
            $table->decimal('processing_fee', 15)->nullable()->default(0);
            $table->decimal('total', 15)->nullable()->default(0);
            $table->decimal('weight', 15)->nullable()->default(0);

            $table->string('coupon_code')->nullable()->default(null);

            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->longText('payment_error_message')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
