@extends('layouts.base')
@section('title', 'Advanced Trading Account - ' . $settings->site_name)

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Advanced Trading Account</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->site_name }} has been sharing financial freedom with traders since 2014. In a continuous effort to give traders a more comfortable and safe experience, its experts have been improving the platform ensuring traders can enjoy and make use of that freedom to trade whenever and wherever they like.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced Trading Account Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Advanced Trading Account</h2>
            
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0 d-flex flex-column justify-content-center" data-aos="fade-right">
                    <h3 class="mb-4 font-weight-bold" style="color:var(--inst-primary); font-size: 1.75rem;">Advanced Trading Account / Mechanical trading systems</h3>
                    <p class="text-muted mb-4">Advanced Trading Account also referred to as mechanical trading systems, algorithmic trading, automated trading or system trading — allow traders to establish specific rules for both trade entries and exits that, once programmed, can be automatically executed via a computer. In fact, various platforms report 70% to 80% or more of shares traded on U.S. stock exchanges come from automatic trading systems.</p>
                    <p class="text-muted mb-4">Traders and investors can turn precise entry, exit, and money management rules into automated trading systems that allow computers to execute and monitor the trades. One of the biggest attractions of strategy automation is that it can take some of the emotion out of trading since trades are automatically placed once certain criteria are met.</p>
                    <p class="text-muted mb-0">The trade entry and exit rules can be based on simple conditions such as a moving average crossover or they can be complicated strategies that require a comprehensive understanding of the programming language specific to the user's trading platform. They can also be based on the expertise of a qualified programmer.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="h-100 rounded-lg shadow-lg w-100" style="background-image: url('https://glidelogiccopytrading.com/assets/pexels-alesia-kozik-6771900.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages of Automated Systems -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold text-white" style="font-size: 2.5rem;" data-aos="fade-up">Advantages of Automated Systems</h2>
            
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border h-100" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Minimizing Emotions</h3>
                        <p class="text-muted mb-0">Automated trading systems minimize emotions throughout the trading process. By keeping emotions in check, traders typically have an easier time sticking to the plan. Since trade orders are executed automatically once the trade rules have been met, traders will not be able to hesitate or question the trade. In addition to helping traders who are afraid to "pull the trigger," automated trading can curb those who are apt to overtrade — buying and selling at every perceived opportunity.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded-lg border h-100" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Backtesting</h3>
                        <p class="text-muted mb-0">Backtesting applies trading rules to historical market data to determine the viability of the idea. When designing a system for automated trading, all rules need to be absolute, with no room for interpretation. The computer cannot make guesses and it has to be told exactly what to do. Traders can take these precise sets of rules and test them on historical data before risking money in live trading. Careful backtesting allows traders to evaluate and fine-tune a trading idea, and to determine the system's expectancy – i.e., the average amount a trader can expect to win (or lose) per unit of risk.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Considerations -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="text-muted mb-0">Although appealing for a variety of reasons, automated trading systems should not be considered a substitute for carefully executed trading. Technology failures can happen, and as such, these systems do require monitoring. Server-based platforms may provide a solution for traders wishing to minimize the risks of mechanical failures. Remember, you should have some trading experience and knowledge before you decide to use automated trading systems.</p>
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
