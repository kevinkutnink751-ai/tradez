@extends('layouts.base')
@section('title', 'Forex Trading')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 80% 20%, rgba(252, 213, 53, 0.05) 0%, transparent 50%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
    </style>
@endsection

@section('content')
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Forex Trading</h1>
                    <p class="lead text-muted mb-5">Trade the world's most liquid market. Access 100+ major, minor, and exotic currency pairs with raw spreads and lightning-fast execution.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Start FX Trading</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Spreads</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <h6 class="text-uppercase text-muted small mb-4">Live Currency Rates</h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span class="text-muted">EUR/USD</span>
                            <div class="text-right">
                                <span class="text-success font-weight-bold d-block">1.0842</span>
                                <span class="small text-muted">+0.05%</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span class="text-muted">GBP/USD</span>
                            <div class="text-right">
                                <span class="text-danger font-weight-bold d-block">1.2650</span>
                                <span class="small text-muted">-0.12%</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">USD/JPY</span>
                            <div class="text-right">
                                <span class="text-success font-weight-bold d-block">151.24</span>
                                <span class="small text-muted">+0.22%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">Why Trade Forex with Us?</h2>
                    <p class="text-muted mb-4">The Foreign Exchange market is the largest financial market in the world, with over $6 trillion traded daily. We provide the institutional bridge you need to capitalize on global macroeconomic shifts.</p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="text-white font-weight-bold">Raw Spreads</h6>
                            <p class="small text-muted">Direct access to interbank liquidity ensuring spreads as low as 0.0 pips on major pairs.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="text-white font-weight-bold">High Leverage</h6>
                            <p class="small text-muted">Capitalize on small price movements with flexible leverage options up to 1:500.</p>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h6 class="text-white font-weight-bold">No Requotes</h6>
                            <p class="small text-muted">Our NDD (No Dealing Desk) model ensures your orders are filled instantly at the best market price.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-white font-weight-bold">24/5 Trading</h6>
                            <p class="small text-muted">Markets are open around the clock from Sunday evening to Friday night.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 border border-secondary rounded bg-inst-secondary shadow-lg">
                        <h5 class="mb-4 font-weight-bold text-warning">Global Reach</h5>
                        <p class="text-muted small">We bridge the gap between retail traders and the global banking network, providing the tools traditionally reserved for hedge funds.</p>
                        <div class="mt-4 p-4 bg-inst-dark rounded border border-secondary">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 small text-muted"><i class="mdi mdi-circle-medium text-warning mr-2"></i> NY4/LD5 Data Center Cross-Connects</li>
                                <li class="mb-3 small text-muted"><i class="mdi mdi-circle-medium text-warning mr-2"></i> Tier-1 Bank Liquidity</li>
                                <li class="small text-muted"><i class="mdi mdi-circle-medium text-warning mr-2"></i> Advanced Slippage Protection</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Sessions Section -->
    <section class="section bg-inst-gradient border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="font-weight-bold mb-4">Capitalize on Market Overlaps</h2>
                    <p class="text-muted mb-4">The FX market never sleeps. Our platform provides real-time heatmaps and session volume trackers so you know exactly when volatility and liquidity are peaking across global centers.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time session volume profiling</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Automated volatility alerts</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Custom trading hours configuration</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1">
                    @include('components.illustrations.forex-sessions')
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-mesh">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold text-white">Dominate the FX Market</h2>
                <p class="text-muted mb-5 max-width-700 mx-auto">Access 100+ major and exotic pairs with institutional execution and zero dealing desk intervention.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-lg">Start Trading Now</a>
            </div>
        </div>
    </section>
@endsection
