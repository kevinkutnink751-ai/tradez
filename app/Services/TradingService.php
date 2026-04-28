<?php

namespace App\Services;

class TradingService
{
    protected static function load(): array
    {
        return require static::path();
    }

    public static function settings(): object
    {
        $data = static::load()['trading_settings'];

        return (object)[
            'accounts' => collect($data['accounts'])->map(fn($item) => (object)$item),
            'my_account' => (object)$data['my_account'],
            'trading_accounts' => collect($data['trading_accounts'])->map(fn($item) => (object)$item),
            'amount_per_slot' => $data['settings']['amount_per_slot'],
        ];
    }

      protected static function save(array $data): bool
    {
        $content = "<?php\n\nreturn " . var_export($data, true) . ";\n";
        return file_put_contents(static::path(), $content) !== false;
    }

    protected static function path():string{
        return resource_path('content/fragments/trading_settings.php');
    }

    protected static function all(): array
    {
        return static::load()['trading_settings'];
    }

    public static function updateStrategy(int $id, array $payload): bool
{
    $data = static::load();

    foreach ($data['trading_settings']['accounts'] as &$account) {
        if ($account['id'] == $id) {
            $account['strategy_name'] = $payload['strategy_name'];
            $account['strategy_description'] = $payload['description'];
            $account['strategy_mode'] = $payload['mode'];
            $account['stra_com'] = $payload['modecompliment'];
            break;
        }
    }

    return static::save($data);
}

public static function deleteAccount(int $id): bool
{
    $data = static::load();

    $data['trading_settings']['accounts'] = array_values(
        array_filter(
            $data['trading_settings']['accounts'],
            fn($acc) => $acc['id'] != $id
        )
    );

    return static::save($data);
}

public static function renewAccount(int $id): bool
{
    $data = static::load();

    foreach ($data['trading_settings']['accounts'] as &$account) {
        if ($account['id'] == $id) {

            $account['start_date'] = now()->toDateTimeString();
            $account['end_date'] = now()->addMonth()->toDateTimeString();
            $account['deployment_status'] = 'Deployed';

            break;
        }
    }

    return static::save($data);
}
}