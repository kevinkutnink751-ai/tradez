<style>
    .trading-terminal {
        background-color: #0b0e11;
        border: 1px solid #2B3139;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        display: flex;
        flex-direction: column;
        user-select: none;
    }
    
    .terminal-top-bar {
        background-color: #161A1E;
        border-bottom: 1px solid #2B3139;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .terminal-pair-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .terminal-pair-name {
        font-weight: 700;
        font-size: 18px;
        color: #EAECEF;
    }
    .terminal-price-up {
        color: #0ecb81;
        font-weight: 600;
        font-size: 16px;
    }
    .terminal-stats {
        display: flex;
        gap: 24px;
        font-size: 12px;
    }
    .stat-item {
        display: flex;
        flex-direction: column;
    }
    .stat-label { color: #848E9C; margin-bottom: 2px; }
    .stat-val { color: #EAECEF; font-weight: 500; }
    .stat-val.up { color: #0ecb81; }
    .stat-val.down { color: #f6465d; }
    .terminal-body {
        display: flex;
        height: 300px;
    }
    .terminal-chart-area {
        flex: 1;
        border-right: 1px solid #2B3139;
        position: relative;
        padding: 16px;
        background: radial-gradient(circle at center, #161a1e 0%, #0b0e11 100%);
    }
    .chart-placeholder {
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        padding-bottom: 20px;
    }
    .candle {
        width: 12px;
        border-radius: 2px;
        position: relative;
        animation: pulseCandle 2s infinite alternate;
    }
    .candle::before {
        content: '';
        position: absolute;
        width: 2px;
        height: 140%;
        left: 5px;
        top: -20%;
        background: inherit;
        opacity: 0.5;
        z-index: 0;
    }
    .candle-up { background-color: #0ecb81; }
    .candle-down { background-color: #f6465d; }
    @keyframes pulseCandle {
        0% { transform: scaleY(0.95); opacity: 0.8; }
        100% { transform: scaleY(1.05); opacity: 1; }
    }
    .terminal-order-panel {
        width: 280px;
        background-color: #161A1E;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .order-tabs {
        display: flex;
        gap: 2px;
        background: #0B0E11;
        padding: 4px;
        border-radius: 4px;
    }
    .order-tab {
        flex: 1;
        text-align: center;
        padding: 6px 0;
        font-size: 13px;
        color: #848E9C;
        cursor: pointer;
        border-radius: 4px;
        font-weight: 600;
    }
    .order-tab.active { background: #2B3139; color: #EAECEF; }
    .input-group-terminal {
        background: #0B0E11;
        border: 1px solid #2B3139;
        border-radius: 4px;
        display: flex;
        align-items: center;
        padding: 8px 12px;
        font-size: 13px;
    }
    .input-group-terminal span.label { color: #848E9C; width: 50px; }
    .input-group-terminal input { 
        background: transparent; 
        border: none; 
        color: #EAECEF; 
        flex: 1; 
        text-align: right; 
        outline: none;
        font-weight: 600;
    }
    .input-group-terminal span.unit { color: #EAECEF; margin-left: 8px; }
    .terminal-btn-group {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }
    .terminal-btn {
        flex: 1;
        padding: 12px 0;
        border: none;
        border-radius: 4px;
        font-weight: 700;
        font-size: 14px;
        color: #fff;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .terminal-btn:hover { opacity: 0.9; }
    .btn-buy { background-color: #0ecb81; }
    .btn-sell { background-color: #f6465d; }
    .terminal-bottom {
        background-color: #161A1E;
        border-top: 1px solid #2B3139;
        padding: 12px 16px;
        font-size: 12px;
    }
    .terminal-bottom table {
        width: 100%;
        color: #848E9C;
        border-collapse: collapse;
    }
    .terminal-bottom th { text-align: left; font-weight: 500; padding-bottom: 8px; }
    .terminal-bottom td { color: #EAECEF; padding: 4px 0; }
    
    /* Dynamic heights for chart illustration */
    .c1 { height: 40%; } .c2 { height: 50%; } .c3 { height: 35%; }
    .c4 { height: 45%; } .c5 { height: 60%; } .c6 { height: 55%; }
    .c7 { height: 70%; } .c8 { height: 65%; } .c9 { height: 80%; }
    .c10 { height: 75%; } .c11 { height: 85%; } .c12 { height: 60%; }
    @media (max-width: 992px) {
        .terminal-stats { display: none; }
        .terminal-order-panel { display: none; }
    }
</style>
<div class="trading-terminal">
    <!-- Top Bar -->
    <div class="terminal-top-bar">
        <div class="terminal-pair-info">
            <span class="terminal-pair-name">{{ $pair ?? 'BTC/USDT' }}</span>
            <span class="terminal-price-up" id="live-price">{{ $price ?? '64,231.50' }}</span>
        </div>
        <div class="terminal-stats">
            <div class="stat-item">
                <span class="stat-label">24h Change</span>
                <span class="stat-val up">+2.45%</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">24h High</span>
                <span class="stat-val">{{ $high ?? '65,120.00' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">24h Low</span>
                <span class="stat-val">{{ $low ?? '62,890.00' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">24h Vol</span>
                <span class="stat-val">{{ $vol ?? '1.2B' }}</span>
            </div>
        </div>
    </div>
    <!-- Main Body -->
    <div class="terminal-body">
        <div class="terminal-chart-area">
            <div class="chart-placeholder">
                <div class="candle candle-down c1"></div>
                <div class="candle candle-up c2"></div>
                <div class="candle candle-down c3"></div>
                <div class="candle candle-up c4"></div>
                <div class="candle candle-up c5"></div>
                <div class="candle candle-down c6"></div>
                <div class="candle candle-up c7"></div>
                <div class="candle candle-down c8"></div>
                <div class="candle candle-up c9"></div>
                <div class="candle candle-down c10"></div>
                <div class="candle candle-up c11"></div>
                <div class="candle candle-down c12"></div>
            </div>
            <div style="position: absolute; top: 16px; left: 16px; display: flex; gap: 8px;">
                <span class="badge" style="background: rgba(43,49,57,0.5); color: #848E9C;">1m</span>
                <span class="badge" style="background: rgba(43,49,57,0.5); color: #848E9C;">5m</span>
                <span class="badge" style="background: rgba(43,49,57,0.5); color: #848E9C;">15m</span>
                <span class="badge" style="background: #2B3139; color: #EAECEF;">1H</span>
                <span class="badge" style="background: rgba(43,49,57,0.5); color: #848E9C;">1D</span>
            </div>
        </div>
        <div class="terminal-order-panel">
            <div class="order-tabs">
                <div class="order-tab active">Limit</div>
                <div class="order-tab">Market</div>
                <div class="order-tab">Stop</div>
            </div>
            <div class="input-group-terminal mt-3">
                <span class="label">Price</span>
                <input type="text" value="{{ $price ?? '64,231.50' }}" readonly>
                <span class="unit">USDT</span>
            </div>
            <div class="input-group-terminal">
                <span class="label">Amount</span>
                <input type="text" value="0.5" readonly>
                <span class="unit">{{ explode('/', $pair ?? 'BTC/USDT')[0] }}</span>
            </div>
            <div style="margin: 10px 0;">
                <div style="height: 4px; background: #2B3139; border-radius: 2px; position: relative;">
                    <div style="position: absolute; left: 25%; top: -4px; width: 12px; height: 12px; background: #EAECEF; border-radius: 50%;"></div>
                </div>
                <div style="display: flex; justify-content: space-between; color: #848E9C; font-size: 10px; margin-top: 6px;">
                    <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                </div>
            </div>
            <div class="input-group-terminal mb-3">
                <span class="label">Total</span>
                <input type="text" value="{{ (floatval(str_replace(',', '', $price ?? '64231.50')) * 0.5) }}" readonly>
                <span class="unit">USDT</span>
            </div>
            <div class="terminal-btn-group">
                <button class="terminal-btn btn-buy">Buy {{ explode('/', $pair ?? 'BTC/USDT')[0] }}</button>
                <button class="terminal-btn btn-sell">Sell {{ explode('/', $pair ?? 'BTC/USDT')[0] }}</button>
            </div>
        </div>
    </div>
    <!-- Bottom Area -->
    <div class="terminal-bottom">
        <div style="display: flex; gap: 20px; margin-bottom: 12px; border-bottom: 1px solid #2B3139; padding-bottom: 8px;">
            <span style="color: #EAECEF; font-weight: 500;">Open Orders (0)</span>
            <span style="color: #848E9C;">Positions (1)</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Size</th>
                    <th>Entry Price</th>
                    <th>Mark Price</th>
                    <th>PNL (ROE%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span style="color: #0ecb81; font-weight: 600; margin-right: 4px;">L</span> {{ $pair ?? 'BTC/USDT' }}</td>
                    <td>0.25</td>
                    <td>{{ number_format(floatval(str_replace(',', '', $price ?? '64231.50')) - 500, 2) }}</td>
                    <td>{{ $price ?? '64,231.50' }}</td>
                    <td style="color: #0ecb81;">+125.00 (+14.2%)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    // Simulate live price ticks
    document.addEventListener('DOMContentLoaded', function() {
        const priceEl = document.getElementById('live-price');
        if(!priceEl) return;
        
        let basePrice = parseFloat(priceEl.innerText.replace(/,/g, ''));
        setInterval(() => {
            const change = (Math.random() - 0.5) * (basePrice * 0.001); // 0.1% volatility
            basePrice += change;
            
            priceEl.innerText = basePrice.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            
            if(change > 0) {
                priceEl.style.color = '#0ecb81';
            } else {
                priceEl.style.color = '#f6465d';
            }
        }, 1500);
    });
</script>