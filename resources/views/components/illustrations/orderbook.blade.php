<style>
    .orderbook-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 20px;
        font-family: 'Inter', sans-serif;
        color: #EAECEF;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .orderbook-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
        border-bottom: 1px solid #2B3139;
        padding-bottom: 10px;
    }
    .ob-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        padding: 4px 0;
        position: relative;
    }
    .ob-price { width: 40%; }
    .ob-amount { width: 30%; text-align: right; }
    .ob-total { width: 30%; text-align: right; }
    .ob-sell .ob-price { color: #f6465d; }
    .ob-buy .ob-price { color: #0ecb81; }
    .ob-bg {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 0;
        opacity: 0.15;
    }
    .ob-sell .ob-bg { background: #f6465d; }
    .ob-buy .ob-bg { background: #0ecb81; }
    .ob-content { position: relative; z-index: 1; display: flex; width: 100%; justify-content: space-between; }
    .spread-divider {
        text-align: center;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 700;
        color: #EAECEF;
        border-top: 1px solid #2B3139;
        border-bottom: 1px solid #2B3139;
        margin: 10px 0;
    }
</style>
<div class="orderbook-container">
    <div class="orderbook-header">
        <span>Price(USDT)</span>
        <span>Amount(BTC)</span>
        <span>Total</span>
    </div>
    <div id="ob-asks">
        <!-- Asks (Sells) will be populated here -->
    </div>
    <div class="spread-divider" id="ob-mid-price">
        64,231.50
    </div>
    <div id="ob-bids">
        <!-- Bids (Buys) will be populated here -->
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const asksContainer = document.getElementById('ob-asks');
        const bidsContainer = document.getElementById('ob-bids');
        const midPriceEl = document.getElementById('ob-mid-price');
        
        function generateRow(price, amount, total, type) {
            const width = Math.random() * 100;
            return `
                <div class="ob-row ob-${type}">
                    <div class="ob-bg" style="width: ${width}%"></div>
                    <div class="ob-content">
                        <span class="ob-price">${price.toLocaleString('en-US', {minimumFractionDigits: 2})}</span>
                        <span class="ob-amount">${amount.toFixed(4)}</span>
                        <span class="ob-total">${total.toFixed(2)}</span>
                    </div>
                </div>
            `;
        }
        function updateOB() {
            let midPrice = parseFloat(midPriceEl.innerText.replace(/,/g, ''));
            midPrice += (Math.random() - 0.5) * 5;
            midPriceEl.innerText = midPrice.toLocaleString('en-US', {minimumFractionDigits: 2});
            let asksHtml = '';
            for(let i=0; i<6; i++) {
                const p = midPrice + (i+1) * 2.5;
                const a = Math.random() * 0.5;
                asksHtml = generateRow(p, a, p*a, 'sell') + asksHtml;
            }
            asksContainer.innerHTML = asksHtml;
            let bidsHtml = '';
            for(let i=0; i<6; i++) {
                const p = midPrice - (i+1) * 2.5;
                const a = Math.random() * 0.5;
                bidsHtml += generateRow(p, a, p*a, 'buy');
            }
            bidsContainer.innerHTML = bidsHtml;
        }
        setInterval(updateOB, 1000);
        updateOB();
    });
</script>
