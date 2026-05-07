@extends('layouts.dash')
@section('title', $title)
@section('content')

<div class="dashboard-wrapper container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark-card border-0 shadow-lg">
                <div class="card-header bg-transparent border-white-10 py-4 px-4 d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="text-white font-weight-bold mb-3 mb-md-0">Top Assets</h5>
                    <div class="asset-filters d-flex bg-dark-input rounded-lg p-1">
                        <button class="btn btn-filter active" data-filter="all">All</button>
                        <button class="btn btn-filter" data-filter="fiat">Fiat</button>
                        <button class="btn btn-filter" data-filter="crypto">Crypto</button>
                        <button class="btn btn-filter" data-filter="stocks">Stocks</button>
                        <button class="btn btn-filter" data-filter="commodity">Commodities</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom mb-0" id="topAssetsTable">
                            <thead>
                                <tr class="text-muted text-uppercase small">
                                    <th class="px-4 py-3">Asset</th>
                                    <th class="py-3">Symbol</th>
                                    <th class="py-3">Current Value</th>
                                    <th class="px-4 py-3 text-right">Estimated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $hasValue = false; @endphp
                                @foreach($all_assets as $asset)
                                    @if($asset->balance > 0)
                                        @php $hasValue = true; @endphp
                                        @php 
                                            $filterType = strtolower($asset->type);
                                            if(in_array($filterType, ['equity', 'index'])) $filterType = 'stocks';
                                        @endphp
                                        <tr class="asset-row" data-category="{{ $filterType }}">
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="asset-icon-circle mr-3">
                                                        @if($asset->logo)
                                                            <img src="{{ $asset->logo }}" alt="{{ $asset->name }}" width="24">
                                                        @else
                                                            {{ substr($asset->name, 0, 1) }}
                                                        @endif
                                                    </div>
                                                    <span class="text-white font-weight-bold">{{ $asset->name }}</span>
                                                </div>
                                            </td>
                                            <td><span class="text-muted">{{ $asset->symbol }}</span></td>
                                            <td><span class="text-white font-weight-bold">{{ number_format($asset->balance, 4) }} {{ $asset->symbol }}</span></td>
                                            <td class="px-4 text-right"><span class="text-white font-weight-bold">${{ number_format($asset->estimated_usd, 2) }}</span></td>
                                        </tr>
                                    @endif
                                @endforeach
                                
                                @if(!$hasValue)
                                <tr id="noAssetsMsg">
                                    <td colspan="4" class="text-center py-5">
                                        <p class="text-muted mb-0">No assets with value found</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <div class="input-group bg-dark-input rounded-lg border-white-10">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control bg-transparent border-0 text-white" id="assetSearch" placeholder="Search assets...">
            </div>
        </div>
    </div>

    <!-- Categorized Assets -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0 shadow-lg mb-4 overflow-hidden">
                <div class="card-header bg-transparent border-white-10 py-3 px-4">
                    <h5 class="text-white font-weight-bold mb-0">Assets</h5>
                </div>
                
                @foreach($categories as $categoryName => $assets)
                <div class="category-block mb-2" id="category-{{ strtolower($categoryName) }}">
                    <div class="category-header bg-dark-input py-3 px-4 d-flex align-items-center">
                        <h6 class="text-white-50 font-weight-bold mb-0 text-uppercase small" style="letter-spacing: 1px;">{{ $categoryName }}</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark-custom mb-0">
                            <tbody>
                                @forelse($assets as $asset)
                                <tr class="asset-list-row" data-name="{{ strtolower($asset->name) }}" data-symbol="{{ strtolower($asset->symbol) }}">
                                    <td class="px-4 w-40">
                                        <div class="d-flex align-items-center">
                                            <div class="asset-icon-circle mr-3">
                                                @if($asset->logo)
                                                    <img src="{{ $asset->logo }}" alt="{{ $asset->name }}" width="24">
                                                @else
                                                    {{ substr($asset->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <span class="text-white font-weight-bold">{{ $asset->name }}</span>
                                        </div>
                                    </td>
                                    <td class="w-20"><span class="text-muted">{{ $asset->symbol }}</span></td>
                                    <td class="w-20"><span class="text-white font-weight-bold">{{ number_format($asset->balance, 4) }} {{ $asset->symbol }}</span></td>
                                    <td class="px-4 text-right w-20"><span class="text-white font-weight-bold">${{ number_format($asset->estimated_usd, 2) }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No {{ $categoryName }} assets available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-wrapper { background: #080b12; min-height: 100vh; padding: 25px; }
    .bg-dark-card { background: #11151d; border-radius: 12px; }
    .bg-dark-input { background: rgba(255, 255, 255, 0.03); }
    .border-white-10 { border-color: rgba(255, 255, 255, 0.05) !important; }
    
    .btn-filter {
        border: none;
        background: transparent;
        color: rgba(255, 255, 255, 0.5);
        padding: 8px 20px;
        font-weight: 700;
        font-size: 0.85rem;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-filter:hover { color: #fff; }
    .btn-filter.active { background: #1a202e; color: #1572e8; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }

    .table-dark-custom thead th { 
        background: transparent; 
        border: 0; 
        color: rgba(255, 255, 255, 0.3); 
        font-size: 0.75rem; 
        letter-spacing: 1px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .table-dark-custom tbody td { 
        border-top: 1px solid rgba(255, 255, 255, 0.03); 
        vertical-align: middle; 
        padding: 1.25rem 0.75rem;
    }
    
    .asset-icon-circle {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #1572e8;
        overflow: hidden;
    }
    
    .category-header {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .w-40 { width: 40%; }
    .w-20 { width: 20%; }

    #assetSearch:focus { outline: none; box-shadow: none; color: #fff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality for Top Assets
    const filterBtns = document.querySelectorAll('.btn-filter');
    const assetRows = document.querySelectorAll('.asset-row');
    const noAssetsMsg = document.getElementById('noAssetsMsg');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            let visibleCount = 0;

            assetRows.forEach(row => {
                if (filter === 'all' || row.getAttribute('data-category') === filter) {
                    row.style.display = 'table-row';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noAssetsMsg) {
                noAssetsMsg.style.display = visibleCount === 0 ? 'table-row' : 'none';
            }
        });
    });

    // Search functionality for all assets
    const searchInput = document.getElementById('assetSearch');
    const assetListRows = document.querySelectorAll('.asset-list-row');
    const categoryBlocks = document.querySelectorAll('.category-block');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        categoryBlocks.forEach(block => {
            const rowsInBlock = block.querySelectorAll('.asset-list-row');
            let blockHasVisibleRows = false;

            rowsInBlock.forEach(row => {
                const name = row.getAttribute('data-name');
                const symbol = row.getAttribute('data-symbol');
                
                if (name.includes(query) || symbol.includes(query)) {
                    row.style.display = 'table-row';
                    blockHasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            block.style.display = blockHasVisibleRows ? 'block' : 'none';
        });
    });
});
</script>

@endsection
