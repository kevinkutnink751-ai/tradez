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
        Schema::create('trading_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. BTC/USDT
            $table->string('symbol'); // e.g. BTC
            $table->string('base_asset'); // e.g. USDT
            $table->string('type')->default('Spot'); // Spot, Future
            $table->double('min_amount', 15, 2)->default(0);
            $table->double('max_amount', 15, 2)->default(0);
            $table->double('leverage', 5, 2)->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_pairs');
    }
};
