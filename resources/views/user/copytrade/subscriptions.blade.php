@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 text-white h3 font-weight-bold">My Subscriptions</h5>
                <p class="text-white-50 mb-0 small">Manage your active copy trading subscriptions and monitor performance.</p>
            </div>
            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                <a href="{{ route('copy.trade') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-plus mr-1"></i> Discover Traders
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($subscriptions as $sub)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card bg-dark-card border-secondary h-100 subscription-card overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-white font-weight-bold mb-0">
                                {{ $sub->masterAccount->name ?? 'Unknown Bot' }}
                            </h5>
                            @if($sub->status == 'Active')
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Active</span>
                            @else
                                <span class="badge badge-warning px-2 py-1">{{ $sub->status }}</span>
                            @endif
                        </div>

                        <p class="text-muted small mb-4">
                            Subscribed on: {{ $sub->start_date->format('M d, Y') }}
                            <br>
                            Ends on: {{ $sub->end_date->format('M d, Y') }} ({{ $sub->duration }})
                        </p>

                        <div class="bg-dark-input rounded p-3 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Allocated Balance:</span>
                                <span class="text-white font-weight-bold">${{ number_format($sub->balance, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Total P&L:</span>
                                <span class="{{ $sub->total_profit >= 0 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $sub->total_profit >= 0 ? '+' : '' }}${{ number_format($sub->total_profit, 2) }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Total Trades Copied:</span>
                                <span class="text-white font-weight-bold">{{ $sub->total_trades }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-auto">
                            <button class="btn btn-sm btn-outline-info rounded-pill px-3" data-toggle="modal" data-target="#statsModal{{ $sub->id }}">
                                <i class="fas fa-chart-line mr-1"></i> View Stats
                            </button>
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fas fa-stop-circle mr-1"></i> Stop Copying
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Modal -->
            <div class="modal fade" id="statsModal{{ $sub->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-dark-card border-secondary text-white">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title">Subscription Statistics: {{ $sub->masterAccount->name ?? 'Unknown Bot' }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row text-center mb-4">
                                <div class="col-6 mb-3">
                                    <small class="text-muted d-block">Win Rate</small>
                                    <h4 class="text-success">{{ $sub->win_rate ?? 0 }}%</h4>
                                </div>
                                <div class="col-6 mb-3">
                                    <small class="text-muted d-block">Total Trades</small>
                                    <h4>{{ $sub->total_trades ?? 0 }}</h4>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Wins</small>
                                    <h5 class="text-success">{{ $sub->win_count ?? 0 }}</h5>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Losses</small>
                                    <h5 class="text-danger">{{ $sub->loss_count ?? 0 }}</h5>
                                </div>
                            </div>
                            
                            <h6 class="border-bottom border-secondary pb-2 mb-3">Recent Trade History</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless text-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-muted font-weight-normal">Symbol</th>
                                            <th class="text-muted font-weight-normal">Type</th>
                                            <th class="text-muted font-weight-normal text-right">P&L</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sub->copyTradeLogs()->latest()->take(5)->get() as $log)
                                            <tr>
                                                <td>{{ $log->signal->symbol ?? 'N/A' }}</td>
                                                <td>
                                                    @if(isset($log->signal) && $log->signal->trade_type == 'BUY')
                                                        <span class="text-success">BUY</span>
                                                    @else
                                                        <span class="text-danger">SELL</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($log->profit_loss >= 0)
                                                        <span class="text-success">+${{ number_format($log->profit_loss, 2) }}</span>
                                                    @else
                                                        <span class="text-danger">-${{ number_format(abs($log->profit_loss), 2) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No recent trades found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted h4 mb-3">You don't have any active subscriptions.</div>
                <a href="{{ route('copy.trade') }}" class="btn btn-primary rounded-pill px-4 py-2">Find a Trader to Copy</a>
            </div>
        @endforelse
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .bg-dark-input { background: #0d1117; }
        .text-white-50 { color: rgba(255, 255, 255, 0.5) !important; }
        .border-secondary { border-color: rgba(255,255,255,0.05) !important; }
        .subscription-card { transition: all 0.3s ease; }
        .subscription-card:hover { transform: translateY(-3px); box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
    </style>
@endsection
