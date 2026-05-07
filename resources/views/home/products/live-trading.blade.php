@extends('layouts.base')
@section('title', 'Live Trading Interface - ' . $settings->site_name)

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Live Trading Interface</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->site_name }} trading platform is a software system offered to investors and traders by certain financial institutions, such as brokerages and banks. Essentially, trading platforms enable investors and traders to place trades and monitor their accounts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Trading Interface Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Live Trading Interface</h2>
            
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0 d-flex flex-column justify-content-center" data-aos="fade-right">
                    <h3 class="mb-4 font-weight-bold" style="color:var(--inst-primary); font-size: 1.75rem;">Essentially, a trading platform is a software system typically offered through a brokerage or other financial institution that lets you trade online, on your own. A trading platform gives investors an online interface through which they can access various markets, place trades, monitor positions, and manage their accounts.</h3>
                    <p class="text-muted mb-4">Trading platforms can offer a number of other features, as well. Broadly speaking, these include real-time quotes, live business and financial news feeds, instant access to a wealth of streaming and historical financial data, technical analysis tools, investment research, and educational resources.</p>
                    <p class="text-muted mb-0">There are two types of trading platforms: commercial platforms and proprietary platforms. Commercial platforms are designed for day traders and retail investors. They are characterized by ease of use and an assortment of helpful features, such as real-time quotes, international news feeds, live, interactive charts, educational content, and research tools.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="h-100 rounded-lg shadow-lg w-100" style="background-image: url('https://glidelogiccopytrading.com/assets/pexels-artem-podrez-5715853.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why our live trading interface is important -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold text-white" style="font-size: 2.5rem;" data-aos="fade-up">Why our live trading interface is important</h2>
            
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <p class="text-muted mb-4"><strong class="text-white">Trading strategy:</strong> Day traders focus intently on building their own personal trading strategies with focused criteria for entering and exiting trades, risk management and profit targets. Strategy is essential to help maintain discipline and consistent decision-making.</p>
                        <p class="text-muted mb-4"><strong class="text-white">Market monitoring:</strong> Day traders actively monitor the market, watching price movements, trading volumes, market news and a host of other factors that could impact their target securities. They depend on real-time data to track the market.</p>
                        <p class="text-muted mb-4"><strong class="text-white">Evaluate opportunities:</strong> The product market monitoring and a solid strategy is the ability of a day trader to evaluate opportunities that align with their criteria. Typically this involves identifying technical factors like support and resistance levels, chart patterns and trend reversals that suggest future price movements.</p>
                        <p class="text-muted mb-4"><strong class="text-white">Trading execution:</strong> Once an opportunity arises, traders need to decisively enter trades to capitalize on short-term price movements. They use different order types—like market orders and limit orders—to get the right prices.</p>
                        <p class="text-muted mb-4"><strong class="text-white">Risk management:</strong> Day trading is very risky, making risk management an essential skill. This includes setting stop-loss orders, which automatically exit a trade if the price moves against them beyond a certain threshold, limiting potential losses. They also use position sizing to determine the appropriate amount of capital for each trade.</p>
                        <p class="text-muted mb-0"><strong class="text-white">Closing positions:</strong> Day traders want to close out all their positions before the end of the trading day to avoid overnight risks. This ensures that they are not exposed to potential market gaps or news events that may occur when they are not actively monitoring the market.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Swing Trading Tactics -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Swing Trading Tactics</h2>
            
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="text-muted mb-4">The key factors necessary to succeed in day trading are fast, reliable execution of trades and the lowest possible trading commissions. A day trader can have a majority of winning trades, yet still lose money at the end of the day if their commissions outweigh their profits. Since day traders are continually buying and selling assets, they may rack up substantial costs in the form of trading commissions.</p>
                    <p class="text-muted mb-0">Similarly, optimal execution of orders is essential. Getting in and out of the market and taking small profits continually throughout the day requires efficient order execution. During fast-moving market conditions, such as at the market open or just after an important piece of news has been released, it’s especially important to be working with a broker that can provide reliable order execution.</p>
                </div>
            </div>
        </div>
    </section>
@include('home.partials.trade-anywhere')
<!-- Achievement -->
@include('home.partials.achievement')
<!-- CTA -->
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
