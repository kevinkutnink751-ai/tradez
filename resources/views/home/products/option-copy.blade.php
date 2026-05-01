@extends('layouts.base')
@section('title', 'Option Copy Trading')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 20% 30%, rgba(252, 213, 53, 0.05) 0%, transparent 50%); }
        .section { padding: 80px 0 !important; background-color: var(--inst-bg) !important; }
        .bg-light { background-color: var(--inst-bg-sec) !important; }
        .feature-box { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-box:hover { border-color: var(--inst-accent); }
        .feature-icon { font-size: 32px; color: var(--inst-accent); margin-bottom: 20px; display: block; }
        .info-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; height: 100%; }
        .pros-cons-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; }
        .risk-warning-box { background: rgba(246, 70, 93, 0.1); border-left: 4px solid #f6465d; padding: 20px; border-radius: 4px; }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="product-hero border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Option Copy Trading</h1>
                    <p class="lead text-muted mb-5">Mirror the positions of seasoned veterans using advanced automated tools and real-time execution signals. Since 2014, we've pioneered the social mirroring model.</p>
                    <div class="d-flex">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5">Start Mirroring</a>
                        <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg">View Master Directory</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-4 bg-light rounded border border-secondary shadow-lg">
                        <h6 class="text-uppercase text-muted small mb-4">Network Activity: <span class="text-success">Live</span></h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span>Signals Replicated</span>
                            <span class="text-warning font-weight-bold">12.4M+</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <span>Copy Accuracy</span>
                            <span class="text-info font-weight-bold">99.98%</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Latency Index</span>
                            <span class="text-success font-weight-bold">< 0.05s</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Definition -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4">What is Copy Trading?</h2>
                    <p class="text-muted mb-4">Copy trading is a type of trading where you replicate the trades performed by another, more experienced trader. It can be manual, semi-automatic, or fully automatic.</p>
                    <p class="text-muted mb-4">Our platform allows individuals to automatically copy another trader’s positions when they are opened or closed. Experienced traders communicate their positions using signals via social networks or forums, where followers can copy the methods with a single click.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2"><i class="mdi mdi-check text-success mr-2"></i> Forex Markets</li>
                                <li class="mb-2"><i class="mdi mdi-check text-success mr-2"></i> Blue Chip Stocks</li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2"><i class="mdi mdi-check text-success mr-2"></i> High-Liquidity CFDs</li>
                                <li class="mb-2"><i class="mdi mdi-check text-success mr-2"></i> Crypto (BTC, ETH)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-card border-warning">
                        <h5 class="text-warning mb-3">Wealth Building Philosophy</h5>
                        <p class="text-muted small mb-4">Copy trading can be a good way to earn a profit, but it is important to understand that you will not become rich overnight. If you use copy trading to build wealth slowly and disciplined, you will have a fair chance of reaching institutional-grade portfolio returns in due time.</p>
                        <a href="{{ url('/register') }}" class="btn btn-warning btn-sm px-4">Open Copy Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pros and Cons -->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="pros-cons-card h-100">
                        <h4 class="text-success mb-4">The Advantages</h4>
                        <div class="mb-4">
                            <h6 class="text-white">Authorised Practice</h6>
                            <p class="small text-muted">Copy trading is generally recognised by key regulatory frameworks, including CySEC, ESMA, MiFID and the FCA. We ensure your funds are never exposed to unregulated scams.</p>
                        </div>
                        <div>
                            <h6 class="text-white">Portfolio Diversification</h6>
                            <p class="small text-muted">Gain exposure to opportunities or trends that you wouldn’t usually consider without the help of another trader’s specific expertise.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="pros-cons-card h-100">
                        <h4 class="text-danger mb-4">The Risks</h4>
                        <div class="mb-4">
                            <h6 class="text-white">Execution Risk</h6>
                            <p class="small text-muted">Even with experienced traders, if a strategy is unsuccessful, the risk translates directly onto your account. No profit is guaranteed.</p>
                        </div>
                        <div>
                            <h6 class="text-white">Lack of Control</h6>
                            <p class="small text-muted">You are essentially entrusting your portfolio to a stranger's decision-making. We provide tools to mitigate this, but the risk remains inherent.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Risk Management -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Strategic Risk Management</h2>
                    <p class="text-muted mb-4">All types of trading are associated with risk. Never invest money you cannot afford to lose. We believe in providing you with the data needed to make informed choices.</p>
                    <div class="mb-4">
                        <h6 class="text-white">Audit the History</h6>
                        <p class="small text-muted">Many platforms give you a risk indicator, but we recommend manually inspecting trade history to see if you feel comfortable with their strategies.</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-white">The Diversification Rule</h6>
                        <p class="small text-muted">A common beginner’s mistake is only copying one trader. All traders can produce periods of poor returns. Split your money and follow more than one master trader to reduce volatility.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="risk-warning-box">
                        <h5 class="text-danger mb-3">Risk Warning</h5>
                        <p class="small text-muted mb-0">CFDs and Options are complex instruments and come with a high risk of losing money rapidly due to leverage. You should consider copying a Master Trader who understands these risks without over-exposing your capital.</p>
                    </div>
                    <div class="mt-4 p-4 border border-secondary rounded">
                        <h6 class="text-white mb-2">Transparency & Trust</h6>
                        <p class="small text-muted mb-0">We believe in open communication. All performance, strategies, and fees are clearly disclosed so you can make informed decisions with full confidence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Start Copying?</h2>
            <p class="text-muted mb-5 max-width-700 mx-auto">Join thousands of users who have automated their wealth creation through our social mirroring technology.</p>
            <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold">Open Institutional Copy Account</a>
        </div>
    </section>
@endsection
