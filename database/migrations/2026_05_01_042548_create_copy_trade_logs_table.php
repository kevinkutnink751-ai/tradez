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
        Schema::create('copy_trade_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trade_signal_id')->index();
            $table->unsignedBigInteger('subscriber_account_id')->index();
            $table->decimal('executed_volume', 10, 2);
            $table->decimal('executed_price', 15, 8);
            $table->string('executed_trade_id')->nullable()->index();
            $table->decimal('closed_price', 15, 8)->nullable();
            $table->decimal('profit_loss', 15, 2)->nullable();
            $table->string('status', 50)->default('SUCCESS'); // SUCCESS, FAILED, CLOSED
            $table->text('error_message')->nullable();
            $table->datetime('copied_at');
            $table->datetime('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_trade_logs');
    }
};
