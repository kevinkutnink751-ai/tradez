@extends('layouts.base')
@section('title', 'Institutional Crypto Spot Trading')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Crypto Spot Trading</h1>
                    <p class="lead text-muted mb-5 max-width-700">Buy and sell digital assets with deep liquidity and institutional-grade security. Access the world's most promising cryptocurrencies with real-time execution and transparent pricing.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Start Crypto Trading</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Live Prices</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="p-4 rounded border shadow-lg" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h6 class="text-uppercase text-muted small mb-4">Top Assets</h6>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">
                            <span class="text-muted"><i class="mdi mdi-bitcoin text-warning mr-2"></i>Bitcoin (BTC)</span>
                            <span class="text-success font-weight-bold">$68,452.12</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">
                            <span class="text-muted"><i class="mdi mdi-ethereum text-primary mr-2"></i>Ethereum (ETH)</span>
                            <span class="text-success font-weight-bold">$3,842.50</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted"><i class="mdi mdi-currency-usd text-success mr-2"></i>Solana (SOL)</span>
                            <span class="text-success font-weight-bold">$145.22</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trading Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold text-dark">Real-Time Crypto Markets</h2>
                    <p class="text-muted mb-4">Spot crypto trading involves the direct purchase or sale of cryptocurrencies like Bitcoin and Ethereum for immediate delivery. Unlike futures or options, when you trade spot, you own the actual underlying asset.</p>
                    <p class="text-muted">Our high-performance matching engine processes thousands of orders per second, ensuring that you always get the best execution price, even during periods of high market volatility.</p>
                    
                    <div class="p-4 mt-4 shadow-sm rounded-md border bg-dark-custom bg-white" style="border-left: 4px solid var(--inst-accent);">
                        <h6 class="font-weight-bold text-white  mb-2">Zero Hidden Fees</h6>
                        <p class="small text-muted mb-0">We believe in absolute transparency. Our fee structure is simple, competitive, and clearly displayed before you execute any trade.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-lg shadow-lg w-100 overflow-hidden" >
                         <img src="{{ asset('images/pexels-artem-podrez-5715853.jpg') }}" alt="Trading" class="img-fluid" height="300px">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Assets Grid -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="font-weight-bold text-white">Why Trade Crypto with Us?</h2>
                    <p class="text-muted">The secure way to build your digital portfolio.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-shield-check h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Institutional Custody</h4>
                        <p class="text-muted small">Your assets are stored in multi-signature cold wallets with institutional insurance coverage.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-api h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Powerful API</h4>
                        <p class="text-muted small">Connect your algorithmic trading bots via our high-speed FIX and REST APIs.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-bank h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Fiat On-Ramps</h4>
                        <p class="text-muted small">Easily deposit and withdraw funds using Bank Transfer, Credit Cards, or Apple Pay.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.partials.trade-anywhere')
    @include('home.partials.achievement')
    @include('home.partials.cta')

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
