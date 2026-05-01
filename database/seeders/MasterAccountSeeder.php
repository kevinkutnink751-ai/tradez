<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MasterAccount::updateOrCreate(
            ['strategy_name' => 'WinningBot'],
            [
                'account_name' => 'Alpha Quant Pro',
                'name' => 'Alpha Quant Pro',
                'strategy_name' => 'WinningBot',
                'strategy_description' => 'High-frequency quantitative strategy focusing on low-drawdown scalp trades.',
                'strategy_mode' => 'Aggressive',
                'account_balance' => 100000.00,
                'is_active' => true,
                'win_rate' => 94.5,
                'roi' => 15.2,
                'risk_level' => 'Low',
                'drawdown' => 2.1,
                'bot_type' => 'winning',
                'total_trades' => 1240,
                'win_count' => 1172,
                'loss_count' => 68,
            ]
        );

        \App\Models\MasterAccount::updateOrCreate(
            ['strategy_name' => 'ModerateBot'],
            [
                'account_name' => 'SteadyGrowth Bot',
                'name' => 'SteadyGrowth Bot',
                'strategy_name' => 'ModerateBot',
                'strategy_description' => 'Balanced trend-following strategy designed for consistent long-term growth.',
                'strategy_mode' => 'Balanced',
                'account_balance' => 50000.00,
                'is_active' => true,
                'win_rate' => 62.8,
                'roi' => 5.4,
                'risk_level' => 'Moderate',
                'drawdown' => 8.5,
                'bot_type' => 'moderate',
                'total_trades' => 850,
                'win_count' => 534,
                'loss_count' => 316,
            ]
        );

        \App\Models\MasterAccount::updateOrCreate(
            ['strategy_name' => 'LosingBot'],
            [
                'account_name' => 'HighRisk Gamble',
                'name' => 'HighRisk Gamble',
                'strategy_name' => 'LosingBot',
                'strategy_description' => 'Experimental martingale strategy with extremely high volatility.',
                'strategy_mode' => 'Risky',
                'account_balance' => 10000.00,
                'is_active' => true,
                'win_rate' => 18.2,
                'roi' => -12.4,
                'risk_level' => 'High',
                'drawdown' => 45.2,
                'bot_type' => 'losing',
                'total_trades' => 420,
                'win_count' => 76,
                'loss_count' => 344,
            ]
        );
    }
}
