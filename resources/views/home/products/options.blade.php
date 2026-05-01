@extends('layouts.base')
@section('title', 'Leveraged Options Trading')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 10% 20%, rgba(252, 213, 53, 0.05) 0%, transparent 50%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .strategy-badge { background: #2B3139; color: var(--inst-accent); padding: 5px 15px; border-radius: 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; display: inline-block; }
        .spread-box { border-left: 2px solid var(--inst-accent); background: rgba(252, 213, 53, 0.02); padding: 25px; margin-top: 30px; }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Options Trading</h1>
                    <p class="lead text-muted mb-5">Move beyond 'Buy and Hold'. Utilize advanced option spreads and leveraged writing strategies to capture short-term gains in any market direction.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Trade Options</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Options Education</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <h6 class="text-uppercase text-muted small mb-4">Market Execution</h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span>Execution Latency</span>
                            <span class="text-warning font-weight-bold">< 0.08s</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span>Writing Capacity</span>
                            <span class="text-success font-weight-bold">Unlimited</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Risk Threshold</span>
                            <span class="text-info font-weight-bold">Customizable</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Investing Styles -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">Active vs. Passive Investing</h2>
                    <p class="text-muted mb-4">When most people think of investment, they think of buying stocks and holding them for long-term gains. This 'buy and hold' strategy is sensible but doesn't provide much in the way of short-term returns.</p>
                    <p class="text-muted mb-4 small">Many investors today are choosing a more active style. With our institutional interface, you can make transactions with just a few clicks, taking advantage of shorter-term price fluctuations.</p>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 bg-inst-secondary border border-secondary rounded shadow-lg">
                        <h5 class="mb-4 text-warning font-weight-bold">The Power of Option Spreads</h5>
                        <p class="small text-muted mb-4">What really makes options interesting is the ability to create spreads. A spread is when you enter a position on two or more options contracts based on the same underlying security.</p>
                        <div class="spread-box shadow-sm">
                            <h6 class="text-white mb-2 font-weight-bold">Limit Risk & Reduce Outlay</h6>
                            <p class="small text-muted mb-0">Spreads are seriously powerful tools used to either limit the risk involved with taking a position or reduce the financial outlay required.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Selling & Writing -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">Selling & Writing Options</h2>
                    <p class="text-muted mb-4">There are basically two ways in which you can sell options contracts: closing a position or opening a short position.</p>
                    <div class="mb-4 p-3 bg-inst-dark rounded border border-secondary shadow-sm">
                        <h6 class="text-white font-weight-bold">Sell to Close</h6>
                        <p class="small text-muted mb-0">Used when you have previously bought contracts and wish to realize your profits or cut your losses. You are closing your existing position.</p>
                    </div>
                    <div class="mb-0 p-3 bg-inst-dark rounded border border-secondary shadow-sm">
                        <h6 class="text-white font-weight-bold">Sell to Open (Writing)</h6>
                        <p class="small text-muted mb-0">Opening a short position by writing new contracts. As the writer, you take on the obligation to either sell (Call) or buy (Put) the underlying security at the strike price.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="feature-card shadow-sm">
                                <span class="strategy-badge">Yield</span>
                                <h6 class="text-white">Income Generation</h6>
                                <p class="small text-muted mb-0">Writing options involves receiving a payment (premium) at the time of placing the order. It is a key tool for professional income generation.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="feature-card shadow-sm">
                                <span class="strategy-badge">Hedge</span>
                                <h6 class="text-white">Risk Obligation</h6>
                                <p class="small text-muted mb-0">While riskier than simple buying, writing is highly profitable if you believe the underlying security won't move against your strike.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="feature-card border-warning shadow-sm">
                                <h6 class="text-warning mb-3 font-weight-bold">Transparency & Trust</h6>
                                <p class="small text-muted mb-0">We believe in open and honest communication. All trading performance, strategies, and fees are clearly disclosed so you can trade with full confidence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payoff Visualizer Section -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="font-weight-bold mb-4">Multi-Leg Strategy Modeling</h2>
                    <p class="text-muted mb-4">Visualize your risk and reward before committing capital. Our built-in payoff modeler allows you to construct complex spreads and analyze break-even points instantly.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Support for Iron Condors, Straddles, and more</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Dynamic P/L charting</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time implied volatility data</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    @include('components.illustrations.payoff-chart')
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-stripe">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold">Master Your Options Strategy</h2>
                <p class="text-muted mb-5 max-width-700 mx-auto">Access institutional-grade tools for active trading, multi-leg spreads, and leveraged income generation.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-lg">Open Institutional Account</a>
            </div>
        </div>
    </section>
@endsection
