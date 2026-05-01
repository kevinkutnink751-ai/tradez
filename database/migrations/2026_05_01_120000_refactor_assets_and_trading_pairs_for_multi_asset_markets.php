<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            if (!Schema::hasColumn('assets', 'price_source')) {
                $table->string('price_source')->nullable()->after('base_rate');
            }
            if (!Schema::hasColumn('assets', 'market_symbol')) {
                $table->string('market_symbol')->nullable()->after('price_source');
            }
            if (!Schema::hasColumn('assets', 'previous_close')) {
                $table->decimal('previous_close', 20, 8)->nullable()->after('market_symbol');
            }
            if (!Schema::hasColumn('assets', 'change_24h')) {
                $table->decimal('change_24h', 10, 2)->nullable()->after('previous_close');
            }
            if (!Schema::hasColumn('assets', 'high_24h')) {
                $table->decimal('high_24h', 20, 8)->nullable()->after('change_24h');
            }
            if (!Schema::hasColumn('assets', 'low_24h')) {
                $table->decimal('low_24h', 20, 8)->nullable()->after('high_24h');
            }
            if (!Schema::hasColumn('assets', 'volume_24h')) {
                $table->decimal('volume_24h', 30, 8)->nullable()->after('low_24h');
            }
        });

        Schema::table('trading_pairs', function (Blueprint $table) {
            if (!Schema::hasColumn('trading_pairs', 'quote_asset')) {
                $table->string('quote_asset')->nullable()->after('base_asset');
            }
            if (!Schema::hasColumn('trading_pairs', 'instrument_category')) {
                $table->string('instrument_category')->nullable()->after('type');
            }
            if (!Schema::hasColumn('trading_pairs', 'chart_symbol')) {
                $table->string('chart_symbol')->nullable()->after('instrument_category');
            }
        });

        DB::table('trading_pairs')
            ->whereNull('quote_asset')
            ->update([
                'quote_asset' => DB::raw('base_asset'),
                'instrument_category' => DB::raw("COALESCE(instrument_category, 'Cryptocurrency')"),
            ]);

        Schema::table('trades', function (Blueprint $table) {
            if (!Schema::hasColumn('trades', 'trading_pair_id')) {
                $table->foreignId('trading_pair_id')->nullable()->after('user_id')->constrained('trading_pairs')->nullOnDelete();
            }
            if (!Schema::hasColumn('trades', 'asset_symbol')) {
                $table->string('asset_symbol')->nullable()->after('pair');
            }
            if (!Schema::hasColumn('trades', 'quote_asset_symbol')) {
                $table->string('quote_asset_symbol')->nullable()->after('asset_symbol');
            }
            if (!Schema::hasColumn('trades', 'instrument_category')) {
                $table->string('instrument_category')->nullable()->after('market_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trades', function (Blueprint $table) {
            $dropColumns = [];

            if (Schema::hasColumn('trades', 'instrument_category')) {
                $dropColumns[] = 'instrument_category';
            }
            if (Schema::hasColumn('trades', 'quote_asset_symbol')) {
                $dropColumns[] = 'quote_asset_symbol';
            }
            if (Schema::hasColumn('trades', 'asset_symbol')) {
                $dropColumns[] = 'asset_symbol';
            }

            if (Schema::hasColumn('trades', 'trading_pair_id')) {
                $table->dropConstrainedForeignId('trading_pair_id');
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });

        Schema::table('trading_pairs', function (Blueprint $table) {
            $dropColumns = [];

            if (Schema::hasColumn('trading_pairs', 'chart_symbol')) {
                $dropColumns[] = 'chart_symbol';
            }
            if (Schema::hasColumn('trading_pairs', 'instrument_category')) {
                $dropColumns[] = 'instrument_category';
            }
            if (Schema::hasColumn('trading_pairs', 'quote_asset')) {
                $dropColumns[] = 'quote_asset';
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });

        Schema::table('assets', function (Blueprint $table) {
            $dropColumns = [];

            foreach (['price_source', 'market_symbol', 'previous_close', 'change_24h', 'high_24h', 'low_24h', 'volume_24h'] as $column) {
                if (Schema::hasColumn('assets', $column)) {
                    $dropColumns[] = $column;
                }
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
