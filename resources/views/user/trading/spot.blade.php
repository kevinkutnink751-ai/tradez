@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="spot-trading-container">
        @php
            $quoteSymbol = $currentPair->quote_asset ?? 'USD';
            $quoteWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($quoteSymbol) {
                $q->where('symbol', $quoteSymbol);
            })->first();
            $baseWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($currentPair) {
                $q->where('symbol', $currentPair->symbol);
            })->first();
        @endphp
        {{-- Trading Header --}}
        <div class="trading-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between" style="background: #11151d;">
            <div class="d-flex align-items-center">
                <div class="dropdown mr-4">
                    <button class="btn btn-dark-input dropdown-toggle font-weight-bold text-white px-3" type="button" data-toggle="dropdown">
                        <i class="fas fa-coins mr-2 text-warning"></i> {{ $currentPair->display_name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark shadow-lg">
                        <div class="px-3 py-2 border-bottom border-white-10">
                            <input type="text" class="form-control form-control-sm bg-dark border-0 text-white" placeholder="Search pairs...">
                        </div>
                        @foreach($pairs as $pair)
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('spot.trade', ['pair' => $pair->name]) }}">
                            <span>{{ $pair->display_name }}</span>
                            <small class="{{ $pair->change_24h >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $pair->change_24h >= 0 ? '+' : '' }}{{ number_format($pair->change_24h, 2) }}%
                            </small>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="price-info d-flex align-items-center">
                    <div class="mr-4 {{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }} font-weight-bold">
                        {{ number_format($currentPair->last_price, 5) }}
                    </div>
                    <div class="mr-4 small">
                        <span class="text-muted">24h Change</span> 
                        <span class="{{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }} ml-1">
                            {{ $currentPair->change_24h >= 0 ? '+' : '' }}{{ number_format($currentPair->change_24h, 2) }}%
                        </span>
                    </div>
                    <div class="mr-4 small"><span class="text-muted">24h High</span> <span class="text-white ml-1">{{ number_format($currentPair->high_24h, 5) }}</span></div>
                    <div class="mr-4 small"><span class="text-muted">24h Low</span> <span class="text-white ml-1">{{ number_format($currentPair->low_24h, 5) }}</span></div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-right mr-3">
                    <small class="text-muted d-block small-label">Spot Balance</small>
                    <span class="text-white font-weight-bold">{{ number_format($quoteWallet->spot_bal ?? 0, 2) }} {{ $quoteSymbol }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-dark-input rounded-pill px-3 mr-2" data-toggle="modal" data-target="#transferModal"><i class="fas fa-sync-alt mr-1"></i> Transfer</button>
                    <button class="btn btn-sm btn-primary rounded-pill px-3">Deposit</button>
                </div>
            </div>
        </div>

        <div class="row no-gutters">
            {{-- Left Column: Order Book --}}
            <div class="col-lg-3 trading-panel border-right">
                <div class="panel-header px-3 py-2">
                    <h6 class="mb-0 text-white font-weight-bold">Order Book</h6>
                </div>
                <div class="order-book px-3 py-2">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless trading-table">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th>Price({{ $quoteSymbol }})</th>
                                    <th class="text-right">Amount({{ $currentPair->symbol }})</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="sell-orders">
                                @for($i=0; $i<10; $i++)
                                <tr class="sell-row">
                                    <td class="text-danger">64,{{ rand(300,400) }}.{{ rand(10,99) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(1,1000)/100, 4) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(100,5000), 2) }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="spread-line my-2 text-center bg-dark-input rounded py-1">
                        <h5 class="text-success mb-0 font-weight-bold">{{ number_format($currentPair->last_price, 5) }} <i class="fas fa-arrow-up small"></i></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless trading-table">
                            <tbody class="buy-orders">
                                @for($i=0; $i<10; $i++)
                                <tr class="buy-row">
                                    <td class="text-success">64,{{ rand(100,200) }}.{{ rand(10,99) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(1,1000)/100, 4) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(100,5000), 2) }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Middle Column: Chart & Forms --}}
            <div class="col-lg-6 trading-panel border-right d-flex flex-column">
                <div class="chart-container flex-grow-1" style="min-height: 400px;">
                    <div id="tradingview_spot" style="height: 100%;"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget({
                        "autosize": true,
                        "symbol": "{{ $currentPair->resolveChartSymbol() }}",
                        "interval": "H",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#11151d",
                        "enable_publishing": false,
                        "hide_side_toolbar": false,
                        "allow_symbol_change": true,
                        "container_id": "tradingview_spot"
                    });
                    </script>
                </div>

                <div class="order-forms p-3 border-top" style="background: #11151d;">
                    <div class="d-flex mb-3">
                        <button class="btn btn-xs btn-dark-input active mr-2">Market</button>
                        <button class="btn btn-xs btn-dark-input mr-2">Limit</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form id="spotBuyForm">
                                @csrf
                                <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                                <input type="hidden" name="type" value="Buy">
                                <input type="hidden" name="price" value="{{ $currentPair->last_price }}">

                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted">Available</small>
                                    <small class="text-white font-weight-bold">{{ number_format($quoteWallet->spot_bal ?? 0, 2) }} {{ $quoteSymbol }}</small>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text bg-dark border-secondary text-muted">Amount</span></div>
                                    <input type="number" name="amount" step="any" class="form-control bg-dark border-secondary text-white" placeholder="0.00">
                                    <div class="input-group-append"><span class="input-group-text bg-dark border-secondary text-muted">{{ $currentPair->symbol }}</span></div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block font-weight-bold py-2 shadow-success">Buy {{ $currentPair->symbol }}</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form id="spotSellForm">
                                @csrf
                                <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                                <input type="hidden" name="type" value="Sell">
                                <input type="hidden" name="price" value="{{ $currentPair->last_price }}">

                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted">Available</small>
                                    <small class="text-white font-weight-bold">{{ number_format($baseWallet->spot_bal ?? 0, 4) }} {{ $currentPair->symbol }}</small>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text bg-dark border-secondary text-muted">Amount</span></div>
                                    <input type="number" name="amount" step="any" class="form-control bg-dark border-secondary text-white" placeholder="0.00">
                                    <div class="input-group-append"><span class="input-group-text bg-dark border-secondary text-muted">{{ $currentPair->symbol }}</span></div>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block font-weight-bold py-2 shadow-danger">Sell {{ $currentPair->symbol }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Markets & Trade History --}}
            <div class="col-lg-3 trading-panel">
                <div class="market-list border-bottom" style="height: 50%;">
                    <div class="px-3 py-2">
                        <div class="input-group input-group-sm bg-dark-input rounded mb-2">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span></div>
                            <input type="text" class="form-control bg-transparent border-0 text-white" placeholder="Search Pairs">
                        </div>
                        <ul class="nav nav-pills nav-pills-xs mb-2">
                            <li class="nav-item"><a class="nav-link active" href="#">Favorites</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">{{ $quoteSymbol }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Cross-Asset</a></li>
                        </ul>
                        <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-sm table-borderless trading-table">
                                <thead class="text-muted small">
                                    <tr><th>Pair</th><th>Price</th><th class="text-right">Change</th></tr>
                                </thead>
                                <tbody>
                                    @foreach($pairs->take(6) as $pair)
                                    <tr>
                                        <td><i class="far fa-star mr-1"></i>{{ $pair->display_name }}</td>
                                        <td class="text-white">{{ number_format($pair->last_price, 4) }}</td>
                                        <td class="text-{{ $pair->change_24h >= 0 ? 'success' : 'danger' }} text-right">
                                            {{ $pair->change_24h >= 0 ? '+' : '' }}{{ number_format($pair->change_24h, 2) }}%
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="trade-history" style="height: 50%;">
                    <div class="px-3 py-2 border-bottom">
                        <h6 class="mb-0 text-white font-weight-bold">Market Trade</h6>
                    </div>
                    <div class="px-3 py-2">
                        <table class="table table-sm table-borderless trading-table">
                            <thead class="text-muted small">
                                <tr><th>Price({{ $quoteSymbol }})</th><th class="text-right">Amount</th><th class="text-right">Time</th></tr>
                            </thead>
                            <tbody>
                                @for($i=0; $i<15; $i++)
                                <tr>
                                    <td class="text-{{ rand(0,1) ? 'success' : 'danger' }}">65,{{ rand(100,999) }}.{{ rand(10,99) }}</td>
                                    <td class="text-right text-white">0.{{ rand(1000,9999) }}</td>
                                    <td class="text-right text-muted">{{ date('H:i:s') }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .spot-trading-container { background: #090c10; margin: -1.5rem; }
        .trading-panel { background: #11151d; height: calc(100vh - 100px); border-right: 1px solid rgba(255,255,255,0.05); }
        .panel-header { border-bottom: 1px solid rgba(255,255,255,0.05); background: #11151d; }
        .trading-table { font-size: 0.72rem; }
        .trading-table th { font-weight: 500; color: rgba(255,255,255,0.3); border: 0; padding-bottom: 5px; }
        .trading-table td { padding: 1px 0.5rem; line-height: 1.4; border: 0; }
        .sell-row:hover, .buy-row:hover { background: rgba(255,255,255,0.03); }
        .sell-row { background: linear-gradient(to left, rgba(220, 53, 69, 0.05) 0%, transparent 100%); }
        .buy-row { background: linear-gradient(to left, rgba(40, 167, 69, 0.05) 0%, transparent 100%); }
        .spread-line { border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); padding: 4px 0; background: rgba(0,0,0,0.1); }
        .nav-tabs-trading .nav-link { color: rgba(255,255,255,0.4); border: 0; font-weight: 600; font-size: 0.75rem; padding: 0.5rem 0.8rem; border-radius: 0; }
        .nav-tabs-trading .nav-link.active { background: transparent; color: #1572e8; border-bottom: 2px solid #1572e8; }
        .bg-dark-input { background: #090c10; border-radius: 2px; border: 1px solid rgba(255,255,255,0.1); }
        .nav-pills-xs .nav-link { font-size: 0.65rem; padding: 2px 6px; color: rgba(255,255,255,0.4); border-radius: 2px; }
        .nav-pills-xs .nav-link.active { background: rgba(21, 114, 232, 0.1); color: #1572e8; }
        .btn-xs { padding: 0.15rem 0.4rem; font-size: 0.65rem; border-radius: 2px; }
        .btn-success, .btn-danger { border-radius: 2px; font-size: 0.85rem; }
        .form-control { border-radius: 2px; font-size: 0.85rem; }
        .input-group-text { border-radius: 2px; font-size: 0.75rem; }
        .percentage-buttons .btn { flex: 1; margin: 0 2px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.5); }
        .percentage-buttons .btn:hover { background: rgba(255,255,255,0.08); color: #fff; }
    </style>
    <script>
        document.querySelectorAll('#spotBuyForm, #spotSellForm').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = this.querySelector('button[type="submit"]');
                const originalText = btn.innerText;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

                const formData = new FormData(this);
                fetch("{{ route('spot.trade.store') }}", {
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
                        btn.innerText = originalText;
                    }
                })
                .catch(error => {
                    $.notify({ icon: 'fas fa-exclamation-circle', message: "Error processing trade." }, { type: 'danger', placement: { from: "top", align: "right" } });
                    btn.disabled = false;
                    btn.innerText = originalText;
                });
            });
        });
    </script>
@endsection
