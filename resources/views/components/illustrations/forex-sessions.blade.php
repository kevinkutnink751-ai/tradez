<style>
    .session-container {
        background: #161A1E;
        border: 1px solid #2B3139;
        border-radius: 8px;
        padding: 25px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .session-timeline {
        position: relative;
        height: 60px;
        background: #0B0E11;
        border-radius: 4px;
        margin: 20px 0;
        display: flex;
        align-items: center;
        padding: 0 10px;
        overflow: hidden;
    }
    .session-block {
        height: 30px;
        border-radius: 4px;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: white;
    }
    .sess-sydney { background: #3498db; width: 30%; left: 0; }
    .sess-tokyo { background: #e67e22; width: 30%; left: 15%; }
    .sess-london { background: #9b59b6; width: 30%; left: 45%; }
    .sess-ny { background: #2ecc71; width: 30%; left: 70%; }
    
    .current-time-marker {
        position: absolute;
        width: 2px;
        height: 100%;
        background: #FCD535;
        left: 55%;
        z-index: 5;
        box-shadow: 0 0 10px #FCD535;
    }
    .session-legend {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 20px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 11px;
        color: #848E9C;
    }
    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 8px;
    }
</style>

<div class="session-container">
    <h6 class="text-white mb-2">Global Market Sessions</h6>
    <p class="small text-muted mb-4">Forex is open 24/5. Trade when liquidity is highest.</p>
    
    <div class="session-timeline">
        <div class="current-time-marker"></div>
        <div class="session-block sess-sydney">SYDNEY</div>
        <div class="session-block sess-tokyo">TOKYO</div>
        <div class="session-block sess-london">LONDON</div>
        <div class="session-block sess-ny">NEW YORK</div>
    </div>

    <div class="session-legend">
        <div class="legend-item"><div class="legend-dot" style="background: #3498db;"></div> Sydney (22:00 - 07:00)</div>
        <div class="legend-item"><div class="legend-dot" style="background: #e67e22;"></div> Tokyo (00:00 - 09:00)</div>
        <div class="legend-item"><div class="legend-dot" style="background: #9b59b6;"></div> London (08:00 - 17:00)</div>
        <div class="legend-item"><div class="legend-dot" style="background: #2ecc71;"></div> New York (13:00 - 22:00)</div>
    </div>
    
    <div class="mt-4 p-3 bg-inst-dark rounded border border-warning">
        <div class="small text-warning font-weight-bold">Peak Liquidity: London/NY Overlap</div>
        <div class="text-muted" style="font-size: 10px;">Highest trading volume occurs during the 13:00 - 17:00 GMT window.</div>
    </div>
</div>

<script>
    // In a real app, this would update based on local time
</script>
