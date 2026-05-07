@extends('layouts.base')
@section('title', 'Institutional Options Trading')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
    
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Options Trading</h1>
                    <p class="lead text-muted mb-5 max-width-700">Explore the power of derivative trading. From vanilla hedging strategies to high-velocity binary outcomes, our platform provides the tools you need to capitalize on market volatility with precision.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Start Trading</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Live Options</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    @include('components.illustrations.payoff-chart')
                </div>
            </div>
        </div>
    </section>

    <!-- Vanilla Options Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold text-dark">Option Trading & Investing</h2>
                    <p class="text-muted mb-4">When most people think of investment, they think of buying stocks on the stock market. However, options trading offers a more dynamic approach. Buying stocks and holding them for long-term gains is a sensible strategy, but it doesn't provide much in the way of short-term gains or downside protection.</p>
                    <p class="text-muted">Thanks to our institutional-grade interface, investors can be more active, taking advantage of shorter-term price fluctuations and leveraging advanced hedging techniques to protect their portfolios.</p>
                    
                    <div class="p-4 mt-4 shadow-sm rounded border bg-white" style="border-left: 4px solid var(--inst-accent);">
                        <h6 class="font-weight-bold text-dark mb-2">Options Spreads</h6>
                        <p class="small text-muted mb-0">Create powerful spreads to limit risk and reduce financial outlay. Most professional options strategies involve the use of spreads to maximize capital efficiency.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-lg shadow-lg w-100 overflow-hidden" style="border: 1px solid var(--inst-border);">
                         <img src="https://glidelogiccopytrading.com/assets/pexels-tima-miroshnichenko-7567228.jpg" alt="Options Trading" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <div class="row mt-5" data-aos="fade-up">
                <div class="col-12">
                    <div class="p-5 rounded-lg border shadow-sm bg-dark-custom">
                        <h4 class="font-weight-bold text-white mb-4">Selling & Writing Options</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="text-muted">There are two primary ways to sell options contracts. If you own contracts, you can realize profits or cut losses by placing a <strong>sell to close</strong> order. This is common when the options you own have reached your target price or if you wish to exit before further losses.</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-muted">Alternatively, you can open a short position by <strong>writing options</strong>. This involves using a <strong>sell to open</strong> order, where you receive a payment (premium) upfront. While riskier, it allows you to profit if the underlying security does not move as the holder expects.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Binary Options Section -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0" data-aos="fade-left">
                    <h2 class="mb-4 font-weight-bold text-white">Binary Precision</h2>
                    <p class="text-muted mb-4">Binary trading (Digital Options) is a high-velocity investment method where the outcome is based on a simple "Yes/No" proposition. Will the price of an asset be above or below a certain point at a specific time?</p>
                    <p class="text-muted small">Unlike traditional options, binary contracts offer a fixed payout and a fixed loss, allowing for precise capital allocation and absolute risk management from the moment you enter the trade.</p>
                    
                    <div class="p-4 mt-4 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important; border-left: 4px solid var(--inst-accent) !important;">
                        <h6 class="text-primary font-weight-bold mb-2">Professional Payouts</h6>
                        <p class="small text-muted mb-0">Our proprietary pricing engine offers competitive yields ranging from 75% to 95%, depending on market volatility and asset class.</p>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <div class="row">
                        <div class="col-md-6 d-flex mb-4">
                            <div class="p-4 text-center rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                                <i class="mdi mdi-timer-outline h1 text-primary mb-3 d-block"></i>
                                <h6 class="text-white font-weight-bold">Fixed Timeframes</h6>
                                <p class="small text-muted mb-0">Contracts ranging from 60 seconds to end-of-day expirations.</p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex mb-4">
                            <div class="p-4 text-center rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                                <i class="mdi mdi-shield-check-outline h1 text-primary mb-3 d-block"></i>
                                <h6 class="text-white font-weight-bold">Capped Risk</h6>
                                <p class="small text-muted mb-0">You can never lose more than your initial investment on any single trade.</p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex mb-4 mb-md-0">
                            <div class="p-4 text-center rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                                <i class="mdi mdi-globe-model h1 text-primary mb-3 d-block"></i>
                                <h6 class="text-white font-weight-bold">Global Assets</h6>
                                <p class="small text-muted mb-0">Trade across 100+ global assets including FX pairs, metals, and indices.</p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="p-4 text-center rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                                <i class="mdi mdi-chart-line h1 text-primary mb-3 d-block"></i>
                                <h6 class="text-white font-weight-bold">Live Charts</h6>
                                <p class="small text-muted mb-0">Institutional-grade charting with real-time price feeds.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Prediction Room Section -->
            <div class="row align-items-center mt-5 pt-5 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="font-weight-bold mb-4 text-white">Real-Time Prediction Room</h2>
                    <p class="text-muted mb-4">Execute high-speed trades with absolute precision. Our proprietary trading room ensures sub-millisecond strike entries, preventing slippage on short-term contracts.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Fixed expiration timers</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> One-click HIGH/LOW execution</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Real-time payout calculation</li>
                    </ul>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    @include('components.illustrations.binary-timer')
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
