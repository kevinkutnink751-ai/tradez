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
            'base_asset' => 'required|string',
            'type' => 'required|string|in:Spot,Future,Binary,Option',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'leverage' => 'nullable|numeric',
        ]);

        TradingPair::create([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'base_asset' => $request->base_asset,
            'type' => $request->type,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'leverage' => $request->leverage ?? 1,
            'status' => true,
        ]);

        return redirect()->back()->with('message', 'Trading pair added successfully');
    }

    public function update(Request $request, $id)
    {
        $pair = TradingPair::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string',
            'base_asset' => 'required|string',
            'type' => 'required|string|in:Spot,Future,Binary,Option',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'leverage' => 'nullable|numeric',
        ]);

        $pair->update([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'base_asset' => $request->base_asset,
            'type' => $request->type,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'leverage' => $request->leverage ?? 1,
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
}
