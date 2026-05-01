@extends('layouts.base')
@section('title', 'Institutional Spot Trading')
@section('styles')
    @parent
    <style>
            :root {
            --inst-bg: #0B0E11;
            --inst-bg-sec: #161A1E;
            --inst-border: #2B3139;
            --inst-text: #EAECEF;
            --inst-text-muted: #848E9C;
            --inst-accent: #FCD535;
        }
        body { background-color: var(--inst-bg) !important; color: var(--inst-text) !important; }
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 20% 80%, rgba(252, 213, 53, 0.05) 0%, transparent 50%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .symbol-tag { background: rgba(252, 213, 53, 0.1); color: var(--inst-accent); padding: 4px 12px; border-radius: 20px; font-size: 11px; margin: 4px; display: inline-block; border: 1px solid rgba(252, 213, 53, 0.2); }
    </style>
@endsection

@section('content')
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Spot Trading</h1>
                    <p class="lead text-muted mb-5">Buy and sell assets for immediate delivery. Access deep liquidity pools across global exchanges with institutional-grade execution speeds and zero-interest custody.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3">Open Spot Account</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Live Orderbook</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    @include('components.illustrations.orderbook', ['pair' => 'BTC/USDT', 'price' => '64,231.50', 'high' => '65,120.00', 'low' => '62,890.00', 'vol' => '1.2B'])
                </div>
            </div>
        </div>
    </section>

    <!-- Why Spot? -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-cash-fast h2 text-warning mb-4 d-block"></i>
                        <h5>Instant Ownership</h5>
                        <p class="text-muted small mb-0">Unlike derivatives, spot trading results in the immediate exchange of ownership. Your assets are credited to your balance instantly upon execution.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-shield-check h2 text-warning mb-4 d-block"></i>
                        <h5>Institutional Custody</h5>
                        <p class="text-muted small mb-0">Your spot assets are held in segregated cold-storage environments, protected by multi-signature protocols and comprehensive insurance coverage.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-percent h2 text-warning mb-4 d-block"></i>
                        <h5>Low-Fee Execution</h5>
                        <p class="text-muted small mb-0">Enjoy competitive maker/taker fees starting at 0.01%. No overnight funding rates or hidden maintenance costs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Asset Universe -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Global Asset Universe</h2>
                    <p class="text-muted mb-4">Access over 500+ spot assets across multiple markets from a single institutional interface. No need for multiple brokerages.</p>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-bitcoin text-warning mr-3 h4 mb-0"></i>
                                <span>Cryptocurrencies</span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-currency-usd text-warning mr-3 h4 mb-0"></i>
                                <span>Forex Majors</span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-pickaxe text-warning mr-3 h4 mb-0"></i>
                                <span>Precious Metals</span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-factory text-warning mr-3 h4 mb-0"></i>
                                <span>Global Equities</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm text-muted mb-0">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th>Asset</th>
                                        <th>Bid</th>
                                        <th>Ask</th>
                                        <th class="text-right">24H Vol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td class="text-white">64,231.5</td>
                                        <td class="text-white">64,232.1</td>
                                        <td class="text-right">$4.2B</td>
                                    </tr>
                                    <tr>
                                        <td>Ethereum</td>
                                        <td class="text-white">3,421.2</td>
                                        <td class="text-white">3,421.8</td>
                                        <td class="text-right">$1.8B</td>
                                    </tr>
                                    <tr>
                                        <td>Gold (oz)</td>
                                        <td class="text-white">2,152.0</td>
                                        <td class="text-white">2,152.5</td>
                                        <td class="text-right">$240M</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deep Liquidity Section -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="font-weight-bold mb-4">Deep Liquidity Orderbook</h2>
                    <p class="text-muted mb-4">Experience institutional-grade depth. Our smart order routing (SOR) system aggregates liquidity from top-tier exchanges to ensure minimal slippage on large orders.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Sub-millisecond order matching</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> 99.9% Fill rate on market orders</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Direct Market Access (DMA) protocol</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    @include('components.illustrations.orderbook')
                </div>
            </div>
        </div>
    </section>

    <!-- Start Trading Step -->
    <section class="section bg-inst-gradient">
        <div class="container text-center">
            <h2 class="mb-5">How to Start Spot Trading</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h4 class="text-warning">01</h4>
                    <h6 class="text-white">Register</h6>
                    <p class="small text-muted">Create your institutional account in minutes.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h4 class="text-warning">02</h4>
                    <h6 class="text-white">Verify</h6>
                    <p class="small text-muted">Complete our fast-track KYC/AML protocol.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h4 class="text-warning">03</h4>
                    <h6 class="text-white">Deposit</h6>
                    <p class="small text-muted">Fund your wallet with USDT or bank transfer.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h4 class="text-warning">04</h4>
                    <h6 class="text-white">Execute</h6>
                    <p class="small text-muted">Start buying assets with one-click execution.</p>
                </div>
            </div>
            <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 mt-5 shadow-lg">Start Trading Now</a>
        </div>
    </section>
@endsection
