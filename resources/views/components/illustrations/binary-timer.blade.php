<style>
    .binary-prediction-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 25px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        text-align: center;
    }
    .timer-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #2B3139;
        border-top-color: #FCD535;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 28px;
        font-weight: 700;
        color: #EAECEF;
        animation: spin 60s linear infinite;
    }
    @keyframes spin { 100% { transform: rotate(360deg); } }
    .timer-val { animation: none; transform: rotate(0); }
    
    .binary-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }
    .binary-btn {
        flex: 1;
        padding: 15px;
        border-radius: 6px;
        border: none;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .binary-btn:active { transform: scale(0.95); }
    .btn-high { background: #0ecb81; }
    .btn-low { background: #f6465d; }
    
    .prediction-chart {
        height: 100px;
        background: #0B0E11;
        border-radius: 4px;
        margin: 20px 0;
        position: relative;
        overflow: hidden;
    }
    .strike-line {
        position: absolute;
        width: 100%;
        height: 1px;
        background: #FCD535;
        top: 50%;
        left: 0;
        z-index: 2;
        border-top: 1px dashed #FCD535;
    }
    .price-dot {
        position: absolute;
        width: 8px;
        height: 8px;
        background: #FCD535;
        border-radius: 50%;
        right: 10px;
        top: 48%;
        box-shadow: 0 0 10px #FCD535;
    }
</style>
<div class="binary-prediction-container">
    <h6 class="text-white mb-4">Real-Time Prediction Room</h6>
    
    <div class="timer-circle">
        <span class="timer-val" id="binary-timer">00:45</span>
    </div>
    <div class="prediction-chart">
        <div class="strike-line"></div>
        <div class="price-dot" id="price-dot"></div>
        <svg style="width: 100%; height: 100%;" preserveAspectRatio="none" viewBox="0 0 100 100">
            <polyline id="price-path" points="0,50 10,55 20,45 30,50 40,60 50,40 60,45 70,35 80,50 90,48" 
                fill="none" stroke="rgba(252,213,53,0.3)" stroke-width="2" />
        </svg>
    </div>
    <div class="binary-actions">
        <button class="binary-btn btn-high">
            <i class="mdi mdi-arrow-up-bold mr-1"></i> HIGH
        </button>
        <button class="binary-btn btn-low">
            <i class="mdi mdi-arrow-down-bold mr-1"></i> LOW
        </button>
    </div>
    
    <div class="mt-3 text-muted small">
        Estimated Payout: <span class="text-success font-weight-bold">88%</span>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timerEl = document.getElementById('binary-timer');
        const dot = document.getElementById('price-dot');
        let seconds = 45;
        setInterval(() => {
            seconds--;
            if(seconds < 0) seconds = 59;
            const s = seconds < 10 ? '0' + seconds : seconds;
            timerEl.innerText = '00:' + s;
            // Animate price dot
            const top = 50 + (Math.random() - 0.5) * 40;
            dot.style.top = top + '%';
        }, 1000);
    });
</script>
