@extends('layouts.base')
@section('title', 'Future Trading - ' . $settings->site_name)

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
       
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Future Trading</h1>
                    <p class="text-muted lead mb-5 max-width-700">Futures are derivative contracts to buy or sell an asset at a future date at an agreed-upon price.</p>
                </div>
                <div class="col-lg-4">
                    @include('components.illustrations.leverage-calc')
                </div>
            </div>
        </div>
    </section>

    <!-- Future Trading Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">Future Trading</h2>
            
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0 d-flex flex-column justify-content-center" data-aos="fade-right">
                    <h3 class="mb-4 font-weight-bold" style="color:var(--inst-primary); font-size: 1.75rem;">Stock futures investing</h3>
                    <p class="text-muted mb-4">Commodities represent a big part of the futures-trading world. Stock futures investing lets you trade futures of individual companies and shares of ETFs.</p>
                    <p class="text-muted mb-4">Futures contracts also exist for bonds and even bitcoin. Some traders like trading futures because they can take a substantial position (the amount invested) while putting up a relatively small amount of cash. That gives them greater potential for leverage than just owning the securities directly.</p>
                    <p class="text-muted mb-4">Most investors think about buying an asset anticipating that its price will go up in the future. But short-selling lets investors do the opposite — borrow money to bet an asset's price will fall so they can buy later at a lower price.</p>
                    <p class="text-muted mb-0">One common application for futures relates to the U.S. stock market. Someone wanting to hedge exposure to stocks may short-sell a futures contract on the Standard & Poor’s 500. If stocks fall, they make money on the short, balancing out their exposure to the index. Conversely, the same investor may feel confident in the future and buy a long contract – gaining a lot of upside if stocks move higher.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="h-100 rounded-lg shadow-lg w-100" style="background-image: url('https://glidelogiccopytrading.com/assets/pexels-tima-miroshnichenko-7567441.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What are futures contracts? -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold text-white" style="font-size: 2.5rem;" data-aos="fade-up">What are futures contracts?</h2>
            
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <p class="text-muted mb-4">Futures contracts, which you can readily buy and sell over exchanges, are standardized. Each futures contract will typically specify all the different contract parameters:</p>
                        
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-3"><i class="mdi mdi-check text-warning mr-2"></i> The unit of measurement.</li>
                            <li class="mb-3"><i class="mdi mdi-check text-warning mr-2"></i> How the trade will be settled – either with physical delivery of a given quantity of goods, or with a cash settlement.</li>
                            <li class="mb-3"><i class="mdi mdi-check text-warning mr-2"></i> The quantity of goods to be delivered or covered under the contract.</li>
                            <li class="mb-3"><i class="mdi mdi-check text-warning mr-2"></i> The currency in which the futures contract is quoted.</li>
                            <li><i class="mdi mdi-check text-warning mr-2"></i> Grade or quality considerations, when appropriate. For example, this could be a certain octane of gasoline or a certain purity of metal.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The risks of futures trading -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="font-size: 2.5rem; color:#000;" data-aos="fade-up">The risks of futures trading: margin and leverage</h2>
            
            <div class="row">
                <div class="col-lg-8" data-aos="fade-right">
                    <p class="text-muted mb-4">Many speculators borrow a substantial amount of money to play the futures market because it’s the main way to magnify relatively small price movements to potentially create profits that justify the time and effort.</p>
                    <p class="text-muted mb-4">But borrowing money also increases risk: If markets move against you, and do so more dramatically than you expect, you could lose more money than you invested. The CFTC warns that futures are complex, volatile, and not recommended for individual investors.</p>
                    <p class="text-muted mb-4">Leverage and margin rules are a lot more liberal in the futures and commodities world than they are for the securities trading world. A commodities broker may allow you to leverage 10:1 or even 20:1, depending on the contract, much higher than you could obtain in the stock world. The exchange sets the rules.</p>
                    <p class="text-muted mb-0">The greater the leverage, the greater the gains, but the greater the potential loss, as well: A 5% change in prices can cause an investor leveraged 10:1 to gain or lose 50 percent of her investment. This volatility means that speculators need the discipline to avoid overexposing themselves to any undue risk when investing in futures.</p>
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
