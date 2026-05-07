@extends('layouts.base')
@section('title', 'Expert Mirroring')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Expert Mirroring</h1>
                    <p class="lead text-muted mb-5 max-width-700">Go beyond basic copy trading. Sync your portfolio with institutional-grade signal providers and hedge fund managers in real-time with sub-50ms execution.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('masterAccount') }}" class="btn btn-primary text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Browse Master Accounts</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Apply as Provider</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="p-5 rounded border shadow-lg text-center" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h2 class="text-primary mb-2 font-weight-bold">94.2%</h2>
                        <p class="text-muted small mb-4">Average Consistency Rating of Tier-1 Providers</p>
                        <div class="progress mb-3" style="height: 6px; background: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-primary" style="width: 94%;"></div>
                        </div>
                        <span class="small text-muted">Audited Performance Metrics</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mirroring Modes -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="font-weight-bold" style="color:#000;">Two Ways to Mirror</h2>
                <p class="text-muted">Choose the level of control that fits your investment style.</p>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex mb-4 " data-aos="fade-right">
                    <div class="p-5 bg-dark-custom rounded-md shadow-sm border">
                        <h4 class="mb-3 font-weight-bold text-white" >Autonomous Mirroring</h4>
                        <p class="text-muted small">The system replicates all trades automatically in real-time. Ideal for passive investors who want professional management without checking screens.</p>
                        <ul class="list-unstyled mt-4 small text-muted">
                            <li class="mb-2"><i class="mdi mdi-check text-muted mr-2"></i> 100% Hands-free execution</li>
                            <li class="mb-2"><i class="mdi mdi-check text-muted mr-2"></i> Instant synchronization</li>
                            <li><i class="mdi mdi-check text-muted mr-2"></i> 24/5 Automated monitoring</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-flex mb-4" data-aos="fade-left">
                    <div class="p-5 bg-dark-custom rounded-md shadow-sm border">
                        <h4 class="mb-3 font-weight-bold text-white">Semi-Manual Mirroring</h4>
                        <p class="text-muted small">Receive signals via push notifications. You review each trade setup and decide whether to approve or reject the replication.</p>
                        <ul class="list-unstyled mt-4 small text-muted">
                            <li class="mb-2"><i class="mdi mdi-check text-muted mr-2"></i> Full control over every trade</li>
                            <li class="mb-2"><i class="mdi mdi-check text-muted mr-2"></i> One-tap approval via mobile app</li>
                            <li><i class="mdi mdi-check text-muted mr-2"></i> Customizable position sizing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaderboard Section -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2" data-aos="fade-left">
                    <h2 class="font-weight-bold mb-4 text-white">Track the Elite</h2>
                    <p class="text-muted mb-4">Our live master leaderboard ranks providers based on strict performance criteria including ROI, maximum drawdown, and risk-adjusted returns (Sharpe Ratio).</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-primary mr-2"></i> Only verified real-money accounts</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-primary mr-2"></i> Transparent fee structures</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-primary mr-2"></i> Detailed historical trade logs</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1" data-aos="fade-right">
                    @include('components.illustrations.mirror-leaderboard')
                </div>
            </div>
        </div>
    </section>


    <!-- Safety & Controls -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold" style="color:#000;">Institutional Safety Controls</h2>
                    <p class="text-muted mb-4">Delegating your portfolio doesn't mean giving up control. Our platform includes built-in circuit breakers to protect your capital.</p>
                    <div class="p-4 bg-white rounded border mb-4 shadow-sm">
                        <h6 class="font-weight-bold" style="color:#000;"><i class="mdi mdi-shield-lock text-primary mr-2"></i> Equity Protection</h6>
                        <p class="small text-muted mb-0">Set an "Equity Guard" level. If your account equity drops below a specific percentage, all mirrored positions close immediately.</p>
                    </div>
                    <div class="p-4 bg-white rounded border shadow-sm">
                        <h6 class="font-weight-bold" style="color:#000;"><i class="mdi mdi-alert-circle text-primary mr-2"></i> Drawdown Circuit Breaker</h6>
                        <p class="small text-muted mb-0">Automatically disconnect from a provider if their performance triggers a pre-defined maximum drawdown limit.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-5 text-center bg-dark-custom rounded border shadow-lg">
                        <i class="mdi mdi-lock-outline h1 text-white mb-4"></i>
                        <h4 class="font-weight-bold text-white">Your Funds, Your Account</h4>
                        <p class="text-muted small">We never take custody of your mirrored funds. Your capital stays in your own brokerage account. The system simply sends execution signals to your terminal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="text-center mb-5 font-weight-bold text-white" data-aos="fade-up">Mirroring FAQ</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="mb-4 border-bottom pb-3" style="border-color: rgba(255,255,255,0.1) !important;">
                        <h6 class="text-white font-weight-bold">Are there any performance fees?</h6>
                        <p class="small text-muted">Most Master Traders charge a small success fee (High-Water Mark) which is only paid when they generate a new profit for you.</p>
                    </div>
                    <div class="mb-4 border-bottom pb-3" style="border-color: rgba(255,255,255,0.1) !important;">
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

    @include('home.partials.trade-anywhere')
    @include('home.partials.achievement')
    @include('home.partials.cta')

    <!-- AOS Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: false,
                offset: 50
            });
        });
    </script>
@endsection
