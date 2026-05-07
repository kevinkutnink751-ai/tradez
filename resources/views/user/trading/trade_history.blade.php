@extends('layouts.dash')
@section('title', $title)
@section('content')
@php $baseUrl = route('trade.history'); @endphp

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 text-white h3 font-weight-bold">Trade History</h5>
            <p class="text-white-50 small mb-0">{{ $currentMode === 'Demo' ? 'Demo (Virtual)' : 'Live' }} &mdash; {{ $stats['total_trades'] }} trades across all markets</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card bg-dark-card border-0">

            <!-- Toolbar: Mode + Search + Export -->
            <div class="history-toolbar">
                <div class="toolbar-left">
                    <div class="mode-switcher">
                        <a href="{{ $baseUrl }}?mode=Live&type={{ $currentType }}" class="mode-btn {{ $currentMode === 'Live' ? 'active' : '' }}"><i class="mdi mdi-chart-line"></i> Live</a>
                        <a href="{{ $baseUrl }}?mode=Demo&type={{ $currentType }}" class="mode-btn {{ $currentMode === 'Demo' ? 'active' : '' }}"><i class="mdi mdi-flask-outline"></i> Demo</a>
                    </div>
                    @if($currentMode === 'Demo')
                        <div class="demo-indicator"><i class="mdi mdi-flask"></i> Viewing Demo Trades</div>
                    @endif
                </div>
                <div class="toolbar-right">
                    <div class="toolbar-search">
                        <i class="mdi mdi-magnify"></i>
                        <input type="text" id="historySearchInput" placeholder="Search trades..." onkeyup="filterRows()">
                    </div>
                    <button class="toolbar-btn" onclick="exportCSV()" title="Export CSV"><i class="mdi mdi-download"></i></button>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-bar px-4 pb-3">
                <div class="stat-chip"><span class="stat-label">Total Invested</span><span class="stat-value">${{ number_format($stats['total_invested'], 2) }}</span></div>
                <div class="stat-chip"><span class="stat-label">Total P&L</span><span class="stat-value text-{{ $stats['total_pnl'] >= 0 ? 'success' : 'danger' }}">{{ $stats['total_pnl'] >= 0 ? '+' : '' }}${{ number_format($stats['total_pnl'], 2) }}</span></div>
                <div class="stat-chip"><span class="stat-label">Open</span><span class="stat-value text-warning">{{ $stats['open_count'] }}</span></div>
                <div class="stat-chip"><span class="stat-label">Total</span><span class="stat-value">{{ $stats['total_trades'] }}</span></div>
            </div>

            <!-- Trade Type Filter Tabs -->
            <div class="px-4 pb-2">
                <div class="type-filter">
                    <a href="{{ $baseUrl }}?mode={{ $currentMode }}&type=all" class="type-btn {{ $currentType === 'all' ? 'active' : '' }}">All <span class="count">{{ $stats['total_trades'] }}</span></a>
                    <a href="{{ $baseUrl }}?mode={{ $currentMode }}&type=binary" class="type-btn {{ $currentType === 'binary' ? 'active' : '' }}"><i class="mdi mdi-timer-outline"></i> Binary <span class="count">{{ $stats['binary_count'] }}</span></a>
                    <a href="{{ $baseUrl }}?mode={{ $currentMode }}&type=options" class="type-btn {{ $currentType === 'options' ? 'active' : '' }}"><i class="mdi mdi-chart-bell-curve"></i> Options <span class="count">{{ $stats['options_count'] }}</span></a>
                    <a href="{{ $baseUrl }}?mode={{ $currentMode }}&type=futures" class="type-btn {{ $currentType === 'futures' ? 'active' : '' }}"><i class="mdi mdi-chart-line-variant"></i> Futures <span class="count">{{ $stats['futures_count'] }}</span></a>
                    <a href="{{ $baseUrl }}?mode={{ $currentMode }}&type=spot" class="type-btn {{ $currentType === 'spot' ? 'active' : '' }}"><i class="mdi mdi-swap-horizontal"></i> Spot <span class="count">{{ $stats['spot_count'] }}</span></a>
                </div>
            </div>

            <!-- Table -->
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom table-hover mb-0" id="tradeTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Market</th>
                                <th>Pair</th>
                                <th>Side</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>P&L</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trades as $trade)
                                <tr class="data-row" onclick="toggleDetail('{{ $trade->id }}')">
                                    <td><span class="trx-id">{{ $trade->id }}</span></td>
                                    <td>
                                        @php $typeColors = ['Binary'=>'#e040fb','Options'=>'#7c4dff','Futures'=>'#00b0ff','Spot'=>'#00e676']; @endphp
                                        <span class="market-badge" style="background:{{ $typeColors[$trade->trade_type] ?? '#666' }}20; color:{{ $typeColors[$trade->trade_type] ?? '#666' }}; border:1px solid {{ $typeColors[$trade->trade_type] ?? '#666' }}30;">{{ $trade->trade_type }}</span>
                                    </td>
                                    <td class="text-white font-weight-bold">{{ $trade->pair }}</td>
                                    <td>
                                        @php $isUp = in_array($trade->side, ['Buy','Call','Rise','Higher']); @endphp
                                        <span class="text-{{ $isUp ? 'success' : 'danger' }} font-weight-bold"><i class="mdi mdi-arrow-{{ $isUp ? 'up' : 'down' }}-thick mr-1"></i>{{ $trade->side }}</span>
                                    </td>
                                    <td>${{ number_format($trade->amount, 2) }}</td>
                                    <td>${{ number_format($trade->price, 2) }}</td>
                                    <td class="text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }} font-weight-bold">{{ $trade->pnl >= 0 ? '+' : '' }}${{ number_format($trade->pnl, 2) }}</td>
                                    <td>
                                        @php $sc = ['Pending'=>'warning','Open'=>'info','Won'=>'success','Lost'=>'danger','Completed'=>'success','Canceled'=>'secondary','Settled'=>'info']; @endphp
                                        <span class="badge badge-soft-{{ $sc[$trade->status] ?? 'secondary' }} px-3 py-1">{{ $trade->status }}</span>
                                    </td>
                                    <td class="small text-muted">{{ $trade->created_at->format('M d, H:i') }}</td>
                                </tr>
                                <tr class="detail-row" id="detail-{{ $trade->id }}" style="display:none;">
                                    <td colspan="9" style="padding:0; border:0;">
                                        <div class="detail-content">
                                            <div class="detail-grid">
                                                <div class="d-item"><span class="dl">Trade ID</span><span class="dv">{{ $trade->id }}</span></div>
                                                <div class="d-item"><span class="dl">Market</span><span class="dv">{{ $trade->trade_type }}</span></div>
                                                <div class="d-item"><span class="dl">Symbol</span><span class="dv">{{ $trade->pair }}</span></div>
                                                <div class="d-item"><span class="dl">Side</span><span class="dv text-{{ $isUp ? 'success' : 'danger' }}">{{ $trade->side }}</span></div>
                                                <div class="d-item"><span class="dl">Amount</span><span class="dv">${{ number_format($trade->amount, 4) }}</span></div>
                                                <div class="d-item"><span class="dl">Price</span><span class="dv">${{ number_format($trade->price, 4) }}</span></div>
                                                @if($trade->leverage && $trade->leverage > 1)<div class="d-item"><span class="dl">Leverage</span><span class="dv">{{ $trade->leverage }}x</span></div>@endif
                                                @if($trade->duration)<div class="d-item"><span class="dl">Duration</span><span class="dv">{{ $trade->duration }}</span></div>@endif
                                                @if($trade->expiration)<div class="d-item"><span class="dl">Expiration</span><span class="dv">{{ $trade->expiration }}</span></div>@endif
                                                @if($trade->strike_price)<div class="d-item"><span class="dl">Strike</span><span class="dv">${{ number_format($trade->strike_price, 4) }}</span></div>@endif
                                                @if($trade->end_price)<div class="d-item"><span class="dl">End Price</span><span class="dv">${{ number_format($trade->end_price, 4) }}</span></div>@endif
                                                <div class="d-item"><span class="dl">P&L</span><span class="dv text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }}">{{ $trade->pnl >= 0 ? '+' : '' }}${{ number_format($trade->pnl, 4) }}</span></div>
                                                <div class="d-item"><span class="dl">Settlement</span><span class="dv">{{ $trade->settlement_asset }}</span></div>
                                                <div class="d-item"><span class="dl">Account</span><span class="dv">{{ $trade->is_demo ? '🧪 Demo' : '🔴 Live' }}</span></div>
                                                <div class="d-item"><span class="dl">Created</span><span class="dv">{{ $trade->created_at->format('M d, Y H:i:s') }}</span></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <i class="mdi mdi-chart-timeline-variant-shimmer" style="font-size:48px; color:rgba(255,255,255,0.08);"></i>
                                        <div class="text-muted mt-2">No {{ $currentMode === 'Demo' ? 'demo' : 'live' }} {{ $currentType !== 'all' ? $currentType : '' }} trades found.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-dark-card { background: #11151d; border: 1px solid rgba(255,255,255,0.04); border-radius: 16px; }

    /* Toolbar */
    .history-toolbar { display:flex; justify-content:space-between; align-items:center; padding:16px 24px; gap:16px; flex-wrap:wrap; }
    .toolbar-left { display:flex; align-items:center; gap:16px; }
    .toolbar-right { display:flex; align-items:center; gap:10px; }
    .mode-switcher { display:flex; border:1px solid rgba(255,255,255,0.1); border-radius:10px; overflow:hidden; background:#0a0e17; }
    .mode-btn { display:inline-flex; align-items:center; gap:6px; padding:8px 20px; color:rgba(255,255,255,0.5); font-size:0.8rem; font-weight:700; text-decoration:none!important; transition:all 0.25s; }
    .mode-btn:hover { color:rgba(255,255,255,0.8); background:rgba(255,255,255,0.03); }
    .mode-btn.active { background:linear-gradient(135deg,rgba(21,114,232,0.2),rgba(21,114,232,0.08)); color:#4a9eff; }
    .demo-indicator { display:inline-flex; align-items:center; gap:5px; padding:5px 14px; background:rgba(255,193,7,0.08); border:1px solid rgba(255,193,7,0.2); border-radius:20px; color:#ffc107; font-size:0.7rem; font-weight:700; letter-spacing:0.5px; animation:demoPulse 2s infinite; }
    @keyframes demoPulse { 0%,100%{opacity:1} 50%{opacity:0.7} }
    .toolbar-search { display:flex; align-items:center; gap:8px; padding:6px 14px; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:8px; min-width:200px; transition:border-color 0.2s; }
    .toolbar-search:focus-within { border-color:rgba(21,114,232,0.4); }
    .toolbar-search i { color:rgba(255,255,255,0.25); font-size:16px; }
    .toolbar-search input { background:transparent; border:none; color:#fff; font-size:0.8rem; width:100%; outline:none; }
    .toolbar-search input::placeholder { color:rgba(255,255,255,0.25); }
    .toolbar-btn { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border:1px solid rgba(255,255,255,0.08); border-radius:8px; background:rgba(255,255,255,0.03); color:rgba(255,255,255,0.5); cursor:pointer; transition:all 0.2s; }
    .toolbar-btn:hover { background:rgba(21,114,232,0.1); color:#4a9eff; border-color:rgba(21,114,232,0.3); }

    /* Stats */
    .stats-bar { display:flex; gap:12px; flex-wrap:wrap; }
    .stat-chip { display:flex; flex-direction:column; gap:2px; padding:10px 18px; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.05); border-radius:10px; min-width:120px; }
    .stat-label { font-size:0.65rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:rgba(255,255,255,0.3); }
    .stat-value { font-size:1.1rem; font-weight:800; color:#fff; }

    /* Type Filter */
    .type-filter { display:flex; gap:8px; flex-wrap:wrap; }
    .type-btn { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06); border-radius:10px; color:rgba(255,255,255,0.5); font-size:0.8rem; font-weight:700; text-decoration:none!important; transition:all 0.2s; }
    .type-btn:hover { background:rgba(255,255,255,0.06); color:#fff; }
    .type-btn.active { background:rgba(21,114,232,0.12); border-color:rgba(21,114,232,0.3); color:#4a9eff; }
    .type-btn .count { background:rgba(255,255,255,0.08); padding:1px 8px; border-radius:12px; font-size:0.7rem; margin-left:2px; }
    .type-btn.active .count { background:rgba(21,114,232,0.2); color:#4a9eff; }

    /* Table */
    .table-dark-custom { color:#8898aa; }
    .table-dark-custom thead th { background:#090c10; border:0; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.5px; color:rgba(255,255,255,0.3); padding:1rem 1.5rem; }
    .table-dark-custom tbody td { border-top:1px solid rgba(255,255,255,0.04); padding:1rem 1.5rem; vertical-align:middle; font-size:0.8rem; }
    .data-row { cursor:pointer; transition:background 0.15s; }
    .data-row:hover { background:rgba(21,114,232,0.04)!important; }
    .trx-id { font-size:0.6rem; color:#1572e8; background:rgba(21,114,232,0.08); padding:2px 6px; border-radius:4px; font-weight:700; letter-spacing:0.3px; }
    .market-badge { font-size:0.65rem; font-weight:800; padding:3px 10px; border-radius:6px; letter-spacing:0.5px; }

    /* Badge colors */
    .badge-soft-success { background:rgba(40,167,69,0.08); color:#28a745; border-radius:6px; }
    .badge-soft-danger { background:rgba(220,53,69,0.08); color:#dc3545; border-radius:6px; }
    .badge-soft-warning { background:rgba(255,193,7,0.08); color:#ffc107; border-radius:6px; }
    .badge-soft-info { background:rgba(23,162,184,0.08); color:#17a2b8; border-radius:6px; }
    .badge-soft-secondary { background:rgba(108,117,125,0.08); color:#6c757d; border-radius:6px; }

    /* Detail Row */
    .detail-content { background:#080b14; border-left:3px solid #1572e8; padding:20px 24px; }
    .detail-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:14px; }
    .d-item { display:flex; flex-direction:column; gap:2px; }
    .dl { font-size:0.6rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:rgba(255,255,255,0.3); }
    .dv { font-size:0.82rem; font-weight:600; color:#e8ecf5; }

    @media(max-width:768px) {
        .history-toolbar { flex-direction:column; align-items:stretch; }
        .type-filter { overflow-x:auto; flex-wrap:nowrap; padding-bottom:8px; }
    }
</style>

<script>
function toggleDetail(id) {
    const row = document.getElementById('detail-' + id);
    if (row) row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
function filterRows() {
    const q = document.getElementById('historySearchInput').value.toLowerCase();
    document.querySelectorAll('.data-row').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        const next = row.nextElementSibling;
        if (next && next.classList.contains('detail-row')) { next.style.display = 'none'; }
    });
}
function exportCSV() {
    const table = document.getElementById('tradeTable');
    let csv = [];
    const headers = [];
    table.querySelectorAll('thead th').forEach(th => headers.push(th.textContent.trim()));
    csv.push(headers.join(','));
    table.querySelectorAll('.data-row').forEach(row => {
        if (row.style.display === 'none') return;
        const cols = [];
        row.querySelectorAll('td').forEach(td => cols.push('"' + td.textContent.trim().replace(/"/g, '""') + '"'));
        csv.push(cols.join(','));
    });
    const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'trade_history_{{ $currentMode }}_{{ $currentType }}_' + new Date().toISOString().slice(0,10) + '.csv';
    a.click();
    toastr.success('History exported!');
}
</script>
@endsection
