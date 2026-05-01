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
        Schema::table('trading_pairs', function (Blueprint $table) {
            $table->decimal('binary_min_amount', 18, 8)->nullable()->default(1);
            $table->decimal('binary_max_amount', 18, 8)->nullable()->default(10000);
            $table->decimal('binary_increment', 18, 8)->nullable()->default(0.001);
            $table->decimal('binary_profit_percent', 5, 2)->nullable()->default(85);
            $table->json('binary_durations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trading_pairs', function (Blueprint $table) {
            $table->dropColumn(['binary_min_amount', 'binary_max_amount', 'binary_increment', 'binary_profit_percent', 'binary_durations']);
        });
    }
};
