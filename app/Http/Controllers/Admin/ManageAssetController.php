<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingsCont;

class ManageAssetController extends Controller
{
    protected array $assetTypes = ['Fiat', 'Crypto', 'Equity', 'Index', 'Commodity', 'Rate', 'Volatility'];

    public function index()
    {
        $assets = \App\Models\Asset::orderBy('name')->get();
        $assetTypes = $this->assetTypes;
        return view('admin.assets.index', compact('assets', 'assetTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10|unique:assets',
            'type' => 'required|in:' . implode(',', $this->assetTypes),
            'category' => 'nullable|string',
            'base_rate' => 'required|numeric|min:0',
            'logo' => 'nullable|string',
            'price_source' => 'nullable|string|in:binance,yahoo',
            'market_symbol' => 'nullable|string|max:50',
        ]);

        \App\Models\Asset::create($request->all());
        return redirect()->back()->with('success', 'Asset created successfully.');
    }

    public function update(Request $request, $id)
    {
        $asset = \App\Models\Asset::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10|unique:assets,symbol,'.$id,
            'type' => 'required|in:' . implode(',', $this->assetTypes),
            'category' => 'nullable|string',
            'base_rate' => 'required|numeric|min:0',
            'logo' => 'nullable|string',
            'status' => 'required|boolean',
            'price_source' => 'nullable|string|in:binance,yahoo',
            'market_symbol' => 'nullable|string|max:50',
        ]);

        $asset->update($request->all());
        return redirect()->back()->with('success', 'Asset updated successfully.');
    }

    public function destroy($id)
    {
        $asset = \App\Models\Asset::findOrFail($id);
        $asset->delete();
        return redirect()->back()->with('success', 'Asset deleted successfully.');
    }
}
