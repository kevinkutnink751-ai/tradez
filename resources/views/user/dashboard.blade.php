@extends('layouts.dash')
@section('title', $title)
@section('content')

<div class="dashboard-wrapper container-fluid">
    <!-- Top Section: Account Summary & Rank -->
    <div class="row mb-4 shadow-lg rounded-xl overflow-hidden premium-header-row">
        <!-- Account Summary -->
        <div class="col-lg-6 summary-column p-4 p-md-5">
            <div class="top-balance-header mb-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-white-50 small font-weight-bold text-uppercase" style="letter-spacing: 1px;">Total Portfolio Balance</span>
                        <h1 class="text-white balance-text font-weight-bold mb-1">${{ number_format(Auth::user()->account_bal + Auth::user()->spot_bal + Auth::user()->future_bal, 2) }}</h1>
                        <p class="text-white-50 mb-0">Capital: ${{ number_format($deposited, 2) }}</p>
                    </div>
                    <div class="header-actions d-none d-sm-flex">
                        <a href="{{ route('manage.wallet') }}" class="icon-btn mr-2 d-flex align-items-center justify-content-center text-decoration-none"><i class="fas fa-wallet"></i></a>
                        <button class="icon-btn"><i class="fas fa-file-alt"></i></button>
                    </div>
                </div>
            </div>

            <div class="summary-list small">
                <div class="summary-item d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="item-icon mr-2 mr-md-3"><i class="fas fa-arrow-down"></i></div>
                        <span class="text-white font-weight-bold text-truncate">Total deposits</span>
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <span class="text-white mr-2 mr-md-3">${{ number_format($deposited, 2) }}</span>
                        <a href="{{ route('deposits') }}" class="btn btn-xs btn-summary-action">Deposit</a>
                    </div>
                </div>
                <div class="summary-item d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="item-icon mr-2 mr-md-3"><i class="fas fa-arrow-up"></i></div>
                        <span class="text-white font-weight-bold text-truncate">Total withdrawals</span>
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <span class="text-white mr-2 mr-md-3">${{ number_format($total_withdrawal, 2) }}</span>
                        <a href="{{ route('withdrawalsdeposits') }}" class="btn btn-xs btn-summary-action">Withdraw</a>
                    </div>
                </div>
                <div class="summary-item d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="item-icon mr-2 mr-md-3"><i class="fas fa-chart-line"></i></div>
                        <span class="text-white font-weight-bold text-truncate">Total profits</span>
                    </div>
                    <span class="text-success font-weight-bold flex-shrink-0">+${{ number_format($total_profits, 2) }}</span>
                </div>
                <div class="summary-item d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="item-icon mr-2 mr-md-3"><i class="fas fa-wallet"></i></div>
                        <span class="text-white font-weight-bold text-truncate">Wallets Hub</span>
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <a href="{{ route('manage.wallet') }}" class="btn btn-xs btn-summary-action">Manage Hub</a>
                    </div>
                </div>
                <div class="summary-item d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="item-icon mr-2 mr-md-3"><i class="fas fa-user-check"></i></div>
                        <span class="text-white font-weight-bold text-truncate">Verification</span>
                    </div>
                    <span class="{{ Auth::user()->account_verify == 'Verified' ? 'text-primary' : 'text-warning' }} font-weight-bold flex-shrink-0">{{ Auth::user()->account_verify == 'Verified' ? 'Verified' : 'Pending' }}</span>
                </div>
            </div>
        </div>

        <!-- Rank Column -->
        <div class="col-lg-6 rank-column p-4 p-md-5 text-center">
            <div class="rank-header text-left mb-4 d-flex justify-content-between align-items-center">
                <h5 class="text-white font-weight-bold mb-0">Trader Level</h5>
                <span class="badge badge-soft-primary px-3">SILVER</span>
            </div>
            
            <div class="rank-badge-display mb-4">
                <img src="{{ asset('assets/images/silver_rank_badge.png') }}" alt="Silver Rank" class="img-fluid floating-badge" style="max-height: 140px;">
            </div>

            <div class="rank-progress-container px-md-4">
                <div class="d-flex justify-content-between small text-white-50 mb-2 font-weight-bold">
                    <span class="text-truncate mr-2">Unlock Gold Rank</span>
                    <span class="flex-shrink-0">${{ number_format($deposited, 0) }} / $5k</span>
                </div>
                <div class="progress progress-dark" style="height: 6px; border-radius: 3px;">
                    @php $progress = min(100, ($deposited / 5000) * 100); @endphp
                    <div class="progress-bar bg-primary shadow-glow" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Section: Chart & P&L Calendar -->
    <div class="row mb-4">
        <!-- Live Market Chart -->
        <div class="col-xl-7 col-lg-6 mb-4 mb-lg-0">
            <div class="card bg-dark-card border-0 h-100 overflow-hidden shadow-lg">
                <div class="card-header bg-transparent border-white-10 py-3 px-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center overflow-hidden">
                        <i class="fas fa-chart-area text-primary mr-3 flex-shrink-0"></i>
                        <h6 class="text-white font-weight-bold mb-0 text-truncate">BTC/USDT Real-time</h6>
                    </div>
                    <span class="badge badge-soft-success d-none d-sm-inline-block">Live Market</span>
                </div>
                <div class="card-body p-0" style="min-height: 400px; height: 450px;">
                    <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
                        <div id="tradingview_chart" style="height: 100%; width: 100%;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.widget({
                            "autosize": true,
                            "symbol": "BINANCE:BTCUSDT",
                            "interval": "D",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "toolbar_bg": "#f1f3f6",
                            "enable_publishing": false,
                            "hide_side_toolbar": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_chart"
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- P&L Calendar -->
        <div class="col-xl-5 col-lg-6">
            <div class="card bg-dark-card border-0 h-100 shadow-lg overflow-hidden">
                <div class="card-header bg-transparent border-white-10 py-3 px-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                        <h6 class="text-white font-weight-bold mb-0">P&L Calendar</h6>
                    </div>
                    <div class="calendar-toggles d-none d-sm-block">
                        <button class="btn btn-xs btn-outline-primary active mr-1">Summary 🔥</button>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                        <i class="fas fa-chevron-left text-muted cursor-pointer"></i>
                        <h6 class="text-white mb-0">{{ now()->format('F Y') }}</h6>
                        <i class="fas fa-chevron-right text-muted cursor-pointer"></i>
                    </div>
                    
                    <div class="pnl-calendar-container">
                        <div class="pnl-calendar-grid">
                            <div class="pnl-day-header">Mon</div>
                            <div class="pnl-day-header">Tue</div>
                            <div class="pnl-day-header">Wed</div>
                            <div class="pnl-day-header">Thu</div>
                            <div class="pnl-day-header">Fri</div>
                            <div class="pnl-day-header text-danger">Sat</div>
                            <div class="pnl-day-header text-danger">Sun</div>
                            
                            @php
                                $startOfMonth = now()->startOfMonth();
                                $daysInMonth = now()->daysInMonth;
                                $dayOfWeek = $startOfMonth->dayOfWeek == 0 ? 7 : $startOfMonth->dayOfWeek;
                                $today = now()->day;
                            @endphp

                            @for($i = 1; $i < $dayOfWeek; $i++)
                                <div class="pnl-day empty"></div>
                            @endfor

                            @for($day = 1; $day <= $daysInMonth; $day++)
                                @php 
                                    $dateStr = now()->year . '-' . str_pad(now()->month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                    $pnl = $dailyPnl[$dateStr] ?? null;
                                @endphp
                                <div class="pnl-day {{ $day == $today ? 'today' : '' }}">
                                    <span class="day-num">{{ $day }}</span>
                                    @if($pnl !== null)
                                        <span class="day-pnl text-{{ $pnl >= 0 ? 'success' : 'danger' }}">{{ $pnl >= 0 ? '+' : '' }}{{ number_format($pnl, 0) }}</span>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Recent Activity & Market Table -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card bg-dark-card border-0 shadow-lg overflow-hidden">
                <div class="card-header bg-transparent border-white-10 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="text-white font-weight-bold mb-0">Recent Activity</h6>
                    <a href="{{ route('trade.history') }}" class="text-primary small font-weight-bold">See All History</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom mb-0">
                            <thead>
                                <tr>
                                    <th class="px-4">Trade</th>
                                    <th class="d-none d-md-table-cell">Market</th>
                                    <th>Side</th>
                                    <th class="d-none d-sm-table-cell">Amount</th>
                                    <th>P&L</th>
                                    <th class="px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recent_orders->take(6) as $order)
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="asset-circle mr-3 bg-{{ $order->type == 'Buy' ? 'success' : 'danger' }}-transparent d-none d-sm-flex">
                                                <i class="fas fa-{{ $order->type == 'Buy' ? 'long-arrow-alt-down' : 'long-arrow-alt-up' }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-white small font-weight-bold mb-0">{{ $order->pair }}</h6>
                                                <small class="text-muted d-block">{{ $order->created_at->format('M d, H:i') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell"><span class="badge badge-soft-dark small">{{ $order->market_type }}</span></td>
                                    <td><span class="text-{{ $order->type == 'Buy' ? 'success' : 'danger' }} small font-weight-bold">{{ $order->type }}</span></td>
                                    <td class="text-white small font-weight-bold d-none d-sm-table-cell">${{ number_format($order->amount, 2) }}</td>
                                    <td class="text-{{ $order->pnl >= 0 ? 'success' : 'danger' }} small font-weight-bold">{{ $order->pnl >= 0 ? '+' : '' }}${{ number_format($order->pnl, 2) }}</td>
                                    <td class="px-4"><span class="badge badge-soft-{{ $order->status == 'Completed' ? 'success' : 'warning' }} small px-2 px-md-3">{{ $order->status }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-4 text-muted">No recent activity.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card bg-dark-card border-0 h-100 shadow-lg overflow-hidden">
                <div class="card-header bg-transparent border-white-10 py-3 px-4">
                    <h6 class="text-white font-weight-bold mb-0">Quick Assets</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($marketPairs->take(5) as $pair)
                        <a href="{{ route('spot.trade', ['pair' => $pair->name]) }}" class="list-group-item bg-transparent border-white-10 py-3 px-4 asset-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center overflow-hidden">
                                    <div class="asset-logo mr-3 bg-primary-transparent text-primary flex-shrink-0">{{ substr($pair->name, 0, 1) }}</div>
                                    <div class="text-truncate">
                                        <h6 class="text-white small font-weight-bold mb-0 text-truncate">{{ $pair->name }}</h6>
                                        <small class="text-muted text-truncate d-block">Vol: {{ number_format($pair->volume_24h / 1000000, 1) }}M</small>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <h6 class="text-white small font-weight-bold mb-0">${{ number_format($pair->last_price, 2) }}</h6>
                                    <small class="text-{{ $pair->change_24h >= 0 ? 'success' : 'danger' }}">{{ $pair->change_24h >= 0 ? '+' : '' }}{{ number_format($pair->change_24h, 2) }}%</small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-wrapper { background: #080b12; min-height: 100vh; padding: 15px; overflow-x: hidden; }
    
    /* Top Row Layout */
    .premium-header-row { border: 1px solid rgba(255,255,255,0.05); }
    .summary-column { 
        background: linear-gradient(135deg, #0d1526 0%, #080b12 100%);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }
    .rank-column { background: #080b12; }
    
    @media (max-width: 991.98px) {
        .summary-column { border-right: none; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .dashboard-wrapper { padding: 10px; }
        .balance-text { font-size: 2rem !important; }
    }

    /* UI Elements */
    .bg-dark-card { background: #11151d; border-radius: 12px; }
    .border-white-10 { border-color: rgba(255,255,255,0.05) !important; }
    .icon-btn { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: #8898aa; width: 32px; height: 32px; border-radius: 8px; }
    .item-icon { width: 20px; color: #1572e8; flex-shrink: 0; }
    .btn-summary-action { background: rgba(21, 114, 232, 0.1); color: #1572e8; border: 1px solid rgba(21, 114, 232, 0.2); border-radius: 6px; padding: 4px 10px; }
    
    /* Rank Effects */
    .floating-badge { filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5)); animation: float 5s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .progress-dark { background: rgba(255,255,255,0.05); }
    .shadow-glow { box-shadow: 0 0 10px rgba(21, 114, 232, 0.3); }

    /* Calendar Grid - Mobile Optimized */
    .pnl-calendar-container { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .pnl-calendar-grid { display: grid; grid-template-columns: repeat(7, minmax(35px, 1fr)); gap: 6px; min-width: 280px; }
    .pnl-day-header { text-align: center; font-size: 0.6rem; font-weight: 800; text-transform: uppercase; color: rgba(255,255,255,0.3); padding-bottom: 5px; }
    .pnl-day { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.04); border-radius: 6px; aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2px; position: relative; }
    .pnl-day.today { border-color: #1572e8; background: rgba(21, 114, 232, 0.05); }
    .day-num { font-size: 0.7rem; font-weight: 700; color: #fff; }
    .day-pnl { font-size: 0.5rem; font-weight: 800; margin-top: 1px; line-height: 1; }

    /* Tables & Lists */
    .table-dark-custom thead th { background: #090c10; border: 0; color: rgba(255,255,255,0.3); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.04); vertical-align: middle; padding: 0.75rem 0.5rem; }
    .asset-circle { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; }
    .asset-logo { width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.7rem; }
    .asset-item { transition: all 0.2s; cursor: pointer; }
    .asset-item:hover { background: rgba(255,255,255,0.02) !important; }

    .badge-soft-primary { background: rgba(21, 114, 232, 0.1); color: #1572e8; }
    .badge-soft-success { background: rgba(40, 167, 69, 0.1); color: #28a745; }
    .badge-soft-dark { background: rgba(255,255,255,0.05); color: #fff; }
</style>

@endsection
