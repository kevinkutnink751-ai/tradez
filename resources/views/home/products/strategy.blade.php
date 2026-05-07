@extends('layouts.base')
@section('title', 'Institutional Strategy Marketplace')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Strategy Marketplace</h1>
                    <p class="lead text-muted mb-5 max-width-700">The ultimate hub for algorithmic and manual trading strategies. Rent, purchase, or subscribe to high-performance quantitative systems vetted by our risk committee.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Explore Strategies</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">Become a Strategy Provider</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="p-4 rounded border shadow-lg" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <div class="d-flex justify-content-between mb-4">
                            <h6 class="text-uppercase text-muted small">Top Quant performance</h6>
                            <span class="badge badge-success px-2 py-1">Verified Live Data</span>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Alpha-Quant V2 (FX)</span>
                                <span class="text-success font-weight-bold">+24.5% (30D)</span>
                            </div>
                            <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                                <div class="progress-bar bg-success" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Volatility-Hedge X (Options)</span>
                                <span class="text-success font-weight-bold">+12.8% (30D)</span>
                            </div>
                            <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                                <div class="progress-bar bg-success" style="width: 60%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="font-weight-bold" style="color:#000;">How the Marketplace Works</h2>
                <p class="text-muted">A secure, transparent bridge between quant developers and capital allocators.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 bg-dark-custom  rounded-md shadow-sm border">
                        <div style="width: 50px; height: 50px; background: var(--inst-accent); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 25px; font-size: 1.2rem;">1</div>
                        <h5 class="font-weight-bold text-white" >Browse & Filter</h5>
                        <p class="text-muted small mb-0">Access thousands of verified strategies. Filter by asset class, risk tolerance, drawdown limits, and Sharpe Ratio to find your perfect match.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 bg-dark-custom  rounded-md shadow-sm border">
                        <div style="width: 50px; height: 50px; background: var(--inst-accent); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 25px; font-size: 1.2rem;">2</div>
                        <h5 class="font-weight-bold text-white" >Connect & Subscribe</h5>
                        <p class="text-muted small mb-0">Select a subscription model (Monthly Rent or Profit Share). Connect the strategy to your trading sub-account with one click.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 bg-dark-custom  rounded-md shadow-sm border">
                        <div style="width: 50px; height: 50px; background: var(--inst-accent); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 25px; font-size: 1.2rem;">3</div>
                        <h5 class="font-weight-bold text-white" >Monitor & Scale</h5>
                        <p class="text-muted small mb-0">Track performance in real-time through our analytics dashboard. Adjust your capital allocation or swap strategies at any time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Monetize Your Edge -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold text-white">Monetize Your Trading Edge</h2>
                    <p class="text-muted mb-4">Are you a successful trader or developer? Scale your income by becoming a Strategy Provider. Our platform provides the infrastructure, you provide the signals.</p>
                    <ul class="list-unstyled mb-5">
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-primary mr-2"></i> Reach a global audience of institutional and retail investors.</li>
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-primary mr-2"></i> Retain full control over your proprietary code; signals are mirrored via API.</li>
                        <li class="mb-3 text-muted small"><i class="mdi mdi-check-circle text-primary mr-2"></i> Automated billing and commission settlement in USDT/Fiat.</li>
                    </ul>
                    <a href="{{ url('/register') }}" class="btn btn-outline-primary btn-lg px-5">Apply as Provider</a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-5 border rounded text-center shadow-lg" style="background: rgba(255,255,255,0.02); border-color: var(--inst-accent) !important;">
                        <h4 class="mb-4 text-primary font-weight-bold">Built-in IP Protection</h4>
                        <p class="text-muted small mb-0">Your algorithm never leaves your server. We connect via our encrypted bridge, ensuring your proprietary logic remains 100% confidential while investors benefit from the resulting execution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Selection Grid -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="font-weight-bold" style="color:#000;">Quant Categories</h2>
                    <p class="text-muted">Explore strategies across different market regimes.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 bg-dark-custom  rounded-md border shadow-sm">
                        <i class="mdi mdi-trending-up h1 text-primary mb-3 d-block"></i>
                        <h6 class="font-weight-bold text-white" >Trend Following</h6>
                        <p class="small text-muted mb-0">Captures massive directional moves in FX and Commodities using momentum indicators.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 bg-dark-custom  rounded-md border shadow-sm">
                        <i class="mdi mdi-swap-horizontal h1 text-primary mb-3 d-block"></i>
                        <h6 class="font-weight-bold text-white" >Mean Reversion</h6>
                        <p class="small text-muted mb-0">Identifies overbought/oversold conditions for short-term statistical corrections.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 bg-dark-custom  rounded-md border shadow-sm">
                        <i class="mdi mdi-clock-fast h1 text-primary mb-3 d-block"></i>
                        <h6 class="font-weight-bold text-white" >HFT & Scalping</h6>
                        <p class="small text-muted mb-0">Ultra-fast systems exploiting micro-inefficiencies in market liquidity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.partials.our-values')
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
