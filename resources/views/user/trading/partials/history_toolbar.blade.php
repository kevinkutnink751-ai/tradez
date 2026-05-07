{{-- Advanced History Toolbar: Live/Demo Toggle, Search, Export --}}
@php
    $currentMode = $currentMode ?? 'Live';
    $currentUrl = request()->url();
    $historyType = $historyType ?? 'trades';
@endphp

<div class="history-toolbar">
    <div class="toolbar-left">
        <!-- Live / Demo Toggle -->
        <div class="mode-switcher">
            <a href="{{ $currentUrl }}?mode=Live" class="mode-btn {{ $currentMode === 'Live' ? 'active' : '' }}">
                <i class="mdi mdi-chart-line"></i> Live
            </a>
            <a href="{{ $currentUrl }}?mode=Demo" class="mode-btn {{ $currentMode === 'Demo' ? 'active' : '' }}">
                <i class="mdi mdi-flask-outline"></i> Demo
            </a>
        </div>

        @if($currentMode === 'Demo')
            <div class="demo-indicator">
                <i class="mdi mdi-flask"></i> Viewing Demo Trades
            </div>
        @endif
    </div>

    <div class="toolbar-right">
        <!-- Search -->
        <div class="toolbar-search">
            <i class="mdi mdi-magnify"></i>
            <input type="text" id="historySearchInput" placeholder="Search {{ $historyType }}..." onkeyup="filterHistoryTable()">
        </div>

        <!-- Export -->
        <button class="toolbar-btn" onclick="exportHistory()" title="Export CSV">
            <i class="mdi mdi-download"></i>
        </button>
    </div>
</div>

<style>
    .history-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .toolbar-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .toolbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mode-switcher {
        display: flex;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
        background: #0a0e17;
    }

    .mode-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 20px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none !important;
        transition: all 0.25s ease;
        white-space: nowrap;
    }

    .mode-btn:hover {
        color: rgba(255, 255, 255, 0.8);
        background: rgba(255, 255, 255, 0.03);
    }

    .mode-btn.active {
        background: linear-gradient(135deg, rgba(21, 114, 232, 0.2), rgba(21, 114, 232, 0.08));
        color: #4a9eff;
        border: none;
    }

    .mode-btn.active i { color: #4a9eff; }

    .demo-indicator {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        background: rgba(255, 193, 7, 0.08);
        border: 1px solid rgba(255, 193, 7, 0.2);
        border-radius: 20px;
        color: #ffc107;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        animation: demoPulse 2s infinite;
    }

    @keyframes demoPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .toolbar-search {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        min-width: 200px;
        transition: border-color 0.2s;
    }

    .toolbar-search:focus-within {
        border-color: rgba(21, 114, 232, 0.4);
    }

    .toolbar-search i {
        color: rgba(255, 255, 255, 0.25);
        font-size: 16px;
    }

    .toolbar-search input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 0.8rem;
        width: 100%;
        outline: none;
    }

    .toolbar-search input::placeholder {
        color: rgba(255, 255, 255, 0.25);
    }

    .toolbar-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.03);
        color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.2s;
    }

    .toolbar-btn:hover {
        background: rgba(21, 114, 232, 0.1);
        color: #4a9eff;
        border-color: rgba(21, 114, 232, 0.3);
    }

    /* Drill-down row styles */
    .table-dark-custom tbody tr {
        cursor: pointer;
        transition: background 0.15s;
    }

    .table-dark-custom tbody tr:hover {
        background: rgba(21, 114, 232, 0.04) !important;
    }

    .trade-detail-row {
        display: none;
    }

    .trade-detail-row.open {
        display: table-row;
    }

    .trade-detail-content {
        background: #080b14;
        border-left: 3px solid #1572e8;
        padding: 20px 24px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .detail-item .label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255, 255, 255, 0.3);
    }

    .detail-item .value {
        font-size: 0.85rem;
        font-weight: 600;
        color: #e8ecf5;
    }

    .badge-demo {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: 6px;
    }

    .badge-live {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: 6px;
    }

    @media (max-width: 768px) {
        .history-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .toolbar-left, .toolbar-right {
            justify-content: space-between;
        }
        .toolbar-search {
            min-width: 0;
            flex-grow: 1;
        }
    }
</style>

<script>
function filterHistoryTable() {
    const query = document.getElementById('historySearchInput').value.toLowerCase();
    document.querySelectorAll('.table-dark-custom tbody tr:not(.trade-detail-row)').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
        // Also hide detail rows when filtering
        const detailRow = row.nextElementSibling;
        if (detailRow && detailRow.classList.contains('trade-detail-row')) {
            detailRow.style.display = 'none';
            detailRow.classList.remove('open');
        }
    });
}

function toggleDetail(id) {
    const row = document.getElementById('detail-' + id);
    if (row) {
        row.classList.toggle('open');
        row.style.display = row.classList.contains('open') ? 'table-row' : 'none';
    }
}

function exportHistory() {
    const table = document.querySelector('.table-dark-custom');
    if (!table) return;
    
    let csv = [];
    const headers = [];
    table.querySelectorAll('thead th').forEach(th => headers.push(th.textContent.trim()));
    csv.push(headers.join(','));

    table.querySelectorAll('tbody tr:not(.trade-detail-row)').forEach(row => {
        if (row.style.display === 'none') return;
        const cols = [];
        row.querySelectorAll('td').forEach(td => {
            cols.push('"' + td.textContent.trim().replace(/"/g, '""') + '"');
        });
        csv.push(cols.join(','));
    });

    const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = '{{ $historyType }}_history_{{ $currentMode }}_' + new Date().toISOString().slice(0,10) + '.csv';
    a.click();
    URL.revokeObjectURL(url);
    toastr.success('History exported successfully!');
}
</script>
