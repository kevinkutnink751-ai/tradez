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
        Schema::create('master_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('mt4_id')->unique();
            $table->string('mt4_password');
            $table->string('server');
            $table->string('account_name')->nullable();
            $table->string('account_type')->nullable(); // Standard, Micro, etc.
            $table->string('currency')->default('USD');
            $table->string('leverage')->nullable();
            $table->string('strategy_name')->nullable();
            $table->text('strategy_description')->nullable();
            $table->string('strategy_mode')->nullable(); // Aggressive, Conservative, etc.
            $table->string('stra_com')->nullable(); // Mode compliment
            $table->decimal('account_balance', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_accounts');
    }
};
