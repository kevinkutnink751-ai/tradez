@extends('layouts.base')
@section('title', 'Institutional Digital Options')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 90% 10%, rgba(252, 213, 53, 0.05) 0%, transparent 50%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .yield-box { border-left: 3px solid var(--inst-accent); background: rgba(252, 213, 53, 0.03); padding: 25px; margin-top: 30px; }
    </style>
@endsection

@section('content')
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Binary Options</h1>
                    <p class="lead text-muted mb-5">High-velocity digital options for the modern era. Trade on fixed-time price movements across Forex, Commodities, and Indices with transparent payouts and capped risk.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Open Trading Room</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">View Asset Payouts</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <h6 class="text-uppercase text-muted small mb-4">Live Payouts</h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span class="text-muted">EUR/USD (60s)</span>
                            <span class="text-success font-weight-bold">88%</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span class="text-muted">BTC/USD (5m)</span>
                            <span class="text-success font-weight-bold">82%</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Gold (15m)</span>
                            <span class="text-success font-weight-bold">91%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">Binary Precision</h2>
                    <p class="text-muted mb-4">Binary trading (Digital Options) is a high-velocity investment method where the outcome is based on a simple "Yes/No" proposition: Will the price of an asset be above or below a certain point at a specific time?</p>
                    <p class="text-muted small">Unlike traditional options, binary contracts offer a fixed payout and a fixed loss, allowing for precise capital allocation and risk management from the moment you enter the trade.</p>
                    
                    <div class="yield-box shadow-sm">
                        <h6 class="text-white font-weight-bold">Professional Payouts</h6>
                        <p class="small text-muted mb-0">Our proprietary pricing engine offers some of the most competitive yields in the industry, ranging from 75% up to 95% depending on market volatility and asset class.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="feature-card text-center shadow-sm">
                                <i class="mdi mdi-timer-outline h1 text-warning mb-3 d-block"></i>
                                <h6 class="text-white">Fixed Timeframes</h6>
                                <p class="small text-muted mb-0">Contracts ranging from 60 seconds to end-of-day expirations.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="feature-card text-center shadow-sm">
                                <i class="mdi mdi-shield-check-outline h1 text-warning mb-3 d-block"></i>
                                <h6 class="text-white">Capped Risk</h6>
                                <p class="small text-muted mb-0">You can never lose more than your initial investment on any single trade.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card text-center shadow-sm">
                                <i class="mdi mdi-globe-model h1 text-warning mb-3 d-block"></i>
                                <h6 class="text-white">Global Assets</h6>
                                <p class="small text-muted mb-0">Trade across 100+ global assets including FX pairs, metals, and indices.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card text-center shadow-sm">
                                <i class="mdi mdi-chart-line h1 text-warning mb-3 d-block"></i>
                                <h6 class="text-white">Live Charts</h6>
                                <p class="small text-muted mb-0">Institutional-grade charting with real-time price feeds.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prediction Room Section -->
    <section class="section bg-inst-gradient border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="font-weight-bold mb-4">Real-Time Prediction Room</h2>
                    <p class="text-muted mb-4">Execute high-speed trades with absolute precision. Our proprietary trading room ensures sub-millisecond strike entries, preventing slippage on short-term contracts.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Fixed expiration timers</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> One-click HIGH/LOW execution</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time payout calculation</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1">
                    @include('components.illustrations.binary-timer')
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-mesh">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold">Ready to Trade with Precision?</h2>
                <p class="text-muted mb-5 max-width-700 mx-auto">Access the most intuitive binary trading room with instant execution and transparent yields.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-lg">Start Trading Now</a>
            </div>
        </div>
    </section>
@endsection
