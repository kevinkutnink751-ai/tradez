@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Spot Trade History</h5>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="nav nav-tabs nav-tabs-trading border-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#history" data-toggle="tab">Order History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#trade" data-toggle="tab">Trade History</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="history">
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
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades as $trade)
                                            <tr>
                                                <td class="small">{{ $trade->created_at->format('Y-m-d H:i') }}</td>
                                                <td class="text-white font-weight-bold">{{ $trade->pair }}</td>
                                                <td>Market</td>
                                                <td class="text-{{ $trade->type == 'Buy' ? 'success' : 'danger' }} font-weight-bold">{{ strtoupper($trade->type) }}</td>
                                                <td>{{ number_format($trade->price, 2) }}</td>
                                                <td>{{ number_format($trade->amount, 4) }}</td>
                                                <td>100%</td>
                                                <td class="text-white font-weight-bold">{{ number_format($trade->price * $trade->amount, 2) }} USDT</td>
                                                <td><span class="badge badge-soft-success">Filled</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5 text-muted">No order history found.</td>
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
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 2px; }
    </style>
@endsection
