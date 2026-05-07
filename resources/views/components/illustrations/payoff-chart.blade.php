<style>
    .payoff-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 25px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .chart-area {
        height: 200px;
        width: 100%;
        border-left: 2px solid #2B3139;
        border-bottom: 2px solid #2B3139;
        position: relative;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .zero-line {
        position: absolute;
        width: 100%;
        height: 1px;
        background: rgba(255,255,255,0.1);
        top: 50%;
        left: 0;
    }
    .payoff-line {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }
    .strategy-select {
        background: #0B0E11;
        border: 1px solid #2B3139;
        color: #EAECEF;
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .payoff-info {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #848E9C;
    }
    .payoff-val { color: #EAECEF; font-weight: 600; }
</style>
<div class="payoff-container">
    <h6 class="text-white mb-3">Options Payoff Visualizer</h6>
    <select class="strategy-select" id="strategy-sel">
        <option value="call">Long Call</option>
        <option value="put">Long Put</option>
        <option value="straddle">Straddle</option>
        <option value="bull-spread">Bull Call Spread</option>
    </select>
    <div class="chart-area">
        <div class="zero-line"></div>
        <svg class="payoff-line" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path id="payoff-path" d="M 0 80 L 50 80 L 100 20" fill="none" stroke="#2980b9" stroke-width="2" />
            <rect id="profit-zone" x="50" y="0" width="50" height="50" fill="rgba(14, 203, 129, 0.1)" />
        </svg>
    </div>
    <div class="payoff-info">
        <div>
            <span>Max Profit:</span>
            <span class="payoff-val" id="max-p">Unlimited</span>
        </div>
        <div>
            <span>Max Loss:</span>
            <span class="payoff-val" id="max-l">-$250.00</span>
        </div>
        <div>
            <span>Breakeven:</span>
            <span class="payoff-val" id="be-p">$64,500</span>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sel = document.getElementById('strategy-sel');
        const path = document.getElementById('payoff-path');
        const profitZone = document.getElementById('profit-zone');
        const maxP = document.getElementById('max-p');
        const maxL = document.getElementById('max-l');
        const beP = document.getElementById('be-p');
        const strategies = {
            'call': {
                path: "M 0 80 L 50 80 L 100 20",
                zone: { x: 66, y: 0, w: 34, h: 50 },
                maxP: "Unlimited", maxL: "-$250.00", beP: "$64,500"
            },
            'put': {
                path: "M 0 20 L 50 80 L 100 80",
                zone: { x: 0, y: 0, w: 34, h: 50 },
                maxP: "Unlimited", maxL: "-$310.00", beP: "$63,800"
            },
            'straddle': {
                path: "M 0 20 L 50 80 L 100 20",
                zone: { x: 0, y: 0, w: 100, h: 100 }, // Over simplified
                maxP: "Unlimited", maxL: "-$560.00", beP: "$63,200 / $65,800"
            },
            'bull-spread': {
                path: "M 0 80 L 30 80 L 70 20 L 100 20",
                zone: { x: 50, y: 0, w: 50, h: 50 },
                maxP: "$450.00", maxL: "-$150.00", beP: "$64,350"
            }
        };
        sel.addEventListener('change', () => {
            const s = strategies[sel.value];
            path.setAttribute('d', s.path);
            profitZone.setAttribute('x', s.zone.x);
            maxP.innerText = s.maxP;
            maxL.innerText = s.maxL;
            beP.innerText = s.beP;
        });
    });
</script>