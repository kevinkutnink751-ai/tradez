@extends('layouts.app')
@section('content')
<div class="mt-2 mb-4">
    <h1 class="title1 text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}">Manage Assets</h1>
</div>
<x-danger-alert />
<x-success-alert />

<div class="mb-5 row">
    <div class="col-md-12">
        <div class="card p-3 shadow-lg bg-{{ Auth('admin')->User()->dashboard_style }}">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}">Market Assets</h4>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAssetModal">
                    <i class="fas fa-plus"></i> Add Asset
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Type</th>
                                <th>USD Price</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $asset)
                            <tr>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->symbol }}</td>
                                <td>
                                    <span class="badge badge-{{ $asset->type == 'Crypto' ? 'info' : 'primary' }}">{{ $asset->type }}</span>
                                </td>
                                <td>{{ number_format($asset->base_rate, 4) }}</td>
                                <td>{{ strtoupper($asset->price_source ?? 'manual') }}</td>
                                <td>
                                    @if($asset->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editAssetModal{{ $asset->id }}">Edit</button>
                                    <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this asset?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-{{ Auth('admin')->User()->dashboard_style }} text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Asset</h5>
                                            <button type="button" class="close text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('admin.assets.update', $asset->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Asset Name</label>
                                                    <input type="text" name="name" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="{{ $asset->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Symbol</label>
                                                    <input type="text" name="symbol" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="{{ $asset->symbol }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select name="type" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" required>
                                                        @foreach($assetTypes as $assetType)
                                                        <option value="{{ $assetType }}" {{ $asset->type == $assetType ? 'selected' : '' }}>{{ $assetType }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <input type="text" name="category" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="{{ $asset->category }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Base Rate (to USD)</label>
                                                    <input type="number" step="0.00000001" name="base_rate" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="{{ $asset->base_rate }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Price Source</label>
                                                    <select name="price_source" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}">
                                                        <option value="">Manual</option>
                                                        <option value="binance" {{ $asset->price_source == 'binance' ? 'selected' : '' }}>Binance</option>
                                                        <option value="yahoo" {{ $asset->price_source == 'yahoo' ? 'selected' : '' }}>Yahoo Finance</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Market Symbol</label>
                                                    <input type="text" name="market_symbol" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="{{ $asset->market_symbol }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" required>
                                                        <option value="1" {{ $asset->status ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ !$asset->status ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addAssetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-{{ Auth('admin')->User()->dashboard_style }} text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}">
            <div class="modal-header">
                <h5 class="modal-title">Add New Asset</h5>
                <button type="button" class="close text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }}" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.assets.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Asset Name</label>
                        <input type="text" name="name" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" placeholder="e.g. Bitcoin" required>
                    </div>
                    <div class="form-group">
                        <label>Symbol</label>
                        <input type="text" name="symbol" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" placeholder="e.g. BTC" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" required>
                            @foreach($assetTypes as $assetType)
                            <option value="{{ $assetType }}">{{ $assetType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" placeholder="e.g. Equity Index Futures">
                    </div>
                    <div class="form-group">
                        <label>Base Rate (to USD)</label>
                        <input type="number" step="0.00000001" name="base_rate" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" value="1" required>
                    </div>
                    <div class="form-group">
                        <label>Price Source</label>
                        <select name="price_source" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}">
                            <option value="">Manual</option>
                            <option value="binance">Binance</option>
                            <option value="yahoo">Yahoo Finance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Market Symbol</label>
                        <input type="text" name="market_symbol" class="form-control text-{{ Auth('admin')->User()->dashboard_style == 'light' ? 'dark' : 'light' }} bg-{{ Auth('admin')->User()->dashboard_style }}" placeholder="e.g. BTCUSDT or ES=F">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
