@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Future Trade History</h5>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="nav nav-tabs nav-tabs-trading border-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#open" data-toggle="tab">Open Positions ({{ $trades->where('status', 'Open')->count() }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#history" data-toggle="tab">History ({{ $trades->whereIn('status', ['Completed', 'Canceled'])->count() }})</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="open">
                            <div class="table-responsive">
                                <table class="table table-dark-custom table-hover">
                                    <thead>
                                        <tr>
                                            <th>Symbol</th>
                                            <th>Size</th>
                                            <th>Entry Price</th>
                                            <th>Mark Price</th>
                                            <th>Liq. Price</th>
                                            <th>Margin</th>
                                            <th>PnL (ROI %)</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades->where('status', 'Open') as $trade)
                                            <tr>
                                                <td class="text-white font-weight-bold">{{ $trade->pair }} <span class="badge badge-soft-success ml-1">{{ $trade->leverage }}x</span></td>
                                                <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type == 'Buy' ? '+' : '-' }}{{ number_format($trade->amount, 4) }}</td>
                                                <td>{{ number_format($trade->price, 4) }}</td>
                                                <td>{{ number_format($trade->price, 4) }}</td>
                                                <td class="text-warning">--</td>
                                                <td>{{ number_format($trade->amount / $trade->leverage, 4) }} {{ $trade->settlement_asset }}</td>
                                                <td>
                                                    <div class="text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }} font-weight-bold">
                                                        {{ $trade->pnl >= 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }} {{ $trade->settlement_asset }}
                                                    </div>
                                                    <small class="text-muted">({{ number_format(($trade->pnl / max(0.0001, $trade->amount / $trade->leverage)) * 100, 2) }}%)</small>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('trade.close', $trade->id) }}" class="btn btn-sm btn-soft-danger px-3 font-weight-bold" onclick="return confirm('Close this position?')">Market Close</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">No open positions found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="history">
                             <div class="table-responsive">
                                <table class="table table-dark-custom table-hover">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Symbol</th>
                                            <th>Type</th>
                                            <th>Side</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>PNL</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades->whereIn('status', ['Completed', 'Canceled']) as $trade)
                                            <tr>
                                                <td class="small text-muted">{{ $trade->created_at->format('Y-m-d H:i') }}</td>
                                                <td class="text-white font-weight-bold">{{ $trade->pair }}</td>
                                                <td>{{ $trade->order_type }}</td>
                                                <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type }}</td>
                                                <td>{{ number_format($trade->price, 4) }}</td>
                                                <td>{{ number_format($trade->amount, 4) }}</td>
                                                <td class="{{ $trade->pnl >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($trade->pnl, 4) }}</td>
                                                <td><span class="badge badge-soft-{{ $trade->status == 'Completed' ? 'success' : 'secondary' }}">{{ $trade->status }}</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">No order history found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #11151d; border: 1px solid rgba(255,255,255,0.05); border-radius: 2px; }
        .nav-tabs-trading .nav-link { color: rgba(255,255,255,0.4); border: 0; font-weight: 600; font-size: 0.85rem; padding: 0.8rem 1.2rem; border-radius: 0; }
        .nav-tabs-trading .nav-link.active { background: transparent; color: #1572e8; border-bottom: 2px solid #1572e8; }
        .table-dark-custom thead th { background: #090c10; border: 0; text-transform: uppercase; font-size: 0.7rem; color: rgba(255,255,255,0.3); padding: 1rem 1.5rem; }
        .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.03); padding: 1rem 1.5rem; vertical-align: middle; color: rgba(255,255,255,0.6); font-size: 0.8rem; }
        .badge-soft-warning { background: rgba(255, 193, 7, 0.08); color: #ffc107; border-radius: 2px; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 2px; }
    </style>
@endsection
