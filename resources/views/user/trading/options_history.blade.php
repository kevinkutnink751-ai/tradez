@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Options Trade History</h5>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Symbol</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Strike Price</th>
                                    <th>Expiration</th>
                                    <th>Status</th>
                                    <th>PnL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trades as $trade)
                                    <tr>
                                        <td class="small">{{ $trade->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="text-white font-weight-bold">{{ $trade->pair }}</td>
                                        <td>
                                            <span class="badge badge-soft-{{ $trade->type == 'Call' ? 'success' : 'danger' }}">
                                                {{ strtoupper($trade->type) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($trade->amount, 2) }} USDT</td>
                                        <td>{{ number_format($trade->strike_price, 2) }}</td>
                                        <td class="small">{{ $trade->expiration }}</td>
                                        <td>
                                            <span class="badge badge-{{ $trade->status == 'Won' ? 'success' : ($trade->status == 'Lost' ? 'danger' : 'warning') }}">
                                                {{ $trade->status }}
                                            </span>
                                        </td>
                                        <td class="text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }} font-weight-bold">
                                            {{ $trade->pnl >= 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }} USDT
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">No options trade history found.</td>
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
        .bg-dark-card { background: #11151d; border: 1px solid rgba(255,255,255,0.05); border-radius: 2px; }
        .table-dark-custom thead th { background: #090c10; border: 0; text-transform: uppercase; font-size: 0.7rem; color: rgba(255,255,255,0.3); padding: 1rem 1.5rem; }
        .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.03); padding: 1rem 1.5rem; vertical-align: middle; color: rgba(255,255,255,0.6); font-size: 0.8rem; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 2px; }
        .badge-soft-danger { background: rgba(220, 53, 69, 0.08); color: #dc3545; border-radius: 2px; }
        .badge-success { background: #28a745; color: #fff; border-radius: 2px; }
        .badge-danger { background: #dc3545; color: #fff; border-radius: 2px; }
        .badge-warning { background: #ffc107; color: #000; border-radius: 2px; }
    </style>
@endsection
