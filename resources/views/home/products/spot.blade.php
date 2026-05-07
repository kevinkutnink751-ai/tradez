@extends('layouts.base')
@section('title', 'Institutional Spot Trading')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Spot Trading</h1>
                    <p class="text-muted lead mb-5 max-width-700">Experience the world's most liquid markets with institutional execution. Trade the actual price of assets in real-time with sub-millisecond precision and deep liquidity pools.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Start Spot Trading</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg mb-3">View Live Quotes</a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-right">
                    @include('components.illustrations.orderbook')
                </div>
            </div>
        </div>
    </section>

    <!-- Spot Trading Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold" style="color:#000;">Direct Market Access</h2>
                    <p class="text-muted mb-4">Spot trading is the purchase or sale of a foreign currency, financial instrument, or commodity for instant delivery on a specified spot date. Most spot contracts involve the physical delivery of the currency or commodity, although cash settlement is also common in many retail environments.</p>
                    <p class="text-muted">Our platform provides you with direct access to top-tier liquidity providers, ensuring that you get the best possible spreads and lightning-fast execution on every trade.</p>
                    
                    <div class="p-4 mt-4 shadow-sm rounded border" style="border-left: 4px solid var(--inst-accent); background: rgba(252, 213, 53, 0.05);">
                        <h6 class="font-weight-bold" style="color:#000;">Institutional Execution</h6>
                        <p class="small text-muted mb-0">Benefit from our low-latency infrastructure that processes millions of orders per second with absolute transparency.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-lg shadow-lg w-100" style="background-image: url('{{ asset('images/pexels-tima-miroshnichenko-7567228.jpg') }}'); background-size: cover; background-position: center; min-height: 400px; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="font-weight-bold text-white">Why Trade Spot with Us?</h2>
                    <p class="text-muted">The ultimate environment for professional traders.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-flash h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Ultra-Low Latency</h4>
                        <p class="text-muted small">Execute trades in under 30ms with our globally distributed server network.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-water h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Deep Liquidity</h4>
                        <p class="text-muted small">Access pooled liquidity from 20+ top-tier banks and dark pools for large order fills.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-chart-areaspline h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Advanced Charts</h4>
                        <p class="text-muted small">Full integration with TradingView for professional technical analysis and order entry.</p>
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
