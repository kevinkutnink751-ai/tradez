@extends('layouts.base')
@section('title', 'Expert Mirroring')
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
        .trader-avatar { width: 64px; height: 64px; border-radius: 50%; background: #222; border: 2px solid var(--inst-border); margin-bottom: 20px; }
        .metric-label { font-size: 10px; color: var(--inst-text-muted); text-transform: uppercase; letter-spacing: 1px; }
        .metric-val { font-size: 18px; font-weight: 700; color: var(--inst-text); }
        .win-rate { color: #0ecb81; }
    </style>
@endsection

@section('content')
    <section class="section border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Expert Mirroring</h1>
                    <p class="lead text-muted mb-5">Go beyond basic copy trading. Sync your portfolio with institutional-grade signal providers and hedge fund managers in real-time with sub-50ms execution.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('masterAccount') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3">Browse Master Accounts</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Apply as Provider</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-5 bg-inst-dark rounded border border-secondary shadow-lg text-center">
                        <h2 class="text-warning mb-2">94.2%</h2>
                        <p class="text-muted small mb-4">Average Consistency Rating of Tier-1 Providers</p>
                        <div class="progress mb-3" style="height: 6px; background: #2B3139;">
                            <div class="progress-bar bg-warning" style="width: 94%;"></div>
                        </div>
                        <span class="small text-muted">Audited Performance Metrics</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mirroring Modes -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold">Two Ways to Mirror</h2>
                <p class="text-muted">Choose the level of control that fits your investment style.</p>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="mirror-card">
                        <h4 class="mb-3">Autonomous Mirroring</h4>
                        <p class="text-muted small">The system replicates all trades automatically in real-time. Ideal for passive investors who want professional management without checking screens.</p>
                        <ul class="list-unstyled mt-4 small text-muted">
                            <li class="mb-2"><i class="mdi mdi-check text-warning mr-2"></i> 100% Hands-free execution</li>
                            <li class="mb-2"><i class="mdi mdi-check text-warning mr-2"></i> Instant synchronization</li>
                            <li><i class="mdi mdi-check text-warning mr-2"></i> 24/5 Automated monitoring</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="mirror-card">
                        <h4 class="mb-3">Semi-Manual Mirroring</h4>
                        <p class="text-muted small">Receive signals via push notifications. You review each trade setup and decide whether to approve or reject the replication.</p>
                        <ul class="list-unstyled mt-4 small text-muted">
                            <li class="mb-2"><i class="mdi mdi-check text-warning mr-2"></i> Full control over every trade</li>
                            <li class="mb-2"><i class="mdi mdi-check text-warning mr-2"></i> One-tap approval via mobile app</li>
                            <li><i class="mdi mdi-check text-warning mr-2"></i> Customizable position sizing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- Leaderboard Section -->
    <section class="section bg-inst-gradient border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="font-weight-bold mb-4">Track the Elite</h2>
                    <p class="text-muted mb-4">Our live master leaderboard ranks providers based on strict performance criteria including ROI, maximum drawdown, and risk-adjusted returns (Sharpe Ratio).</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Only verified real-money accounts</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Transparent fee structures</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Detailed historical trade logs</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1">
                    @include('components.illustrations.mirror-leaderboard')
                </div>
            </div>
        </div>
    </section>


    <!-- Safety & Controls -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="mb-4">Institutional Safety Controls</h2>
                    <p class="text-muted mb-4">Delegating your portfolio doesn't mean giving up control. Our platform includes built-in circuit breakers to protect your capital.</p>
                    <div class="p-4 bg-inst-dark rounded border border-secondary mb-4 shadow-sm">
                        <h6 class="text-white"><i class="mdi mdi-shield-lock text-warning mr-2"></i> Equity Protection</h6>
                        <p class="small text-muted mb-0">Set an "Equity Guard" level. If your account equity drops below a specific percentage, all mirrored positions close immediately.</p>
                    </div>
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-sm">
                        <h6 class="text-white"><i class="mdi mdi-alert-circle text-warning mr-2"></i> Drawdown Circuit Breaker</h6>
                        <p class="small text-muted mb-0">Automatically disconnect from a provider if their performance triggers a pre-defined maximum drawdown limit.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 text-center bg-inst-secondary rounded border border-secondary shadow-lg">
                        <i class="mdi mdi-lock-outline h1 text-warning mb-4"></i>
                        <h4 class="text-white">Your Funds, Your Account</h4>
                        <p class="text-muted small">We never take custody of your mirrored funds. Your capital stays in your own brokerage account. The system simply sends execution signals to your terminal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section bg-inst-dark">
        <div class="container">
            <h2 class="text-center mb-5 font-weight-bold">Mirroring FAQ</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mb-4 border-bottom border-secondary pb-3">
                        <h6 class="text-white font-weight-bold">Are there any performance fees?</h6>
                        <p class="small text-muted">Most Master Traders charge a small success fee (High-Water Mark) which is only paid when they generate a new profit for you.</p>
                    </div>
                    <div class="mb-4 border-bottom border-secondary pb-3">
                        <h6 class="text-white font-weight-bold">What is the minimum capital required?</h6>
                        <p class="small text-muted">While we support micro-lots, we recommend a minimum of $500 to ensure proper risk management and position scaling.</p>
                    </div>
                    <div class="mb-0">
                        <h6 class="text-white font-weight-bold">Can I stop mirroring at any time?</h6>
                        <p class="small text-muted">Yes. You can disconnect from a Master Trader instantly with a single click and close all active positions manually if needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    <!-- CTA -->
    <section class="section bg-inst-stripe">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 font-weight-bold text-white">Sync with the Best</h2>
                <p class="text-muted mb-5 lead">Join 15,000+ investors leveraging institutional expertise.</p>
                <a href="{{ route('masterAccount') }}" class="btn btn-primary btn-lg px-5 shadow-lg">View Master Leaderboard</a>
            </div>
        </div>
    </section>
@endsection
