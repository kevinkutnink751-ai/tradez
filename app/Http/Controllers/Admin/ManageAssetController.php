<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingsCont;

class ManageAssetController extends Controller
{
    public function index()
    {
        $assets = \App\Models\Asset::orderBy('name')->get();
        return view('admin.assets.index', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10|unique:assets',
            'type' => 'required|in:Fiat,Crypto',
            'category' => 'nullable|string',
            'base_rate' => 'required|numeric|min:0',
            'logo' => 'nullable|string',
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
            'type' => 'required|in:Fiat,Crypto',
            'category' => 'nullable|string',
            'base_rate' => 'required|numeric|min:0',
            'logo' => 'nullable|string',
            'status' => 'required|boolean',
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
