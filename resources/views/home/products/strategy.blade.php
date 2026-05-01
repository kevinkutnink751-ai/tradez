@extends('layouts.base')
@section('title', 'Institutional Strategy Marketplace')
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
        .page-header { padding: 120px 0 60px 0; background: var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .section { padding: 100px 0 !important; background-color: var(--inst-bg) !important; }
        .trader-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); border-radius: 4px; padding: 30px; transition: all 0.3s; }
        .trader-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); }
        .step-num { width: 40px; height: 40px; background: var(--inst-accent); color: #000; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 20px; }
    </style>
@endsection

@section('content')
    <section class="section border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Strategy Marketplace</h1>
                    <p class="lead text-muted mb-5">The ultimate hub for algorithmic and manual trading strategies. Rent, purchase, or subscribe to high-performance quantitative systems vetted by our risk committee.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3">Explore Strategies</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">Become a Strategy Provider</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <div class="d-flex justify-content-between mb-4">
                            <h6 class="text-uppercase text-muted small">Top Quant performance</h6>
                            <span class="badge badge-success">Verified Live Data</span>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Alpha-Quant V2 (FX)</span>
                                <span class="text-success">+24.5% (30D)</span>
                            </div>
                            <div class="progress" style="height: 4px; background: #2B3139;">
                                <div class="progress-bar bg-success" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Volatility-Hedge X (Options)</span>
                                <span class="text-success">+12.8% (30D)</span>
                            </div>
                            <div class="progress" style="height: 4px; background: #2B3139;">
                                <div class="progress-bar bg-success" style="width: 60%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold">How the Marketplace Works</h2>
                <p class="text-muted">A secure, transparent bridge between quant developers and capital allocators.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary h-100 rounded border border-secondary">
                        <div class="step-num">1</div>
                        <h5>Browse & Filter</h5>
                        <p class="text-muted small">Access thousands of verified strategies. Filter by asset class, risk tolerance, drawdown limits, and Sharpe Ratio to find your perfect match.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary h-100 rounded border border-secondary">
                        <div class="step-num">2</div>
                        <h5>Connect & Subscribe</h5>
                        <p class="text-muted small">Select a subscription model (Monthly Rent or Profit Share). Connect the strategy to your trading sub-account with one click.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary h-100 rounded border border-secondary">
                        <div class="step-num">3</div>
                        <h5>Monitor & Scale</h5>
                        <p class="text-muted small">Track performance in real-time through our analytics dashboard. Adjust your capital allocation or swap strategies at any time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Monetize Your Edge -->
    <section class="section bg-inst-mesh">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4">Monetize Your Trading Edge</h2>
                    <p class="text-muted mb-4">Are you a successful trader or developer? Scale your income by becoming a Strategy Provider. Our platform provides the infrastructure, you provide the signals.</p>
                    <ul class="list-unstyled mb-5">
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-warning mr-2"></i> Reach a global audience of institutional and retail investors.</li>
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-warning mr-2"></i> Retain full control over your proprietary code; signals are mirrored via API.</li>
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-warning mr-2"></i> Automated billing and commission settlement in USDT/Fiat.</li>
                    </ul>
                    <a href="{{ url('/register') }}" class="btn btn-outline-warning btn-lg px-5">Apply as Provider</a>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 border border-warning rounded text-center bg-inst-secondary">
                        <h4 class="mb-4 text-warning">Built-in IP Protection</h4>
                        <p class="text-muted small">Your algorithm never leaves your server. We connect via our encrypted bridge, ensuring your proprietary logic remains 100% confidential while investors benefit from the resulting execution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Selection Grid -->
    <section class="section bg-inst-dark border-top border-secondary">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold">Quant Categories</h2>
                    <p class="text-muted">Explore strategies across different market regimes.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary rounded border border-secondary shadow-sm">
                        <i class="mdi mdi-trending-up h3 text-warning mb-3 d-block"></i>
                        <h6>Trend Following</h6>
                        <p class="small text-muted mb-0">Captures massive directional moves in FX and Commodities using momentum indicators.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary rounded border border-secondary shadow-sm">
                        <i class="mdi mdi-swap-horizontal h3 text-warning mb-3 d-block"></i>
                        <h6>Mean Reversion</h6>
                        <p class="small text-muted mb-0">Identifies overbought/oversold conditions for short-term statistical corrections.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-secondary rounded border border-secondary shadow-sm">
                        <i class="mdi mdi-clock-fast h3 text-warning mb-3 d-block"></i>
                        <h6>HFT & Scalping</h6>
                        <p class="small text-muted mb-0">Ultra-fast systems exploiting micro-inefficiencies in market liquidity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-stripe">
        <div class="container">
            <div class="p-5 bg-inst-dark rounded border border-warning text-center shadow-lg">
                <h2 class="mb-4">Ready to Automate Your Portfolio?</h2>
                <p class="text-muted mb-5 lead">Join 50,000+ investors using algorithmic strategies to diversify their market exposure.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5">Get Started Today</a>
            </div>
        </div>
    </section>
@endsection
