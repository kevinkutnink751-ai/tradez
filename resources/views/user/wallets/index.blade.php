@extends('layouts.dash')
@section('title', $title)
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white font-weight-bold mb-0">Spot Wallets</h3>
        <div>
            <ul class="nav nav-pills custom-nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#spot">Spot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#funding">Funding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#future">Future</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#copytrade">Copy Trade</a>
                </li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
    @endif

    <div class="mb-4">
        <button class="btn btn-outline-info rounded-pill px-4" data-toggle="modal" data-target="#addWalletModal">
            <i class="fas fa-plus mr-2"></i> Add Wallet
        </button>
        <button class="btn btn-outline-success rounded-pill px-4 ml-2" data-toggle="modal" data-target="#transferModalGlobal">
            <i class="fas fa-exchange-alt mr-2"></i> Transfer
        </button>
    </div>

    <div class="card bg-dark-card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="tab-content">
                {{-- SPOT TAB --}}
                <div class="tab-pane fade show active" id="spot">
                    <div class="table-responsive">
                        <table class="table table-borderless text-white mb-0 custom-table">
                            <thead class="text-muted border-bottom border-secondary">
                                <tr>
                                    <th class="font-weight-normal py-3">Currency</th>
                                    <th class="font-weight-normal py-3">Available Balance</th>
                                    <th class="font-weight-normal py-3">In Order</th>
                                    <th class="font-weight-normal py-3">Total Balance</th>
                                    <th class="font-weight-normal py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wallets as $wallet)
                                <tr class="border-bottom border-white-10">
                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            @if($wallet->asset->logo)
                                                <img src="{{ $wallet->asset->logo }}" alt="" class="rounded-circle mr-3" width="30">
                                            @else
                                                <div class="rounded-circle bg-secondary text-center mr-3 d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                                                    <span class="font-weight-bold text-white" style="font-size: 12px;">{{ substr($wallet->asset->symbol, 0, 1) }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 text-white font-weight-bold">{{ $wallet->asset->name }}</h6>
                                                <small class="text-muted">{{ $wallet->asset->symbol }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 align-middle">{{ number_format($wallet->spot_bal, 4) }}</td>
                                    <td class="py-3 align-middle">0.0000</td>
                                    <td class="py-3 align-middle">{{ number_format($wallet->spot_bal, 4) }}</td>
                                    <td class="py-3 align-middle text-right">
                                        <button class="btn btn-sm btn-outline-info rounded-pill px-3" data-toggle="modal" data-target="#transferModal{{ $wallet->id }}">
                                            <i class="fas fa-eye mr-1"></i> View / Transfer
                                        </button>
                                    </td>
                                </tr>

                                {{-- Transfer Modal for Specific Wallet --}}
                                <div class="modal fade" id="transferModal{{ $wallet->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark-card text-white border-secondary">
                                            <div class="modal-header border-secondary">
                                                <h5 class="modal-title">Transfer {{ $wallet->asset->symbol }}</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('wallet.transfer') }}" method="POST" class="ajax-transfer-form">
                                                @csrf
                                                <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                                                <div class="modal-body">
                                                    <div class="d-flex align-items-center mb-4">
                                                        <div class="flex-grow-1">
                                                            <label class="text-muted small">From</label>
                                                            <select name="from_type" class="form-control form-control-sm bg-dark border-secondary text-white">
                                                                <option value="spot">Spot Wallet (Bal: {{ number_format($wallet->spot_bal, 4) }})</option>
                                                                <option value="funding">Funding Wallet (Bal: {{ number_format($wallet->funding_bal, 4) }})</option>
                                                                <option value="future">Future Wallet (Bal: {{ number_format($wallet->future_bal, 4) }})</option>
                                                                <option value="copy_trade">Copy Trade Wallet (Bal: {{ number_format($wallet->copy_trade_bal, 4) }})</option>
                                                            </select>
                                                        </div>
                                                        <div class="mx-3 mt-4 text-primary">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <label class="text-muted small">To</label>
                                                            <select name="to_type" class="form-control form-control-sm bg-dark border-secondary text-white">
                                                                <option value="future">Future Wallet</option>
                                                                <option value="spot">Spot Wallet</option>
                                                                <option value="funding">Funding Wallet</option>
                                                                <option value="copy_trade">Copy Trade Wallet</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-muted small">Amount</label>
                                                        <div class="input-group">
                                                            <input type="number" name="amount" step="0.0001" min="0.01" class="form-control bg-dark border-secondary text-white" placeholder="0.0000">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-dark border-secondary text-muted">{{ $wallet->asset->symbol }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-secondary">
                                                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill btn-transfer">Confirm Transfer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No wallets found. Click 'Add Wallet' to create one.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- FUNDING TAB --}}
                <div class="tab-pane fade" id="funding">
                    <div class="table-responsive">
                        <table class="table table-borderless text-white mb-0 custom-table">
                            <thead class="text-muted border-bottom border-secondary">
                                <tr>
                                    <th class="font-weight-normal py-3">Currency</th>
                                    <th class="font-weight-normal py-3">Available Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wallets as $wallet)
                                <tr class="border-bottom border-white-10">
                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bold">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</span>
                                        </div>
                                    </td>
                                    <td class="py-3 align-middle">{{ number_format($wallet->funding_bal, 4) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- FUTURE TAB --}}
                <div class="tab-pane fade" id="future">
                     <div class="table-responsive">
                        <table class="table table-borderless text-white mb-0 custom-table">
                            <thead class="text-muted border-bottom border-secondary">
                                <tr>
                                    <th class="font-weight-normal py-3">Currency</th>
                                    <th class="font-weight-normal py-3">Available Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wallets as $wallet)
                                <tr class="border-bottom border-white-10">
                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bold">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</span>
                                        </div>
                                    </td>
                                    <td class="py-3 align-middle">{{ number_format($wallet->future_bal, 4) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- COPY TRADE TAB --}}
                <div class="tab-pane fade" id="copytrade">
                     <div class="table-responsive">
                        <table class="table table-borderless text-white mb-0 custom-table">
                            <thead class="text-muted border-bottom border-secondary">
                                <tr>
                                    <th class="font-weight-normal py-3">Currency</th>
                                    <th class="font-weight-normal py-3">Available Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wallets as $wallet)
                                <tr class="border-bottom border-white-10">
                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bold">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</span>
                                        </div>
                                    </td>
                                    <td class="py-3 align-middle">{{ number_format($wallet->copy_trade_bal, 4) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Wallet Modal --}}
<div class="modal fade" id="addWalletModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-card text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Create Wallet</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('wallet.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-muted">Select Asset</label>
                        <select name="asset_id" class="form-control bg-dark border-secondary text-white" required>
                            @foreach($availableAssets as $asset)
                                <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->symbol }}) - {{ $asset->type }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted mt-2 d-block">You can create both Fiat and Crypto wallets depending on your selection.</small>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Create Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.custom-nav-pills .nav-link {
    color: #a0a5aa;
    background: transparent;
    border-radius: 0;
    padding: 10px 20px;
    font-weight: 500;
    border-bottom: 2px solid transparent;
}
.custom-nav-pills .nav-link.active {
    color: #0d6efd;
    background: transparent;
    border-bottom: 2px solid #0d6efd;
}
.bg-dark-card {
    background-color: #11151d;
}
.border-white-10 {
    border-color: rgba(255,255,255,0.05) !important;
}
.custom-table th {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('.ajax-transfer-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = form.find('.btn-transfer');
        let originalText = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(response.message);
                    btn.html(originalText).prop('disabled', false);
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred. Please try again.');
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
});
</script>
@endsection
