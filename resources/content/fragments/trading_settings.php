<?php

return [

    'trading_settings' => [

        // -----------------------------------------
        // Master Accounts (from $response['data'])
        // -----------------------------------------
        'accounts' => [

           
            [
                'id' => 1,
                'login' => '123456',
                'password' => 'pass123',
                'account_type' => 'MT5',
                'account_name' => 'Primary Master',
                'server' => 'ICMarkets-Live',
                'deployment_status' => 'Deployed',
                'start_date' => '2026-04-01 10:00:00',
                'end_date' => '2026-05-01 10:00:00',

                // ✅ NEW (for strategy modal)
                'strategy_name' => 'Scalping Pro',
                'strategy_description' => 'High frequency scalp strategy',
                'strategy_mode' => 'fixedRisk',
                'stra_com' => '2%', // complement value (modecompliment)

                // ✅ Optional (useful for UI logic)
                'is_expired' => false,
            ],

            [
                'id' => 2,
                'login' => '789012',
                'password' => 'pass456',
                'account_type' => 'MT4',
                'account_name' => 'Secondary Master',
                'server' => 'Exness-Server',
                'deployment_status' => 'Pending',
                'start_date' => '2026-04-10 12:00:00',
                'end_date' => '2026-04-20 12:00:00',

                // ✅ Strategy fields
                'strategy_name' => 'Swing Trader',
                'strategy_description' => 'Medium-term swing entries',
                'strategy_mode' => 'balance',
                'stra_com' => '5',

                // ✅ Expired example
                'is_expired' => true,
            ],

        ],

        // -----------------------------------------
        // My Account (/account-profile)
        // -----------------------------------------
        'my_account' => [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'balance' => 5000,
            'currency' => 'USD',

            'trading_account_slot' => 3,
            'wallet_balance' => 1500.50,
        ],

        // -----------------------------------------
        // Trading Accounts (/trading-accounts)
        // -----------------------------------------
        'trading_accounts' => [

            [
                'id' => 1,
                'login' => '30001',
                'server' => 'ICMarkets-Demo',
                'balance' => 1000,
                'status' => 'active',
            ],

            [
                'id' => 2,
                'login' => '30002',
                'server' => 'ICMarkets-Demo',
                'balance' => 2000,
                'status' => 'inactive',
            ],

        ],

        // -----------------------------------------
        // Settings (/settings)
        // -----------------------------------------
        'settings' => [
            'amount_per_slot' => 100,
        ],

    ],

];