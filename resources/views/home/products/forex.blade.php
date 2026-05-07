@extends('layouts.base')
@section('title', 'Forex Trading')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Forex Trading</h1>
                    <p class="lead text-muted mb-5 max-width-700">Trade the world's most liquid market. Access 100+ major, minor, and exotic currency pairs with raw spreads and lightning-fast execution.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-warning text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Start FX Trading</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Spreads</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="p-4 rounded border shadow-lg" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h6 class="text-uppercase text-muted small mb-4">Live Currency Rates</h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">
                            <span class="text-muted">EUR/USD</span>
                            <div class="text-right">
                                <span class="text-success font-weight-bold d-block">1.0842</span>
                                <span class="small text-muted">+0.05%</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">
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

    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold" style="color: #000;">Why Trade Forex with Us?</h2>
                    <p class="text-muted mb-4">The Foreign Exchange market is the largest financial market in the world, with over $6 trillion traded daily. We provide the institutional bridge you need to capitalize on global macroeconomic shifts.</p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="font-weight-bold" style="color: #000;">Raw Spreads</h6>
                            <p class="small text-muted">Direct access to interbank liquidity ensuring spreads as low as 0.0 pips on major pairs.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="font-weight-bold" style="color: #000;">High Leverage</h6>
                            <p class="small text-muted">Capitalize on small price movements with flexible leverage options up to 1:500.</p>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h6 class="font-weight-bold" style="color: #000;">No Requotes</h6>
                            <p class="small text-muted">Our NDD (No Dealing Desk) model ensures your orders are filled instantly at the best market price.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold" style="color: #000;">24/5 Trading</h6>
                            <p class="small text-muted">Markets are open around the clock from Sunday evening to Friday night.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-5 border rounded shadow-lg bg-white" style="border-color: rgba(0,0,0,0.05) !important;">
                        <h5 class="mb-4 font-weight-bold text-warning">Global Reach</h5>
                        <p class="text-muted small">We bridge the gap between retail traders and the global banking network, providing the tools traditionally reserved for hedge funds.</p>
                        <div class="mt-4 p-4 rounded border shadow-sm bg-light">
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
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2" data-aos="fade-left">
                    <h2 class="font-weight-bold mb-4 text-white">Capitalize on Market Overlaps</h2>
                    <p class="text-muted mb-4">The FX market never sleeps. Our platform provides real-time heatmaps and session volume trackers so you know exactly when volatility and liquidity are peaking across global centers.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time session volume profiling</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Automated volatility alerts</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Custom trading hours configuration</li>
                    </ul>
                </div>
                <div class="col-lg-7 order-lg-1" data-aos="fade-right">
                    @include('components.illustrations.forex-sessions')
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
