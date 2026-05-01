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
                                <a class="nav-link active" href="#open" data-toggle="tab">Open Positions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#history" data-toggle="tab">Order History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#trade" data-toggle="tab">Trade History</a>
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
                                            <th>Margin Ratio</th>
                                            <th>PnL (ROE %)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades->where('status', 'Open') as $trade)
                                            <tr>
                                                <td class="text-white font-weight-bold">{{ $trade->pair }} <span class="badge badge-soft-warning ml-1">{{ $trade->leverage }}x</span></td>
                                                <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type == 'Buy' ? '+' : '-' }}{{ number_format($trade->amount, 4) }}</td>
                                                <td>{{ number_format($trade->price, 2) }}</td>
                                                <td>{{ number_format($trade->price * 1.01, 2) }}</td> {{-- Mock mark price --}}
                                                <td class="text-warning">{{ number_format($trade->price * 0.8, 2) }}</td> {{-- Mock liq price --}}
                                                <td>2.45%</td>
                                                <td>
                                                    <div class="text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }} font-weight-bold">
                                                        {{ $trade->pnl >= 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }} {{ $trade->quote_asset_symbol ?: 'USD' }}
                                                    </div>
                                                    <small class="text-muted">(+12.4%)</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger px-3">Close</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">No open positions.</td>
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
                                            <th>Filled</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades as $trade)
                                            <tr>
                                                <td class="small">{{ $trade->created_at->format('Y-m-d H:i') }}</td>
                                                <td class="text-white font-weight-bold">{{ $trade->pair }}</td>
                                                <td>Market</td>
                                                <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">{{ $trade->type }}</td>
                                                <td>{{ number_format($trade->price, 2) }}</td>
                                                <td>{{ number_format($trade->amount, 4) }}</td>
                                                <td>100%</td>
                                                <td><span class="badge badge-soft-success">Filled</span></td>
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
