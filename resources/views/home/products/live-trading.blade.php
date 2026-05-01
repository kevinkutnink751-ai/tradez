@extends('layouts.base')
@section('title', 'Institutional Live Trading Interface')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 80% 20%, rgba(252, 213, 53, 0.05) 0%, transparent 50%); }
        .section { padding: 80px 0 !important; background-color: var(--inst-bg) !important; }
        .bg-light { background-color: var(--inst-bg-sec) !important; }
        .terminal-box { background: #000; border: 1px solid var(--inst-border); border-radius: 4px; font-family: 'Courier New', Courier, monospace; overflow: hidden; height: 100%; }
        .terminal-header { background: var(--inst-bg-sec); padding: 10px 15px; border-bottom: 1px solid var(--inst-border); }
        .terminal-body { padding: 25px; color: #0ecb81; font-size: 13px; line-height: 1.6; }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .pillar-card { border-left: 2px solid var(--inst-accent); background: rgba(252, 213, 53, 0.02); padding: 20px; margin-bottom: 20px; }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Live Trading Interface</h1>
                    <p class="lead text-muted mb-5">Essentially, a trading platform is a software system offered through a brokerage or financial institution that lets you trade online, on your own.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Go Live Now</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Open Demo Account</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="terminal-box">
                        <div class="terminal-header d-flex justify-content-between align-items-center">
                            <span class="small text-muted">GLCT_PRO_V4.0</span>
                            <div class="d-flex">
                                <div class="rounded-circle bg-secondary mr-1" style="width: 8px; height: 8px;"></div>
                                <div class="rounded-circle bg-secondary mr-1" style="width: 8px; height: 8px;"></div>
                                <div class="rounded-circle bg-secondary" style="width: 8px; height: 8px;"></div>
                            </div>
                        </div>
                        <div class="terminal-body">
                            <div class="mb-2">> INITIALIZING MARKET_DATA_FEED...</div>
                            <div class="mb-2">> SYNCING REAL-TIME QUOTES [OK]</div>
                            <div class="mb-2">> EUR/USD: 1.0842 <span class="text-success">▲</span></div>
                            <div class="mb-2">> BTC/USD: 64,210.50 <span class="text-danger">▼</span></div>
                            <div class="mb-2">> OIL/WTI: 81.15 <span class="text-success">▲</span></div>
                            <div class="mb-0">> SYSTEM STATUS: <span class="text-success">OPTIMAL_EXECUTION</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Definition & Features -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">The Gateway to Global Markets</h2>
                    <p class="text-muted mb-4">A trading platform gives investors an online interface through which they can access various markets, place trades, monitor positions, and manage their accounts with total autonomy.</p>
                    <p class="text-muted mb-4 small">Broadly speaking, these include real-time quotes, live business feeds, instant access to financial data, technical analysis tools, and institutional research.</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-white mb-2 font-weight-bold">Commercial Platforms</h6>
                            <p class="small text-muted">Designed for day traders and retail investors with focus on ease of use.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-white mb-2 font-weight-bold">Proprietary Systems</h6>
                            <p class="small text-muted">Exclusive interfaces built for institutional-grade precision and speed.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 bg-inst-secondary rounded border border-secondary shadow-lg">
                        <h5 class="mb-4 font-weight-bold">Execution Pillars</h5>
                        <div class="pillar-card shadow-sm">
                            <h6 class="text-white mb-1">Optimal Execution</h6>
                            <p class="small text-muted mb-0">Efficient order routing to maximize entry and exit precision.</p>
                        </div>
                        <div class="pillar-card shadow-sm">
                            <h6 class="text-white mb-1">Fast & Reliable</h6>
                            <p class="small text-muted mb-0">Low-latency architecture crucial during high-volatility news events.</p>
                        </div>
                        <div class="pillar-card shadow-sm" style="margin-bottom: 0;">
                            <h6 class="text-white mb-1">Low Commissions</h6>
                            <p class="small text-muted mb-0">Maximize profits by keeping transaction costs at institutional minimums.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Importance of Live Interface -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="font-weight-bold">Master the Day Trading Discipline</h2>
                    <p class="text-muted">Why our live trading interface is essential for your success.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Trading Strategy</h5>
                        <p class="small text-muted mb-0">Build personal strategies with focused criteria for entering and exiting trades. Strategy is essential to maintain discipline.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Market Monitoring</h5>
                        <p class="small text-muted mb-0">Actively monitor price movements, trading volumes, and market news in real-time with zero-lag feeds.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Risk Management</h5>
                        <p class="small text-muted mb-0">Set stop-loss orders to automatically exit trades. Use position sizing to limit potential losses.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Evaluate Opportunities</h5>
                        <p class="small text-muted mb-0">Identify technical factors like support/resistance levels and chart patterns for high-probability setups.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Decisive Execution</h5>
                        <p class="small text-muted mb-0">Use advanced order types capitalize on short-term price movements and get the right entry prices.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card shadow-sm">
                        <h5 class="mb-3">Closing Positions</h5>
                        <p class="small text-muted mb-0">Close all positions before the end of the day to avoid overnight risks and exposure to gaps.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-stripe">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold">Ready to Access Professional Markets?</h2>
                <p class="text-muted mb-5 max-width-700 mx-auto">Join the ranks of elite day traders with a terminal designed for high-conviction execution.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-lg">Open My Trading Account</a>
            </div>
        </div>
    </section>
@endsection
