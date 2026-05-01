@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Manage Active Orders</h5>
        <p class="text-white-50 small">Track and manage your open positions in Spot and Future markets.</p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-white font-weight-bold mb-0">Open Positions</h6>
                        <div class="filter-actions">
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 mr-2">Close All</button>
                            <button class="btn btn-sm btn-primary rounded-pill px-3">Export</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover align-items-center">
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
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="pair-icon mr-2 bg-soft-primary text-primary"><i class="fas fa-exchange-alt"></i></div>
                                                <div class="font-weight-bold text-white">{{ $trade->pair }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }} font-weight-bold">
                                                {{ $trade->type }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-info px-2">{{ $trade->market_type }}</span>
                                            @if($trade->leverage > 1)
                                                <small class="text-warning ml-1">{{ $trade->leverage }}x</small>
                                            @endif
                                        </td>
                                        <td class="text-white">{{ number_format($trade->amount, 4) }}</td>
                                        <td>${{ number_format($trade->price, 2) }}</td>
                                        <td class="text-white">${{ number_format($trade->price * 1.02, 2) }}</td> {{-- Mock current price --}}
                                        <td>
                                            <span class="font-weight-bold text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }}">
                                                {{ $trade->pnl >= 0 ? '+' : '' }}${{ number_format($trade->pnl, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Close</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">No active orders found. Start trading to see your positions here.</div>
                                            <a href="{{ route('spot.trade') }}" class="btn btn-primary mt-3 rounded-pill px-4">Open Trade</a>
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
        .bg-dark-card { background: #151a24; }
        .bg-dark-input { background: #0d1117; }
        .table-dark-custom { color: #8898aa; margin-bottom: 0; }
        .table-dark-custom thead th {
            background: #0d1117;
            border: 0;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1.25rem 1.5rem;
        }
        .table-dark-custom tbody td {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
        }
        .pair-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; }
        .bg-soft-primary { background: rgba(21, 114, 232, 0.1); }
        .badge-soft-info { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
    </style>
@endsection
