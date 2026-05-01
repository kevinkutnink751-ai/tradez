@extends('layouts.terminal')
@section('title', $title)
@section('content')
@php
    $baseSymbol = $currentPair->symbol;
    $quoteSymbol = $currentPair->quote_asset ?? 'USD';
    
    $quoteWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($quoteSymbol) { $q->where('symbol', $quoteSymbol); })->first();
    $baseWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($baseSymbol) { $q->where('symbol', $baseSymbol); })->first();
@endphp

<div class="terminal-shell">
    <div class="terminal-grid">
        <!-- Left: Order Book -->
        <div class="terminal-panel orderbook-panel">
            <div class="panel-header d-flex justify-content-between">
                <h6 class="mb-0 font-weight-bold">Order Book</h6>
                <div class="x-small">
                    <span class="text-info mr-2 cursor-pointer">All</span>
                    <span class="text-danger mr-2 cursor-pointer">Sell</span>
                    <span class="text-success cursor-pointer">Buy</span>
                </div>
            </div>
            <div class="orderbook-content flex-grow-1 overflow-hidden d-flex flex-column">
                <div class="px-3 py-2 d-flex justify-content-between x-small text-muted">
                    <span>Price({{ $quoteSymbol }})</span>
                    <span>Amount({{ $baseSymbol }})</span>
                    <span>Total</span>
                </div>
                <div class="book-container flex-grow-1 overflow-hidden" id="spotDepthBook">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>

        <!-- Middle: Market Ticker, Chart & Tickets -->
        <div class="grid-main">
            <!-- Market Ticker -->
            <div class="market-ticker d-flex align-items-center">
                <div class="ticker-pair mr-5">
                    <h2 class="text-white font-weight-bold">{{ $currentPair->display_name }}</h2>
                </div>
                <div class="ticker-stats d-flex flex-grow-1 justify-content-between">
                    <div class="ticker-item"><label>Price</label><span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }} d-block">{{ number_format($currentPair->last_price, 4) }}</span></div>
                    <div class="ticker-item"><label>Last Price</label><span class="text-white d-block">{{ number_format($currentPair->last_price, 4) }}</span></div>
                    <div class="ticker-item"><label>1h Change</label><span class="text-danger d-block">0.0083%</span></div>
                    <div class="ticker-item"><label>24h Change</label><span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }} d-block">{{ number_format($currentPair->change_24h, 2) }}%</span></div>
                    <div class="ticker-item d-none d-xl-block"><label>Market Cap</label><span class="text-white d-block">1,557,372,308,946.70</span></div>
                </div>
            </div>

            <!-- Chart Panel -->
            <div class="terminal-panel chart-panel">
                <div id="tradingview_spot_widget" style="height: 100%;"></div>
            </div>

            <!-- Trade Tickets -->
            <div class="trade-tickets">
                <!-- Buy Ticket -->
                <div class="terminal-panel p-4">
                    <div class="d-flex justify-content-between x-small mb-3">
                        <ul class="nav nav-pills market-categories">
                            <li class="nav-item"><a class="nav-link active px-0" href="#">Limit</a></li>
                            <li class="nav-item"><a class="nav-link px-0" href="#">Market</a></li>
                            <li class="nav-item"><a class="nav-link px-0" href="#">Stop Limit</a></li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between x-small mb-2">
                        <span class="text-muted">Available</span>
                        <span class="text-white">{{ number_format($quoteWallet->spot_bal ?? 0, 4) }} {{ $quoteSymbol }} <i class="mdi mdi-plus-circle-outline text-info"></i></span>
                    </div>
                    <form action="{{ route('spot.trade.store') }}" method="POST" class="ajax-trade-form">
                        @csrf
                        <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                        <input type="hidden" name="type" value="Buy">
                        
                        <div class="ticket-input-group mb-3">
                            <span class="input-label">Price</span>
                            <input type="number" step="any" name="price" class="ticket-input" value="{{ $currentPair->last_price }}">
                            <span class="input-unit">{{ $quoteSymbol }}</span>
                        </div>
                        <div class="ticket-input-group mb-2">
                            <span class="input-label">Amount</span>
                            <input type="number" step="any" name="amount" id="buyAmountInput" class="ticket-input" placeholder="Minimum 0.0001">
                            <span class="input-unit">{{ $baseSymbol }}</span>
                        </div>
                        
                        <div class="range-slider-container mb-4">
                            <input type="range" class="terminal-range" id="buySlider" min="0" max="100" step="1" value="0" oninput="handleSlider('Buy', this.value)">
                            <div class="d-flex justify-content-between x-small text-muted mt-1" style="font-size: 9px;">
                                <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                            </div>
                        </div>

                        <div class="ticket-input-group mb-4">
                            <span class="input-label">Total</span>
                            <input type="number" step="any" id="buyTotalDisplay" class="ticket-input" placeholder="0.00">
                            <span class="input-unit">{{ $quoteSymbol }}</span>
                        </div>

                        <button type="submit" class="btn btn-buy btn-block font-weight-bold">BUY {{ $baseSymbol }}</button>
                    </form>
                </div>

                <!-- Sell Ticket -->
                <div class="terminal-panel p-4">
                    <div class="d-flex justify-content-between x-small mb-3">
                        <ul class="nav nav-pills market-categories">
                            <li class="nav-item"><a class="nav-link active px-0" href="#">Limit</a></li>
                            <li class="nav-item"><a class="nav-link px-0" href="#">Market</a></li>
                            <li class="nav-item"><a class="nav-link px-0" href="#">Stop Limit</a></li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between x-small mb-2">
                        <span class="text-muted">Available</span>
                        <span class="text-white">{{ number_format($baseWallet->spot_bal ?? 0, 4) }} {{ $baseSymbol }} <i class="mdi mdi-plus-circle-outline text-info"></i></span>
                    </div>
                    <form action="{{ route('spot.trade.store') }}" method="POST" class="ajax-trade-form">
                        @csrf
                        <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                        <input type="hidden" name="type" value="Sell">
                        
                        <div class="ticket-input-group mb-3">
                            <span class="input-label">Price</span>
                            <input type="number" step="any" name="price" class="ticket-input" value="{{ $currentPair->last_price }}">
                            <span class="input-unit">{{ $quoteSymbol }}</span>
                        </div>
                        <div class="ticket-input-group mb-2">
                            <span class="input-label">Amount</span>
                            <input type="number" step="any" name="amount" id="sellAmountInput" class="ticket-input" placeholder="Minimum 0.0001">
                            <span class="input-unit">{{ $baseSymbol }}</span>
                        </div>
                        
                        <div class="range-slider-container mb-4">
                            <input type="range" class="terminal-range" id="sellSlider" min="0" max="100" step="1" value="0" oninput="handleSlider('Sell', this.value)">
                            <div class="d-flex justify-content-between x-small text-muted mt-1" style="font-size: 9px;">
                                <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                            </div>
                        </div>

                        <div class="ticket-input-group mb-4">
                            <span class="input-label">Total</span>
                            <input type="number" step="any" id="sellTotalDisplay" class="ticket-input" placeholder="0.00">
                            <span class="input-unit">{{ $quoteSymbol }}</span>
                        </div>

                        <button type="submit" class="btn btn-sell btn-block font-weight-bold">SELL {{ $baseSymbol }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right: Markets & Trades -->
        <div class="grid-right d-flex flex-column gap-2" style="height: 100%; overflow: hidden;">
            <div class="terminal-panel flex-grow-1 overflow-hidden" style="height: 60%;">
                <div class="panel-header d-flex justify-content-between align-items-center" id="marketHeader">
                    <div id="marketTitleContainer" class="d-flex align-items-center w-100">
                        <h6 class="mb-0 font-weight-bold text-white flex-grow-1">Markets</h6>
                        <i class="mdi mdi-magnify text-muted cursor-pointer" onclick="toggleMarketSearch()"></i>
                    </div>
                    <div id="marketSearchContainer" class="d-none w-100 align-items-center">
                        <input type="text" id="marketSearchInput" class="form-control form-control-sm bg-transparent border-0 text-white p-0" placeholder="Search pairs..." onkeyup="filterMarkets()">
                        <i class="mdi mdi-close text-muted cursor-pointer ml-2" onclick="toggleMarketSearch()"></i>
                    </div>
                </div>
                <div class="p-3 border-bottom border-secondary">
                    <ul class="nav nav-pills market-categories justify-content-between">
                        <li class="nav-item"><a class="nav-link market-category-link active p-0" href="javascript:void(0)" data-category="All" onclick="setMarketCategory('All')">All</a></li>
                        <li class="nav-item"><a class="nav-link market-category-link p-0" href="javascript:void(0)" data-category="BTC" onclick="setMarketCategory('BTC')">BTC</a></li>
                        <li class="nav-item"><a class="nav-link market-category-link p-0" href="javascript:void(0)" data-category="ETH" onclick="setMarketCategory('ETH')">ETH</a></li>
                        <li class="nav-item"><a class="nav-link market-category-link p-0" href="javascript:void(0)" data-category="USDT" onclick="setMarketCategory('USDT')">USDT</a></li>
                        <li class="nav-item"><a class="nav-link market-category-link p-0" href="javascript:void(0)" data-category="USDC" onclick="setMarketCategory('USDC')">USDC</a></li>
                    </ul>
                </div>
                <div class="flex-grow-1 overflow-auto">
                    <table class="table terminal-table mb-0">
                        <thead>
                            <tr>
                                <th class="pl-3">Pair</th>
                                <th class="text-right">Price</th>
                                <th class="text-right pr-3">Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pairs as $pair)
                            <tr class="market-row cursor-pointer" data-quote="{{ $pair->quote_asset }}" onclick="window.location.href='{{ route('spot.trade', ['pair' => $pair->name]) }}'">
                                <td class="pl-3"><i class="mdi mdi-star-outline text-warning mr-1"></i> {{ $pair->display_name }}</td>
                                <td class="text-right text-white">{{ number_format($pair->last_price, 4) }}</td>
                                <td class="text-right pr-3 text-{{ $pair->change_24h >= 0 ? 'success' : 'danger' }}">{{ number_format($pair->change_24h, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="terminal-panel flex-grow-1 overflow-hidden" style="height: 40%;">
                <div class="panel-header">
                    <h6 class="mb-0 font-weight-bold text-white">Trade History</h6>
                </div>
                <div class="trades-list flex-grow-1 overflow-auto p-3" id="recentTradesList">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://s3.tradingview.com/tv.js"></script>
<script>
    const currentPrice = {{ $currentPair->last_price }};
    const buyBalance = {{ $quoteWallet->spot_bal ?? 0 }};
    const sellBalance = {{ $baseWallet->spot_bal ?? 0 }};

    let activeCategory = 'All';

    function toggleMarketSearch() {
        const title = document.getElementById('marketTitleContainer');
        const search = document.getElementById('marketSearchContainer');
        const input = document.getElementById('marketSearchInput');
        
        if (title.classList.contains('d-none')) {
            title.classList.remove('d-none');
            title.classList.add('d-flex');
            search.classList.add('d-none');
            search.classList.remove('d-flex');
            input.value = '';
            filterMarkets();
        } else {
            title.classList.add('d-none');
            title.classList.remove('d-flex');
            search.classList.remove('d-none');
            search.classList.add('d-flex');
            input.focus();
        }
    }

    function setMarketCategory(category) {
        activeCategory = category;
        document.querySelectorAll('.market-category-link').forEach(link => {
            link.classList.toggle('active', link.dataset.category === category);
        });
        filterMarkets();
    }

    function filterMarkets() {
        const query = document.getElementById('marketSearchInput').value.toLowerCase();
        
        document.querySelectorAll('.market-row').forEach(row => {
            const pair = row.innerText.toLowerCase();
            const quote = row.dataset.quote;
            
            const matchCategory = (activeCategory === 'All' || quote === activeCategory);
            const matchSearch = pair.includes(query);
            
            row.style.display = (matchCategory && matchSearch) ? '' : 'none';
        });
    }

    function handleSlider(side, percent) {
        const balance = side === 'Buy' ? buyBalance : sellBalance;
        if (balance <= 0) {
            toastr.warning(`Insufficient ${side === 'Buy' ? 'USDT' : 'asset'} balance in your Spot wallet.`);
            return;
        }

        let amount = 0;
        if (side === 'Buy') {
            if (currentPrice > 0) {
                amount = (buyBalance / currentPrice) * (percent / 100);
            }
        } else {
            amount = sellBalance * (percent / 100);
        }
        
        const inputId = side === 'Buy' ? 'buyAmountInput' : 'sellAmountInput';
        document.getElementById(inputId).value = amount.toFixed(8);
        updateTotals(side);
    }

    function updateTotals(side) {
        const amount = parseFloat(document.getElementById(side === 'Buy' ? 'buyAmountInput' : 'sellAmountInput').value) || 0;
        const total = amount * currentPrice;
        document.getElementById(side === 'Buy' ? 'buyTotalDisplay' : 'sellTotalDisplay').value = total.toFixed(4);
    }

    document.getElementById('buyAmountInput').addEventListener('input', () => updateTotals('Buy'));
    document.getElementById('sellAmountInput').addEventListener('input', () => updateTotals('Sell'));

    function populateDepth() {
        const container = document.getElementById('spotDepthBook');
        if(!container) return;
        let html = '<div class="asks-section">';
        for(let i=8; i>=1; i--) {
            const p = currentPrice + (i * 0.5);
            const a = (Math.random() * 2).toFixed(4);
            html += `<div class="d-flex justify-content-between px-3 x-small text-danger py-1"><span>${p.toFixed(4)}</span><span>${a}</span><span>${(p*a).toFixed(2)}</span></div>`;
        }
        html += '</div>';
        html += `<div class="ob-price-middle text-center">
                    <div class="h3 mb-0 text-success font-weight-bold d-flex align-items-center justify-content-center">
                        ${currentPrice.toFixed(4)} 
                        <i class="mdi mdi-arrow-up ml-2"></i>
                    </div>
                 </div>`;
        html += '<div class="bids-section">';
        for(let i=1; i<=8; i++) {
            const p = currentPrice - (i * 0.5);
            const a = (Math.random() * 2).toFixed(4);
            html += `<div class="d-flex justify-content-between px-3 x-small text-success py-1"><span>${p.toFixed(4)}</span><span>${a}</span><span>${(p*a).toFixed(2)}</span></div>`;
        }
        html += '</div>';
        container.innerHTML = html;
    }

    function populateTrades() {
        const container = document.getElementById('recentTradesList');
        if(!container) return;
        let html = '<table class="table table-sm terminal-table x-small mb-0"><tbody>';
        for(let i=0; i<15; i++) {
            const isUp = Math.random() > 0.5;
            html += `<tr>
                <td class="${isUp ? 'text-success' : 'text-danger'}">${(currentPrice + (Math.random() * 10 - 5)).toFixed(4)}</td>
                <td class="text-white text-right">${(Math.random() * 0.5).toFixed(4)}</td>
                <td class="text-muted text-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', second:'2-digit'})}</td>
            </tr>`;
        }
        html += '</tbody></table>';
        container.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', function() {
        populateDepth();
        populateTrades();
        setInterval(populateDepth, 3000);
        setInterval(populateTrades, 5000);

        if (window.TradingView) {
            new TradingView.widget({
                "autosize": true,
                "symbol": @json($currentPair->resolveChartSymbol()),
                "interval": "60",
                "timezone": "Etc/UTC",
                "theme": "dark",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#161a1e",
                "enable_publishing": false,
                "hide_side_toolbar": false,
                "container_id": "tradingview_spot_widget"
            });
        }

        $('.ajax-trade-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const btn = form.find('button[type="submit"]');
            btn.prop('disabled', true);
            $.post(form.attr('action'), form.serialize())
                .done(resp => {
                    if(resp.status == 200) {
                        toastr.success(resp.message);
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        toastr.error(resp.message);
                        btn.prop('disabled', false);
                    }
                })
                .fail(() => {
                    toastr.error('Trade execution failed');
                    btn.prop('disabled', false);
                });
        });
    });
</script>
@endpush
@endsection
