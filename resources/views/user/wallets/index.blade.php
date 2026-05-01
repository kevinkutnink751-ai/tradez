@extends('layouts.dash')
@section('title', $title)
@section('content')
@php
    $totalUsd = $wallets->sum(fn ($wallet) => ($wallet->spot_bal + $wallet->funding_bal + $wallet->future_bal + $wallet->copy_trade_bal) * ($wallet->asset->base_rate ?? 1));
    $tabs = [
        'spot' => 'Spot',
        'funding' => 'Funding',
        'future' => 'Futures',
        'copy_trade' => 'Copy Trade',
    ];
@endphp

<div class="wallet-hub">
    <div class="wallet-topbar">
        <div>
            <p class="eyebrow">Asset Hub</p>
            <h2>Wallet orchestration</h2>
            <span>Move capital across fiat and crypto wallets with simple asset-first controls.</span>
        </div>
        <div class="wallet-actions">
            <button class="hub-btn hub-btn--ghost" data-toggle="modal" data-target="#addWalletModal">Add Asset Wallet</button>
            <button class="hub-btn hub-btn--primary" data-toggle="modal" data-target="#transferModalGlobal">Transfer Assets</button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
    @endif

    <div class="wallet-hero">
        <div class="hero-card hero-card--primary">
            <span>Total Wallet Equity</span>
            <strong>${{ number_format($totalUsd, 2) }}</strong>
            <small>Derived from asset USD rates across every wallet segment.</small>
        </div>
        <div class="hero-card">
            <span>Active Asset Wallets</span>
            <strong>{{ $wallets->count() }}</strong>
            <small>{{ $wallets->where('asset.type', 'Fiat')->count() }} fiat, {{ $wallets->where('asset.type', '!=', 'Fiat')->count() }} market assets.</small>
        </div>
        <div class="hero-card">
            <span>Fast Actions</span>
            <div class="hero-links">
                <a href="{{ route('deposits') }}">Deposit</a>
                <a href="{{ route('withdrawalsdeposits') }}">Withdraw</a>
                <a href="{{ route('spot.trade') }}">Trade</a>
            </div>
        </div>
    </div>

    <div class="segment-tabs nav nav-pills" role="tablist">
        @foreach($tabs as $key => $label)
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="pill" href="#wallet-{{ $key }}">{{ $label }}</a>
        @endforeach
    </div>

    <div class="tab-content">
        @foreach($tabs as $key => $label)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="wallet-{{ $key }}">
                <div class="wallet-grid">
                    @forelse($wallets as $wallet)
                        @php
                            $column = $key . '_bal';
                            $balance = $wallet->$column;
                            $usdValue = $balance * ($wallet->asset->base_rate ?? 1);
                        @endphp
                        <div class="wallet-tile">
                            <div class="wallet-tile__head">
                                <div class="asset-badge">
                                    @if($wallet->asset->logo)
                                        <img src="{{ $wallet->asset->logo }}" alt="{{ $wallet->asset->symbol }}">
                                    @else
                                        <span>{{ substr($wallet->asset->symbol, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4>{{ $wallet->asset->name }}</h4>
                                    <p>{{ $wallet->asset->symbol }} · {{ $wallet->asset->type }}</p>
                                </div>
                                <span class="market-tag">{{ $wallet->asset->category }}</span>
                            </div>
                            <div class="wallet-tile__body">
                                <div>
                                    <span>Available</span>
                                    <strong>{{ number_format($balance, 8) }} {{ $wallet->asset->symbol }}</strong>
                                </div>
                                <div>
                                    <span>USD Value</span>
                                    <strong>${{ number_format($usdValue, 2) }}</strong>
                                </div>
                                <div>
                                    <span>Price</span>
                                    <strong>${{ number_format($wallet->asset->base_rate, 4) }}</strong>
                                </div>
                            </div>
                            <div class="wallet-tile__actions">
                                <a class="hub-btn hub-btn--thin" href="{{ route('deposits', ['asset_id' => $wallet->asset_id, 'balance_type' => $key]) }}">Deposit</a>
                                <button class="hub-btn hub-btn--thin hub-btn--ghost" data-toggle="modal" data-target="#transferModalGlobal" data-from-wallet="{{ $wallet->id }}" data-from-type="{{ $key }}">Transfer</button>
                                @if($key === 'spot')
                                    <a class="hub-btn hub-btn--thin hub-btn--ghost" href="{{ route('spot.trade', ['pair' => $wallet->asset->symbol . '/USD']) }}">Trade</a>
                                @elseif($key === 'future')
                                    <a class="hub-btn hub-btn--thin hub-btn--ghost" href="{{ route('future.trade', ['pair' => $wallet->asset->symbol . '/USD']) }}">Trade</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <h4>No wallets yet</h4>
                            <p>Create fiat or crypto wallets to start funding, transferring, and trading assets.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="addWalletModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wallet-modal">
            <div class="modal-header">
                <h5 class="modal-title">Create an asset wallet</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('wallet.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Asset</label>
                    <select name="asset_id" class="form-control wallet-input" required>
                        @foreach($availableAssets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->symbol }}) · {{ $asset->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="hub-btn hub-btn--ghost" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="hub-btn hub-btn--primary">Create Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="transferModalGlobal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content wallet-modal">
            <div class="modal-header">
                <h5 class="modal-title">Cross-asset transfer</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('wallet.transfer') }}" method="POST" id="globalTransferForm">
                @csrf
                <div class="modal-body">
                    <div class="transfer-grid">
                        <div>
                            <label>From Asset Wallet</label>
                            <select name="from_wallet_id" id="fromWalletSelect" class="form-control wallet-input" required>
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>From Segment</label>
                            <select name="from_type" id="fromTypeSelect" class="form-control wallet-input" required>
                                @foreach($balanceTypes as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>To Asset Wallet</label>
                            <select name="to_wallet_id" id="toWalletSelect" class="form-control wallet-input" required>
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>To Segment</label>
                            <select name="to_type" id="toTypeSelect" class="form-control wallet-input" required>
                                @foreach($balanceTypes as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="transfer-grid__full">
                            <label>Amount</label>
                            <input type="number" name="amount" step="0.00000001" min="0.00000001" class="form-control wallet-input" placeholder="0.00" required>
                            <small class="text-muted mt-2 d-block">Transfers convert through each asset’s USD price, so you can move capital between fiat and crypto wallets directly.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="hub-btn hub-btn--ghost" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="hub-btn hub-btn--primary">Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .wallet-hub { color: #d8e4ee; }
    .wallet-topbar, .wallet-hero, .wallet-grid, .transfer-grid { display: grid; gap: 1rem; }
    .wallet-topbar { grid-template-columns: 1fr auto; align-items: end; margin-bottom: 1.5rem; }
    .wallet-topbar h2 { color: #f6fbff; font-size: 2rem; margin: 0; }
    .wallet-topbar span { color: #7e94a8; }
    .eyebrow { color: #1bd1c7; text-transform: uppercase; letter-spacing: .16em; font-size: .72rem; margin-bottom: .35rem; }
    .wallet-actions { display: flex; gap: .75rem; }
    .wallet-hero { grid-template-columns: repeat(3, minmax(0, 1fr)); margin-bottom: 1.5rem; }
    .hero-card, .wallet-tile, .wallet-modal { background: #121b24; border: 1px solid rgba(123, 154, 181, 0.14); border-radius: 18px; }
    .hero-card { padding: 1.25rem; }
    .hero-card span, .wallet-tile__body span { color: #7f95aa; display: block; font-size: .8rem; }
    .hero-card strong { color: #f5fbff; display: block; font-size: 1.8rem; margin: .35rem 0; }
    .hero-links { display: flex; gap: 1rem; margin-top: .65rem; }
    .hero-links a { color: #9de9e3; }
    .hero-card--primary { background: linear-gradient(135deg, rgba(21,32,43,.95), rgba(9,74,87,.95)); }
    .segment-tabs { display: flex; gap: .6rem; margin-bottom: 1.25rem; }
    .segment-tabs .nav-link { border: 1px solid rgba(123,154,181,.14); border-radius: 999px; color: #89a1b7; padding: .65rem 1rem; }
    .segment-tabs .nav-link.active { background: #0d3942; color: #eaffff; border-color: rgba(27,209,199,.35); }
    .wallet-grid { grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); }
    .wallet-tile { padding: 1.1rem; }
    .wallet-tile__head { display: grid; grid-template-columns: auto 1fr auto; gap: .9rem; align-items: center; margin-bottom: 1rem; }
    .wallet-tile__head h4 { color: #f7fbff; margin: 0; font-size: 1rem; }
    .wallet-tile__head p { color: #7f95aa; margin: 0; font-size: .8rem; }
    .asset-badge { width: 44px; height: 44px; border-radius: 12px; background: rgba(255,255,255,.04); display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .asset-badge img { width: 100%; height: 100%; object-fit: cover; }
    .asset-badge span { color: #fff; font-weight: 700; }
    .market-tag { color: #9adbd6; background: rgba(27,209,199,.08); padding: .35rem .6rem; border-radius: 999px; font-size: .72rem; }
    .wallet-tile__body { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: .8rem; margin-bottom: 1rem; }
    .wallet-tile__body strong { color: #fff; display: block; margin-top: .25rem; font-size: .95rem; }
    .wallet-tile__actions { display: flex; gap: .65rem; flex-wrap: wrap; }
    .hub-btn { border: 0; border-radius: 12px; padding: .72rem 1rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }
    .hub-btn--primary { background: linear-gradient(135deg, #13c9bf, #0a7d8f); color: #041319; }
    .hub-btn--ghost { background: rgba(255,255,255,.04); color: #cfe0ee; border: 1px solid rgba(123,154,181,.14); }
    .hub-btn--thin { padding: .55rem .85rem; font-size: .85rem; }
    .wallet-modal { background: #111a22; color: #d9e5ef; }
    .wallet-modal .modal-header, .wallet-modal .modal-footer { border-color: rgba(123,154,181,.14); }
    .wallet-input { background: #0d141b; border: 1px solid rgba(123,154,181,.18); color: #ecf5fb; border-radius: 12px; min-height: 48px; }
    .transfer-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .transfer-grid__full { grid-column: 1 / -1; }
    .empty-state { padding: 2rem; background: #121b24; border: 1px dashed rgba(123,154,181,.18); border-radius: 18px; text-align: center; }
    .empty-state h4 { color: #fff; }
    @media (max-width: 991px) {
        .wallet-topbar, .wallet-hero, .transfer-grid { grid-template-columns: 1fr; }
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#transferModalGlobal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const fromWallet = button.data('from-wallet');
        const fromType = button.data('from-type');

        if (fromWallet) {
            $('#fromWalletSelect').val(String(fromWallet));
        }
        if (fromType) {
            $('#fromTypeSelect').val(String(fromType));
        }
    });

    $('#globalTransferForm').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);
        const button = form.find('button[type="submit"]');
        const original = button.text();
        button.prop('disabled', true).text('Processing...');

        $.post(form.attr('action'), form.serialize())
            .done(function (response) {
                if (response.status === 'success') {
                    toastr.success(response.message + ' Received ' + response.converted_amount + ' ' + response.target_symbol + '.');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    toastr.error(response.message || 'Transfer failed.');
                    button.prop('disabled', false).text(original);
                }
            })
            .fail(function (xhr) {
                toastr.error(xhr.responseJSON?.message || 'Transfer failed.');
                button.prop('disabled', false).text(original);
            });
    });
});
</script>
@endpush
@endsection
