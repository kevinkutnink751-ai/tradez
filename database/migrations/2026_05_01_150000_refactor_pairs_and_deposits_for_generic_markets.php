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
        Schema::table('trading_pairs', function (Blueprint $table) {
            if (!Schema::hasColumn('trading_pairs', 'supported_markets')) {
                $table->json('supported_markets')->nullable()->after('chart_symbol');
            }
            if (!Schema::hasColumn('trading_pairs', 'leverage_options')) {
                $table->json('leverage_options')->nullable()->after('supported_markets');
            }
        });

        $pairs = DB::table('trading_pairs')->get()->groupBy('name');

        foreach ($pairs as $name => $group) {
            $primary = $group->sortBy('id')->first();
            $markets = $group->pluck('type')->filter()->map(fn ($type) => strtolower($type))->unique()->values()->all();
            $leverages = $group->pluck('leverage')->filter()->map(fn ($value) => (int) $value)->unique()->sort()->values()->all();

            DB::table('trading_pairs')
                ->where('id', $primary->id)
                ->update([
                    'supported_markets' => json_encode($markets),
                    'leverage_options' => json_encode($leverages),
                ]);

            DB::table('trading_pairs')
                ->where('name', $name)
                ->where('id', '<>', $primary->id)
                ->delete();
        }

        Schema::table('deposits', function (Blueprint $table) {
            if (!Schema::hasColumn('deposits', 'asset_id')) {
                $table->foreignId('asset_id')->nullable()->after('wallet')->constrained('assets')->nullOnDelete();
            }
            if (!Schema::hasColumn('deposits', 'balance_type')) {
                $table->string('balance_type')->nullable()->after('asset_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            if (Schema::hasColumn('deposits', 'asset_id')) {
                $table->dropConstrainedForeignId('asset_id');
            }

            if (Schema::hasColumn('deposits', 'balance_type')) {
                $table->dropColumn('balance_type');
            }
        });

        Schema::table('trading_pairs', function (Blueprint $table) {
            $dropColumns = [];

            if (Schema::hasColumn('trading_pairs', 'supported_markets')) {
                $dropColumns[] = 'supported_markets';
            }
            if (Schema::hasColumn('trading_pairs', 'leverage_options')) {
                $dropColumns[] = 'leverage_options';
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
