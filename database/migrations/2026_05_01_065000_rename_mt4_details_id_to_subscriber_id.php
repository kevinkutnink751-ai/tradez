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
        Schema::table('mt4_transaction_logs', function (Blueprint $table) {
            $table->renameColumn('mt4_details_id', 'subscriber_account_id');
        });

        Schema::table('deployment_records', function (Blueprint $table) {
            $table->renameColumn('mt4_details_id', 'subscriber_account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt4_transaction_logs', function (Blueprint $table) {
            $table->renameColumn('subscriber_account_id', 'mt4_details_id');
        });

        Schema::table('deployment_records', function (Blueprint $table) {
            $table->renameColumn('subscriber_account_id', 'mt4_details_id');
        });
    }
};
