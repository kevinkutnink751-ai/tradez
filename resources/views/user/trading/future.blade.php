@extends('layouts.terminal')
@section('title', $title)
@section('content')
@php
    $baseSymbol = $currentPair->symbol;
    $quoteSymbol = $currentPair->quote_asset ?? 'USD';
    
    // Check if base asset is Crypto or Fiat
    $isBaseSelectable = in_array(optional($currentPair->asset)->type, ['Crypto', 'Fiat']);
    
    $settlementSymbol = $quoteSymbol; 
    $settlementWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($settlementSymbol) { $q->where('symbol', $settlementSymbol); })->first();
    $baseWallet = Auth::user()->wallets()->whereHas('asset', function($q) use ($baseSymbol) { $q->where('symbol', $baseSymbol); })->first();
    
    $leverages = $currentPair->availableLeverages();
    $defaultLeverage = end($leverages) ?: 100;
@endphp

<div class="terminal-shell">
    <!-- Market Header Stats -->
    <div class="market-ticker d-flex align-items-center py-2 px-3">
        <div class="ticker-pair mr-4 dropdown">
            <h2 class="h5 mb-0 text-white font-weight-bold d-flex align-items-center cursor-pointer" data-toggle="dropdown">
                <i class="mdi mdi-star-outline text-warning mr-2"></i>
                {{ $currentPair->display_name }} 
                <span class="badge badge-soft-warning x-small mx-2">Prep</span>
                <i class="mdi mdi-chevron-down text-muted"></i>
            </h2>
            <div class="ticker-price text-success h5 mb-0 font-weight-bold">{{ number_format($currentPair->last_price, 4) }}</div>
            
            <div class="dropdown-menu dropdown-menu-left bg-dark border-secondary market-selector-dropdown p-0" style="width: 300px; z-index: 9999;">
                <div class="p-2 border-bottom border-secondary">
                    <input type="text" class="form-control form-control-sm bg-transparent border-secondary text-white" placeholder="Search pairs..." onkeyup="filterPairs(this.value)">
                </div>
                <div class="pairs-list" style="max-height: 400px; overflow-y: auto;">
                    @foreach($pairs as $pair)
                        <a href="{{ route('future.trade', ['pair' => $pair->name]) }}" class="dropdown-item d-flex justify-content-between align-items-center py-2 border-bottom border-secondary pair-item">
                            <span class="text-white small font-weight-bold">{{ $pair->display_name }}</span>
                            <span class="text-{{ $pair->change_24h >= 0 ? 'success' : 'danger' }} x-small">{{ $pair->change_24h >= 0 ? '+' : '' }}{{ number_format($pair->change_24h, 2) }}%</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ticker-stats d-flex">
            <div class="ticker-item px-3"><label>Price</label><span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }}">{{ number_format($currentPair->last_price, 4) }}</span></div>
            <div class="ticker-item px-3 border-left border-secondary"><label>24h High</label><span class="text-white">{{ number_format($currentPair->high_24h, 4) }}</span></div>
            <div class="ticker-item px-3 border-left border-secondary"><label>24h Low</label><span class="text-white">{{ number_format($currentPair->low_24h, 4) }}</span></div>
            <div class="ticker-item px-3 border-left border-secondary"><label>24h Change</label><span class="text-{{ $currentPair->change_24h >= 0 ? 'success' : 'danger' }}">{{ number_format($currentPair->change_24h, 2) }}%</span></div>
            <div class="ticker-item px-3 border-left border-secondary d-none d-xl-block"><label>24h Volume({{ $baseSymbol }})</label><span class="text-white">{{ number_format($currentPair->volume_24h, 2) }}</span></div>
        </div>
    </div>

    <div class="terminal-grid">
        <!-- Main Left: Chart & Positions -->
        <div class="grid-main">
            <div class="terminal-panel chart-panel mb-1">
                <div id="tradingview_futures_widget" style="height: 500px;"></div>
            </div>

            <div class="terminal-panel dashboard-panel">
                <div class="panel-header border-bottom border-secondary">
                    <ul class="nav nav-tabs border-0" id="dashTabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#positions">Positions({{ $openPositions->count() }})</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#openOrders">Open Order({{ $pendingOrders->count() }})</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tradeHistory">History</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="positions">
                        <div class="table-responsive">
                            <table class="table table-sm terminal-table">
                                <thead>
                                    <tr>
                                        <th>Symbol</th>
                                        <th>Size</th>
                                        <th>Entry Price</th>
                                        <th>Mark Price</th>
                                        <th>Liq. Price</th>
                                        <th>Margin Ratio</th>
                                        <th>Margin</th>
                                        <th>PNL (ROI)</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($openPositions as $position)
                                        @php
                                            // Basic Liquidation Price Calculation
                                            // Long: Entry * (1 - 1/Lev + MM)
                                            // Short: Entry * (1 + 1/Lev - MM)
                                            $mm = 0.005; // 0.5% maintenance margin
                                            $liqPrice = ($position->type == 'Buy') 
                                                ? $position->price * (1 - (1 / $position->leverage) + $mm)
                                                : $position->price * (1 + (1 / $position->leverage) - $mm);
                                            
                                            $marginUsed = ($position->amount * $position->price) / $position->leverage;
                                            $marginRatio = ($mm * ($position->amount * $position->price)) / max(0.0001, $marginUsed) * 100;
                                        @endphp
                                        <tr>
                                            <td class="text-white font-weight-bold">{{ $position->pair }} <span class="text-success x-small">{{ $position->leverage }}X</span></td>
                                            <td class="{{ $position->type == 'Buy' ? 'text-success' : 'text-danger' }}">
                                                {{ $position->type == 'Buy' ? '+' : '-' }}{{ number_format($position->amount, 4) }}
                                            </td>
                                            <td>{{ number_format($position->price, 4) }}</td>
                                            <td>{{ number_format($currentPair->last_price, 4) }}</td>
                                            <td class="text-warning font-weight-bold">{{ number_format($liqPrice, 4) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2 text-info">{{ number_format($marginRatio, 2) }}%</span>
                                                    <div class="progress flex-grow-1" style="height: 3px; background: rgba(255,255,255,0.05);">
                                                        <div class="progress-bar bg-info" style="width: {{ $marginRatio }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($marginUsed / ($position->price ?: 1), 4) }} {{ $position->settlement_asset }}</td>
                                            <td class="{{ $position->pnl >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ number_format($position->pnl, 2) }} ({{ number_format(($position->pnl / max(0.0001, $position->amount / $position->leverage)) * 100, 2) }}%)
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-link btn-sm text-danger p-0 font-weight-bold" onclick="closePosition({{ $position->id }})">Market Close</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="9" class="text-center py-4 text-muted">No active positions</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="openOrders">
                        <div class="table-responsive">
                            <table class="table table-sm terminal-table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Symbol</th>
                                        <th>Type</th>
                                        <th>Side</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingOrders as $order)
                                        <tr>
                                            <td class="text-muted">{{ $order->created_at->format('H:i:s') }}</td>
                                            <td class="text-white">{{ $order->pair }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td class="{{ $order->type == 'Buy' ? 'text-success' : 'text-danger' }}">{{ $order->type }}</td>
                                            <td>{{ number_format($order->price, 4) }}</td>
                                            <td>{{ number_format($order->amount, 4) }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-link btn-sm text-muted p-0" onclick="cancelOrder({{ $order->id }})">Cancel</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center py-4 text-muted">No open orders</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tradeHistory">
                        <div class="table-responsive">
                            <table class="table table-sm terminal-table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Symbol</th>
                                        <th>Side</th>
                                        <th>Avg Price</th>
                                        <th>Amount</th>
                                        <th>PNL</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tradeHistory as $hist)
                                        <tr>
                                            <td class="text-muted">{{ $hist->created_at->format('m-d H:i') }}</td>
                                            <td class="text-white">{{ $hist->pair }}</td>
                                            <td class="{{ $hist->type == 'Buy' ? 'text-success' : 'text-danger' }}">{{ $hist->type }}</td>
                                            <td>{{ number_format($hist->price, 4) }}</td>
                                            <td>{{ number_format($hist->amount, 4) }}</td>
                                            <td class="{{ $hist->pnl >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($hist->pnl, 4) }}</td>
                                            <td><span class="badge badge-soft-{{ $hist->status == 'Completed' ? 'success' : 'secondary' }}">{{ $hist->status }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center py-4 text-muted">No trade history</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle: Order Book & Recent Trades -->
        <div class="grid-middle">
            <div class="terminal-panel orderbook-panel mb-3">
                <div class="panel-title py-2 px-3 border-bottom border-secondary d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-white x-small font-weight-bold text-uppercase">Order Book</h6>
                    <div class="book-controls d-flex">
                        <i class="mdi mdi-view-list text-success mr-2"></i>
                        <i class="mdi mdi-view-list text-danger mr-2"></i>
                        <i class="mdi mdi-view-list text-muted"></i>
                    </div>
                </div>
                <div class="orderbook-content">
                    <div class="orderbook-header px-3 py-1 d-flex justify-content-between x-small text-muted">
                        <span>Price({{ $quoteSymbol }})</span>
                        <span>Amount({{ $baseSymbol }})</span>
                        <span>Total</span>
                    </div>
                    <div class="book-asks px-3" id="bookAsks">
                        <!-- Populated by JS -->
                    </div>
                    <div class="book-spread py-2 px-3 border-top border-bottom border-secondary text-center">
                        <span class="h6 mb-0 text-danger font-weight-bold" id="lastPriceBook">{{ number_format($currentPair->last_price, 4) }}</span>
                        <i class="mdi mdi-arrow-down text-danger ml-1"></i>
                    </div>
                    <div class="book-bids px-3" id="bookBids">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <div class="terminal-panel trades-panel">
                <div class="panel-title py-2 px-3 border-bottom border-secondary">
                    <h6 class="mb-0 text-white x-small font-weight-bold text-uppercase">Recent Trade</h6>
                </div>
                <div class="trades-content">
                    <div class="trades-header px-3 py-1 d-flex justify-content-between x-small text-muted">
                        <span>Price({{ $quoteSymbol }})</span>
                        <span>Amount({{ $baseSymbol }})</span>
                        <span>Date</span>
                    </div>
                    <div class="trades-list px-3" id="recentTradesList">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Trade Ticket -->
        <div class="grid-right">
            <div class="terminal-panel trade-ticket">
                <div class="ticket-header p-3 border-bottom border-secondary">
                    <div class="d-flex mb-3">
                        <div class="btn-group btn-group-sm w-100 mr-2">
                            <button class="btn btn-secondary py-1 x-small active">Isolated</button>
                            <button class="btn btn-secondary py-1 x-small">Cross</button>
                        </div>
                        <div class="dropdown w-50">
                            <button class="btn btn-secondary btn-sm x-small px-3 w-100 dropdown-toggle" type="button" data-toggle="dropdown" id="leverageBtn">
                                {{ $defaultLeverage }}X
                            </button>
                            <div class="dropdown-menu dropdown-menu-right bg-dark border-secondary">
                                @foreach($leverages as $lev)
                                    <a class="dropdown-item text-white x-small" href="javascript:void(0)" onclick="setLeverage({{ $lev }})">{{ $lev }}X</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="order-tabs d-flex">
                        <button class="flex-grow-1 py-1 active" onclick="setOrderType('Limit')">Limit</button>
                        <button class="flex-grow-1 py-1" onclick="setOrderType('Market')">Market</button>
                        <button class="flex-grow-1 py-1" onclick="setOrderType('Stop')">Stop Limit</button>
                    </div>
                </div>

                <form action="{{ route('future.trade.store') }}" method="POST" class="ajax-trade-form p-3" id="futureTradeForm">
                    @csrf
                    <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                    <input type="hidden" name="type" id="futureTradeType" value="Buy">
                    <input type="hidden" name="order_type" id="futureOrderType" value="Limit">
                    <input type="hidden" name="settlement_asset" id="settlementAssetInput" value="{{ $quoteSymbol }}">
                    <input type="hidden" name="leverage" id="futureLeverageInput" value="{{ $defaultLeverage }}">

                    <div class="mb-3">
                        <div class="d-flex justify-content-between x-small mb-2">
                            <span class="text-info font-weight-bold">Available</span>
                            <span class="text-white" id="availableBalanceDisplay">{{ number_format($settlementWallet->future_bal ?? 0, 4) }} {{ $quoteSymbol }}</span>
                        </div>

                        <!-- Price Input -->
                        <div class="ticket-input-group mb-3">
                            <input type="number" step="any" name="price" id="futurePriceInput" class="ticket-input" value="{{ $currentPair->last_price }}">
                            <span class="input-label">{{ $quoteSymbol }}</span>
                        </div>

                        <!-- Amount Input with Dropdown -->
                        <div class="ticket-input-group mb-3">
                            <input type="number" step="any" name="amount" id="futureAmountInput" class="ticket-input" placeholder="Size">
                            <div class="dropdown input-dropdown">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="assetSelectBtn">
                                    {{ $quoteSymbol }} <i class="mdi mdi-chevron-down ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="setSettlementAsset('{{ $quoteSymbol }}', {{ $settlementWallet->future_bal ?? 0 }})">{{ $quoteSymbol }}</a>
                                    @if($isBaseSelectable)
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="setSettlementAsset('{{ $baseSymbol }}', {{ $baseWallet->future_bal ?? 0 }})">{{ $baseSymbol }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Slider -->
                        <div class="range-slider-container mb-4">
                            <input type="range" class="terminal-range" id="allocationSlider" min="0" max="100" step="1" value="0" oninput="handleSliderChange(this.value)">
                            <div class="range-dots">
                                <span class="dot" style="left: 0%"></span>
                                <span class="dot" style="left: 25%"></span>
                                <span class="dot" style="left: 50%"></span>
                                <span class="dot" style="left: 75%"></span>
                                <span class="dot" style="left: 100%"></span>
                            </div>
                            <div class="d-flex justify-content-between x-small text-muted mt-2">
                                <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                            </div>
                        </div>

                        <div class="d-flex gap-.5 mb-4">
                            <button type="submit" onclick="document.getElementById('futureTradeType').value='Buy'" class="btn btn-success flex-grow-1 py-2 font-weight-bold">BUY/LONG</button>
                            <button type="submit" onclick="document.getElementById('futureTradeType').value='Sell'" class="btn btn-danger flex-grow-1 py-2 font-weight-bold">SELL/SHORT</button>
                        </div>

                        <div class="ticket-details x-small">
                            <div class="detail-row"><span>Size:</span><span id="detailSize">0.0000 {{ $quoteSymbol }}</span></div>
                            <div class="detail-row"><span>Cost:</span><span id="detailCost">0.0000 {{ $quoteSymbol }}</span></div>
                            <div class="detail-row"><span>Min:</span><span>0.0001 {{ $baseSymbol }}</span></div>
                            <div class="detail-row"><span>Max:</span><span>10 {{ $baseSymbol }}</span></div>
                            <div class="detail-row"><span>Buy Charge:</span><span>1.00%</span></div>
                            <div class="detail-row"><span>Sell Charge:</span><span>1.00%</span></div>
                        </div>
                    </div>

                    <div class="ticket-assets mt-4 pt-3 border-top border-secondary">
                        <h6 class="text-info x-small font-weight-bold text-uppercase mb-3">Assets</h6>
                        <div class="asset-rows x-small">
                            <div class="detail-row"><span>Overall Balance:</span><span class="text-white">${{ number_format(Auth::user()->total_balance, 4) }} USD</span></div>
                            <div class="detail-row"><span>Available Balance:</span><span class="text-white" id="assetAvailBal">{{ number_format($settlementWallet->future_bal ?? 0, 4) }} {{ $quoteSymbol }}</span></div>
                            <div class="detail-row"><span>Unrealized Pnl:</span><span class="text-danger">0.0000 {{ $quoteSymbol }}</span></div>
                            <div class="detail-row"><span>Running Position:</span><span class="text-white">0</span></div>
                            <div class="detail-row"><span>Open Orders:</span><span class="text-white">16</span></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body { background: #0b1217; font-family: 'Inter', sans-serif; color: #848e9c; }
    .terminal-shell { height: 100vh; display: flex; flex-direction: column; overflow: hidden; }
    
    /* Market Ticker */
    .market-ticker { background: #161a1e; border-bottom: 1px solid #2b3139; }
    .ticker-item { margin-left: 24px; }
    .ticker-item label { display: block; font-size: 0.6rem; color: #848e9c; margin-bottom: 0; }
    .ticker-item span { font-size: 0.75rem; font-weight: 600; }
    .cursor-pointer { cursor: pointer; }

    /* Grid Layout */
    .terminal-grid { display: grid; grid-template-columns: 1fr 300px 320px; gap: 4px; flex-grow: 1; padding: 4px; overflow: hidden; }
    .grid-main { display: flex; flex-direction: column; min-width: 0; }
    .grid-middle { display: flex; flex-direction: column; }
    .grid-right { display: flex; flex-direction: column; }

    .terminal-panel { background: #161a1e; border: 1px solid #2b3139; border-radius: 4px; display: flex; flex-direction: column; }
    .chart-panel { flex-grow: 1; }
    .dashboard-panel { height: 250px; }
    .orderbook-panel { height: 400px; }
    .trades-panel { flex-grow: 1; min-height: 200px; }
    .trade-ticket { flex-grow: 1; overflow-y: auto; }

    /* Tables & Navs */
    .panel-header .nav-tabs .nav-link { color: #848e9c; border: 0; font-size: 0.7rem; padding: 12px 16px; position: relative; background: transparent; }
    .panel-header .nav-tabs .nav-link.active { color: #1bd1c7; }
    .panel-header .nav-tabs .nav-link.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: #1bd1c7; }
    
    .terminal-table { margin-bottom: 0; }
    .terminal-table thead th { border-bottom: 1px solid #2b3139; border-top: 0; font-size: 0.65rem; color: #848e9c; font-weight: 500; padding: 8px 12px; }
    .terminal-table tbody td { border: 0; font-size: 0.7rem; padding: 10px 12px; vertical-align: middle; }

    /* Orderbook & Trades */
    .orderbook-content, .trades-content { flex-grow: 1; overflow-y: hidden; }
    .book-row, .trade-row { display: flex; justify-content: space-between; font-size: 0.7rem; padding: 2px 0; position: relative; }
    .book-row .bg-overlay { position: absolute; top: 0; right: 0; bottom: 0; opacity: 0.15; transition: width 0.3s; }
    .book-row.ask { color: #f6465d; }
    .book-row.bid { color: #0ecb81; }

    /* Trade Ticket */
    .order-tabs button { background: transparent; border: 0; color: #848e9c; font-size: 0.7rem; font-weight: 600; padding-bottom: 6px; position: relative; }
    .order-tabs button.active { color: #1bd1c7; }
    .order-tabs button.active::after { content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 2px; background: #1bd1c7; }

    .ticket-input-group { background: #2b3139; border-radius: 4px; display: flex; align-items: center; padding: 4px 12px; border: 1px solid transparent; transition: border 0.2s; }
    .ticket-input-group:focus-within { border-color: #1bd1c7; }
    .ticket-input { background: transparent; border: 0; color: #fff; font-size: 0.85rem; font-weight: 500; flex-grow: 1; padding: 8px 0; width: 100%; }
    .ticket-input:focus { outline: none; }
    .input-label { font-size: 0.7rem; color: #848e9c; margin-left: 8px; }
    
    .input-dropdown .dropdown-toggle { background: transparent; border: 0; color: #fff; font-size: 0.75rem; padding: 0; }
    .input-dropdown .dropdown-menu { background: #2b3139; border: 1px solid #474d57; }
    .input-dropdown .dropdown-item { color: #fff; font-size: 0.7rem; }
    .input-dropdown .dropdown-item:hover { background: #1e2329; }

    /* Slider dots */
    .range-slider-container { position: relative; padding-top: 10px; }
    .terminal-range { width: 100%; height: 4px; background: #2b3139; border-radius: 2px; -webkit-appearance: none; position: relative; z-index: 2; }
    .terminal-range::-webkit-slider-thumb { -webkit-appearance: none; width: 14px; height: 14px; background: #1bd1c7; border: 2px solid #161a1e; border-radius: 50%; cursor: pointer; }
    .range-dots { position: absolute; top: 11px; left: 0; right: 0; height: 2px; z-index: 1; pointer-events: none; }
    .range-dots .dot { position: absolute; width: 6px; height: 6px; background: #474d57; border-radius: 50%; transform: translate(-50%, -2px); }

    .detail-row { display: flex; justify-content: space-between; margin-bottom: 4px; }
    .detail-row span:last-child { color: #fff; font-weight: 500; }

    /* Scrollbars */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #2b3139; border-radius: 10px; }

    .x-small { font-size: 0.65rem; }
    @media (max-width: 1400px) { .ticker-stats { display: none !important; } }
</style>

@push('scripts')
<script src="https://s3.tradingview.com/tv.js"></script>
<script>
let currentSettlementAsset = "{{ $quoteSymbol }}";
let currentBalance = {{ $settlementWallet->future_bal ?? 0 }};
let currentLeverage = {{ $defaultLeverage }};

function filterPairs(query) {
    query = query.toLowerCase();
    document.querySelectorAll('.pair-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
}

// Simulated Depth Data
function populateDepth() {
    const asks = document.getElementById('bookAsks');
    const bids = document.getElementById('bookBids');
    const basePrice = {{ $currentPair->last_price }};
    
    let asksHtml = '';
    for(let i=0; i<15; i++) {
        const price = basePrice + (Math.random() * 50);
        const amount = Math.random() * 2;
        const total = price * amount;
        asksHtml = `<div class="book-row ask">
            <span>${price.toFixed(4)}</span>
            <span>${amount.toFixed(4)}</span>
            <span>${total.toFixed(2)}</span>
            <div class="bg-overlay bg-danger" style="width: ${Math.random()*100}%"></div>
        </div>` + asksHtml;
    }
    asks.innerHTML = asksHtml;

    let bidsHtml = '';
    for(let i=0; i<15; i++) {
        const price = basePrice - (Math.random() * 50);
        const amount = Math.random() * 2;
        const total = price * amount;
        bidsHtml += `<div class="book-row bid">
            <span>${price.toFixed(4)}</span>
            <span>${amount.toFixed(4)}</span>
            <span>${total.toFixed(2)}</span>
            <div class="bg-overlay bg-success" style="width: ${Math.random()*100}%"></div>
        </div>`;
    }
    bids.innerHTML = bidsHtml;
}

function populateTrades() {
    const list = document.getElementById('recentTradesList');
    const basePrice = {{ $currentPair->last_price }};
    let html = '';
    for(let i=0; i<20; i++) {
        const side = Math.random() > 0.5 ? 'success' : 'danger';
        html += `<div class="trade-row">
            <span class="text-${side}">${(basePrice + (Math.random()-0.5)*10).toFixed(4)}</span>
            <span class="text-white">${(Math.random()*0.5).toFixed(4)}</span>
            <span class="text-muted">${new Date().toLocaleTimeString()}</span>
        </div>`;
    }
    list.innerHTML = html;
}

function setOrderType(type) {
    document.getElementById('futureOrderType').value = type;
    document.querySelectorAll('.order-tabs button').forEach(btn => {
        btn.classList.toggle('active', btn.textContent.trim().includes(type));
    });
    
    const priceInput = document.getElementById('futurePriceInput');
    if (type === 'Market') {
        priceInput.readOnly = true;
        priceInput.value = "{{ $currentPair->last_price }}";
        priceInput.parentElement.style.opacity = '0.5';
    } else {
        priceInput.readOnly = false;
        priceInput.parentElement.style.opacity = '1';
    }
}

function setLeverage(lev) {
    currentLeverage = lev;
    document.getElementById('leverageBtn').textContent = lev + 'X';
    document.getElementById('futureLeverageInput').value = lev;
    updateTradeDetails();
}

function setSettlementAsset(symbol, balance) {
    currentSettlementAsset = symbol;
    currentBalance = balance;
    document.getElementById('settlementAssetInput').value = symbol;
    document.getElementById('assetSelectBtn').innerHTML = symbol + ' <i class="mdi mdi-chevron-down ml-1"></i>';
    document.getElementById('availableBalanceDisplay').textContent = balance.toFixed(4) + ' ' + symbol;
    document.getElementById('assetAvailBal').textContent = balance.toFixed(4) + ' ' + symbol;
    handleSliderChange(document.getElementById('allocationSlider').value);
}

function handleSliderChange(percent) {
    if (currentBalance <= 0) {
        toastr.warning(`Insufficient ${currentSettlementAsset} balance in your Futures wallet.`);
        return;
    }
    const amount = (currentBalance * (percent / 100));
    document.getElementById('futureAmountInput').value = amount.toFixed(4);
    updateTradeDetails();
}

function updateTradeDetails() {
    const amount = Number(document.getElementById('futureAmountInput').value || 0);
    const cost = amount / currentLeverage;
    
    document.getElementById('detailSize').textContent = amount.toFixed(4) + ' ' + currentSettlementAsset;
    document.getElementById('detailCost').textContent = cost.toFixed(4) + ' ' + currentSettlementAsset;
}

document.getElementById('futureAmountInput').addEventListener('input', function() {
    updateTradeDetails();
    const percent = currentBalance > 0 ? (this.value / currentBalance) * 100 : 0;
    document.getElementById('allocationSlider').value = percent;
});

function openCloseModal(id) {
    const row = document.querySelector(`button[onclick="closePosition(${id})"]`).closest('tr');
    const symbol = row.cells[0].innerText;
    const size = row.cells[1].innerText;
    const entry = row.cells[2].innerText;
    const pnl = row.cells[7].innerText.split('(')[0];
    const roi = row.cells[7].innerText.split('(')[1]?.replace(')', '') || '0.00%';

    document.getElementById('mgmtModalTitle').innerText = 'Close Position';
    document.getElementById('mgmtSymbol').innerText = symbol;
    document.getElementById('mgmtSize').innerText = size;
    document.getElementById('mgmtEntryPrice').innerText = entry;
    document.getElementById('mgmtPnl').innerText = pnl;
    document.getElementById('mgmtPnl').className = `h3 font-weight-bold mb-0 ${pnl.includes('-') ? 'text-danger' : 'text-success'}`;
    document.getElementById('mgmtRoi').innerText = roi;
    document.getElementById('mgmtRoi').className = `badge x-small mt-1 ${roi.includes('-') ? 'badge-soft-danger' : 'badge-soft-success'}`;
    document.getElementById('mgmtCompletion').innerText = 'Auto-Settled via Liquidation Engine';
    document.getElementById('confirmTradeBtn').innerText = 'Confirm Closure';
    document.getElementById('confirmTradeBtn').className = 'btn btn-danger px-4 font-weight-bold x-small';
    
    window.currentMgmtTrade = id;
    window.currentMgmtType = 'close';
    $('#tradeManagementModal').modal('show');
}

function openCancelModal(id) {
    const row = document.querySelector(`button[onclick="cancelOrder(${id})"]`).closest('tr');
    const symbol = row.cells[1].innerText;
    const size = row.cells[5].innerText;
    const price = row.cells[4].innerText;

    document.getElementById('mgmtModalTitle').innerText = 'Cancel Pending Order';
    document.getElementById('mgmtSymbol').innerText = symbol;
    document.getElementById('mgmtSize').innerText = size;
    document.getElementById('mgmtEntryPrice').innerText = price;
    document.getElementById('mgmtPnl').innerText = 'N/A';
    document.getElementById('mgmtPnl').className = 'h3 font-weight-bold mb-0 text-muted';
    document.getElementById('mgmtRoi').innerText = '0.00%';
    document.getElementById('mgmtRoi').className = 'badge badge-soft-secondary x-small mt-1';
    document.getElementById('mgmtCompletion').innerText = 'Manual/Auto Cancellation';
    document.getElementById('confirmTradeBtn').innerText = 'Confirm Cancellation';
    document.getElementById('confirmTradeBtn').className = 'btn btn-warning px-4 font-weight-bold x-small text-dark';

    window.currentMgmtTrade = id;
    window.currentMgmtType = 'cancel';
    $('#tradeManagementModal').modal('show');
}

// Map the old names to the new ones for compatibility with existing rows
window.closePosition = openCloseModal;
window.cancelOrder = openCancelModal;

function executeTradeManagement() {
    const btn = document.getElementById('confirmTradeBtn');
    const originalText = btn.innerText;
    btn.innerText = 'Processing...';
    btn.disabled = true;

    const url = window.currentMgmtType === 'close' 
        ? "{{ route('trade.close', '') }}/" + window.currentMgmtTrade 
        : "{{ route('trade.cancel', '') }}/" + window.currentMgmtTrade;

    $.ajax({
        url: url,
        method: 'GET',
        success: function(resp) {
            if(resp.status == 200) {
                toastr.success(resp.message);
                $('#tradeManagementModal').modal('hide');
                setTimeout(() => location.reload(), 1000);
            } else {
                toastr.error(resp.message);
                btn.innerText = originalText;
                btn.disabled = false;
            }
        },
        error: function() {
            toastr.error('An error occurred. Please try again.');
            btn.innerText = originalText;
            btn.disabled = false;
        }
    });
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
            "container_id": "tradingview_futures_widget",
            "studies": [
                "MASimple@tv-basicstudies",
                "RSI@tv-basicstudies"
            ],
        });
    }

    $('.ajax-trade-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtns = form.find('button[type="submit"]');
        submitBtns.prop('disabled', true);
        
        $.post(form.attr('action'), form.serialize())
            .done(function(response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                    setTimeout(() => window.location.reload(), 800);
                } else {
                    toastr.error(response.message);
                    submitBtns.prop('disabled', false);
                }
            })
            .fail(function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Trade failed.');
                submitBtns.prop('disabled', false);
            });
    });
});
</script>

<!-- Trade Management Modal (FTX Style) -->
<div class="modal fade" id="tradeManagementModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark border-secondary text-white">
            <div class="modal-header border-bottom border-secondary py-2">
                <h6 class="modal-title font-weight-bold text-uppercase x-small" id="mgmtModalTitle">Close Position</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="trade-stats-box mb-4 p-3 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Instrument</span>
                        <span class="text-white font-weight-bold" id="mgmtSymbol">--</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Size</span>
                        <span class="text-white" id="mgmtSize">--</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Price</span>
                        <span class="text-white" id="mgmtEntryPrice">--</span>
                    </div>
                </div>

                <div class="pnl-estimate-box text-center mb-4">
                    <label class="text-muted x-small text-uppercase font-weight-bold mb-1 d-block">Estimated Realized P&L</label>
                    <h2 class="h3 font-weight-bold mb-0" id="mgmtPnl">--</h2>
                    <span class="badge badge-soft-success x-small mt-1" id="mgmtRoi">+0.00%</span>
                </div>

                <div class="settlement-info p-3 border border-secondary rounded mb-4" style="background: rgba(27, 209, 199, 0.05);">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle mr-3 p-2 rounded-circle" style="background: rgba(27, 209, 199, 0.1);">
                            <i class="mdi mdi-shield-check-outline text-info"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 small font-weight-bold">Settlement Method</h6>
                            <p class="mb-0 x-small text-muted" id="mgmtCompletion">Auto-Settled via Liquidation Engine</p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-soft-warning x-small mb-0 border-0" style="background: rgba(255, 193, 7, 0.05); color: #ffc107;">
                    <i class="mdi mdi-information-outline mr-1"></i>
                    Closing this position will instantly realize all gains/losses and return margin to your settlement wallet.
                </div>
            </div>
            <div class="modal-footer border-top border-secondary py-2">
                <button type="button" class="btn btn-link text-muted x-small" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4 font-weight-bold x-small" id="confirmTradeBtn" onclick="executeTradeManagement()">Confirm Closure</button>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-soft-secondary { background: rgba(132, 142, 156, 0.1); color: #848e9c; }
    .alert-soft-warning { border-radius: 4px; }
    .modal-content { box-shadow: 0 15px 50px rgba(0,0,0,0.6); }
</style>
@endpush
@endsection
