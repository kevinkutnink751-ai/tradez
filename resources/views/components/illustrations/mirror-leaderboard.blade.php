<style>
    .leaderboard-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 20px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .lb-header { display: flex; color: #848E9C; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #2B3139; padding-bottom: 10px; margin-bottom: 10px; }
    .lb-row { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px dashed rgba(43,49,57,0.5); transition: background 0.3s; position: relative; overflow: hidden; }
    .lb-row:hover { background: #0B0E11; }
    .lb-rank { width: 10%; font-weight: 700; color: #EAECEF; text-align: center; }
    .lb-trader { width: 40%; display: flex; align-items: center; gap: 10px; }
    .lb-avatar { width: 24px; height: 24px; border-radius: 50%; background: #2B3139; display: flex; align-items: center; justify-content: center; font-size: 10px; color: white; }
    .lb-name { color: #EAECEF; font-size: 13px; font-weight: 600; }
    .lb-roi { width: 25%; color: #0ecb81; font-weight: 700; font-size: 14px; text-align: right; }
    .lb-action { width: 25%; text-align: right; }
    .btn-copy { background: #FCD535; color: #000; border: none; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 700; cursor: pointer; transition: transform 0.1s; }
    .btn-copy:active { transform: scale(0.95); }
    
    /* Animation class */
    .lb-pulse { animation: lbPulse 1s ease-out; }
    @keyframes lbPulse {
        0% { background: rgba(14,203,129,0.2); }
        100% { background: transparent; }
    }
</style>

<div class="leaderboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="text-white mb-0">Live Master Leaderboard</h6>
        <span class="badge badge-success" style="font-size: 10px;"><span class="spinner-grow spinner-grow-sm text-white" style="width: 8px; height: 8px;"></span> Live Sync</span>
    </div>
    
    <div class="lb-header">
        <div style="width: 10%; text-align: center;">Rank</div>
        <div style="width: 40%;">Master Trader</div>
        <div style="width: 25%; text-align: right;">30D ROI</div>
        <div style="width: 25%; text-align: right;">Action</div>
    </div>
    
    <div id="lb-list">
        <!-- Rows injected via JS -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const list = document.getElementById('lb-list');
        const traders = [
            { name: 'Apex_Quant', roi: 45.2, color: '#e74c3c' },
            { name: 'FX_Sniper', roi: 38.7, color: '#3498db' },
            { name: 'MacroTrend', roi: 31.4, color: '#9b59b6' },
            { name: 'Gold_Bug_99', roi: 28.1, color: '#f1c40f' },
            { name: 'AlgoFlow_Capital', roi: 22.5, color: '#2ecc71' }
        ];

        function renderRows() {
            let html = '';
            traders.forEach((t, i) => {
                html += `
                    <div class="lb-row" id="trader-${i}">
                        <div class="lb-rank">#${i+1}</div>
                        <div class="lb-trader">
                            <div class="lb-avatar" style="background: ${t.color}">${t.name.charAt(0)}</div>
                            <span class="lb-name">${t.name}</span>
                        </div>
                        <div class="lb-roi">+${t.roi.toFixed(2)}%</div>
                        <div class="lb-action"><button class="btn-copy">Copy</button></div>
                    </div>
                `;
            });
            list.innerHTML = html;
        }
        
        renderRows();

        // Simulate live ROI updates
        setInterval(() => {
            const idx = Math.floor(Math.random() * traders.length);
            const bump = Math.random() * 0.5;
            traders[idx].roi += bump;
            
            // Re-sort
            traders.sort((a,b) => b.roi - a.roi);
            renderRows();
            
            // Find new index of the bumped trader and animate
            const newIdx = traders.findIndex(t => t.name === traders[idx].name);
            const row = document.getElementById('trader-' + newIdx);
            if(row) {
                row.classList.remove('lb-pulse');
                void row.offsetWidth; // trigger reflow
                row.classList.add('lb-pulse');
            }
        }, 3000);
    });
</script>
