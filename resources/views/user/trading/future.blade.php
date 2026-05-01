@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="spot-trading-container">
        @php
            $settlementSymbol = $currentPair->quote_asset ?? 'USD';
            $settlementWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($settlementSymbol) {
                $q->where('symbol', $settlementSymbol);
            })->first();
            $currentFutureBalance = $settlementWallet->future_bal ?? 0;
            $defaultLeverage = max(1, min(10, (int) $currentPair->leverage));
        @endphp
        {{-- Trading Header --}}
        <div class="trading-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between" style="background: #11151d;">
            <div class="d-flex align-items-center">
                <div class="dropdown mr-4">
                    <button class="btn btn-dark-input dropdown-toggle font-weight-bold text-white px-3" type="button" data-toggle="dropdown">
                        <i class="fas fa-chart-line mr-2 text-primary"></i> {{ $currentPair->display_name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark shadow-lg">
                        <div class="px-3 py-2 border-bottom border-white-10">
                            <input type="text" class="form-control form-control-sm bg-dark border-0 text-white" placeholder="Search pairs...">
                        </div>
                        @foreach($pairs as $pair)
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('future.trade', ['pair' => $pair->name]) }}">
                            <span>{{ $pair->display_name }}</span>
                            <small class="{{ $pair->change_24h >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $pair->change_24h >= 0 ? '+' : '' }}{{ number_format($pair->change_24h, 2) }}%
                            </small>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="price-info d-flex align-items-center">
                    <div class="mr-4">
                        <small class="text-muted d-block small-label">Last Price</small>
                        <span class="{{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }} font-weight-bold">
                            {{ number_format($currentPair->last_price, 5) }}
                        </span>
                    </div>
                    <div class="mr-4">
                        <small class="text-muted d-block small-label">24h Change</small>
                        <span class="{{ $currentPair->change_24h >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $currentPair->change_24h >= 0 ? '+' : '' }}{{ number_format($currentPair->change_24h, 2) }}%
                        </span>
                    </div>
                    <div class="mr-4">
                        <small class="text-muted d-block small-label">24h High</small>
                        <span class="text-white">{{ number_format($currentPair->high_24h, 5) }}</span>
                    </div>
                    <div class="mr-4">
                        <small class="text-muted d-block small-label">24h Low</small>
                        <span class="text-white">{{ number_format($currentPair->low_24h, 5) }}</span>
                    </div>
                    <div class="mr-4">
                        <small class="text-muted d-block small-label">Category</small>
                        <span class="text-white">{{ $currentPair->instrument_category }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-right mr-3">
                    <small class="text-muted d-block small-label">Settlement Balance</small>
                    <span class="text-white font-weight-bold">{{ number_format($currentFutureBalance, 2) }} {{ $settlementSymbol }}</span>
                </div>
                <button class="btn btn-sm btn-primary rounded-pill px-3" data-toggle="modal" data-target="#transferModal"><i class="fas fa-sync-alt mr-1"></i> Transfer</button>
            </div>
        </div>

        <div class="row no-gutters">
            {{-- Left Column: Order Book --}}
            <div class="col-lg-3 trading-panel border-right">
                <div class="panel-header px-3 py-2 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-white font-weight-bold">Order Book</h6>
                </div>
                <div class="order-book px-3 py-2">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless trading-table">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th>Price</th>
                                    <th class="text-right">Size</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="sell-orders">
                                @for($i=0; $i<12; $i++)
                                <tr class="sell-row">
                                    <td class="text-danger">64,{{ rand(200,300) }}.{{ rand(10,99) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(1,1000)/100, 4) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(100,2000), 2) }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="spread-line my-2 py-1 text-center bg-dark-input rounded">
                        <h5 class="text-success mb-0 font-weight-bold">64,231.50 <i class="fas fa-arrow-up small"></i></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless trading-table">
                            <tbody class="buy-orders">
                                @for($i=0; $i<12; $i++)
                                <tr class="buy-row">
                                    <td class="text-success">64,{{ rand(100,200) }}.{{ rand(10,99) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(1,1000)/100, 4) }}</td>
                                    <td class="text-right text-white">{{ number_format(rand(100,2000), 2) }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Middle Column: Chart & Trade Forms --}}
            <div class="col-lg-6 trading-panel border-right d-flex flex-column">
                <div class="chart-container flex-grow-1" style="min-height: 400px;">
                    <div id="tradingview_future" style="height: 100%;"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget({
                        "autosize": true,
                        "symbol": "{{ $currentPair->resolveChartSymbol() }}",
                        "interval": "15",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#11151d",
                        "enable_publishing": false,
                        "hide_top_toolbar": false,
                        "allow_symbol_change": true,
                        "container_id": "tradingview_future"
                    });
                    </script>
                </div>

                <div class="order-forms p-3 border-top" style="background: #11151d;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex">
                            <button class="btn btn-xs btn-dark-input active mr-2">Market</button>
                            <button class="btn btn-xs btn-dark-input mr-2">Limit</button>
                            <button class="btn btn-xs btn-dark-input">Stop</button>
                        </div>
                        <div class="leverage-info">
                            <span class="text-muted small">Max Leverage:</span>
                            <span class="text-warning font-weight-bold ml-1">{{ $currentPair->leverage }}x</span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('future.trade.store') }}" method="POST" class="ajax-trade-form" id="futureTradeForm">
                                @csrf
                                <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                                <input type="hidden" name="type" id="tradeType" value="Buy">
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-primary small font-weight-bold">Available</span>
                                    <span class="text-white small font-weight-bold">{{ number_format($currentFutureBalance, 4) }} {{ $settlementSymbol }}</span>
                                </div>

                                {{-- Rate Input --}}
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" name="price" id="tradePriceInput" step="any" class="form-control bg-dark border-secondary text-white" value="{{ $currentPair->last_price }}" placeholder="Rate" >
                                    <div class="input-group-append"><span class="input-group-text bg-dark border-secondary text-muted">{{ $settlementSymbol }}</span></div>
                                </div>

                                {{-- Amount Input --}}
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text bg-dark border-secondary text-muted">Size</span></div>
                                    <input type="number" name="amount" id="tradeAmountInput" step="any" class="form-control bg-dark border-secondary text-white" placeholder="size" required>
                                    <div class="input-group-append">
                                        <select name="base_currency" class="form-control bg-dark border-secondary text-muted" style="width: auto; -webkit-appearance: none; border-left: none;">
                                            <option value="{{ $settlementSymbol }}">{{ $settlementSymbol }}</option>
                                            @php $baseCoin = explode('/', $currentPair->name)[0]; @endphp
                                            <option value="{{ $baseCoin }}">{{ $baseCoin }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <input type="range" class="custom-range" min="1" max="{{ max(1, (int) $currentPair->leverage) }}" value="{{ $defaultLeverage }}" id="percentageSlider" name="leverage">
                                    <div class="d-flex justify-content-between small text-muted mt-1 px-1" style="font-size: 10px;">
                                        <span>1x</span>
                                        <span>{{ floor($currentPair->leverage * 0.25) }}x</span>
                                        <span>{{ floor($currentPair->leverage * 0.5) }}x</span>
                                        <span>{{ floor($currentPair->leverage * 0.75) }}x</span>
                                        <span>{{ (int) $currentPair->leverage }}x</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-6 pr-1">
                                        <button type="button" class="btn btn-success btn-block font-weight-bold py-2 shadow-success" onclick="document.getElementById('tradeType').value='Buy'; document.getElementById('futureTradeForm').requestSubmit();">BUY/LONG</button>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <button type="button" class="btn btn-danger btn-block font-weight-bold py-2 shadow-danger" onclick="document.getElementById('tradeType').value='Sell'; document.getElementById('futureTradeForm').requestSubmit();">SELL/SHORT</button>
                                    </div>
                                </div>

                                <div class="trade-stats mt-4">
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Size:</span>
                                        <span class="text-white font-weight-bold" id="statSize">0.0000 {{ $settlementSymbol }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Cost:</span>
                                        <span class="text-white font-weight-bold" id="statCost">0.0000 {{ $settlementSymbol }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Min:</span>
                                        <span class="text-white font-weight-bold">1 {{ $baseCoin }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Max:</span>
                                        <span class="text-white font-weight-bold">10000 {{ $baseCoin }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Buy Charge:</span>
                                        <span class="text-white font-weight-bold">1.00%</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span class="text-muted">Sell Charge:</span>
                                        <span class="text-white font-weight-bold">1.00%</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Assets & Open Positions --}}
            <div class="col-lg-3 trading-panel">
                <div class="p-3">
                    <h6 class="text-muted small font-weight-bold text-uppercase mb-3">Margin Ratio</h6>
                    <div class="progress bg-dark mb-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 5%"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-4">
                        <span>Ratio</span>
                        <span class="text-success">0.45%</span>
                    </div>

                    <div class="border-top border-white-10 pt-3 mb-4">
                        <h6 class="text-muted small font-weight-bold text-uppercase mb-3">Asset Details</h6>
                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Wallet Balance</span>
                            <span class="text-white">{{ number_format($currentFutureBalance, 2) }} {{ $settlementSymbol }}</span>
                        </div>
                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Unrealized PNL</span>
                            <span class="text-success">+0.00 USD</span>
                        </div>
                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Margin Balance</span>
                            <span class="text-white">{{ number_format($currentFutureBalance, 2) }} {{ $settlementSymbol }}</span>
                        </div>
                    </div>

                    <div class="border-top border-white-10 pt-3">
                        <h6 class="text-muted small font-weight-bold text-uppercase mb-3">Funding Rate</h6>
                        <div class="p-2 bg-dark-input rounded mb-2">
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">Funding Rate</span>
                                <span class="text-warning">0.0100%</span>
                            </div>
                        </div>
                        <div class="p-2 bg-dark-input rounded">
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">Countdown</span>
                                <span class="text-white">04:15:22</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Section: Positions & History --}}
        <div class="trading-footer border-top" style="background: #11151d; min-height: 200px;">
            <ul class="nav nav-tabs nav-tabs-trading px-3">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#positions">Open Positions ({{ $openPositions->count() }})</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#orders">Open Orders (0)</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history">Order History</a></li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane fade show active" id="positions">
                    <div class="table-responsive">
                        <table class="table table-dark-custom small">
                            <thead>
                                <tr class="text-muted text-uppercase">
                                    <th>Symbol</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Leverage</th>
                                    <th>Entry Price</th>
                                    <th>Mark Price</th>
                                    <th>Margin</th>
                                    <th>PNL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($openPositions as $position)
                                <tr>
                                    <td class="font-weight-bold text-white">{{ $position->pair }}<br><small class="text-muted">{{ $position->instrument_category }}</small></td>
                                    <td>
                                        <span class="badge badge-{{ $position->type == 'Buy' ? 'success' : 'danger' }} px-2">
                                            {{ $position->type == 'Buy' ? 'Long' : 'Short' }}
                                        </span>
                                    </td>
                                    <td class="text-white">{{ number_format($position->amount, 2) }} {{ $position->quote_asset_symbol ?: $settlementSymbol }}</td>
                                    <td class="text-warning">{{ $position->leverage }}x</td>
                                    <td class="text-white">{{ number_format($position->price, 2) }}</td>
                                    <td class="text-white">{{ number_format(optional($position->tradingPair)->last_price ?? $position->price, 2) }}</td>
                                    <td class="text-white">{{ number_format($position->amount / $position->leverage, 2) }} {{ $position->quote_asset_symbol ?: $settlementSymbol }}</td>
                                    <td class="text-success font-weight-bold">+0.00 (0.00%)</td>
                                    <td>
                                        <a href="{{ route('trade.close', $position->id) }}" class="btn btn-xs btn-outline-danger px-3">Market Close</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">No open positions.</td>
                                </tr>
                                @endforelse
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
        .trading-table td { padding: 1px 0.5rem; font-size: 0.72rem; line-height: 1.4; border: 0; }
        .sell-row { background: linear-gradient(to left, rgba(220, 53, 69, 0.05) 0%, transparent 100%); }
        .buy-row { background: linear-gradient(to left, rgba(40, 167, 69, 0.05) 0%, transparent 100%); }
        .nav-tabs-trading .nav-link { color: rgba(255,255,255,0.4); border: 0; font-weight: 600; font-size: 0.75rem; padding: 0.5rem 0.8rem; border-radius: 0; }
        .nav-tabs-trading .nav-link.active { background: rgba(21, 114, 232, 0.08); color: #1572e8; border-radius: 2px; }
        .bg-dark-input { background: #090c10; border-radius: 2px; border: 1px solid rgba(255,255,255,0.1); }
        .border-right { border-right: 1px solid rgba(255,255,255,0.05) !important; }
        .border-top { border-top: 1px solid rgba(255,255,255,0.05) !important; }
        .border-secondary { border-color: rgba(255,255,255,0.05) !important; }
        .custom-range::-webkit-slider-thumb { background: #1572e8; border-radius: 2px; }
        .btn-success, .btn-danger { border-radius: 2px; }
        .badge-warning { border-radius: 2px; font-weight: 600; }
    </style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    $('.ajax-trade-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = form.find('button[type="submit"]');
        let originalText = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 200) {
                    toastr.success(response.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    toastr.error(response.message);
                    btn.html(originalText).prop('disabled', false);
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while executing the trade.');
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
});
</script>
@endpush
