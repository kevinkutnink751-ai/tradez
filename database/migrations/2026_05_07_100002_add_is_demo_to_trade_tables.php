<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->boolean('is_demo')->default(false)->after('pnl');
        });

        Schema::table('binary_trades', function (Blueprint $table) {
            $table->boolean('is_demo')->default(false)->after('end_price');
        });

        Schema::table('option_trades', function (Blueprint $table) {
            $table->boolean('is_demo')->default(false)->after('pnl');
        });
    }

    public function down(): void
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('is_demo');
        });

        Schema::table('binary_trades', function (Blueprint $table) {
            $table->dropColumn('is_demo');
        });

        Schema::table('option_trades', function (Blueprint $table) {
            $table->dropColumn('is_demo');
        });
    }
};
