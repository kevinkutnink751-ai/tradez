@extends('layouts.terminal')
@php
    $currentPair = $currentPair ?? $pairs->first();
    $baseSymbol = $currentPair->symbol ?? 'BTC';
    $quoteSymbol = $currentPair->quote_asset ?? 'USD';
    $profitPercent = $currentPair->binary_profit_percent ?? 85;
    $durations = $currentPair->binary_durations ?? [30, 60, 300];
    $defaultAmount = $currentPair->binary_min_amount ?? 0.001;
    $currentPrice = (float) ($currentPair->last_price ?? 78400.23);
    $displayPairs = $pairs->take(5);
@endphp

@section('styles')
<style>
    :root {
        --terminal-bg: #020716;
        --terminal-panel: #111722;
        --terminal-panel-2: #171d2a;
        --terminal-border: #2c3546;
        --terminal-grid: rgba(120, 133, 156, 0.13);
        --terminal-blue: #087bff;
        --terminal-green: #0e4152;
        --terminal-red: #ff4549;
        --terminal-text: #f5f7fb;
        --terminal-muted: #aab3c5;
    }

    html,
    body {
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: var(--terminal-bg) !important;
        color: var(--terminal-text);
    }

    #topnav {
        display: none !important;
    }

    main {
        height: 100vh;
        min-height: 100vh;
        background: var(--terminal-bg);
        overflow: hidden;
    }

    .binary-terminal {
        display: grid;
        grid-template-rows: 112px minmax(0, 1fr) 38px;
        width: 100%;
        height: 100vh;
        min-height: 640px;
        background: var(--terminal-bg);
        border-top: 2px solid #263047;
        font-family: Inter, sans-serif;
    }

    .binary-topbar {
        display: grid;
        grid-template-columns: 200px minmax(0, 1fr) 86px;
        align-items: center;
        gap: 20px;
        height: 112px;
        padding: 0 30px;
        border-bottom: 1px solid var(--terminal-border);
        background: #030819;
    }

    .binary-brand {
        display: flex;
        align-items: center;
        min-width: 0;
        text-decoration: none !important;
    }

    .binary-brand img {
        max-width: 168px;
        max-height: 58px;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .binary-tabs {
        display: flex;
        align-items: center;
        gap: 24px;
        min-width: 0;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .binary-tabs::-webkit-scrollbar {
        display: none;
    }

    .asset-tab {
        position: relative;
        display: grid;
        grid-template-columns: 44px minmax(0, 1fr);
        align-items: center;
        flex: 0 0 148px;
        height: 60px;
        padding: 8px 12px 8px 16px;
        border: 1px solid #43506a;
        border-radius: 8px;
        background: #070d20;
        color: var(--terminal-text);
        text-decoration: none !important;
    }

    .asset-tab.active {
        background: #17243f;
        border-color: var(--terminal-green);
    }

    .asset-tab-close {
        position: absolute;
        top: 3px;
        left: 6px;
        color: #d8dfef;
        font-size: 18px;
        line-height: 1;
    }

    .asset-icons {
        position: relative;
        width: 44px;
        height: 36px;
    }

    .coin-badge,
    .quote-badge {
        position: absolute;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid #fff;
        font-size: 13px;
        font-weight: 900;
        color: #fff;
    }

    .coin-badge {
        top: 3px;
        left: 4px;
        background: #8fd12d;
        color: #fff;
    }

    .quote-badge {
        right: 4px;
        bottom: 2px;
        background: #0e4152;
    }

    .asset-tab-meta {
        min-width: 0;
    }

    .asset-tab-name {
        display: block;
        max-width: 78px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 14px;
        font-weight: 800;
        color: #fff;
    }

    .asset-tab-rate {
        display: block;
        margin-top: 3px;
        font-size: 14px;
        color: #f5f7fb;
    }

    .asset-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border: 1px solid #59647a;
        border-radius: 4px;
        color: #c5ccda;
        font-size: 31px;
        line-height: 1;
        text-decoration: none !important;
    }

    .binary-user {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
    }

    .binary-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1px solid #34425b;
        background: #20283a;
        color: #aeb8ca;
        font-size: 28px;
    }

    .terminal-main {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 206px;
        min-height: 0;
        background: var(--terminal-bg);
    }

    .chart-panel {
        position: relative;
        min-width: 0;
        margin: 16px 24px 16px 30px;
        overflow: hidden;
        border-radius: 6px;
        background: #141923;
    }

    .price-chart {
        display: block;
        width: 100%;
        height: 100%;
        min-height: 480px;
    }

    .axis-price {
        font-size: 13px;
        fill: #edf2ff;
    }

    .axis-time {
        font-size: 13px;
        fill: #edf2ff;
    }

    .price-tag {
        fill: var(--terminal-green);
    }

    .price-tag-text {
        font-size: 13px;
        font-weight: 700;
        fill: #fff;
    }

    .chart-date-pill {
        position: absolute;
        left: 25%;
        bottom: 4px;
        display: inline-flex;
        gap: 10px;
        padding: 6px 12px;
        background: var(--terminal-green);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .order-panel {
        padding: 18px 30px 0 0;
        background: var(--terminal-bg);
    }

    .mode-toggle {
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 41px;
        margin-bottom: 10px;
        padding: 2px;
        border: 1px solid var(--terminal-green);
        border-radius: 10px;
        background: #030819;
    }

    .mode-toggle button {
        border: 0;
        border-radius: 7px;
        background: transparent;
        color: #fff;
        font-size: 14px;
        font-weight: 800;
    }

    .mode-toggle button.active {
        background: var(--terminal-green);
    }

    .order-card {
        border: 1px solid #455169;
        border-radius: 8px;
        background: #050b1c;
        overflow: hidden;
    }

    .amount-control {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 42px;
        min-height: 78px;
        margin-bottom: 10px;
    }

    .amount-field,
    .duration-field {
        padding: 11px 12px;
        background: #292e3e;
    }

    .control-label {
        display: block;
        color: #d0d6e4;
        font-size: 14px;
        font-weight: 700;
    }

    .amount-field input {
        width: 100%;
        margin-top: 4px;
        border: 0;
        background: transparent;
        color: #fff;
        font-size: 26px;
        font-weight: 900;
        line-height: 1;
        outline: 0;
    }

    .amount-buttons {
        display: grid;
        grid-template-rows: 1fr 1fr;
        border-left: 2px solid #050b1c;
        background: #050b1c;
        gap: 2px;
    }

    .amount-buttons button {
        border: 0;
        background: #292e3e;
        color: #aeb7c8;
        font-size: 28px;
        line-height: 1;
    }

    .duration-field {
        min-height: 75px;
        margin-bottom: 16px;
    }

    .duration-value {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
        color: #fff;
        font-size: 25px;
        font-weight: 900;
    }

    .duration-value select {
        border: 0;
        background: transparent;
        color: #fff;
        font: inherit;
        outline: 0;
        appearance: none;
    }

    .duration-value select option {
        background: #111722;
        color: #fff;
    }

    .profit-card {
        min-height: 143px;
        padding: 21px 20px;
        margin-bottom: 16px;
        border: 1px solid #3b4860;
        border-radius: 8px;
        background: #050b1c;
    }

    .profit-label {
        color: #d5dbea;
        font-size: 14px;
        font-weight: 800;
    }

    .profit-percent {
        margin-top: 4px;
        color: #35e66b;
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
    }

    .profit-amount {
        margin-top: 12px;
        color: #35e66b;
        font-size: 22px;
        font-weight: 900;
    }

    .trade-actions {
        display: grid;
        gap: 16px;
    }

    .trade-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        height: 80px;
        border: 0;
        border-radius: 7px;
        color: #fff;
        font-size: 21px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .trade-action.higher {
        background: var(--terminal-green);
    }

    .trade-action.lower {
        background: var(--terminal-red);
    }

    .binary-history-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 38px;
        padding: 0 32px;
        border-top: 1px solid #182137;
        background: #111827;
        color: #f4f6fb;
        font-size: 16px;
        font-weight: 800;
    }

    .history-toggle {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 0;
        background: transparent;
        color: #f4f6fb;
        font: inherit;
    }

    .history-drawer {
        position: fixed;
        right: 0;
        bottom: 38px;
        left: 0;
        z-index: 50;
        display: none;
        max-height: 330px;
        overflow: auto;
        border-top: 1px solid #2b3549;
        background: #0b1020;
    }

    .history-drawer.open {
        display: block;
    }

    .history-table {
        width: 100%;
        color: #d8deeb;
        font-size: 13px;
    }

    .history-table th,
    .history-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #20293b;
    }

    .empty-history,
    .empty-state {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 120px;
        color: #9ba6bc;
    }

    @media (max-width: 1199.98px) {
        .binary-terminal {
            min-height: 720px;
        }

        .binary-topbar {
            grid-template-columns: 150px minmax(0, 1fr) 56px;
            gap: 12px;
            padding: 0 16px;
        }

        .binary-brand img {
            max-width: 130px;
        }

        .terminal-main {
            grid-template-columns: minmax(0, 1fr) 190px;
        }

        .chart-panel {
            margin: 12px;
        }

        .order-panel {
            padding: 12px 12px 0 0;
        }
    }

    @media (max-width: 767.98px) {
        body {
            overflow: auto;
        }

        main {
            height: auto;
            overflow: visible;
        }

        .binary-terminal {
            grid-template-rows: auto auto 42px;
            height: auto;
            min-height: 100vh;
        }

        .binary-topbar {
            grid-template-columns: 1fr 52px;
            min-height: 106px;
        }

        .binary-tabs {
            grid-column: 1 / -1;
            order: 3;
        }

        .binary-user {
            grid-column: 2;
            grid-row: 1;
        }

        .terminal-main {
            grid-template-columns: 1fr;
        }

        .chart-panel {
            height: 440px;
            margin: 10px;
        }

        .price-chart {
            min-height: 440px;
        }

        .order-panel {
            padding: 0 10px 16px;
        }
    }
</style>
@endsection

@section('content')
<div class="binary-terminal">
    <header class="binary-topbar">
        <a class="binary-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}">
        </a>

        <div class="binary-tabs">
            @foreach($displayPairs as $pair)
                @php
                    $pairProfit = $pair->binary_profit_percent ?? $profitPercent;
                    $pairName = $pair->display_name ?? $pair->name;
                    $quote = $pair->quote_asset ?? 'USD';
                @endphp
                <a class="asset-tab {{ $pair->id === $currentPair->id ? 'active' : '' }}" href="{{ route('binary.trade', ['pair' => $pair->name]) }}">
                    <span class="asset-tab-close">&times;</span>
                    <span class="asset-icons">
                        <span class="coin-badge">₿</span>
                        <span class="quote-badge">{{ $quote === 'USD' ? '$' : substr($quote, 0, 1) }}</span>
                    </span>
                    <span class="asset-tab-meta">
                        <span class="asset-tab-name">{{ $pairName }}</span>
                        <span class="asset-tab-rate">{{ $pairProfit }}%</span>
                    </span>
                </a>
            @endforeach
            <a class="asset-add" href="{{ route('binary.trade') }}">+</a>
        </div>

     
    </header>

    <section class="terminal-main">
        <div class="chart-panel">
            <svg class="price-chart" viewBox="0 0 1700 840" preserveAspectRatio="none" aria-label="Binary price chart">
                <defs>
                    <pattern id="binaryGrid" width="90" height="42" patternUnits="userSpaceOnUse">
                        <path d="M 90 0 L 0 0 0 42" fill="none" stroke="var(--terminal-grid)" stroke-width="1" />
                    </pattern>
                    <linearGradient id="binaryArea" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#025e7d" stop-opacity="0.34" />
                        <stop offset="100%" stop-color="#025e7d" stop-opacity="0.1" />
                    </linearGradient>
                </defs>

                <rect x="0" y="0" width="1630" height="800" fill="url(#binaryGrid)" />
                <rect x="1630" y="0" width="70" height="800" fill="#111722" />

                <line x1="0" y1="52" x2="1700" y2="52" stroke="#025e7d" stroke-width="1" stroke-dasharray="2 3" />
                <line x1="0" y1="224" x2="1700" y2="224" stroke="#025e7d" stroke-width="1" stroke-dasharray="2 3" />
                <line x1="485" y1="0" x2="485" y2="800" stroke="#025e7d" stroke-width="1" stroke-dasharray="2 3" />

                <path d="M0,740 L14,740 L14,713 L44,713 L44,670 L75,670 L75,654 L116,654 L116,654 L142,654 L142,646 L154,646 L154,637 L160,637 L160,616 L168,616 L168,598 L292,598 L292,570 L332,570 L332,568 L340,568 L340,596 L350,596 L350,586 L378,586 L378,542 L392,542 L392,698 L398,698 L398,660 L438,660 L438,538 L450,538 L450,496 L492,496 L492,496 L592,496 L592,568 L626,568 L626,526 L765,526 L765,470 L808,470 L808,357 L850,357 L850,280 L862,280 L862,198 L874,198 L874,211 L880,211 L880,260 L886,260 L886,302 L898,302 L898,307 L910,307 L910,361 L948,361 L948,344 L962,344 L962,276 L984,276 L984,231 L1188,231 L1188,198 L1209,198 L1209,231 L1236,231 L1236,201 L1252,201 L1252,174 L1284,174 L1284,231 L1388,231 L1388,234 L1510,234 L1510,236 L1518,236 L1518,236 L1518,800 L0,800 Z" fill="url(#binaryArea)" />
                <path d="M0,740 L14,740 L14,713 L44,713 L44,670 L75,670 L75,654 L116,654 L116,654 L142,654 L142,646 L154,646 L154,637 L160,637 L160,616 L168,616 L168,598 L292,598 L292,570 L332,570 L332,568 L340,568 L340,596 L350,596 L350,586 L378,586 L378,542 L392,542 L392,698 L398,698 L398,660 L438,660 L438,538 L450,538 L450,496 L492,496 L492,496 L592,496 L592,568 L626,568 L626,526 L765,526 L765,470 L808,470 L808,357 L850,357 L850,280 L862,280 L862,198 L874,198 L874,211 L880,211 L880,260 L886,260 L886,302 L898,302 L898,307 L910,307 L910,361 L948,361 L948,344 L962,344 L962,276 L984,276 L984,231 L1188,231 L1188,198 L1209,198 L1209,231 L1236,231 L1236,201 L1252,201 L1252,174 L1284,174 L1284,231 L1388,231 L1388,234 L1510,234 L1510,236 L1518,236" fill="none" stroke="#025e7d" stroke-width="3" stroke-linejoin="round" />

                <circle cx="485" cy="496" r="6" fill="#025e7d" stroke="#030819" stroke-width="3" />
                <circle cx="1518" cy="236" r="4" fill="#00c853" />

                @php
                    $priceLabels = range(78450, 78250, -10);
                @endphp
                @foreach($priceLabels as $index => $label)
                    <text x="1640" y="{{ 16 + ($index * 41) }}" class="axis-price">{{ number_format($label, 2, '.', '') }}</text>
                @endforeach

                <rect class="price-tag" x="1630" y="44" width="70" height="24" />
                <text class="price-tag-text" x="1637" y="61">{{ number_format($currentPrice + 40, 2, '.', '') }}</text>
                <rect class="price-tag" x="1630" y="216" width="70" height="24" />
                <text class="price-tag-text" x="1637" y="233">{{ number_format($currentPrice - 4.10, 2, '.', '') }}</text>

                @foreach(['23:11','23:12','23:13','23:14','23:15','23:17','23:18','23:19','23:20','23:21','23:22','23:23','23:24','23:25','23:26','23:27'] as $index => $time)
                    <text x="{{ 25 + ($index * 89) }}" y="818" class="axis-time" font-weight="{{ in_array($time, ['23:15','23:20']) ? '800' : '500' }}">{{ $time }}</text>
                @endforeach
            </svg>
            <div class="chart-date-pill"><span>01 May '26</span><span>22:15</span></div>
        </div>

        <aside class="order-panel">
            <div class="mode-toggle">
                <button type="button" class="active" id="liveAccBtn" onclick="toggleAccount('Live')">Live</button>
                <button type="button" id="demoAccBtn" onclick="toggleAccount('Demo')">Demo</button>
            </div>

            <div class="order-card amount-control">
                <div class="amount-field">
                    <label class="control-label">Amount ({{ $baseSymbol }})</label>
                    <input type="number" id="binaryAmount" value="{{ $defaultAmount }}" step="{{ $currentPair->binary_increment ?? 0.001 }}" min="{{ $currentPair->binary_min_amount ?? 0.001 }}" oninput="updateProfit()">
                </div>
                <div class="amount-buttons">
                    <button type="button" onclick="adjustAmount(1)">+</button>
                    <button type="button" onclick="adjustAmount(-1)">−</button>
                </div>
            </div>

            <div class="order-card duration-field">
                <label class="control-label">Duration</label>
                <div class="duration-value">
                    <i class="mdi mdi-clock-outline"></i>
                    <select id="binaryDuration">
                        @foreach($durations as $sec)
                            <option value="{{ $sec }}">{{ $sec >= 3600 ? floor($sec / 3600).':00:00' : gmdate('i:s', $sec) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="profit-card">
                <div class="profit-label">Profit</div>
                <div class="profit-percent">+{{ $profitPercent }}%</div>
                <div class="profit-amount" id="profitPreview">+0.0000</div>
            </div>

            <div class="trade-actions">
                <button type="button" class="trade-action higher" onclick="executeBinary('Call')">
                    <i class="mdi mdi-arrow-top-right"></i>
                    <span>Higher</span>
                </button>
                <button type="button" class="trade-action lower" onclick="executeBinary('Put')">
                    <i class="mdi mdi-arrow-bottom-right"></i>
                    <span>Lower</span>
                </button>
            </div>
        </aside>
    </section>

    <footer class="binary-history-bar">
        <span>History</span>
        <button type="button" class="history-toggle" onclick="toggleHistory()">
            <span>Show History</span>
            <i class="mdi mdi-chevron-up"></i>
        </button>
    </footer>
</div>

<div class="history-drawer" id="historyDrawer">
    <div class="empty-state" id="historyContent">Loading history...</div>
</div>
@endsection

@push('scripts')
<script>
    let currentAccount = 'Live';
    const binaryIncrement = parseFloat("{{ $currentPair->binary_increment ?? 0.001 }}") || 0.001;
    const binaryProfitPercent = parseFloat("{{ $profitPercent }}") || 0;

    function toggleAccount(type) {
        currentAccount = type;
        document.getElementById('liveAccBtn').classList.toggle('active', type === 'Live');
        document.getElementById('demoAccBtn').classList.toggle('active', type === 'Demo');
    }

    function adjustAmount(direction) {
        const input = document.getElementById('binaryAmount');
        const current = parseFloat(input.value) || 0;
        const next = Math.max(binaryIncrement, current + (binaryIncrement * direction));
        input.value = next < 1 ? next.toFixed(3) : next.toFixed(2);
        updateProfit();
    }

    function updateProfit() {
        const amount = parseFloat(document.getElementById('binaryAmount').value) || 0;
        const payout = amount + (amount * (binaryProfitPercent / 100));
        document.getElementById('profitPreview').innerText = '+' + (payout < 1 ? payout.toFixed(4) : payout.toFixed(2));
    }

    function toggleHistory() {
        document.getElementById('historyDrawer').classList.toggle('open');
    }

    function switchHistoryTab(tab = 'running') {
        const content = document.getElementById('historyContent');
        content.innerHTML = '<div class="empty-state">Loading history...</div>';

        fetch(`{{ route('binary.history') }}?tab=${tab}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            content.innerHTML = data.html || '<div class="empty-state">No trades found</div>';
        })
        .catch(() => {
            content.innerHTML = '<div class="empty-state">Unable to load history</div>';
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
            if (data.status === 200) {
                toastr.success(data.message);
                switchHistoryTab('running');
            } else {
                toastr.error(data.message || 'Trade could not be placed.');
            }
        })
        .catch(() => toastr.error("Server error occurred."));
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateProfit();
        switchHistoryTab('running');
    });
</script>
@endpush
