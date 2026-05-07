@extends('layouts.base')

@section('title', $settings->site_title)

@section('styles')
    @parent
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 mb-5" data-aos="fade-right">
                <h1 class="hero-title">Purpose-Driven Copytrading, Built on Innovation and Transparency</h1>
                <p class="hero-subtitle">Trade smarter, not harder, by automatically mirroring the strategies of top-performing investors, giving you a smarter way to grow your portfolio with confidence, transparency, and control.</p>
                <div class="d-flex gap-3">
                    <a href="https://app.glidelogiccopytrading.com/register" class="btn btn-primary btn-lg rounded-pill px-5 py-3">Register</a>
                    <a href="https://app.glidelogiccopytrading.com/login" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 ml-3">Login</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mb-5 mt-5 mt-lg-0  position-relative" style="height: 350px;" data-aos="fade-left" data-aos-delay="200">
                <img src="{{ asset('images/hero-img.svg') }}" style="position: absolute;width: 80%;right: 0;top: 0;" alt="Platform Overview">
                <img src="{{ asset('images/hero-img1.svg') }}" style="position: absolute;width: 10%;left: 25%;" alt="Element 1">
                <img src="{{ asset('images/hero-img2.svg') }}" style="position: absolute;width: 10%;left: 25%;top: 60%;" alt="Element 2">
            </div>
        </div>
    </div>
</section>

<!-- A user-friendly trading platform -->
<section class="section py-5 mt-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 mb-5" data-aos="fade-right">
                <h1 class="section-title mb-4">A user-friendly trading platform</h1>
                <p class="text-muted lead mb-4">Trade options on financial markets and 24/7 Derived Indices. Start with just USD 0.09, and choose from multiple contract types and durations to suit your trading strategy.</p>
                <a href="/" class="btn btn-primary rounded-pill px-4 py-2">Try now</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mt-5 mt-lg-0 text-center" data-aos="fade-left">
                <img src="https://glidelogiccopytrading.com/assets/6757d2193bf331c84b5fd1be_dtrader-revamped-hero-row.webp" class="img-fluid rounded" alt="Mobile Trading" style="max-width: 80%;">
            </div>
        </div>
    </div>
</section>

<!-- About Us -->
<section class="section bg-light py-5 position-relative">
    <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="row mb-4">
            <div class="col-12" data-aos="fade-up">
                <h2 class="section-title">About Us</h2>
            </div>
        </div>
        <div class="row align-items-center px-2">
            <div class="col-lg-7 bg-dark-custom rounded-lg px-3 py-5" data-aos="fade-right">
                <h2 class="mb-4 text-white">Time to take action with the international {{ $settings->site_name }} broker</h2>
                <p class="text-muted mb-4">Trading will bring you profit with proper support, constant education, and a reasonable approach. {{ $settings->site_name }} is a broker platform that has created all the conditions to help you improve your trading life in every possible way.</p>
                <p class="text-muted">From educational broker’s tools, demo accounts, and 24/7 support to your financial success, {{ $settings->site_name }} works tirelessly to remain at the forefront in trading online. Join now! Take full advantage of this online trading leader and make your way into the world of professional trading.</p>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0" data-aos="zoom-in">
                <img src="{{ asset('images/assets/euro-copy.webp') }}" class="img-fluid rounded-lg shadow-lg" alt="About Us">
            </div>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<section class="section py-5">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" style="grid-column: span 2; position: relative; overflow: hidden;" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('images/assets/960.webp') }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.3; z-index: 1;" alt="bg">
                <div style="position: relative; z-index: 2;">
                    <div class="stat-value">130+<br>countries</div>
                    <div class="stat-label">We support all, so traders from all over the world could enjoy and profit anytime</div>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-value">1M+</div>
                <div class="stat-label">Trader accounts</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-value">30M+</div>
                <div class="stat-label">Monthly transactions</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-value">$16M+</div>
                <div class="stat-label">Average monthly payouts</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="500">
                <div class="stat-value">$211M</div>
                <div class="stat-label">Monthly trade turnover</div>
            </div>
        </div>
    </div>
</section>

<!-- Features / Trusted -->
<section class="section bg-light py-5 position-relative">
    <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up">
                <h2 class="section-title" style="font-size: 3rem;">Trusted by millions of traders</h2>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-2 mb-3">Open free account</a>
                <p class="text-muted">It takes 30 seconds to register</p>
            </div>
            <div class="col-lg-7 pl-lg-5">
                <div class="glass-card border-0 bg-transparent mb-4" style="border-bottom: 1px solid var(--inst-border) !important; border-radius: 0; padding-bottom: 20px;" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/assets/summary.webp') }}" width="40" class="mr-4" alt="License">
                        <div>
                            <h4 class="mb-2">Licensed and regulated</h4>
                            <p class="text-muted mb-2">{{ $settings->site_name }} is authorized financial services provider and cryptocurrency exchange.</p>
                            <a href="{{ route('regulations') }}" class="text-warning font-weight-bold">Our licenses <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="glass-card border-0 bg-transparent mb-4" style="border-bottom: 1px solid var(--inst-border) !important; border-radius: 0; padding-bottom: 20px;" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/assets/margin.webp') }}" width="40" class="mr-4" alt="Transparency">
                        <div>
                            <h4 class="mb-2">Transparent trading conditions</h4>
                            <p class="text-muted mb-2">Fees from 0% with no hidden costs.</p>
                            <a href="{{ route('register') }}" class="text-warning font-weight-bold">Start trading <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="glass-card border-0 bg-transparent" style="border-radius: 0; padding-bottom: 20px;" data-aos="fade-up" data-aos-delay="300">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/assets/support.webp') }}" width="40" class="mr-4" alt="Support">
                        <div>
                            <h4 class="mb-2">Always by your side</h4>
                            <p class="text-muted mb-0">24/7 live support with a 30-second average response time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grid Features -->
<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h4 class="mb-3 text-white">Fast, Seamless Navigation</h4>
                <p class="text-muted">The interface is built for speed — switch between markets, charts, and orders in seconds with minimal clicks. Whether you're a beginner or a pro, everything is exactly where you'd expect it to be.</p>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h4 class="mb-3 text-white">Powerful Built-In Charts</h4>
                <p class="text-muted">Analyze the market with interactive charts, technical indicators, and drawing tools — all directly in the platform. No need for third-party tools to stay ahead of the trends.</p>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <h4 class="mb-3 text-white">Lightning-Fast Order Execution</h4>
                <p class="text-muted">Place trades instantly with one-click execution and manage them easily with advanced order types like stop-loss and limit orders. Every action is responsive and reliable.</p>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <h4 class="mb-3 text-white">Real-Time Data & Smart Alerts</h4>
                <p class="text-muted">Stay in control with live price feeds and customizable alerts. Get notified of price movements or trade activity the moment it happens — no delays, no missed opportunities.</p>
            </div>
        </div>
        <div class="row mt-5" data-aos="fade-up">
            <div class="col-12">
                <h4 class="mb-3 text-white">Seamless trading with secure funding options</h4>
                <p class="text-muted">Fund your account quickly and securely with a variety of trusted payment methods. Our platform ensures your deposits and withdrawals are processed efficiently, so you can focus on trading with confidence and peace of mind.</p>
            </div>
        </div>
    </div>
</section>

<!-- Scrolling Strip -->
<div class="scrolling-wrapper">
    <div class="scrolling-content">
        <img src="https://glidelogiccopytrading.com/assets/strip-b.svg" alt="Partner">
        <img src="https://glidelogiccopytrading.com/assets/strip-b.svg" alt="Partner">
        <img src="https://glidelogiccopytrading.com/assets/strip-b.svg" alt="Partner">
        <img src="https://glidelogiccopytrading.com/assets/strip-b.svg" alt="Partner">
    </div>
</div>

<!-- Trade Stock derivatives -->
<section class="section py-5  bg-light">
    <div class="container">
        <div class="glass-card" style="background: url('https://naga.com/images/markets/tradeOn/stock-cfds.jpeg') no-repeat center center / cover;" data-aos="fade-up">
            <div style="background: rgba(0,0,0,0.7); padding: 40px; border-radius: 16px;">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-4 text-white">Trade Stock derivatives:</h2>
                        <p class="mb-3 text-muted"><strong>Access a Wide Range of Instruments –</strong> Trade options, futures, and other stock derivatives across major global markets.</p>
                        <p class="mb-3 text-muted"><strong>Leverage Market Opportunities –</strong> Use derivatives to hedge, speculate, or enhance portfolio performance with strategic exposure.</p>
                        <p class="text-muted"><strong>Advanced Tools & Real-Time Data –</strong> Make informed decisions with powerful trading tools, analytics, and up-to-the-second market data.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mirror Trading -->
<section class="section bg-light py-5 position-relative">
    <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-right">
                <h2 class="section-title">Mirror Trading</h2>
            </div>
        </div>
        <div class="mirror-grid">
            <a href="/option-trading" class="mirror-card" data-aos="fade-up" data-aos-delay="100">
                <h4>Copy Option Trading</h4>
                <p>Copy trading is a type of trading where you copy the trades performed by another, more experienced trader. It can be manual, semi-automatic or fully automatic.</p>
            </a>
            <a href="/advance-trading" class="mirror-card" data-aos="fade-up" data-aos-delay="200">
                <h4>Advance Trading</h4>
                <p>The trade entry and exit rules can be based on simple conditions such as a moving average crossover or they can be complicated strategies that require a comprehensive understanding of the programming language specific to the user's trading platform.</p>
            </a>
            <a href="/live-trading" class="mirror-card" data-aos="fade-up" data-aos-delay="300">
                <h4>Cryptocurrency Trading</h4>
                <p>Trade popular cryptocurrencies like Bitcoin, Ethereum, and more with ease. Our platform offers secure transactions, real-time pricing, and advanced tools to help you capitalize on the dynamic crypto market—whether you're a beginner or an experienced trader.</p>
            </a>
            <a href="/risk-management" class="mirror-card" data-aos="fade-up" data-aos-delay="400">
                <h4>Risk Management Tools</h4>
                <p>Utilize advanced risk management features such as stop-loss, take-profit, and negative balance protection to help safeguard your investments and trade with greater confidence.</p>
            </a>
        </div>
    </div>
</section>

<!-- Why trade Forex / Widget -->
<section class="section py-5 bg-dark-custom">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="section-title text-white">Why trade Forex with us?</h2>
                <p class="text-muted">All you need to become a trading guru gathered in one place: education, analytics, video lessons,<br> trading tips, market news, and so much more!</p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('images/assets/pair.svg') }}" class="mb-3" alt="Pairs">
                        <h5 class="mb-2 text-white">60+ Currency Pairs</h5>
                        <p class="text-muted small">Trade more than 60 currency pairs including Major, Minor, and Exotics.</p>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('images/assets/leverage.svg') }}" class="mb-3 " alt="Leverage">
                        <h5 class="mb-2 text-white">Up to 1:2000 Leverage</h5>
                        <p class="text-muted small">Take advantage of leverage up to 1:2000 to potentially earn larger profits with a smaller initial investment.</p>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('images/assets/spread.svg') }}" class="mb-3" alt="Spreads">
                        <h5 class="mb-2 text-white">Ultra-tight spreads</h5>
                        <p class="text-muted small">With 0.0 pips as the lowest spreads, increase your profits on each trade.</p>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ asset('images/assets/speed.svg') }}" class="mb-3" alt="Speed">
                        <h5 class="mb-2 text-white">High Execution Speed</h5>
                        <p class="text-muted small">Order execution from 0.1 seconds for a smoother and fast trading experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0" data-aos="zoom-in">
                <div class="glass-card p-2" style="height: 400px; background: #000;">
                    <!-- TradingView Widget -->
                    <div class="tradingview-widget-container  rounded overflow-hidden" id="tradingview_widget"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Copy Trading -->
<section class="section py-5">
    <div class="container">
        <div class="copy-grid">
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="100">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(0,255,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">Get results while others<br>do the work</h4>
                <p class="text-muted small">Spend less time analyzing markets or manually setting strategies. Sit back and watch as your portfolio replicates automatically.</p>
            </div>
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="200">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(255,0,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">A trading masterclass in<br>real-time</h4>
                <p class="text-muted small">Gain valuable insights into market trends, strategies, and risk management — all while observing real-world trading in action.</p>
            </div>
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="300">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(0,255,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">Trade at the same price as<br>the top traders</h4>
                <p class="text-muted small">Get the same execution price as the trader you are copying through a built-in price-matching algorithm.</p>
            </div>
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="400">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(0,255,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">Maintain full control</h4>
                <p class="text-muted small">Customize your risk exposure with individual Stop Loss and Take Profit limits for each trade.</p>
            </div>
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="500">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(0,255,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">Real traders, real results</h4>
                <p class="text-muted small">Tap into the expertise of real traders and mirror their tried and tested strategies to achieve your desired results.</p>
            </div>
            <div class="copy-grid-item" data-aos="fade-up" data-aos-delay="600">
                <img src="https://glidelogiccopytrading.com/assets/icon-1.png" class="copy-icon-custom" style="filter: invert(1) drop-shadow(0 0 5px rgba(0,255,255,0.5));" alt="Icon">
                <h4 class="mb-3 text-white font-weight-bold">Complete flexibility</h4>
                <p class="text-muted small">Enjoy the freedom to start, stop, or modify your copy trading settings at any time, adapting to changing market conditions.</p>
            </div>
        </div>
    </div>
</section>


<!-- Processes / ESG -->
<section class="section py-5 bg-light-custom">
    <div class="container position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:30%; height:100%; z-index:1;"></div>
        
        <h1 class="font-weight-bold mb-5 position-relative" style="z-index:2; color:#000;">Find Yourself on {{ $settings->site_name }}</h1>
        
        <div class="row position-relative" style="z-index:2;">
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="blue-card " style="background: url('{{ asset('images/assets/social-bg.jpg') }}');">
                    <h5 class="mb-4 text-white font-weight-bold text-uppercase tracking-wide">Clear Investment Processes</h5>
                    <p class="mb-0">Our transparent investment processes detail how each investment team identifies and implements investment opportunities and the risk/return profile to be expected. We believe that strict adherence to these guidelines is one of the most effective forms of risk management.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-left">
                <div class="white-card " style="background: url('{{ asset('images/assets/chat-bg.jpg') }}') right center / cover no-repeat;">
                    <div style="background: rgba(255,255,255,0.85); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="mb-4 font-weight-bold text-uppercase tracking-wide" style="color:#000;">ESG Integration</h5>
                        <p style="color:#333;">As a signatory of the United Nations-supported Principles for Responsible Investment (UN PRI) initiative, we're committed to investing responsibly and supported by a global team of dedicated ESG specialists whose recommendations help shape the investment process.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row position-relative" style="z-index:2;">
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="blue-card " style="background: url('{{ asset('images/assets/social-bg.jpg') }}');">
                    <h5 class="mb-4 text-white font-weight-bold text-uppercase tracking-wide">Robust Oversight</h5>
                    <p class="mb-0">Portfolio risk management is supplemented by our independent risk and quantitative analytics team—which partners with investment teams to measure behavioral biases and other risks but reports to senior investment management—and an operational risk management function that assesses risk across the complex.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-left">
                <div class="white-card " style="background: url('{{ asset('images/assets/chat-bg.jpg') }}') right center / cover no-repeat;">
                    <div style="background: rgba(255,255,255,0.85); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="mb-4 font-weight-bold text-uppercase tracking-wide" style="color:#000;">High-Conviction, Risk-Aware Portfolios</h5>
                        <p style="color:#333;">Our focus on proprietary, security-level research allows us to build high-conviction, differentiated portfolios. Our risk management processes provide valuable insight to help our teams understand potential outcomes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Pay less, trade more -->
<section class="section py-5 bg-light-custom">
    <div class="container bg-dark-custom rounded-md p-0">
        <div class="row m-0 align-items-center no-gutters" style="min-height: 400px;">
            <div class="col-lg-6 p-5" data-aos="fade-right">
                <h1 class="font-weight-bold text-white mb-3" style="font-size: 3rem;">Pay less, trade more</h1>
                <p class="text-muted mb-5">When you trade with us, you can start small and still earn big.</p>
                
                <ul class="list-unstyled mb-5">
                    <li class="mb-3 text-white"><i class="mdi mdi-scale-balance text-white mr-3" style="font-size: 1.2rem;"></i> Open larger trades with less money using leverage</li>
                    <li class="mb-3 text-white"><i class="mdi mdi-currency-usd text-white mr-3" style="font-size: 1.2rem;"></i> Hold your trades open for longer with cheap funding rates</li>
                    <li class="mb-3 text-white"><i class="mdi mdi-chart-line text-white mr-3" style="font-size: 1.2rem;"></i> Keep more of your profits with low trading fees</li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <a href="{{ route('register') }}" class="btn btn-primary" style="background:#4A67FF;border-color:#4A67FF;border-radius:6px;padding:10px 24px;">Get Started <i class="mdi mdi-arrow-right"></i></a>
                    <span class="text-muted small ml-4">Leverage may magnify your losses</span>
                </div>
            </div>
            <div class="col-lg-6 h-100 position-relative " data-aos="fade-left">
                <!-- Using a seesaw or generic crypto stack image -->
                <div class="d-flex justify-content-center align-items-center h-100 p-5">
                     <img src="{{ asset('images/image.fcb36e3b.svg') }}" alt="Crypto Balance" class="img-fluid" style="max-height: 300px; filter: drop-shadow(0px 10px 20px rgba(0,0,0,0.5));">
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Trading at your fingertips -->
<section class="section py-5  bg-light-custom dot-grid-bg">
    <div class="container position-relative">
        <div class="position-absolute " style="top:0; right:0; width:15%; height:100%; z-index:1; opacity:0.5;"></div>
        
        <h1 class="font-weight-bold mb-2 position-relative" style="z-index:2; color:#000; font-size:3rem;">Trading at your fingertips</h1>
        <p class="text-muted mb-5 position-relative" style="z-index:2; color:#848E9C !important;">New features, latest webinars and more...</p>
        
        <div class="row align-items-center position-relative" style="z-index:2;">
            <div class="col-lg-6 pr-lg-5 col-md-6 mb-5 col-sm-6" data-aos="fade-right">
                <h4 class="font-weight-bold mb-4" style="color:#000;">Powerful Trading Platforms to help you succeed</h4>
                <p style="color:#4B5563;" class="mb-4">Clients in over 200 countries and territories trade stocks, options, futures, currencies, bonds, funds and more on 150 global markets from a single unified platform.</p>
                <p style="color:#4B5563;" class="mb-4">Spot opportunities and calibrate complete portfolio performance. Keep your performance track record with PortfolioAnalyst inception reporting and historical aggregation at no cost.</p>
                <p style="color:#4B5563;">Our mission is to bring advanced portfolio analytics to everyone who needs them – both professionals and individuals. The best way to do that is to offer them at no cost, with no strings.</p>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0 col-md-6 col-sm-6 mb-5" data-aos="fade-left">
                <!-- Phone App Mockup -->
                <div class="text-center" style="background:#000; border-radius: 12px; padding: 40px 20px 0 20px; overflow: hidden;">
                    <video width="100%" height="100%" autoplay muted loop>
                        <source src="{{ asset('images/assets/video.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Become a Pro Trader -->
<section class="section py-5 bg-light-custom">
    <div class="container position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.5;"></div>
        
        <h1 class="font-weight-bold mb-5 position-relative" style="z-index:2; color:#000; font-size:3rem;">Become a Pro Trader</h1>
        
        <div class="row position-relative" style="z-index:2;">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="pro-trader-card bg-dark-custom rounded-md shadow-lg">
                    <h5 class="text-white font-weight-bold text-uppercase tracking-wide mb-4">A RELIABLE TRADING PLATFORM IS THE FOUNDATION OF SUCCESS</h5>
                    <p class="text-muted small mb-4">Every trader wants to profit in the best conditions and doesn’t want to fear for the safety of personal funds. The first obvious thing a novice trader does is to study different online trading sites.</p>
                    <p class="text-muted small">The main criteria for a successful internet trading platform are international reputation, unwavering reliability, constant support at all stages, and unique useful trading features. These qualities are combined in the award-winning {{ $settings->site_name }} broker and electronic trading platform.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
@include('home.partials.our-values')

<!-- Trade Anywhere -->
@include('home.partials.trade-anywhere')
<!-- Achievement -->
@include('home.partials.achievement')
<!-- CTA -->
@include('home.partials.cta')

<!-- AOS Initialization -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://s3.tradingview.com/tv.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: false,
            offset: 50
        });
    });

  if (window.TradingView) {
        new TradingView.widget({
            "autosize": true,
            "symbol": "BTCUSD",
            "interval": "60",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "5",
            "locale": "en",
            "toolbar_bg": "#161a1e",
            "enable_publishing": false,
            "hide_side_toolbar": false,
            "container_id": "tradingview_widget",
            "studies": [
                "MASimple@tv-basicstudies",
                "RSI@tv-basicstudies"
            ],
        });
    }

</script>

@endsection