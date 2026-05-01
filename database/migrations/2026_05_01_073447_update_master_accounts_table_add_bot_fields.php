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
        Schema::table('master_accounts', function (Blueprint $table) {
            $table->string('mt4_id')->nullable()->change();
            $table->string('mt4_password')->nullable()->change();
            $table->string('server')->nullable()->change();
            
            $table->string('name')->nullable()->after('account_name');
            $table->decimal('roi', 8, 2)->default(0)->after('win_rate');
            $table->string('risk_level')->default('Moderate')->after('roi');
            $table->decimal('drawdown', 8, 2)->default(0)->after('risk_level');
            $table->string('bot_type')->default('moderate')->after('drawdown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_accounts', function (Blueprint $table) {
            $table->dropColumn(['name', 'roi', 'risk_level', 'drawdown', 'bot_type']);
        });
    }
};
