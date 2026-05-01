@extends('layouts.dash')
@section('title', $title)
@section('content')

<div class="dashboard-wrapper container-fluid px-0">
    {{-- Header Section --}}
    <div class="dashboard-hero d-flex align-items-center justify-content-between mb-4">
        <div>
            <div class="dashboard-kicker">Trading Desk</div>
            <h4 class="text-white font-weight-bold mb-1">Welcome back, {{ Auth::user()->name }}!</h4>
            <p class="text-muted small mb-0">A full account snapshot across funding, spot, futures, and activity.</p>
        </div>
        <div class="d-flex align-items-center dashboard-actions">
            <div class="btn-group mr-3">
                <button class="btn btn-dark-input btn-sm px-3 border-white-10" onclick="copyRef()">
                    <i class="fas fa-link mr-2 text-primary"></i> Referral Link
                </button>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary btn-sm px-4" data-toggle="dropdown">
                    <i class="fas fa-plus mr-2"></i> Quick Actions
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark">
                    <a class="dropdown-item" href="{{ route('newdeposit') }}"><i class="fas fa-wallet mr-2"></i> Deposit</a>
                    <a class="dropdown-item" href="{{ route('withdrawamount') }}"><i class="fas fa-arrow-up mr-2"></i> Withdraw</a>
                    {{-- <a class="dropdown-item" href="{{ route('transfer') }}"><i class="fas fa-exchange-alt mr-2"></i> Transfer</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row dashboard-grid">
        {{-- Main Content --}}
        <div class="col-lg-8">
            {{-- Portfolio Overview --}}
            <div class="card bg-premium-gradient border-0 mb-4 overflow-hidden dashboard-balance-card">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="text-white-50 text-uppercase small font-weight-bold mb-2" style="letter-spacing: 1px;">Total Portfolio Balance</h6>
                            <h2 class="text-white font-weight-bold mb-2">${{ number_format(Auth::user()->getTotalBalanceAttribute(), 2) }}</h2>
                            <div class="d-flex align-items-center">
                                <span class="text-success mr-2 font-weight-bold"><i class="fas fa-caret-up mr-1"></i> 2.45%</span>
                                <span class="text-white-50 small">+$1,240.50 (24h)</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-right d-none d-md-block">
                            <div class="mini-chart-container" style="height: 100px;">
                                {{-- Placeholder for sparkline --}}
                                <canvas id="portfolioChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white-5 border-0 py-3">
                    <div class="row text-center">
                        <div class="col-4 border-right border-white-10">
                            <small class="text-white-50 d-block">Spot</small>
                            <span class="text-white font-weight-bold">${{ number_format(Auth::user()->spot_bal, 2) }}</span>
                        </div>
                        <div class="col-4 border-right border-white-10">
                            <small class="text-white-50 d-block">Futures</small>
                            <span class="text-white font-weight-bold">${{ number_format(Auth::user()->future_bal, 2) }}</span>
                        </div>
                        <div class="col-4">
                            <small class="text-white-50 d-block">Funding</small>
                            <span class="text-white font-weight-bold">${{ number_format(Auth::user()->account_bal, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Market Overview --}}
            <div class="card bg-dark-card border-0 mb-4 dashboard-panel">
                <div class="card-header bg-transparent border-white-10 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="text-white font-weight-bold mb-0">Market Overview</h5>
                    <a href="#" class="text-primary small">View All Markets</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom mb-0">
                            <thead>
                                <tr class="text-muted text-uppercase small">
                                    <th class="pl-4">Asset</th>
                                    <th>Price</th>
                                    <th>Change (24h)</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="asset-icon-sm bg-warning mr-3">B</div>
                                            <div>
                                                <h6 class="text-white mb-0 font-weight-bold">Bitcoin</h6>
                                                <small class="text-muted">BTC/USDT</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-white font-weight-bold">$64,231.50</span></td>
                                    <td><span class="text-success font-weight-bold">+2.45%</span></td>
                                    <td class="text-right pr-4">
                                        <a href="{{ route('spot.trade', ['pair' => 'BTC/USDT']) }}" class="btn btn-xs btn-outline-primary px-3">Trade</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="asset-icon-sm bg-primary mr-3">E</div>
                                            <div>
                                                <h6 class="text-white mb-0 font-weight-bold">Ethereum</h6>
                                                <small class="text-muted">ETH/USDT</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-white font-weight-bold">$3,450.20</span></td>
                                    <td><span class="text-danger font-weight-bold">-1.12%</span></td>
                                    <td class="text-right pr-4">
                                        <a href="{{ route('spot.trade', ['pair' => 'ETH/USDT']) }}" class="btn btn-xs btn-outline-primary px-3">Trade</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="asset-icon-sm bg-info mr-3">S</div>
                                            <div>
                                                <h6 class="text-white mb-0 font-weight-bold">Solana</h6>
                                                <small class="text-muted">SOL/USDT</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-white font-weight-bold">$145.75</span></td>
                                    <td><span class="text-success font-weight-bold">+5.60%</span></td>
                                    <td class="text-right pr-4">
                                        <a href="{{ route('spot.trade', ['pair' => 'SOL/USDT']) }}" class="btn btn-xs btn-outline-primary px-3">Trade</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="card bg-dark-card border-0 dashboard-panel">
                <div class="card-header bg-transparent border-white-10 py-3 px-4">
                    <h5 class="text-white font-weight-bold mb-0">Recent Activity</h5>
                </div>
                <div class="card-body p-4">
                    <div class="activity-timeline">
                        @forelse ($recent_orders->take(5) as $order)
                        <div class="activity-item d-flex mb-4">
                            <div class="activity-icon bg-{{ $order->type == 'Buy' ? 'success' : 'danger' }}-transparent text-{{ $order->type == 'Buy' ? 'success' : 'danger' }} mr-3">
                                <i class="fas fa-{{ $order->type == 'Buy' ? 'arrow-down' : 'arrow-up' }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white mb-1 font-weight-bold">{{ $order->type }} {{ $order->pair }}</h6>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted small mb-0">Order #{{ $order->id }} completed for {{ $order->amount }} {{ $order->coin }} at market price.</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-history text-muted fa-3x mb-3"></i>
                            <p class="text-muted">No recent activity to show.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Content --}}
        <div class="col-lg-4">
            {{-- Product Shortcuts --}}
            <div class="row">
                @if(isset($mod['future']) && $mod['future'])
                <div class="col-12 mb-4">
                    <a href="{{ route('future.trade') }}" class="card-link">
                        <div class="card bg-dark-card border-0 product-card h-100 overflow-hidden dashboard-panel">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="product-icon bg-primary text-white mr-3">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <h6 class="text-white font-weight-bold mb-0">Futures Trading</h6>
                                </div>
                                <p class="text-muted small mb-0">Trade with up to 125x leverage on major crypto and forex pairs.</p>
                            </div>
                            <div class="product-card-bg">
                                <i class="fas fa-bolt"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(isset($mod['copy']) || isset($mod['subscription']))
                <div class="col-12 mb-4">
                    <a href="{{ route('copy.trade') }}" class="card-link">
                        <div class="card bg-dark-card border-0 product-card h-100 overflow-hidden dashboard-panel">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="product-icon bg-info text-white mr-3">
                                        <i class="fas fa-copy"></i>
                                    </div>
                                    <h6 class="text-white font-weight-bold mb-0">Copy Trading</h6>
                                </div>
                                <p class="text-muted small mb-0">Follow elite traders and mirror their winning strategies automatically.</p>
                            </div>
                            <div class="product-card-bg">
                                <i class="fas fa-copy"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>

            {{-- Recent Transactions --}}
            <div class="card bg-dark-card border-0 mb-4 dashboard-panel">
                <div class="card-header bg-transparent border-white-10 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="text-white font-weight-bold mb-0">Transactions</h6>
                    <a href="{{ route('accounthistory') }}" class="text-primary small">See All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($t_history->take(4) as $item)
                        <div class="list-group-item bg-transparent border-white-10 py-3 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="tx-icon rounded-circle mr-3 {{ $item->amount > 0 ? 'bg-success-transparent text-success' : 'bg-danger-transparent text-danger' }}">
                                        <i class="fas fa-{{ $item->amount > 0 ? 'plus' : 'minus' }}"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-white small font-weight-bold mb-0">{{ $item->plan }}</h6>
                                        <small class="text-muted">{{ $item->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                                <h6 class="text-white small font-weight-bold mb-0">{{ $item->amount > 0 ? '+' : '' }}{{ number_format($item->amount, 2) }} {{ $item->coin ?? 'USD' }}</h6>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted small">No transactions.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Referral Card --}}
            <div class="card border-0 bg-primary-transparent overflow-hidden dashboard-panel">
                <div class="card-body p-4 position-relative z-index-1">
                    <h6 class="text-primary font-weight-bold text-uppercase mb-2" style="letter-spacing: 1px; font-size: 0.65rem;">Affiliation</h6>
                    <h5 class="text-white font-weight-bold mb-2">Invite Friends, Earn Crypto</h5>
                    <p class="text-muted small mb-4">Get up to 20% commission on every trade your friends make on our platform.</p>
                    <button class="btn btn-primary btn-sm btn-block rounded-xs" onclick="copyRef()">Copy Invite Link</button>
                </div>
                <div class="referral-decor">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-wrapper {
        padding: 0;
    }
    .dashboard-hero {
        padding: 0.25rem 0 0.4rem;
    }
    .dashboard-kicker {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.75rem;
        margin-bottom: 0.9rem;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 6px;
        background: rgba(255,255,255,0.02);
        color: #7d8ca5;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
    .dashboard-grid {
        margin-left: -0.75rem;
        margin-right: -0.75rem;
    }
    .dashboard-grid > [class*="col-"] {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    .dashboard-actions {
        gap: 0.75rem;
    }
    .dashboard-actions .btn-group {
        margin-right: 0 !important;
    }
    .dashboard-wrapper .card-header,
    .dashboard-wrapper .card-body,
    .dashboard-wrapper .card-footer {
        border-color: rgba(255,255,255,0.06) !important;
    }
    .dashboard-wrapper .table th,
    .dashboard-wrapper .table td {
        vertical-align: middle;
    }
    .dashboard-panel,
    .dashboard-balance-card {
        border-radius: 10px;
        box-shadow: none;
    }
    @media (max-width: 991.98px) {
        .dashboard-hero {
            padding: 0.3rem 0 0.2rem;
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }
        .dashboard-actions {
            width: 100%;
            flex-direction: column;
            align-items: stretch !important;
        }
        .dashboard-actions .btn,
        .dashboard-actions .dropdown,
        .dashboard-actions .btn-group {
            width: 100%;
        }
        .dashboard-wrapper .col-lg-8,
        .dashboard-wrapper .col-lg-4 {
            margin-bottom: 1rem;
        }
    }
    @media (max-width: 767.98px) {
        .dashboard-wrapper {
            padding: 0;
        }
        .dashboard-wrapper .card {
            border-radius: 10px;
        }
    }
</style>

<style>
    .bg-dark-card {
        background:
            linear-gradient(180deg, rgba(255,255,255,0.02), transparent 32%),
            #11151d;
        border-radius: 10px;
    }
    .bg-white-5 { background: rgba(255,255,255,0.03); }
    .border-white-10 { border-color: rgba(255,255,255,0.05) !important; }
    
    /* Premium Gradient Card */
    .bg-premium-gradient {
        background: linear-gradient(135deg, #1572e8 0%, #0c4a9a 100%);
        box-shadow: 0 10px 30px rgba(21, 114, 232, 0.2);
    }
    
    /* Stats & Icons */
    .asset-icon-sm {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #fff;
        font-size: 0.8rem;
    }
    .product-icon {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .tx-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }
    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
    
    /* Transparent BG utilities */
    .bg-primary-transparent { background: rgba(21, 114, 232, 0.05); }
    .bg-success-transparent { background: rgba(0, 200, 83, 0.1); }
    .bg-danger-transparent { background: rgba(255, 61, 0, 0.1); }
    
    /* Product Cards */
    .product-card {
        transition: all 0.3s;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-5px);
        background: #1a1f2c;
    }
    .product-card-bg {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 5rem;
        opacity: 0.02;
        color: #fff;
        transform: rotate(-15deg);
    }
    .card-link:hover { text-decoration: none; }
    
    /* Table Styling */
    .table-dark-custom th { border-top: 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .table-dark-custom td { border-top: 1px solid rgba(255,255,255,0.03); vertical-align: middle; padding: 1.25rem 0.75rem; }
    
    /* Referral Decor */
    .referral-decor {
        position: absolute;
        right: -10px;
        top: -10px;
        font-size: 4rem;
        opacity: 0.05;
        color: #1572e8;
        transform: rotate(15deg);
    }
    
    /* Button Tweaks */
    .btn-xs { padding: 0.25rem 0.75rem; font-size: 0.7rem; border-radius: 2px; }
    .btn-outline-primary { border-color: rgba(21, 114, 232, 0.3); color: #1572e8; }
    .btn-outline-primary:hover { background: rgba(21, 114, 232, 0.1); border-color: #1572e8; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('portfolioChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        data: [65, 59, 80, 81, 56, 95],
                        borderColor: 'rgba(255, 255, 255, 0.3)',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });
        }
    });

    function copyRef() {
        var dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.value = "{{ Auth::user()->ref_link }}";
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        
        $.notify({
            icon: 'fas fa-check-circle',
            message: "Referral link copied!"
        }, {
            type: 'success',
            placement: { from: "top", align: "right" },
            time: 1000,
        });
    }
</script>
@endsection
