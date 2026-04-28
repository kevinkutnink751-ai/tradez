<?php

return [
    'signals' => [
        [
            'signal' => [
                'id'             => 1,
                'reference'      => 'TRD-00123',
                'trade_direction'=> 'Buy',
                'currency_pair'  => 'EUR/USD',
                'price'          => '1.08450',
                'take_profit1'   => '1.09000',
                'take_profit2'   => '1.09500',
                'stop_loss1'     => '1.07900',
                'result'         => 'TP1 Hit',
                'status'         => 'published',
                'created_at'     => '2026-04-28T10:00:00.000000Z',
            ],
        ],
        [
            'signal' => [
                'id'             => 2,
                'reference'      => 'TRD-00124',
                'trade_direction'=> 'Sell',
                'currency_pair'  => 'GBP/JPY',
                'price'          => '191.250',
                'take_profit1'   => '190.500',
                'take_profit2'   => null,
                'stop_loss1'     => '192.000',
                'result'         => null,
                'status'         => 'unpublished',
                'created_at'     => '2026-04-28T11:30:00.000000Z',
            ],
        ],
        [
            'signal' => [
                'id'             => 3,
                'reference'      => 'TRD-00125',
                'trade_direction'=> 'Buy',
                'currency_pair'  => 'USD/CAD',
                'price'          => '1.36200',
                'take_profit1'   => '1.37000',
                'take_profit2'   => '1.37800',
                'stop_loss1'     => '1.35500',
                'result'         => null,
                'status'         => 'published',
                'created_at'     => '2026-04-27T08:15:00.000000Z',
            ],
        ],
    ],
      'settings' => [
        'signal_monthly_fee'  => 29.99,
        'signal_quartly_fee'  => 79.99,
        'signal_yearly_fee'   => 299.99,
        'chat_id'             => '-1001234567890',
        'telegram_bot_api'    => '7123456789:AAFakeTokenForTestingPurposesOnly123',
        'currency'            => 'USD',
    ],

    'subscribers' => [
        [
            'id'          => 1,
            'name'        => 'John Doe',
            'email'       => 'john@example.com',
            'plan'        => 'monthly',
            'amount'      => 29.99,
            'status'      => 'active',
            'subscribed_at' => '2026-03-01T09:00:00.000000Z',
            'expires_at'  => '2026-04-30T09:00:00.000000Z',
            'client_id'   => 1,
            "subscription" => "monthly",
            "amount_paid"   => "29.99", 
            "expired_at" => "2026-04-30T09:00:00.000000Z", 
            "created_at"=> now()
            
        ],
        [
            'id'          => 2,
            'name'        => 'Jane Smith',
            'email'       => 'jane@example.com',
            'plan'        => 'yearly',
            'amount'      => 299.99,
            'status'      => 'active',
            'subscribed_at' => '2026-01-15T14:00:00.000000Z',
            'expires_at'  => '2027-01-15T14:00:00.000000Z',
            'client_id'   => 1,
            "subscription" => "monthly",
            "amount_paid"   => "10998",
             "expired_at" => "2026-04-30T09:00:00.000000Z", 
             "created_at"=> now()
        ],
        [
            'id'          => 3,
            'name'        => 'Mike Johnson',
            'email'       => 'mike@example.com',
            'plan'        => 'quarterly',
            'amount'      => 79.99,
            'status'      => 'expired',
            'client_id'   => 1,
            'subscribed_at' => '2025-10-01T10:00:00.000000Z',
            'expires_at'  => '2026-01-01T10:00:00.000000Z',
            "subscription" => "monthly",
            "amount_paid"   => "10998",
             "expired_at" => "2026-04-30T09:00:00.000000Z", 
             "created_at"=> now()
        ],
    ],
];