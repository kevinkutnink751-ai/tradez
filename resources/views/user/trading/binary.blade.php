@extends('layouts.terminal')
@php
    $baseSymbol = $currentPair->symbol;
    $quoteSymbol = $currentPair->quote_asset ?? 'USD';
    $profitPercent = $currentPair->binary_profit_percent ?? 85;
    $durations = $currentPair->binary_durations ?? [60, 300, 3600];
@endphp

@section('styles')
<style>
    /* Professional FTX/IBKR Style Grid */
    body { background: #0b1217; overflow: hidden; }
    #topnav { background: #0b1217 !important; border-bottom: 1px solid #1c2127 !important; }
    
    .binary-layout {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 60px);
        background: #0b1217;
        color: #e2e8f0;
    }

    /* Top Strip: Asset Info */
    .asset-header {
        height: 50px;
        border-bottom: 1px solid #1c2127;
        display: flex;
        align-items: center;
        padding: 0 20px;
        background: #11161d;
    }

    /* Main Flex: Chart + Order Book/Entry */
    .main-workspace {
        display: flex;
        flex-grow: 1;
        height: calc(100% - 250px); /* Leave 250px for history */
    }

    /* Chart Area */
    .chart-container {
        flex-grow: 1;
        border-right: 1px solid #1c2127;
        position: relative;
        background: #0b1217;
    }

    /* Right Sidebar: Order Entry */
    .order-sidebar {
        width: 320px;
        min-width: 320px;
        background: #11161d;
        display: flex;
        flex-direction: column;
    }

    .order-header {
        padding: 15px 20px;
        border-bottom: 1px solid #1c2127;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-header h6 { margin: 0; font-weight: 700; color: #fff; font-size: 14px; }
    
    .account-type-toggle {
        display: flex;
        background: #0b1217;
        border-radius: 4px;
        border: 1px solid #1c2127;
        overflow: hidden;
    }
    
    .account-type-toggle button {
        background: transparent;
        border: none;
        color: #848e9c;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }
    .account-type-toggle button.active {
        background: #2b3139;
        color: #fff;
    }

    .order-body {
        padding: 20px;
        flex-grow: 1;
        overflow-y: auto;
    }

    /* Clean Form Elements */
    .form-group-clean { margin-bottom: 20px; }
    
    .form-group-clean label {
        display: flex;
        justify-content: space-between;
        color: #848e9c;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .input-wrapper {
        display: flex;
        background: #0b1217;
        border: 1px solid #1c2127;
        border-radius: 4px;
        height: 40px;
    }

    .input-wrapper input, .input-wrapper select {
        flex-grow: 1;
        background: transparent;
        border: none;
        color: #fff;
        padding: 0 12px;
        font-weight: 600;
        font-size: 14px;
        outline: none;
    }

    .input-wrapper .addon {
        display: flex;
        align-items: center;
        padding: 0 12px;
        color: #848e9c;
        font-size: 12px;
        font-weight: 600;
        border-left: 1px solid #1c2127;
    }

    .input-wrapper:focus-within { border-color: #f3ba2f; }

    /* Percent Buttons */
    .percent-row {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
    }
    .percent-row button {
        flex-grow: 1;
        margin: 0 2px;
        background: transparent;
        border: 1px solid #1c2127;
        color: #848e9c;
        font-size: 10px;
        border-radius: 2px;
        padding: 4px 0;
    }
    .percent-row button:hover { background: #2b3139; color: #fff; }

    /* Expected Payout Box */
    .payout-box {
        background: #0b1217;
        border: 1px solid #1c2127;
        border-radius: 4px;
        padding: 15px;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .payout-box .title { color: #848e9c; font-size: 11px; font-weight: 600; margin-bottom: 5px; }
    .payout-box .val { color: #0ecb81; font-size: 24px; font-weight: 700; }
    .payout-box .percent { color: #0ecb81; font-size: 12px; }

    /* FTX Style Execution Buttons */
    .exec-buttons {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    .btn-ftx {
        flex: 1;
        height: 48px;
        border: none;
        border-radius: 4px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        line-height: 1.2;
        transition: opacity 0.2s;
    }
    .btn-ftx:hover { opacity: 0.9; }
    .btn-ftx:active { transform: translateY(1px); }
    
    .btn-ftx-buy { background: #0ecb81; color: #fff; }
    .btn-ftx-sell { background: #f6465d; color: #fff; }
    
    .btn-ftx small { font-size: 10px; opacity: 0.8; font-weight: 500; }

    /* Bottom History Panel */
    .history-panel {
        height: 250px;
        min-height: 250px;
        border-top: 1px solid #1c2127;
        background: #0b1217;
        display: flex;
        flex-direction: column;
    }

    .history-tabs {
        display: flex;
        border-bottom: 1px solid #1c2127;
        background: #11161d;
    }
    .history-tab {
        padding: 10px 20px;
        color: #848e9c;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        border-bottom: 2px solid transparent;
    }
    .history-tab.active {
        color: #f3ba2f;
        border-bottom-color: #f3ba2f;
    }
    .history-content {
        flex-grow: 1;
        overflow-y: auto;
        padding: 0;
    }

    .empty-state {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #848e9c;
        font-size: 12px;
    }
</style>
@endsection

@section('content')
<div class="binary-layout">
    
    <!-- Top Asset Bar -->
    <div class="asset-header">
        <div class="d-flex align-items-center">
            <h4 class="text-white font-weight-bold mb-0 mr-3">{{ $currentPair->name }}</h4>
            <span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }} font-weight-bold mr-4">
                {{ number_format($currentPair->last_price, 2) }}
            </span>
            <div class="d-flex flex-column mr-4">
                <span class="text-muted" style="font-size: 10px;">24h Change</span>
                <span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }}" style="font-size: 12px;">
                    {{ $currentPair->change_24h >= 0 ? '+' : '' }}{{ number_format($currentPair->change_24h, 2) }}%
                </span>
            </div>
            <div class="d-flex flex-column mr-4">
                <span class="text-muted" style="font-size: 10px;">Payout Rate</span>
                <span class="text-success font-weight-bold" style="font-size: 12px;">+{{ $profitPercent }}%</span>
            </div>
        </div>
    </div>

    <!-- Main Workspace -->
    <div class="main-workspace">
        
        <!-- Left: Chart -->
        <div class="chart-container">
            <div id="tradingview_binary" style="height: 100%;"></div>
        </div>

        <!-- Right: Order Entry -->
        <div class="order-sidebar">
            <div class="order-header">
                <h6>Place Order</h6>
                <div class="account-type-toggle">
                    <button class="active" id="liveAccBtn" onclick="toggleAccount('Live')">Live</button>
                    <button id="demoAccBtn" onclick="toggleAccount('Demo')">Demo</button>
                </div>
            </div>

            <div class="order-body">
                
                <!-- Amount -->
                <div class="form-group-clean">
                    <label>
                        <span>Amount</span>
                        <span id="balDisplay">Bal: {{ number_format(Auth::user()->account_bal, 2) }} USDT</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="number" id="binaryAmount" value="{{ $currentPair->binary_min_amount ?? 10 }}" oninput="updateProfit()">
                        <div class="addon">{{ $quoteSymbol }}</div>
                    </div>
                    <div class="percent-row">
                        <button onclick="setPercent(25)">25%</button>
                        <button onclick="setPercent(50)">50%</button>
                        <button onclick="setPercent(75)">75%</button>
                        <button onclick="setPercent(100)">100%</button>
                    </div>
                </div>

                <!-- Expiration -->
                <div class="form-group-clean">
                    <label><span>Duration</span></label>
                    <div class="input-wrapper">
                        <select id="binaryDuration">
                            @foreach($durations as $sec)
                                <option value="{{ $sec }}">{{ $sec >= 3600 ? floor($sec/3600).'h' : ($sec >= 60 ? floor($sec/60).'m' : $sec.'s') }}</option>
                            @endforeach
                        </select>
                        <div class="addon"><i class="mdi mdi-clock-outline"></i></div>
                    </div>
                </div>

                <!-- Payout -->
                <div class="payout-box">
                    <div class="title">Expected Payout</div>
                    <div class="val" id="profitPreview">+0.00</div>
                    <div class="percent">Yield: {{ $profitPercent }}%</div>
                </div>

                <!-- Action Buttons -->
                <div class="exec-buttons">
                    <button class="btn-ftx btn-ftx-buy" onclick="executeBinary('Call')">
                        BUY / HIGHER
                    </button>
                    <button class="btn-ftx btn-ftx-sell" onclick="executeBinary('Put')">
                        SELL / LOWER
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom: History -->
    <div class="history-panel">
        <div class="history-tabs">
            <div class="history-tab active" onclick="switchHistoryTab('running')">Open Positions</div>
            <div class="history-tab" onclick="switchHistoryTab('closed')">Order History</div>
        </div>
        <div class="history-content" id="historyContent">
            <div class="empty-state">Loading history...</div>
        </div>
    </div>

</div>
@endsection 

@push('scripts')
<script src="https://s3.tradingview.com/tv.js"></script>
<script>
    new TradingView.widget({
        "autosize": true,
        "symbol": "{{ $currentPair->resolveChartSymbol() }}",
        "interval": "1",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "en",
        "toolbar_bg": "#0b1217",
        "enable_publishing": false,
        "hide_side_toolbar": true,
        "allow_symbol_change": false,
        "container_id": "tradingview_binary",
        "backgroundColor": "#0b1217",
        "gridColor": "#1c2127",
    });

    let currentAccount = 'Live';
    
    function toggleAccount(type) {
        currentAccount = type;
        document.getElementById('liveAccBtn').classList.toggle('active', type === 'Live');
        document.getElementById('demoAccBtn').classList.toggle('active', type === 'Demo');
        toastr.info(`Switched to ${type} Account`);
    }

    function setPercent(pct) {
        const bal = {{ Auth::user()->account_bal }};
        const amount = (bal * pct) / 100;
        document.getElementById('binaryAmount').value = Math.max(1, amount.toFixed(2));
        updateProfit();
    }

    function updateProfit() {
        const amount = parseFloat(document.getElementById('binaryAmount').value) || 0;
        const profit = amount * ({{ $profitPercent }} / 100);
        document.getElementById('profitPreview').innerText = '+' + profit.toFixed(2);
    }

    function switchHistoryTab(tab) {
        document.querySelectorAll('.history-tab').forEach(el => {
            el.classList.toggle('active', el.innerText.toLowerCase().includes(tab === 'running' ? 'open' : 'order'));
        });
        
        const content = document.getElementById('historyContent');
        content.innerHTML = '<div class="empty-state"><i class="mdi mdi-loading mdi-spin mr-2"></i> Loading...</div>';
        
        fetch(`{{ route('binary.history') }}?tab=${tab}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            content.innerHTML = data.html || '<div class="empty-state">No trades found</div>';
        });
    }

    function executeBinary(direction) {
        const amount = document.getElementById('binaryAmount').value;
        const duration = document.getElementById('binaryDuration').value;
        
        fetch("{{ route('binary.trade.store') }}", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                pair: "{{ $currentPair->name }}",
                type: direction,
                amount: amount,
                duration: duration
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 200) {
                toastr.success(data.message);
                switchHistoryTab('running');
            } else {
                toastr.error(data.message);
            }
        })
        .catch(() => toastr.error("Server error occurred."));
    }

    window.onload = () => {
        updateProfit();
        switchHistoryTab('running');
    };
</script>
@endpush
