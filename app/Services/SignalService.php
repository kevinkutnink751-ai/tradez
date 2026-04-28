<?php

namespace App\Services;

class SignalService
{
    protected static function load(): array
    {
        return require resource_path('content/fragments/signals.php');
    }

    // -----------------------------------------------
    // Signals
    // -----------------------------------------------

    public static function signals(): \Illuminate\Support\Collection
    {
        return collect(static::load()['signals'])->map(fn($item) => static::mapSignal($item));
    }

    public static function signalsPaginated(int $page = 1, int $perPage = 15): object
    {
        $all   = collect(static::load()['signals'])->map(fn($item) => static::mapSignal($item));
        $total = $all->count();

        return (object)[
            'data'         => $all->forPage($page, $perPage)->values(),
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => (int) ceil($total / $perPage),
        ];
    }

    public static function signal(int $id): ?object
    {
        $signal = collect(static::load()['signals'])
            ->firstWhere('signal.id', $id);

        return $signal ? static::mapSignal($signal) : null;
    }

    public static function byStatus(string $status): \Illuminate\Support\Collection
    {
        return collect(static::load()['signals'])
            ->filter(fn($item) => $item['signal']['status'] === $status)
            ->map(fn($item) => static::mapSignal($item))
            ->values();
    }

    public static function byDirection(string $direction): \Illuminate\Support\Collection
    {
        return collect(static::load()['signals'])
            ->filter(fn($item) => $item['signal']['trade_direction'] === $direction)
            ->map(fn($item) => static::mapSignal($item))
            ->values();
    }

    // -----------------------------------------------
    // Settings
    // -----------------------------------------------

    public static function settings(): object
    {
        return static::mapSettings(static::load()['settings']);
    }

    // -----------------------------------------------
    // Subscribers
    // -----------------------------------------------

    public static function subscribers(): \Illuminate\Support\Collection
    {
        return collect(static::load()['subscribers'])->map(fn($item) => static::mapSubscriber($item));
    }

    public static function subscriber(int $id): ?object
    {
        $subscriber = collect(static::load()['subscribers'])
            ->firstWhere('id', $id);

        return $subscriber ? static::mapSubscriber($subscriber) : null;
    }

    public static function subscribersByStatus(string $status): \Illuminate\Support\Collection
    {
        return collect(static::load()['subscribers'])
            ->filter(fn($item) => $item['status'] === $status)
            ->map(fn($item) => static::mapSubscriber($item))
            ->values();
    }

    // -----------------------------------------------
    // Mappers
    // -----------------------------------------------

    protected static function mapSignal(array $item): object
    {
        return (object)[
            'id'              => $item['signal']['id'],
            'reference'       => $item['signal']['reference'],
            'trade_direction' => $item['signal']['trade_direction'],
            'currency_pair'   => $item['signal']['currency_pair'],
            'price'           => $item['signal']['price'],
            'take_profit1'    => $item['signal']['take_profit1'],
            'take_profit2'    => $item['signal']['take_profit2'] ?? null,
            'stop_loss1'      => $item['signal']['stop_loss1'],
            'result'          => $item['signal']['result'] ?? null,
            'status'          => $item['signal']['status'],
            'created_at'      => $item['signal']['created_at'],
        ];
    }

    protected static function mapSettings(array $item): object
    {
        return (object)[
            'signal_monthly_fee'  => $item['signal_monthly_fee'],
            'signal_quartly_fee'  => $item['signal_quartly_fee'],
            'signal_yearly_fee'   => $item['signal_yearly_fee'],
            'chat_id'             => $item['chat_id'],
            'telegram_bot_api'    => $item['telegram_bot_api'],
            'currency'            => $item['currency'],
        ];
    }

    protected static function mapSubscriber(array $item): object
    {
        return (object)[
            'id'            => $item['id'],
            'name'          => $item['name'],
            'email'         => $item['email'],
            'plan'          => $item['plan'],
            'amount'        => $item['amount'],
            'status'        => $item['status'],
            'subscribed_at' => $item['subscribed_at'],
            'expires_at'    => $item['expires_at'],
            "client_id"     => $item['client_id'],
            "subscription"  => $item['subscription'],
            "amount_paid"   => $item['amount_paid'],
            "expired_at"    => $item['expired_at'],
            "created_at" => $item['created_at']
        ];
    }
}