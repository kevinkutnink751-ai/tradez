@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="binary-trading-container">
        {{-- Trading Header --}}
        <div class="trading-header px-4 py-2 border-bottom d-flex align-items-center justify-content-between" style="background: #11151d;">
            <div class="d-flex align-items-center">
                <div class="dropdown mr-4">
                    <button class="btn btn-dark-input dropdown-toggle font-weight-bold text-white px-3" type="button" data-toggle="dropdown">
                        <i class="fas fa-hourglass-start mr-2 text-primary"></i> {{ $currentPair->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark shadow-lg">
                        @foreach($pairs as $pair)
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('binary.trade', ['pair' => $pair->name]) }}">
                            <span>{{ $pair->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="price-info d-flex align-items-center">
                    <div class="mr-4 {{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }} font-weight-bold h5 mb-0">
                        {{ number_format($currentPair->last_price, 5) }}
                    </div>
                    <div class="mr-4 small">
                        <span class="text-muted">24h Change</span> 
                        <span class="{{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }} ml-1">
                            {{ $currentPair->change_24h >= 0 ? '+' : '' }}{{ number_format($currentPair->change_24h, 2) }}%
                        </span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-right mr-3">
                    <small class="text-muted d-block small-label">Balance</small>
                    <span class="text-white font-weight-bold">{{ number_format(Auth::user()->account_bal, 2) }} USDT</span>
                </div>
                <button class="btn btn-sm btn-primary rounded-pill px-3">Top Up</button>
            </div>
        </div>

        <div class="row no-gutters">
            {{-- Left Column: Asset Selection & Chart --}}
            <div class="col-lg-9 trading-panel border-right">
                <div class="chart-container" style="height: calc(100vh - 160px);">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="height: 100%;">
                        <div id="tradingview_binary" style="height: 100%;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.widget({
                            "autosize": true,
                            "symbol": "{{ $currentPair->resolveChartSymbol() }}",
                            "interval": "1",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "2", // Line chart for binary
                            "locale": "en",
                            "enable_publishing": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_binary",
                            "hide_side_toolbar": true,
                            "hide_top_toolbar": true,
                            "toolbar_bg": "#11151d"
                        });
                        </script>
                    </div>
                </div>
            </div>

            {{-- Right Column: Trade Execution --}}
            <div class="col-lg-3 trading-panel">
                <div class="p-4">
                    <h6 class="text-muted font-weight-bold mb-3 text-uppercase small-label">Trade Execution</h6>
                    
                    <form id="binaryTradeForm">
                        @csrf
                        <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                        <input type="hidden" name="type" id="binary_type" value="Call">
                        <input type="hidden" name="price" value="{{ $currentPair->last_price }}">

                        <div class="form-group mb-4">
                            <label class="text-muted small-label">Amount</label>
                            <div class="input-group bg-dark-input rounded border border-white-10">
                                <div class="input-group-prepend"><span class="input-group-text bg-transparent border-0 text-white">$</span></div>
                                <input type="number" name="amount" class="form-control bg-transparent border-0 text-white font-weight-bold" value="100" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small-label">Duration</label>
                            <select name="duration" class="form-control bg-dark-input border-white-10 text-white font-weight-bold custom-select-dark">
                                <option value="60">1 Minute</option>
                                <option value="120">2 Minutes</option>
                                <option value="300">5 Minutes</option>
                                <option value="600">10 Minutes</option>
                            </select>
                        </div>

                        <div class="profit-box p-3 rounded mb-4 d-flex justify-content-between align-items-center" style="background: rgba(40, 167, 69, 0.05); border: 1px solid rgba(40, 167, 69, 0.2);">
                            <div>
                                <small class="text-muted d-block small-label">Payout</small>
                                <h4 class="text-success mb-0 font-weight-bold">+$85.00</h4>
                            </div>
                            <div class="text-right">
                                <span class="badge badge-success px-2">+85%</span>
                            </div>
                        </div>

                        <div class="strike-price-box p-3 rounded mb-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                            <small class="text-muted d-block small-label">Strike Price</small>
                            <h5 class="text-white mb-0 font-weight-bold">{{ number_format($currentPair->last_price, 5) }}</h5>
                        </div>

                        <div class="trade-buttons">
                            <button type="button" onclick="submitBinary('Call')" class="btn btn-success btn-block btn-lg py-3 font-weight-bold mb-3 shadow-sm">
                                <i class="fas fa-arrow-up mr-2"></i> CALL
                            </button>
                            <button type="button" onclick="submitBinary('Put')" class="btn btn-danger btn-block btn-lg py-3 font-weight-bold shadow-sm">
                                <i class="fas fa-arrow-down mr-2"></i> PUT
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 pt-4 border-top border-white-10">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted small-label">Account Balance</small>
                            <small class="text-white font-weight-bold">${{ number_format(Auth::user()->account_bal, 2) }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted small-label">Active Trades</small>
                            <small class="text-primary font-weight-bold">0</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .binary-trading-container { background: #090c10; margin: -1.5rem; }
        .trading-panel { background: #11151d; height: calc(100vh - 100px); }
        .bg-dark-input { background: #090c10; }
        .border-white-10 { border-color: rgba(255,255,255,0.05) !important; }
        .small-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: rgba(255,255,255,0.4) !important; }
        .custom-select-dark { height: 45px; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px; }
        .btn-success { background: #00c853; border-color: #00c853; }
        .btn-danger { background: #ff3d00; border-color: #ff3d00; }
    </style>
    <script>
        function submitBinary(type) {
            const form = document.getElementById('binaryTradeForm');
            const typeInput = document.getElementById('binary_type');
            typeInput.value = type;
            
            const formData = new FormData(form);
            const btn = event.currentTarget;
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch("{{ route('binary.trade.store') }}", {
                method: "POST",
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    $.notify({ icon: 'fas fa-check-circle', message: data.message }, { type: 'success', placement: { from: "top", align: "right" } });
                    setTimeout(() => location.reload(), 1500);
                } else {
                    $.notify({ icon: 'fas fa-exclamation-triangle', message: data.message }, { type: 'danger', placement: { from: "top", align: "right" } });
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            })
            .catch(error => {
                $.notify({ icon: 'fas fa-exclamation-circle', message: "Error processing trade." }, { type: 'danger', placement: { from: "top", align: "right" } });
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        }
    </script>
    <script>
        function submitBinary(type) {
            const form = document.getElementById('binaryTradeForm');
            const typeInput = document.getElementById('binary_type');
            typeInput.value = type;
            
            const formData = new FormData(form);
            const btn = event.currentTarget;
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch("{{ route('binary.trade.store') }}", {
                method: "POST",
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    $.notify({ icon: 'fas fa-check-circle', message: data.message }, { type: 'success', placement: { from: "top", align: "right" } });
                    setTimeout(() => location.reload(), 1500);
                } else {
                    $.notify({ icon: 'fas fa-exclamation-triangle', message: data.message }, { type: 'danger', placement: { from: "top", align: "right" } });
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            })
            .catch(error => {
                $.notify({ icon: 'fas fa-exclamation-circle', message: "Error processing trade." }, { type: 'danger', placement: { from: "top", align: "right" } });
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        }
    </script>
@endsection
