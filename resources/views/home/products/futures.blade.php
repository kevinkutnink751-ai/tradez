@extends('layouts.base')
@section('title', 'Institutional Futures Trading')
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
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 50% 50%, rgba(252, 213, 53, 0.05) 0%, transparent 70%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .spec-item { border-left: 2px solid var(--inst-accent); padding: 15px 20px; margin-bottom: 20px; background: rgba(252, 213, 53, 0.02); }
        .risk-highlight { background: rgba(246, 70, 93, 0.05); border: 1px solid rgba(246, 70, 93, 0.2); padding: 25px; border-radius: 4px; }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h1 class="display-4 font-weight-bold mb-4">Futures Contracts</h1>
                    <p class="lead text-muted mb-5">Futures are derivative contracts to buy or sell an asset at a future date at an agreed-upon price. Access high-leverage commodities, bonds, and digital assets.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Start Trading</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">View Margin Specs</a>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    @include('components.trading-terminal-illustration', ['pair' => 'OIL/WTI', 'price' => '81.15', 'high' => '82.40', 'low' => '80.05', 'vol' => '450M'])
                </div>
            </div>
        </div>
    </section>

    <!-- Investing & Strategy -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center mb-5 pb-5 border-bottom border-secondary">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold">Stock & Commodity Futures</h2>
                    <p class="text-muted mb-4">Commodities represent a big part of the futures-trading world. Stock futures investing lets you trade futures of individual companies and shares of ETFs. Contracts also exist for bonds and even bitcoin.</p>
                    <p class="text-muted mb-4 small">Some traders like trading futures because they can take a substantial position while putting up a relatively small amount of cash. This gives them greater potential for leverage than just owning the securities directly.</p>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="text-white mb-2 font-weight-bold">Short-Selling & Hedging</h6>
                            <p class="small text-muted">Someone wanting to hedge exposure to stocks may short-sell a futures contract on the Standard & Poor’s 500. If stocks fall, they make money on the short, balancing out their exposure to the index.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 bg-inst-secondary border border-secondary rounded shadow-lg">
                        <h5 class="mb-4 text-warning font-weight-bold">Standardized Parameters</h5>
                        <div class="spec-item shadow-sm">
                            <h6 class="text-white mb-1">Unit of Measurement</h6>
                            <p class="small text-muted mb-0">Specific quantity of the underlying asset per contract.</p>
                        </div>
                        <div class="spec-item shadow-sm">
                            <h6 class="text-white mb-1">Settlement Method</h6>
                            <p class="small text-muted mb-0">Either physical delivery of goods or cash settlement.</p>
                        </div>
                        <div class="spec-item shadow-sm" style="margin-bottom: 0;">
                            <h6 class="text-white mb-1">Currency & Quality</h6>
                            <p class="small text-muted mb-0">Quoted currency and grade considerations (e.g. octane or purity).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Risk & Leverage -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="risk-highlight shadow-lg bg-inst-dark border-danger">
                        <h3 class="text-danger mb-4 font-weight-bold">Margin & Leverage Risks</h3>
                        <p class="text-muted mb-4 small">Many speculators borrow a substantial amount of money to play the futures market because it’s the main way to magnify relatively small price movements to potentially create profits.</p>
                        <p class="text-muted mb-4 small">But borrowing money also increases risk: If markets move against you, you could lose more money than you invested. Futures are complex and volatile.</p>
                        <div class="p-4 bg-dark rounded border border-danger">
                            <p class="small text-danger mb-0 font-weight-bold">"A 5% change in prices can cause an investor leveraged 10:1 to gain or lose 50 percent of their investment."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="feature-card shadow-sm">
                                <h6 class="text-white mb-3">10:1 / 20:1 Leverage</h6>
                                <p class="small text-muted mb-0">Leverage and margin rules are significantly more liberal in the futures world compared to standard securities.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="feature-card shadow-sm">
                                <h6 class="text-white mb-3">Volatility Discipline</h6>
                                <p class="small text-muted mb-0">Speculators need the discipline to avoid overexposing themselves to undue risk during volatile periods.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="feature-card border-warning shadow-sm">
                                <h6 class="text-warning mb-3 font-weight-bold">Transparency & Security</h6>
                                <p class="small text-muted mb-0">Our platform is built with robust security measures and a commitment to safeguarding users' funds. All performance and fees are clearly disclosed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leverage Calculator Section -->
    <section class="section bg-inst-gradient border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="font-weight-bold mb-4">Precision Margin Control</h2>
                    <p class="text-muted mb-4">Master your risk-to-reward ratio with our dynamic margin calculator. Visualize potential profits and liquidation thresholds before entering a position.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time margin requirement updates</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Tiered liquidation protocols</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Cross and Isolated margin modes</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1">
                    @include('components.illustrations.leverage-calc')
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section bg-inst-stripe">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold">Ready to Hedge or Speculate?</h2>
                <p class="text-muted mb-5 max-width-700 mx-auto">Access the world's most liquid derivatives markets with institutional-grade margin requirements.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-lg">Open Institutional Account</a>
            </div>
        </div>
    </section>
@endsection
