@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 text-white h3 font-weight-bold">Spot Trades</h5>
                <p class="text-white-50 small mb-0">{{ ($currentMode ?? 'Live') === 'Demo' ? 'Demo (Virtual)' : 'Live' }} spot history</p>
            </div>
            <a href="{{ route('spot.trade') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                <i class="mdi mdi-plus mr-1"></i> New Trade
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                @include('user.trading.partials.history_toolbar', ['historyType' => 'spot'])

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Symbol</th>
                                    <th>Side</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trades as $trade)
                                    <tr onclick="toggleDetail({{ $trade->id }})">
                                        <td class="small">{{ $trade->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="text-white font-weight-bold">{{ $trade->pair }}</span>
                                            @if($trade->is_demo)<span class="badge-demo">DEMO</span>@endif
                                        </td>
                                        <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }} font-weight-bold">{{ strtoupper($trade->type) }}</td>
                                        <td>{{ number_format($trade->price, 2) }}</td>
                                        <td>{{ number_format($trade->amount, 4) }}</td>
                                        <td class="text-white font-weight-bold">{{ number_format($trade->price * $trade->amount, 2) }} USDT</td>
                                        <td><span class="badge badge-soft-success">Filled</span></td>
                                    </tr>
                                    <tr class="trade-detail-row" id="detail-{{ $trade->id }}">
                                        <td colspan="7" style="padding:0; border:0;">
                                            <div class="trade-detail-content">
                                                <div class="detail-grid">
                                                    <div class="detail-item"><span class="label">Trade ID</span><span class="value">#{{ $trade->id }}</span></div>
                                                    <div class="detail-item"><span class="label">Symbol</span><span class="value">{{ $trade->pair }}</span></div>
                                                    <div class="detail-item"><span class="label">Side</span><span class="value text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type }}</span></div>
                                                    <div class="detail-item"><span class="label">Price</span><span class="value">${{ number_format($trade->price, 4) }}</span></div>
                                                    <div class="detail-item"><span class="label">Amount</span><span class="value">{{ number_format($trade->amount, 6) }}</span></div>
                                                    <div class="detail-item"><span class="label">Total</span><span class="value">${{ number_format($trade->price * $trade->amount, 4) }}</span></div>
                                                    <div class="detail-item"><span class="label">Account Type</span><span class="value">{{ $trade->is_demo ? '🧪 Demo' : '🔴 Live' }}</span></div>
                                                    <div class="detail-item"><span class="label">Created</span><span class="value">{{ $trade->created_at->format('M d, Y H:i:s') }}</span></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-history">
                                                <i class="mdi mdi-swap-horizontal-bold" style="font-size: 48px; color: rgba(255,255,255,0.1);"></i>
                                                <div class="text-muted mt-2">No {{ ($currentMode ?? 'Live') === 'Demo' ? 'demo' : 'live' }} spot trades found.</div>
                                                <a href="{{ route('spot.trade') }}" class="btn btn-primary mt-3 rounded-pill px-4 btn-sm">Start Trading</a>
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
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 6px; }
        .empty-history { display: flex; flex-direction: column; align-items: center; padding: 20px 0; }
    </style>
@endsection
