<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradingPair;
use Illuminate\Http\Request;

class TradingPairController extends Controller
{
    public function index()
    {
        $pairs = TradingPair::orderByDesc('id')->get();
        return view('admin.trading.pairs', [
            'title' => 'Trading Pairs',
            'pairs' => $pairs,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string',
            'quote_asset' => 'required|string',
            'instrument_category' => 'nullable|string',
            'chart_symbol' => 'nullable|string',
            'supported_markets' => 'required|array|min:1',
            'supported_markets.*' => 'string|in:spot,future,binary,option',
            'leverage_options' => 'nullable|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'binary_min_amount' => 'nullable|numeric',
            'binary_max_amount' => 'nullable|numeric',
            'binary_increment' => 'nullable|numeric',
            'binary_profit_percent' => 'nullable|numeric|max:100',
            'binary_durations' => 'nullable|string',
        ]);

        $leverages = $this->parseLeverageOptions($request->leverage_options);
        $durations = $this->parseDurationOptions($request->binary_durations);

        TradingPair::create([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'base_asset' => $request->quote_asset,
            'quote_asset' => $request->quote_asset,
            'instrument_category' => $request->instrument_category,
            'chart_symbol' => $request->chart_symbol,
            'supported_markets' => $request->supported_markets,
            'leverage_options' => $leverages,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'leverage' => max($leverages ?: [1]),
            'status' => true,
            'binary_min_amount' => $request->binary_min_amount ?: 1,
            'binary_max_amount' => $request->binary_max_amount ?: 10000,
            'binary_increment' => $request->binary_increment ?: 0.001,
            'binary_profit_percent' => $request->binary_profit_percent ?: 85,
            'binary_durations' => $durations,
        ]);

        return redirect()->back()->with('message', 'Trading pair added successfully');
    }

    public function update(Request $request, $id)
    {
        $pair = TradingPair::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string',
            'quote_asset' => 'required|string',
            'instrument_category' => 'nullable|string',
            'chart_symbol' => 'nullable|string',
            'supported_markets' => 'required|array|min:1',
            'supported_markets.*' => 'string|in:spot,future,binary,option',
            'leverage_options' => 'nullable|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'binary_min_amount' => 'nullable|numeric',
            'binary_max_amount' => 'nullable|numeric',
            'binary_increment' => 'nullable|numeric',
            'binary_profit_percent' => 'nullable|numeric|max:100',
            'binary_durations' => 'nullable|string',
        ]);

        $leverages = $this->parseLeverageOptions($request->leverage_options);
        $durations = $this->parseDurationOptions($request->binary_durations);

        $pair->update([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'base_asset' => $request->quote_asset,
            'quote_asset' => $request->quote_asset,
            'instrument_category' => $request->instrument_category,
            'chart_symbol' => $request->chart_symbol,
            'supported_markets' => $request->supported_markets,
            'leverage_options' => $leverages,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'leverage' => max($leverages ?: [1]),
            'binary_min_amount' => $request->binary_min_amount,
            'binary_max_amount' => $request->binary_max_amount,
            'binary_increment' => $request->binary_increment,
            'binary_profit_percent' => $request->binary_profit_percent,
            'binary_durations' => $durations,
        ]);

        return redirect()->back()->with('message', 'Trading pair updated successfully');
    }

    public function destroy($id)
    {
        TradingPair::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Trading pair deleted successfully');
    }

    public function toggleStatus($id)
    {
        $pair = TradingPair::findOrFail($id);
        $pair->update(['status' => !$pair->status]);
        return redirect()->back()->with('message', 'Status updated successfully');
    }

    protected function parseLeverageOptions(?string $value): array
    {
        if (!$value) {
            return [1];
        }

        $options = collect(explode(',', $value))
            ->map(fn ($item) => (int) trim($item))
            ->filter(fn ($item) => $item >= 1)
            ->unique()
            ->sort()
            ->values()
            ->all();

        return !empty($options) ? $options : [1];
    }

    protected function parseDurationOptions(?string $value): array
    {
        if (!$value) {
            return [60, 120, 300];
        }

        return collect(explode(',', $value))
            ->map(fn ($item) => (int) trim($item))
            ->filter(fn ($item) => $item >= 1)
            ->unique()
            ->sort()
            ->values()
            ->all();
    }
}
