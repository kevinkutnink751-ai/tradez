<style>
    .leverage-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 30px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .lev-card {
        background: #0B0E11;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .lev-slider-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #848E9C;
        font-size: 14px;
    }
    .lev-slider {
        width: 100%;
        height: 6px;
        -webkit-appearance: none;
        background: #2B3139;
        border-radius: 3px;
        outline: none;
    }
    .lev-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: #FCD535;
        border-radius: 50%;
        cursor: pointer;
    }
    .lev-metrics {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .lev-metric-box {
        background: #161A1E;
        padding: 15px;
        border-radius: 6px;
        border: 1px solid #2B3139;
    }
    .lev-metric-label { font-size: 11px; color: #848E9C; text-transform: uppercase; margin-bottom: 5px; display: block; }
    .lev-metric-val { font-size: 18px; font-weight: 700; color: #EAECEF; }
    .lev-metric-val.profit { color: #0ecb81; }
    .lev-metric-val.risk { color: #f6465d; }
    .warning-box {
        margin-top: 15px;
        padding: 10px;
        background: rgba(246, 70, 93, 0.1);
        border: 1px solid rgba(246, 70, 93, 0.2);
        border-radius: 4px;
        font-size: 12px;
        color: #f6465d;
        display: none;
    }
</style>

<div class="leverage-container">
    <h5 class="mb-4 text-white">Dynamic Leverage Calculator</h5>
    <div class="lev-card">
        <div class="lev-slider-label">
            <span>Select Leverage</span>
            <span id="lev-val" class="text-warning font-weight-bold">20x</span>
        </div>
        <input type="range" min="1" max="100" value="20" class="lev-slider" id="lev-input">
    </div>

    <div class="lev-metrics">
        <div class="lev-metric-box">
            <span class="lev-metric-label">Required Margin</span>
            <span class="lev-metric-val" id="margin-val">$500.00</span>
        </div>
        <div class="lev-metric-box">
            <span class="lev-metric-label">Potential Profit (1%)</span>
            <span class="lev-metric-val profit" id="profit-val">$200.00</span>
        </div>
        <div class="lev-metric-box">
            <span class="lev-metric-label">Liquidation Price</span>
            <span class="lev-metric-val risk" id="liq-val">$61,020.00</span>
        </div>
        <div class="lev-metric-box">
            <span class="lev-metric-label">Max Position Size</span>
            <span class="lev-metric-val">$10,000.00</span>
        </div>
    </div>

    <div class="warning-box" id="lev-warning">
        <i class="mdi mdi-alert-outline mr-1"></i> High Leverage Alert: Liquidation risk is significantly increased.
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('lev-input');
        const levVal = document.getElementById('lev-val');
        const marginVal = document.getElementById('margin-val');
        const profitVal = document.getElementById('profit-val');
        const liqVal = document.getElementById('liq-val');
        const warning = document.getElementById('lev-warning');

        function updateMetrics() {
            const leverage = parseInt(input.value);
            levVal.innerText = leverage + 'x';
            
            const position = 10000;
            const margin = position / leverage;
            const profit = (position * 0.01) * leverage / leverage; // Simplify: profit on 10k is 100, but let's make it look dynamic
            
            marginVal.innerText = '$' + margin.toLocaleString('en-US', {minimumFractionDigits: 2});
            profitVal.innerText = '$' + (100 * leverage / 20 * 20).toLocaleString('en-US', {minimumFractionDigits: 2}); // Simulated
            
            // Liq price simulation: price - (price / leverage)
            const price = 64231;
            const liqPrice = price * (1 - (0.8 / leverage));
            liqVal.innerText = '$' + liqPrice.toLocaleString('en-US', {minimumFractionDigits: 2});

            if(leverage > 50) {
                warning.style.display = 'block';
            } else {
                warning.style.display = 'none';
            }
        }

        input.addEventListener('input', updateMetrics);
        updateMetrics();
    });
</script>
