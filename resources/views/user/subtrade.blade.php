@extends('layouts.dash')
@section('title', $title)
@section('content')
    <div class="page-title mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 text-white h3 font-weight-bold">Managed Accounts</h5>
                <p class="text-white-50 mb-0">Monitor and manage your copy-trading accounts in real-time.</p>
            </div>
            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#submitmt4modal">
                    <i class="fas fa-plus mr-2"></i>Link New Account
                </button>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    {{-- Aggregate Stats --}}
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow-sm border-0 h-100" style="background: #1a1f2c; color: white;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1">Total Profit</h6>
                            <span class="h3 font-weight-bold mb-0 {{ $stats['total_profit'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $settings->currency }}{{ number_format($stats['total_profit'], 2) }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow-sm border-0 h-100" style="background: #1a1f2c; color: white;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1">Total Trades</h6>
                            <span class="h3 font-weight-bold mb-0 text-white">{{ $stats['total_trades'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow-sm border-0 h-100" style="background: #1a1f2c; color: white;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1">Active Accounts</h6>
                            <span class="h3 font-weight-bold mb-0 text-white">{{ $stats['active_accounts'] }} / {{ $stats['total_accounts'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="fas fa-server"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow-sm border-0 h-100" style="background: #1a1f2c; color: white;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1">Success Rate</h6>
                            @php
                                $total_wins = $subscriptions->sum('win_count');
                                $total_trades = $subscriptions->sum('total_trades');
                                $success_rate = $total_trades > 0 ? round(($total_wins / $total_trades) * 100, 1) : 0;
                            @endphp
                            <span class="h3 font-weight-bold mb-0 text-white">{{ $success_rate }}%</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="row">
        <div class="col-12">
            @forelse ($subscriptions as $sub)
                <div class="card shadow-sm border-0 mb-5 overflow-hidden">
                    <div class="card-header border-0 py-4" style="background: #1a1f2c;">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="text-white mb-1 font-weight-bold">
                                    <i class="fas fa-microchip mr-2 text-primary"></i> {{ $sub->account_name ?? 'MT4 Account' }} 
                                    <small class="ml-2 text-muted font-weight-light">#{{ $sub->mt4_id }}</small>
                                </h5>
                                <p class="text-muted mb-0 small">{{ $sub->server }} &middot; {{ $sub->account_type }} &middot; {{ $sub->leverage }} Leverage</p>
                            </div>
                            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                @if($sub->status == 'Active')
                                    <span class="badge badge-success badge-pill px-3 py-2">ACTIVE</span>
                                @elseif($sub->status == 'Expired')
                                    <span class="badge badge-danger badge-pill px-3 py-2">EXPIRED</span>
                                @else
                                    <span class="badge badge-warning badge-pill px-3 py-2">{{ strtoupper($sub->status) }}</span>
                                @endif
                                <button class="btn btn-sm btn-outline-light ml-3" onclick="deletemt4()">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            {{-- Account Summary Stats --}}
                            <div class="col-lg-4">
                                <div class="bg-secondary-light rounded p-4 h-100 border">
                                    <h6 class="text-muted font-weight-bold mb-4">ACCOUNT PERFORMANCE</h6>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Equity Balance</small>
                                            <span class="h5 font-weight-bold mb-0 text-dark">{{ $settings->currency }}{{ number_format($sub->balance ?? 0, 2) }}</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Total Profit</small>
                                            <span class="h5 font-weight-bold mb-0 {{ $sub->total_profit >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $sub->total_profit >= 0 ? '+' : '' }}{{ number_format($sub->total_profit, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Win Rate</small>
                                            <span class="h5 font-weight-bold mb-0 text-dark">{{ $sub->win_rate }}%</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Win / Loss</small>
                                            <span class="h5 font-weight-bold mb-0 text-dark">
                                                <span class="text-success">{{ $sub->win_count }}</span> / <span class="text-danger">{{ $sub->loss_count }}</span>
                                            </span>
                                        </div>
                                    </div>

                                    <h6 class="text-muted font-weight-bold mb-3">SUBSCRIPTION DETAILS</h6>
                                    <ul class="list-unstyled small">
                                        <li class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Duration:</span>
                                            <span class="font-weight-600 text-dark">{{ $sub->duration }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Started:</span>
                                            <span class="font-weight-600 text-dark">{{ $sub->start_date ? $sub->start_date->format('M d, Y') : '-' }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span class="text-muted">Expires:</span>
                                            <span class="font-weight-600 text-dark text-{{ now()->greaterThan($sub->end_date) ? 'danger' : 'primary' }}">
                                                {{ $sub->end_date ? $sub->end_date->format('M d, Y') : '-' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Recent Trades --}}
                            <div class="col-lg-8 mt-4 mt-lg-0">
                                <h6 class="text-muted font-weight-bold mb-3 d-flex justify-content-between align-items-center">
                                    RECENT TRADES
                                    <span class="badge badge-light badge-pill border">{{ $sub->copyTradeLogs->count() }} Entries</span>
                                </h6>
                                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table table-hover align-items-center table-flush table-sm border-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="py-3">Type</th>
                                                <th class="py-3">Symbol</th>
                                                <th class="py-3">Open Price</th>
                                                <th class="py-3">Close Price</th>
                                                <th class="py-3 text-right">Profit/Loss</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sub->copyTradeLogs as $trade)
                                                <tr>
                                                    <td>
                                                        @if($trade->signal)
                                                            <span class="badge badge-{{ $trade->signal->trade_type == 'BUY' ? 'success' : 'danger' }} px-2 py-1">
                                                                {{ $trade->signal->trade_type }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary px-2 py-1">TRADE</span>
                                                        @endif
                                                    </td>
                                                    <td class="font-weight-bold">{{ $trade->signal->symbol ?? 'Unknown' }}</td>
                                                    <td>{{ $trade->executed_price }}</td>
                                                    <td>{{ $trade->closed_price ?? '—' }}</td>
                                                    <td class="text-right">
                                                        @if($trade->status == 'OPEN')
                                                            <span class="text-info font-weight-bold italic">OPEN</span>
                                                        @else
                                                            <span class="font-weight-bold {{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                                                {{ $trade->profit_loss >= 0 ? '+' : '' }}{{ number_format($trade->profit_loss, 2) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5 text-muted">No trades recorded for this account.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 text-right">
                                    <a href="{{ route('tradinghistory') }}" class="small font-weight-bold text-primary">View Full Trade History <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm border-0 py-5">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-server fa-4x text-muted opacity-3"></i>
                        </div>
                        <h4 class="text-muted font-weight-bold">No Managed Accounts Found</h4>
                        <p class="text-muted mb-4">Start copying our expert traders by linking your MT4 account today.</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#submitmt4modal">
                            Get Started Now
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @include('user.modals')

    <style>
        .bg-secondary-light { background: #f8f9fe; }
        .bg-white-10 { background: rgba(255, 255, 255, 0.05); }
        .text-white-50 { color: rgba(255, 255, 255, 0.5) !important; }
        .icon-shape {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .table thead th {
            text-transform: uppercase;
            font-size: .65rem;
            letter-spacing: .025em;
            font-weight: 700;
            background-color: #f6f9fc;
            border-bottom: 1px solid #e9ecef;
        }
        .italic { font-style: italic; }
    </style>

    <script type="text/javascript">
        function deletemt4() {
            swal({
                title: "Cancel Subscription?",
                text: "To cancel your account management service, please send an email to {{ $settings->contact_email }}. Our team will process your request within 24 hours.",
                icon: "info",
                buttons: {
                    confirm: {
                        text: "Close",
                        value: true,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true
                    }
                }
            });
        }
    </script>
@endsection
