@extends('layouts.dash')
@section('title', $title)
@section('content')
    <div class="options-trading-container p-4">
        {{-- Trading Header --}}
        <div class="trading-header px-3 py-2 border-bottom d-flex align-items-center justify-content-between mb-4" style="background: #11151d; border-radius: 4px;">
            <div class="d-flex align-items-center">
                <div class="dropdown mr-4">
                    <button class="btn btn-dark-input dropdown-toggle font-weight-bold text-white px-3" type="button" data-toggle="dropdown">
                        <i class="fas fa-chart-area mr-2 text-info"></i> {{ $currentPair->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark shadow-lg">
                        @foreach($pairs as $pair)
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('options.trade', ['pair' => $pair->name]) }}">
                            <span>{{ $pair->name }}</span>
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
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-right mr-3">
                    <small class="text-muted d-block small-label">Account Balance</small>
                    <span class="text-white font-weight-bold">{{ number_format(Auth::user()->account_bal, 2) }} USDT</span>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Chart Section --}}
            <div class="col-lg-8 pr-lg-1">
                <div class="trading-panel shadow-sm">
                    <div class="chart-container" style="height: 500px;">
                        <div id="tradingview_options" style="height: 100%;"></div>
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
                            "allow_symbol_change": true,
                            "container_id": "tradingview_options"
                        });
                        </script>
                    </div>
                </div>
            </div>

            {{-- Trading Section --}}
            <div class="col-lg-4 pl-lg-1">
                <div class="trading-panel p-4 shadow-sm h-100">
                    <h5 class="text-white font-weight-bold mb-4">Execute Trade</h5>
                    
                    <form id="optionsTradeForm">
                        @csrf
                        <input type="hidden" name="pair" value="{{ $currentPair->name }}">
                        <input type="hidden" name="type" id="option_type" value="Call">
                        <input type="hidden" name="price" value="{{ $currentPair->last_price }}">

                        <div class="trading-modes mb-4">
                            <ul class="nav nav-pills nav-fill bg-dark-input p-1 rounded">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active py-2 border-0 bg-transparent text-white btn-opt-type" data-type="Call">Call</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link py-2 border-0 bg-transparent text-white-50 btn-opt-type" data-type="Put">Put</button>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small-label">Investment Amount (USDT)</label>
                            <div class="input-group">
                                <input type="number" name="amount" class="form-control bg-dark-input border-0 text-white py-4" placeholder="0.00" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-dark-input border-0 text-muted">USDT</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small-label">Expiration Time</label>
                            <select name="expiry" class="form-control bg-dark-input border-0 text-white custom-select-dark">
                                <option value="1m">1 Minute</option>
                                <option value="5m">5 Minutes</option>
                                <option value="15m">15 Minutes</option>
                                <option value="1h">1 Hour</option>
                                <option value="1d">1 Day</option>
                            </select>
                        </div>

                        <div class="profit-preview p-3 mb-4 rounded" style="background: rgba(21, 114, 232, 0.05); border: 1px dashed rgba(21, 114, 232, 0.2);">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Expected Profit</span>
                                <span class="text-success font-weight-bold">+85%</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Payout</span>
                                <span class="text-white font-weight-bold">0.00 USDT</span>
                            </div>
                        </div>

                        <button type="submit" id="optSubmitBtn" class="btn btn-primary btn-block py-3 font-weight-bold shadow-lg mb-3">PLACE CALL ORDER</button>
                    </form>
                    <small class="text-muted text-center d-block">By clicking, you agree to the trading terms and conditions.</small>
                </div>
            </div>
        </div>

        {{-- Bottom History Section --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="trading-panel p-4 shadow-sm">
                    <h6 class="text-white font-weight-bold mb-4">Recent Options History</h6>
                    <div class="table-responsive">
                        <table class="table table-dark-custom">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Strike Price</th>
                                    <th>Result</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No recent history found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .options-trading-container { background: #090c10; min-height: 100vh; }
        .trading-panel { background: #11151d; border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.05); }
        .bg-dark-input { background: #090c10 !important; }
        .small-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 8px; display: block; }
        .custom-select-dark { height: 50px; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px; }
        .nav-pills .nav-link { font-weight: 600; font-size: 0.9rem; color: rgba(255,255,255,0.4); border-radius: 2px; }
        .nav-pills .nav-link.active { background: #1572e8; color: #fff; }
        .table-dark-custom { color: rgba(255,255,255,0.7); }
        .table-dark-custom th { border: 0; color: rgba(255,255,255,0.3); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
        .table-dark-custom td { border-top: 1px solid rgba(255,255,255,0.05); vertical-align: middle; padding: 1rem 0.75rem; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeBtns = document.querySelectorAll('.btn-opt-type');
            const typeInput = document.getElementById('option_type');
            const submitBtn = document.getElementById('optSubmitBtn');
            const form = document.getElementById('optionsTradeForm');

            typeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    typeBtns.forEach(b => {
                        b.classList.remove('active', 'text-white');
                        b.classList.add('text-white-50');
                    });
                    this.classList.add('active', 'text-white');
                    this.classList.remove('text-white-50');
                    const type = this.dataset.type;
                    typeInput.value = type;
                    submitBtn.innerText = 'PLACE ' + type.toUpperCase() + ' ORDER';
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                const originalText = submitBtn.innerText;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

                const formData = new FormData(this);
                fetch("{{ route('options.trade.store') }}", {
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
                        submitBtn.disabled = false;
                        submitBtn.innerText = originalText;
                    }
                })
                .catch(error => {
                    $.notify({ icon: 'fas fa-exclamation-circle', message: "Error processing trade." }, { type: 'danger', placement: { from: "top", align: "right" } });
                    submitBtn.disabled = false;
                    submitBtn.innerText = originalText;
                });
            });
        });
    </script>
@endsection
