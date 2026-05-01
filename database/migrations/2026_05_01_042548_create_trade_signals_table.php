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
        Schema::create('trade_signals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_account_id')->index();
            $table->string('external_trade_id')->nullable()->index();
            $table->string('trade_type', 10); // BUY, SELL
            $table->string('symbol', 20); // EURUSD, GBPUSD
            $table->decimal('volume', 10, 2);
            $table->decimal('open_price', 15, 8);
            $table->decimal('close_price', 15, 8)->nullable();
            $table->decimal('stop_loss', 15, 8)->nullable();
            $table->decimal('take_profit', 15, 8)->nullable();
            $table->decimal('profit_loss', 15, 2)->nullable();
            $table->datetime('signal_timestamp');
            $table->datetime('closed_timestamp')->nullable();
            $table->string('status', 50)->default('NEW');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_signals');
    }
};
