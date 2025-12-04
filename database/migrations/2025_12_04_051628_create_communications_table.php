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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('message');
            $table->json('attach_files')->nullable()->default(null);
            $table->boolean('send_all')->default(true);
            $table->json('school_ids')->nullable()->default(null);
            $table->unsignedInteger('total_recipients')->nullable()->default(0);
            $table->string('status')->nullable()->default(Status::QUEUED->value);
            $table->timestamp('sent_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
