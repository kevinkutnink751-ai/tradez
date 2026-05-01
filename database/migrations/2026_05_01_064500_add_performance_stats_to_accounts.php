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
        Schema::table('mt4_details', function (Blueprint $table) {
            $table->decimal('total_profit', 15, 2)->default(0);
            $table->integer('total_trades')->default(0);
            $table->integer('win_count')->default(0);
            $table->integer('loss_count')->default(0);
            $table->decimal('win_rate', 5, 2)->default(0);
        });

        Schema::table('master_accounts', function (Blueprint $table) {
            $table->decimal('total_profit', 15, 2)->default(0);
            $table->integer('total_trades')->default(0);
            $table->integer('win_count')->default(0);
            $table->integer('loss_count')->default(0);
            $table->decimal('win_rate', 5, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt4_details', function (Blueprint $table) {
            $table->dropColumn(['total_profit', 'total_trades', 'win_count', 'loss_count', 'win_rate']);
        });

        Schema::table('master_accounts', function (Blueprint $table) {
            $table->dropColumn(['total_profit', 'total_trades', 'win_count', 'loss_count', 'win_rate']);
        });
    }
};
