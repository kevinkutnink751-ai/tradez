@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 text-white h3 font-weight-bold">Manage Active Orders</h5>
                <p class="text-white-50 small mb-0">{{ ($currentMode ?? 'Live') === 'Demo' ? 'Demo (Virtual)' : 'Live' }} open positions</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                @include('user.trading.partials.history_toolbar', ['historyType' => 'orders'])

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Asset Pair</th>
                                    <th>Type</th>
                                    <th>Market</th>
                                    <th>Amount</th>
                                    <th>Entry Price</th>
                                    <th>Current Price</th>
                                    <th>PnL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trades as $trade)
                                    <tr onclick="toggleDetail({{ $trade->id }})">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="pair-icon mr-2 bg-soft-primary text-primary"><i class="mdi mdi-swap-horizontal"></i></div>
                                                <div class="font-weight-bold text-white">{{ $trade->pair }}</div>
                                                @if($trade->is_demo)<span class="badge-demo">DEMO</span>@endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }} font-weight-bold">{{ $trade->type }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-info px-2">{{ $trade->market_type }}</span>
                                            @if($trade->leverage > 1)
                                                <small class="text-warning ml-1">{{ $trade->leverage }}x</small>
                                            @endif
                                        </td>
                                        <td class="text-white">{{ number_format($trade->amount, 4) }}</td>
                                        <td>${{ number_format($trade->price, 2) }}</td>
                                        <td class="text-white">${{ number_format($trade->price * 1.02, 2) }}</td>
                                        <td>
                                            <span class="font-weight-bold text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }}">
                                                {{ $trade->pnl >= 0 ? '+' : '' }}${{ number_format($trade->pnl, 2) }}
                                            </span>
                                        </td>
                                        <td onclick="event.stopPropagation();">
                                            <a href="{{ route('trade.close', $trade->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Close this position?')">Close</a>
                                        </td>
                                    </tr>
                                    <tr class="trade-detail-row" id="detail-{{ $trade->id }}">
                                        <td colspan="8" style="padding:0; border:0;">
                                            <div class="trade-detail-content">
                                                <div class="detail-grid">
                                                    <div class="detail-item"><span class="label">Trade ID</span><span class="value">#{{ $trade->id }}</span></div>
                                                    <div class="detail-item"><span class="label">Market</span><span class="value">{{ $trade->market_type }}</span></div>
                                                    <div class="detail-item"><span class="label">Side</span><span class="value text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type }}</span></div>
                                                    <div class="detail-item"><span class="label">Leverage</span><span class="value">{{ $trade->leverage }}x</span></div>
                                                    <div class="detail-item"><span class="label">Entry</span><span class="value">${{ number_format($trade->price, 4) }}</span></div>
                                                    <div class="detail-item"><span class="label">Size</span><span class="value">{{ number_format($trade->amount, 6) }}</span></div>
                                                    <div class="detail-item"><span class="label">Settlement</span><span class="value">{{ $trade->settlement_asset }}</span></div>
                                                    <div class="detail-item"><span class="label">Account Type</span><span class="value">{{ $trade->is_demo ? '🧪 Demo' : '🔴 Live' }}</span></div>
                                                    <div class="detail-item"><span class="label">Opened</span><span class="value">{{ $trade->created_at->format('M d, Y H:i:s') }}</span></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-history">
                                                <i class="mdi mdi-folder-open-outline" style="font-size: 48px; color: rgba(255,255,255,0.1);"></i>
                                                <div class="text-muted mt-2">No active {{ ($currentMode ?? 'Live') === 'Demo' ? 'demo' : 'live' }} orders found.</div>
                                                <a href="{{ route('spot.trade') }}" class="btn btn-primary mt-3 rounded-pill px-4 btn-sm">Open Trade</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #11151d; border: 1px solid rgba(255,255,255,0.04); border-radius: 16px; }
        .table-dark-custom { color: #8898aa; margin-bottom: 0; }
        .table-dark-custom thead th { background: #090c10; border: 0; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px; color: rgba(255,255,255,0.3); padding: 1rem 1.5rem; }
        .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.04); padding: 1rem 1.5rem; vertical-align: middle; font-size: 0.8rem; }
        .pair-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; }
        .bg-soft-primary { background: rgba(21, 114, 232, 0.1); }
        .badge-soft-info { background: rgba(23, 162, 184, 0.08); color: #17a2b8; border-radius: 6px; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 6px; }
        .empty-history { display: flex; flex-direction: column; align-items: center; padding: 20px 0; }
    </style>
@endsection
