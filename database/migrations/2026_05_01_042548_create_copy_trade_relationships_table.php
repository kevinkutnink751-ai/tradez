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
        Schema::create('copy_trade_relationships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscriber_account_id')->index();
            $table->unsignedBigInteger('master_account_id')->index();
            $table->string('status', 50)->default('ACTIVE'); // ACTIVE, DISABLED, PAUSED
            $table->json('risk_settings')->nullable();
            $table->datetime('enabled_at')->nullable();
            $table->datetime('disabled_at')->nullable();
            $table->integer('total_trades_copied')->default(0);
            $table->integer('successful_copies')->default(0);
            $table->integer('failed_copies')->default(0);
            $table->decimal('total_profit_loss', 15, 2)->default(0);
            $table->datetime('last_trade_copied_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_trade_relationships');
    }
};
