@extends('layouts.base')
@section('title', 'Swing Trading - ' . $settings->site_name)

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Swing Trading</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->site_name }} Trade has been sharing financial freedom with traders since 2014. In a continuous effort to give traders a more comfortable and safe experience, its experts have been improving the platform ensuring traders can enjoy and make use of that freedom to trade whenever and wherever they like.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Swing Trading Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Swing Trading</h2>
            
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0 d-flex flex-column justify-content-center" data-aos="fade-right">
                    <h3 class="mb-4 font-weight-bold" style="color:var(--inst-primary); font-size: 1.75rem;">Swing trading is one of the most popular forms of active trading, where traders look for intermediate-term opportunities using various forms of technical analysis.</h3>
                    <p class="text-muted mb-4">Swing trading is a style of trading that attempts to capture short- to medium-term gains in a stock (or any financial instrument) over a period of a few days to several weeks. Swing traders primarily use technical analysis to look for trading opportunities.</p>
                    <p class="text-muted mb-0">Many swing traders assess trades on a risk/reward basis. By analyzing the chart of an asset, they determine where they will enter, where they will place a stop-loss order, and then anticipate where they can get out with a profit. If they are risking $1 per share on a setup that could reasonably produce a $3 gain, that is a favorable risk/reward ratio. On the other hand, risking $1 only to make $0.75 isn’t quite as favorable.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-lg shadow-lg w-100" style="background-image: url('{{ asset('images/assets/pexels-artem-podrez-5715853.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pros and Cons -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold text-white" style="font-size: 2.5rem;" data-aos="fade-up">Pros and Cons</h2>
            
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border " style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Pros</h3>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-4"><i class="mdi mdi-check text-success mr-2"></i> Swing trading requires less time to trade than day trading.</li>
                            <li class="mb-4"><i class="mdi mdi-check text-success mr-2"></i> It maximizes short-term profit potential by capturing the bulk of market swings.</li>
                            <li><i class="mdi mdi-check text-success mr-2"></i> Swing traders can rely exclusively on technical analysis, simplifying the trading process.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded-lg border " style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Cons</h3>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-4"><i class="mdi mdi-close text-danger mr-2"></i> Swing trade positions are subject to overnight and weekend market risk.</li>
                            <li class="mb-4"><i class="mdi mdi-close text-danger mr-2"></i> Abrupt market reversals can result in substantial losses.</li>
                            <li><i class="mdi mdi-close text-danger mr-2"></i> Swing traders often miss longer-term trends in favor of short-term market moves.</li>
                        </ul>
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
                <div class="col-lg-8" data-aos="fade-right">
                    <p class="text-muted mb-4">A swing trader tends to look for multiday chart patterns. Some of the more common patterns involve moving average crossovers, cup and handle patterns, head and shoulders patterns, flags, and triangles. Key reversal candlesticks may be used in addition to other indicators to devise a solid trading plan.</p>
                    <p class="text-muted mb-0">Ultimately, each swing trader devises a plan and strategy that gives them an edge over many trades. This involves looking for trade setups that tend to lead to predictable movements in the asset’s price. This isn’t easy, and no strategy or setup works every time. With a favorable risk/reward, winning every time isn’t required. The more favorable the risk/reward of a trading strategy, the fewer times it needs to win to produce an overall profit over many trades.</p>
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
