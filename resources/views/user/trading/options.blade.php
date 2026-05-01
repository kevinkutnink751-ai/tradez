@extends('layouts.terminal')
@php
    $baseSymbol = $currentPair->symbol;
    $quoteSymbol = $currentPair->quote_asset ?? 'USD';
    $profitPercent = $currentPair->binary_profit_percent ?? 85;
    $durations = $currentPair->binary_durations ?? [60, 300, 3600];
@endphp

@section('styles')
<style>
    :root {
        --options-primary: #7c4dff;
        --options-bg: #050510;
        --glass-bg: rgba(15, 15, 35, 0.9);
        --glass-border: rgba(124, 77, 255, 0.2);
    }

    #topnav { background: #050510 !important; border-bottom: 1px solid var(--glass-border) !important; }
    
    .options-shell {
        height: calc(100vh - 60px);
        background: var(--options-bg);
        position: relative;
        overflow: hidden;
        display: flex;
    }

    .chart-background {
        position: absolute;
        top: 0;
        left: 320px;
        right: 360px;
        bottom: 140px;
        z-index: 1;
    }

    .glass-panel {
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        z-index: 10;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.8);
    }

    /* Left Panel: Markets & Chain */
    .left-panel {
        position: absolute;
        left: 20px;
        top: 20px;
        bottom: 20px;
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .chain-container {
        flex-grow: 1;
        overflow-y: auto;
        padding: 15px;
    }

    .chain-table {
        width: 100%;
        color: #fff;
        font-size: 11px;
    }

    .chain-table th { color: #848e9c; padding-bottom: 10px; font-weight: 700; text-transform: uppercase; }
    .chain-table td { padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }

    .strike-row:hover { background: rgba(124, 77, 255, 0.1); cursor: pointer; }
    .strike-row.active { background: rgba(124, 77, 255, 0.2); border-left: 3px solid var(--options-primary); }

    /* Right Panel: Order Form */
    /* New Improved Form Elements */
    .opt-input-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 15px;
    }

    .opt-label {
        color: #848e9c;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .amount-entry-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .large-amount-input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 32px;
        font-weight: 800;
        width: 100%;
        text-align: center;
        outline: none;
    }

    .large-amount-input::-webkit-inner-spin-button { display: none; }

    .amount-btn {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(124, 77, 255, 0.1);
        border: 1px solid var(--glass-border);
        color: var(--options-primary);
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .amount-btn:hover { background: var(--options-primary); color: #fff; }

    .percent-shortcuts {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }

    .percent-shortcuts button {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        color: #848e9c;
        font-size: 10px;
        padding: 6px 0;
        font-weight: 700;
        transition: all 0.2s;
    }

    .percent-shortcuts button:hover {
        background: rgba(124, 77, 255, 0.1);
        color: var(--options-primary);
        border-color: var(--glass-border);
    }

    /* Custom Select */
    .custom-select-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .custom-glass-select {
        width: 100%;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        outline: none;
        appearance: none;
        cursor: pointer;
    }

    .custom-select-wrapper i {
        position: absolute;
        right: 0;
        color: #848e9c;
        pointer-events: none;
    }

    /* Greeks Bar */
    .greeks-bar {
        display: flex;
        justify-content: space-between;
        background: rgba(0,0,0,0.2);
        padding: 12px;
        border-radius: 12px;
    }

    .greek-box { text-align: center; }
    .greek-box .label { color: #848e9c; font-size: 9px; display: block; font-weight: 700; }
    .greek-box .val { color: #fff; font-size: 13px; font-weight: 800; }

    /* Payoff Section */
    .payoff-section {
        background: rgba(124, 77, 255, 0.03);
        border: 1px solid rgba(124, 77, 255, 0.05);
        border-radius: 16px;
        padding: 15px;
    }

    .payoff-graph-container {
        height: 100px;
        position: relative;
    }

    /* Trade Actions */
    .trade-actions-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: auto;
    }

    .btn-trade {
        height: 80px;
        border-radius: 20px;
        border: none;
        font-weight: 900;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn-trade:active { transform: scale(0.96); }

    .btn-call {
        background: linear-gradient(135deg, #00c853, #64dd17);
        color: #000;
        box-shadow: 0 10px 25px rgba(0, 200, 83, 0.3);
    }

    .btn-put {
        background: linear-gradient(135deg, #ff1744, #d50000);
        color: #fff;
        box-shadow: 0 10px 25px rgba(255, 23, 68, 0.3);
    }

    .btn-label { font-size: 14px; letter-spacing: 2px; margin-bottom: 5px; }

    .badge-soft-primary {
        background: rgba(124, 77, 255, 0.15);
        color: #7c4dff;
        font-weight: 800;
        padding: 4px 8px;
        border-radius: 6px;
    }


    /* Bottom History Overlay */
    .history-overlay {
        position: absolute;
        bottom: 20px;
        left: 340px;
        right: 380px;
        height: 100px;
        padding: 10px 20px;
    }

    .asset-switcher {
        padding: 10px 15px;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        margin-bottom: 10px;
        cursor: pointer;
    }

</style>
@endsection

@section('content')
<div class="options-shell">
    <!-- Centered Chart -->
    <div class="chart-background">
        <div id="tradingview_options_pro" style="height: 100%;"></div>
    </div>

    <!-- Left Panel: Options Chain (Matrix) -->
    <div class="glass-panel left-panel">
        <div class="p-3 border-bottom border-light" style="border-color: rgba(255,255,255,0.05) !important;">
            <h6 class="text-white font-weight-bold mb-0">OPTIONS CHAIN</h6>
            <small class="text-muted">MARKET PRICE: ${{ number_format($currentPair->last_price, 2) }}</small>
        </div>
        
        <div class="chain-container">
            <table class="chain-table">
                <thead>
                    <tr>
                        <th class="text-left">CALLS</th>
                        <th class="text-center">STRIKE</th>
                        <th class="text-right">PUTS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($strikes as $strike)
                    <tr class="strike-row {{ $loop->index == 2 ? 'active' : '' }}" onclick="selectStrike({{ $strike['price'] }}, {{ $strike['delta'] }}, {{ $strike['theta'] }})">
                        <td class="text-success">${{ number_format($strike['call_premium'], 2) }}</td>
                        <td class="text-center text-white font-weight-bold">${{ number_format($strike['price'], 0) }}</td>
                        <td class="text-danger text-right">${{ number_format($strike['put_premium'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-3">
            <div class="asset-switcher d-flex justify-content-between align-items-center" onclick="toastr.info('Market browser opening...')">
                <div>
                    <div class="text-white small font-weight-bold">{{ $currentPair->name }}</div>
                    <small class="text-muted">Switch Market</small>
                </div>
                <i class="mdi mdi-chevron-right text-muted"></i>
            </div>
        </div>
    </div>

    <!-- Right Panel: Order Execution & Strategy -->
    <div class="glass-panel order-panel">
        <!-- Order Header -->
        <div class="text-center mb-2">
            <h5 class="text-white font-weight-bold mb-0">EXECUTION</h5>
            <small class="text-muted text-uppercase" style="letter-spacing: 2px; font-size: 10px;">{{ $currentPair->name }} Options</small>
        </div>

        <!-- Strike Display (Static but clickable) -->
        <div class="opt-input-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="opt-label mb-0">STRIKE PRICE</label>
                <span class="badge badge-soft-primary">ATM</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="h3 text-white font-weight-bold mb-0" id="selectedStrikeDisplay">${{ number_format($currentPair->last_price, 2) }}</span>
                <i class="mdi mdi-target text-muted h4 mb-0"></i>
            </div>
        </div>

        <!-- Large Amount Input -->
        <div class="opt-input-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="opt-label mb-0">INVESTMENT AMOUNT</label>
                <span class="text-muted small">BAL: ${{ number_format(Auth::user()->account_bal, 2) }}</span>
            </div>
            <div class="amount-entry-wrapper">
                <button class="amount-btn" onclick="adjustAmount(-10)"><i class="mdi mdi-minus"></i></button>
                <div class="flex-grow-1 text-center">
                    <input type="number" id="optAmount" class="large-amount-input" value="100" onchange="updatePayoff()">
                    <span class="text-muted small d-block">USDT</span>
                </div>
                <button class="amount-btn" onclick="adjustAmount(10)"><i class="mdi mdi-plus"></i></button>
            </div>
            <div class="percent-shortcuts mt-3">
                <button onclick="setAmountPercent(25)">25%</button>
                <button onclick="setAmountPercent(50)">50%</button>
                <button onclick="setAmountPercent(75)">75%</button>
                <button onclick="setAmountPercent(100)">MAX</button>
            </div>
        </div>

        <!-- Expiration Select -->
        <div class="opt-input-card">
            <label class="opt-label">EXPIRATION TIME</label>
            <div class="custom-select-wrapper">
                <select id="optExpiry" class="custom-glass-select">
                    @foreach($durations as $sec)
                        <option value="{{ $sec }}">{{ $sec >= 3600 ? floor($sec/3600).' Hours' : ($sec >= 60 ? floor($sec/60).' Minutes' : $sec.' Seconds') }}</option>
                    @endforeach
                </select>
                <i class="mdi mdi-chevron-down"></i>
            </div>
        </div>

        <!-- Greeks Display -->
        <div class="greeks-bar">
            <div class="greek-box">
                <span class="label">DELTA</span>
                <span class="val" id="valDelta">0.52</span>
            </div>
            <div class="greek-box">
                <span class="label">THETA</span>
                <span class="val" id="valTheta">-0.021</span>
            </div>
            <div class="greek-box">
                <span class="label">VEGA</span>
                <span class="val">0.14</span>
            </div>
        </div>

        <!-- Payoff Graph -->
        <div class="payoff-section">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="opt-label mb-0">EXPECTED PAYOUT</label>
                <span class="text-success font-weight-bold" id="profitPreview">$0.00</span>
            </div>
            <div class="payoff-graph-container">
                <canvas id="payoffChart"></canvas>
            </div>
        </div>

        <!-- Large Action Buttons -->
        <div class="trade-actions-group">
            <button class="btn-trade btn-call" onclick="placeOrder('Call')">
                <div class="d-flex flex-column align-items-center">
                    <span class="btn-label">CALL</span>
                    <i class="mdi mdi-arrow-up-thick h3 mb-0"></i>
                </div>
            </button>
            <button class="btn-trade btn-put" onclick="placeOrder('Put')">
                <div class="d-flex flex-column align-items-center">
                    <span class="btn-label">PUT</span>
                    <i class="mdi mdi-arrow-down-thick h3 mb-0"></i>
                </div>
            </button>
        </div>

    </div>

    <!-- Bottom History Strip -->
    <div class="glass-panel history-overlay d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-4">
            <div>
                <small class="text-muted d-block">ACTIVE POSITIONS</small>
                <span class="text-white font-weight-bold" id="activeCount">0</span>
            </div>
            <div class="border-left border-secondary pl-4" style="height: 30px;"></div>
            <div>
                <small class="text-muted d-block">TOTAL P&L</small>
                <span class="text-success font-weight-bold">+$0.00</span>
            </div>
        </div>
        <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ route('options.history') }}'">ALL TRADES</button>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize TradingView
    new TradingView.widget({
        "autosize": true,
        "symbol": "{{ $currentPair->resolveChartSymbol() }}",
        "interval": "1",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "en",
        "toolbar_bg": "#050510",
        "enable_publishing": false,
        "hide_side_toolbar": true,
        "allow_symbol_change": false,
        "container_id": "tradingview_options_pro",
        "backgroundColor": "#050510",
        "gridColor": "rgba(124, 77, 255, 0.05)",
    });

    // Payoff Chart Logic
    let payoffChart;
    function setAmountPercent(percent) {
        const balance = {{ Auth::user()->account_bal }};
        const amount = (balance * percent) / 100;
        document.getElementById('optAmount').value = Math.floor(amount);
        document.getElementById('displayAmount').innerText = Math.floor(amount);
        updatePayoff();
        toastr.info(`Set amount to ${percent}% of balance`);
    }

    function adjustAmount(delta) {
        const input = document.getElementById('optAmount');
        let val = parseFloat(input.value) + delta;
        if (val < 1) val = 1;
        input.value = val;
        updatePayoff();
    }


    function initPayoffChart() {
        const ctx = document.getElementById('payoffChart').getContext('2d');
        payoffChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [-10, -5, 0, 5, 10],
                datasets: [{
                    label: 'P/L',
                    data: [-100, -100, 0, 100, 200],
                    borderColor: '#7c4dff',
                    backgroundColor: 'rgba(124, 77, 255, 0.1)',
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { 
                        display: true, 
                        grid: { color: 'rgba(255,255,255,0.05)' },
                        ticks: { color: '#848e9c', font: { size: 8 } }
                    }
                }
            }
        });
    }

    function updatePayoff(type = 'Call') {
        const amount = parseFloat(document.getElementById('optAmount').value);
        const data = type === 'Call' ? 
            [-amount, -amount, 0, amount, amount * 2] : 
            [amount * 2, amount, 0, -amount, -amount];
        
        payoffChart.data.datasets[0].data = data;
        payoffChart.data.datasets[0].borderColor = type === 'Call' ? '#00c853' : '#ff1744';
        payoffChart.update();
    }

    function selectStrike(price, delta, theta) {
        document.getElementById('selectedStrikeDisplay').innerText = `$${price.toFixed(0)}`;
        document.getElementById('valDelta').innerText = delta.toFixed(2);
        document.getElementById('valTheta').innerText = theta.toFixed(3);
        
        document.querySelectorAll('.strike-row').forEach(r => r.classList.remove('active'));
        event.currentTarget.classList.add('active');
        updatePayoff();
    }

    function placeOrder(type) {
        const amount = document.getElementById('optAmount').value;
        const expiry = document.getElementById('optExpiry').value;
        
        toastr.info(`Submitting ${type} Order...`);
        // AJAX logic here...
    }

    window.onload = () => {
        initPayoffChart();
        updatePayoff('Call');
    };
</script>
@endsection
