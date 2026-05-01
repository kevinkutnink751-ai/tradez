@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Manage Wallet</h5>
        <p class="text-white-50 small">Manage your assets, track balances, and execute quick deposits or withdrawals.</p>
    </div>

    <div class="row">
        {{-- Total Balance Card --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1572e8 0%, #0c5adb 100%);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <small class="text-white-50 d-block mb-1 text-uppercase letter-spacing-1">Estimated Total Balance</small>
                            <h1 class="text-white font-weight-bold mb-0">${{ number_format(Auth::user()->account_bal, 2) }} <span class="h4 text-white-50">USD</span></h1>
                            <div class="mt-3">
                                <span class="badge badge-white text-primary px-3 py-2 mr-2">
                                    <i class="fas fa-arrow-up mr-1"></i> Available: ${{ number_format(Auth::user()->account_bal, 2) }}
                                </span>
                                <span class="badge badge-soft-light text-white px-3 py-2">
                                    <i class="fas fa-lock mr-1"></i> Locked: $0.00
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right mt-4 mt-md-0">
                            <button class="btn btn-white text-primary rounded-pill px-4 font-weight-bold mr-2" data-toggle="modal" data-target="#depositModal">
                                <i class="fas fa-plus-circle mr-2"></i> Deposit
                            </button>
                            <button class="btn btn-outline-white rounded-pill px-4 font-weight-bold" data-toggle="modal" data-target="#withdrawModal">
                                <i class="fas fa-minus-circle mr-2"></i> Withdraw
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wallets Selection --}}
        <div class="col-lg-3 mb-4">
            <div class="card bg-dark-card border-0 h-100">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush wallet-menu">
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 active d-flex align-items-center py-3 px-4">
                            <i class="fas fa-coins mr-3"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold">Spot Wallet</h6>
                                <small class="text-muted">Trading & Staking</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 d-flex align-items-center py-3 px-4">
                            <i class="fas fa-chart-line mr-3"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold">Futures Wallet</h6>
                                <small class="text-muted">Leverage Trading</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 d-flex align-items-center py-3 px-4">
                            <i class="fas fa-hand-holding-usd mr-3"></i>
                            <div>
                                <h6 class="mb-0 font-weight-bold">Funding Wallet</h6>
                                <small class="text-muted">P2P & Transfers</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Asset List --}}
        <div class="col-lg-9 mb-4">
            <div class="card bg-dark-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="text-white font-weight-bold mb-0">Assets (Spot)</h5>
                    <div class="custom-control custom-checkbox custom-checkbox-sm">
                        <input type="checkbox" class="custom-control-input" id="hideSmall">
                        <label class="custom-control-label text-muted small" for="hideSmall">Hide small balances</label>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Total Balance</th>
                                    <th>Available</th>
                                    <th>Locked</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="coin-icon bg-success mr-2">S</div>
                                            <div>
                                                <h6 class="text-white mb-0 font-weight-bold">United States Dollar</h6>
                                                <small class="text-muted">USD</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-white">{{ number_format(Auth::user()->account_bal, 2) }}</td>
                                    <td class="text-white">{{ number_format(Auth::user()->account_bal, 2) }}</td>
                                    <td>0.00</td>
                                    <td class="text-right">
                                        <a href="{{ route('deposits') }}" class="text-primary mr-3 small font-weight-bold">Deposit</a>
                                        <a href="{{ route('withdrawfunds') }}" class="text-primary mr-3 small font-weight-bold">Withdraw</a>
                                        <a href="{{ route('spot.trade') }}" class="text-primary small font-weight-bold">Trade</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="coin-icon bg-warning mr-2">B</div>
                                            <div>
                                                <h6 class="text-white mb-0 font-weight-bold">Bitcoin</h6>
                                                <small class="text-muted">BTC</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-white">0.00000000</td>
                                    <td class="text-white">0.00000000</td>
                                    <td>0.00000000</td>
                                    <td class="text-right">
                                        <a href="#" class="text-primary mr-3 small font-weight-bold">Deposit</a>
                                        <a href="#" class="text-primary mr-3 small font-weight-bold">Withdraw</a>
                                        <a href="{{ route('spot.trade') }}" class="text-primary small font-weight-bold">Trade</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .wallet-menu .list-group-item { color: #8898aa; transition: all 0.2s; }
        .wallet-menu .list-group-item:hover { background: rgba(255,255,255,0.02) !important; color: #fff; }
        .wallet-menu .list-group-item.active { background: rgba(21, 114, 232, 0.1) !important; color: #1572e8; }
        .wallet-menu .list-group-item i { font-size: 1.2rem; width: 25px; }
        .table-dark-custom thead th { background: #0d1117; border: 0; text-transform: uppercase; font-size: 0.75rem; color: #8898aa; padding: 1.25rem 1.5rem; }
        .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.05); padding: 1.25rem 1.5rem; vertical-align: middle; color: #8898aa; }
        .coin-icon { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #fff; }
        .badge-soft-light { background: rgba(255,255,255,0.1); }
        .btn-outline-white { border-color: #fff; color: #fff; }
        .btn-outline-white:hover { background: #fff; color: #1572e8; }
    </style>
@endsection
