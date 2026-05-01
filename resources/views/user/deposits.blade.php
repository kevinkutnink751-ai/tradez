@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Fund USD wallet</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="javascript:;" method="post" id="submitpaymentform">
                                @csrf
                                <div class="row">
                                    <div class="mb-4 col-md-12">
                                        <h5 class="card-title">Enter Amount</h5>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0">$</span>
                                            </div>
                                            <input class="form-control" placeholder="0.00"
                                                min="{{ $moresettings->minamt }}" type="number" step="any" name="amount" required>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <h5 class="card-title">Destination Wallet</h5>
                                        <select name="balance_type" class="form-control" id="walletSelect" onchange="updateSettlementRule()">
                                            <option value="funding" {{ $selectedBalanceType == 'funding' ? 'selected' : '' }}>Funding Wallet</option>
                                            <option value="spot" {{ $selectedBalanceType == 'spot' ? 'selected' : '' }}>Spot Wallet</option>
                                            <option value="future" {{ $selectedBalanceType == 'future' ? 'selected' : '' }}>Futures Wallet</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <h5 class="card-title">Select Asset</h5>
                                        <select name="asset_id" class="form-control" id="assetSelect" onchange="updateSettlementRule()">
                                            @foreach($assets as $asset)
                                                <option value="{{ $asset->id }}" data-symbol="{{ $asset->symbol }}" {{ (optional($selectedAsset)->id == $asset->id || (!$selectedAsset && $asset->symbol == 'USD')) ? 'selected' : '' }}>
                                                    {{ $asset->name }} ({{ $asset->symbol }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <h5 class="card-title">Settlement Summary</h5>
                                        <div class="p-3 rounded border bg-light">
                                            <p class="mb-0 text-dark small" id="settlementRuleText">
                                                Paid amount will be credited to your <strong>USD Funding Wallet</strong>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <input type="hidden" name="payment_method" id="paymethod">
                                    </div>
                                    <div class="mt-2 mb-1 col-md-12">
                                        <h5 class="card-title ">Choose Payment Method from the list below</h5>
                                    </div>
                                    @forelse ($dmethods as $method)
                                        <div class="mb-2 col-md-6">
                                            <a style="cursor: pointer;" data-method="{{ $method->name }}"
                                                id="{{ $method->id }}" class="text-decoration-none"
                                                onclick="checkpamethd(this.id)">
                                                <div class="rounded border">
                                                    <div
                                                        class="card-body d-flex justify-content-between align-items-center">
                                                        <span class="">
                                                            @if (!empty($method->img_url))
                                                                <img src="{{ $method->img_url }}" alt=""
                                                                    class="" style="width: 25px;">
                                                            @endif
                                                            {{ $method->name }}
                                                        </span>
                                                        <span>
                                                            <input type="radio" id="{{ $method->id }}customCheck1"
                                                                readonly>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="mb-1 col-md-12">
                                            <p class="">No Payment Method enabled at the moment, please check
                                                back later.</p>
                                        </div>
                                    @endforelse
                                    @if (count($dmethods) > 0)
                                        <div class="mt-2 mb-1 col-md-12">
                                            <input type="submit" class="px-5 btn btn-primary btn-lg"
                                                value="Procced to Payment">
                                        </div>
                                        <input type="hidden" id="lastchosen" value="0">
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 col-md-4">
                            <!-- Seller -->
                            <div class="card">

                                <div class="card-body">
                                    <div class="pb-4">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h6 class="mb-0">Total Deposit</h6>
                                                <span class="text-sm text-muted">-</span>
                                            </div>
                                            <div class="col-6">
                                        <h6 class="mb-1">
                                                    <b>{{ $settings->currency }}{{ number_format($deposited, 2, '.', ',') }}
                                                    </b>
                                                </h6>
                                                <span class="text-sm text-muted">Amount</span>
                                            </div>
                                        </div>
                                        <div class="mt-3 p-3 rounded" style="background: rgba(255,255,255,0.04);">
                                            <small class="text-muted d-block">Deposit settlement</small>
                                            <strong>USD</strong>
                                            <div class="small text-muted">Every confirmed deposit settles to the funding wallet.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="actions d-flex justify-content-between">
                                        <a href="{{ route('accounthistory') }}" class="action-item">
                                            <span class="btn-inner--icon">View deposit history</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        @parent
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('dash2/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

        <script>
            function updateSettlementRule() {
                const wallet = document.getElementById('walletSelect').options[document.getElementById('walletSelect').selectedIndex].text;
                const asset = document.getElementById('assetSelect').options[document.getElementById('assetSelect').selectedIndex].getAttribute('data-symbol');
                document.getElementById('settlementRuleText').innerHTML = `Paid amount will be credited to your <strong>${asset} ${wallet}</strong>.`;
            }
            // Initialize on load
            document.addEventListener('DOMContentLoaded', updateSettlementRule);
        </script>
        @include('user.script')
    @endsection
@endsection
