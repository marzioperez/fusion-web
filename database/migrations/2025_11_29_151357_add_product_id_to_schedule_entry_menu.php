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
        Schema::table('schedule_entry_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->default(null)->after('order_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_entry_menu', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
};
