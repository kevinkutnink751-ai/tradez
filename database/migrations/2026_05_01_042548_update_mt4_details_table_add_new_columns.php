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
            $table->unsignedBigInteger('master_account_id')->nullable()->after('account_name');
            $table->boolean('copy_trade_enabled')->default(false)->after('master_account_id');
            $table->string('deployment_status')->default('NONE')->after('copy_trade_enabled');
            $table->string('api_account_id')->nullable()->after('mt4_password');
            $table->datetime('verified_at')->nullable()->after('status');
            $table->text('rejection_reason')->nullable()->after('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt4_details', function (Blueprint $table) {
            $table->dropColumn([
                'master_account_id',
                'copy_trade_enabled',
                'deployment_status',
                'api_account_id',
                'verified_at',
                'rejection_reason'
            ]);
        });
    }
};
