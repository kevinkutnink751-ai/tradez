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
            $table->decimal('last_price', 15, 5)->nullable()->after('status');
            $table->decimal('change_24h', 10, 2)->nullable()->after('last_price');
            $table->decimal('high_24h', 15, 5)->nullable()->after('change_24h');
            $table->decimal('low_24h', 15, 5)->nullable()->after('high_24h');
            $table->decimal('volume_24h', 20, 5)->nullable()->after('low_24h');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trading_pairs', function (Blueprint $table) {
            $table->dropColumn(['last_price', 'change_24h', 'high_24h', 'low_24h', 'volume_24h']);
        });
    }
};
