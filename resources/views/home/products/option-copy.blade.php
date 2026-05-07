@extends('layouts.base')
@section('title', 'Option Copy Trading')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Option Copy Trading</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->site_name }} has been sharing financial freedom with traders since 2014. In a continuous effort to give traders a more comfortable and safe experience, its experts have been improving the platform ensuring traders can enjoy and make use of that freedom to trade whenever and wherever they like.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What is Copy Trading -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Option Copy Trading</h2>
            
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0 d-flex flex-column justify-content-center" data-aos="fade-right">
                    <h3 class="mb-4 font-weight-bold" style="color:var(--inst-primary); font-size: 1.75rem;">Copy trading is replicating another trader’s positions using social platforms, automated tools and signals</h3>
                    <p class="text-muted mb-4">Copy trading is a type of trading where you copy the trades performed by another, more experienced trader. It can be manual, semi-automatic or fully automatic.</p>
                    <p class="text-muted mb-4">Copy trading allows individuals to automatically copy another trader’s positions when they are opened or closed. Experienced traders communicate their positions using signals via social networks or forums, where followers can copy the methods.</p>
                    <p class="text-muted mb-4">Traders can copy positions in many markets, including forex, stocks and CFDs. You can also copy trades on popular crypto coins, including Bitcoin (BTC) or major precious metals such as Gold or Platinum.</p>
                    <p class="text-muted mb-0">Copy trading can be a good way to earn a profit and make you rich, but it is important to understand that you will not become rich overnight. If you try to become rich too fast, you will have to copy very high-risk trades, and you will likely end up losing your money. If you use copy trading to build wealth slowly, you will have a fair chance of becoming a millionaire in due time.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="h-100 rounded-lg shadow-lg w-100" style="background-image: url('https://glidelogiccopytrading.com/assets/pexels-anna-nekrashevich-6801872.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px; border-radius: 20px;">
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
            
            <div class="row ">
                <div class="col-lg-6 mb-4 mb-lg-0 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border " style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Pros</h3>
                        <p class="text-muted mb-4">Authorised practice – copy trading is generally recognised by key regulatory frameworks, including CySEC, ESMA, MiFID and the FCA. Choosing a licensed and reputable broker will ensure your funds are safe and not exposed to scams.</p>
                        <p class="text-muted mb-0">Portfolio diversification – traders can gain exposure to opportunities or trends that they wouldn’t usually consider without the help of another trader’s expertise.</p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded-lg border " style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h3 class="text-white mb-4 font-weight-bold">Cons</h3>
                        <p class="text-muted mb-4">Risk – the risks can be high even if you choose an experienced trader to copy. If a strategy is unsuccessful, the risk will also translate onto a follower’s account and can result in a financial loss.</p>
                        <p class="text-muted mb-0">Control – one of the main disadvantages is the lack of control a trader will have once they begin copying an account; traders are essentially entrusting their portfolio to a stranger.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Risk -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Risk</h2>
            
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="text-muted mb-4">All types of trading are associated with risk. You always risk losing part or all of your investment. Never invest money you can not afford to lose. The risk associated with copy trading depends on the type of asset or security you choose to copy trade. Copying the trades of a trader that trades high-risk assets such as Forex, Crypto or binary options will be high risk. Copying the trades of a trader that trades low-risk securities such as blue chip stocks will be low risk.</p>
                    <p class="text-muted mb-4">You should follow a trader that trades using a risk profile that you feel comfortable with. Many platforms will give you a risk indicator for each trader you can choose to copy, but it is always best to manually inspect their trade history and see if you feel comfortable with their trading strategies and risk profile. When in doubt, choose a broker with a lower-risk profile. You can increase your risk exposure later on, but if you choose a high-risk strategy and lose money, it will be too late to move that money to a lower-risk option since the money is already lost.</p>
                    <p class="text-muted mb-0">A common beginner’s mistake is only copying one trader. A profitable trading history does not guarantee future returns. All traders can produce a period of poor returns or losses. It is always best to split your money and follow more than one trader. This will give you better diversification and will allow you to earn a profit even if one trader has a bad month or year. Diversification will reduce the risk associated with all types of trading and is one of the most basic types of risk management. All beginner traders should try to diversify their investment portfolio.</p>
                </div>
                <div class="col-lg-6">
                    @include('components.illustrations.mirror-leaderboard')
                </div>
            </div>
        </div>
    </section>
@include('home.partials.our-values')
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
