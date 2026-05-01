@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', $settings->site_title)

@section('styles')
    @parent
    <style>
        /* Institutional Design System */
        :root {
            --inst-bg: #0B0E11;
            --inst-bg-sec: #161A1E;
            --inst-border: #2B3139;
            --inst-text: #EAECEF;
            --inst-text-muted: #848E9C;
            --inst-accent: #FCD535; /* Professional Muted Gold */
            --inst-success: #0ECB81;
            --inst-danger: #F6465D;
            --inst-radius: 4px;
        }

        body {
            background-color: var(--inst-bg) !important;
            color: var(--inst-text) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        }

    

        .btn-primary {
            background-color: var(--inst-accent) !important;
            border-color: var(--inst-accent) !important;
            color: #000 !important;
            font-weight: 700 !important;
            border-radius: var(--inst-radius) !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 24px !important;
        }

        .btn-outline-primary {
            border: 1px solid var(--inst-border) !important;
            color: var(--inst-text) !important;
            background: transparent !important;
            border-radius: var(--inst-radius) !important;
            font-weight: 600 !important;
        }

        .section {
            padding: 100px 0 !important;
            background-color: var(--inst-bg) !important;
        }

        .bg-soft-primary {
            background-color: var(--inst-bg-sec) !important;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--inst-text) !important;
            font-weight: 700 !important;
        }

        .text-muted {
            color: var(--inst-text-muted) !important;
        }

        /* Hero Section */
        .hero-section {
            padding: 160px 0 100px 0;
            background: radial-gradient(circle at 70% 30%, rgba(252, 213, 53, 0.05) 0%, transparent 50%);
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 24px;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            color: var(--inst-text-muted);
            margin-bottom: 40px;
            max-width: 540px;
        }

        /* Stats Cards */
        .stat-card {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            padding: 24px;
            border-radius: var(--inst-radius);
            text-align: center;
        }

        .stat-val {
            font-size: 24px;
            font-weight: 700;
            color: var(--inst-text);
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: var(--inst-text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        /* Feature Cards */
        .feature-card {
            background: var(--inst-bg);
            border: 1px solid var(--inst-border);
            padding: 40px;
            height: 100%;
            border-radius: var(--inst-radius);
            transition: border-color 0.3s;
        }

        .feature-card:hover {
            border-color: var(--inst-accent);
        }

        .feature-icon {
            color: var(--inst-accent);
            font-size: 32px;
            margin-bottom: 24px;
            display: inline-block;
        }

        /* Market Table Mockup */
        .market-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .market-table th {
            padding: 16px;
            text-align: left;
            color: var(--inst-text-muted);
            font-size: 12px;
            border-bottom: 1px solid var(--inst-border);
        }

        .market-table td {
            padding: 16px;
            border-bottom: 1px solid var(--inst-border);
            font-size: 14px;
            font-weight: 600;
        }

        .price-up { color: var(--inst-success); }
        .price-down { color: var(--inst-danger); }

        /* Experience Section */
        .exp-ui-mockup {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        /* Footer Overrides */
        footer {
            background-color: var(--inst-bg) !important;
            border-top: 1px solid var(--inst-border) !important;
            padding: 80px 0 40px 0 !important;
        }

        footer .footer-list li a {
            color: var(--inst-text-muted) !important;
        }

        footer .footer-list li a:hover {
            color: var(--inst-accent) !important;
        }
    </style>
@endsection

@inject('content', 'App\Http\Controllers\FrontController')

@section('content')
    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="px-2 py-1 small rounded border border-warning text-warning font-weight-bold mr-2" style="background: rgba(252, 213, 53, 0.1)">
                                NEW
                            </div>
                            <span class="text-muted small font-weight-bold uppercase">{{ $content->getContent('rXJ7JQ', 'title') }}</span>
                        </div>
                        <h1 class="hero-title">Purpose-Driven Copytrading, Built on Innovation.</h1>
                        <p class="hero-subtitle">Trade smarter, not harder, by automatically mirroring the strategies of top-performing investors. Grow your portfolio with institutional-grade transparency and control.</p>
                        
                        <div class="d-flex gap-3 mt-5">
                            <a href="{{ url('/register') }}" class="btn btn-primary mr-3">Start Trading Now</a>
                            <a href="#markets" class="btn btn-outline-primary">View Real-Time Markets</a>
                        </div>
                        
                        <div class="mt-5 d-flex align-items-center text-muted small">
                            <div class="mr-4"><i class="mdi mdi-check-circle text-success mr-1"></i> Fast Onboarding</div>
                            <div class="mr-4"><i class="mdi mdi-check-circle text-success mr-1"></i> Multi-Asset Support</div>
                            <div><i class="mdi mdi-check-circle text-success mr-1"></i> 24/7 Expert Support</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Subtle SVG Chart Visual -->
                    <svg viewBox="0 0 500 300" class="w-100" style="opacity: 0.6;">
                        <path d="M0,250 L50,230 L100,240 L150,180 L200,200 L250,120 L300,150 L350,80 L400,100 L450,40 L500,60" 
                              fill="none" stroke="var(--inst-accent)" stroke-width="2" />
                        <path d="M0,250 L50,230 L100,240 L150,180 L200,200 L250,120 L300,150 L350,80 L400,100 L450,40 L500,60 L500,300 L0,300 Z" 
                              fill="url(#grad1)" opacity="0.1" />
                        <defs>
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:var(--inst-accent);stop-opacity:1" />
                                <stop offset="100%" style="stop-color:var(--inst-accent);stop-opacity:0" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. MARKET OVERVIEW / STATS -->
    <section class="py-4 border-top border-bottom border-light" style="border-color: var(--inst-border) !important; background: var(--inst-bg-sec);">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6 mb-3 mb-lg-0">
                    <div class="stat-card border-0">
                        <span class="stat-val">130+</span>
                        <span class="stat-label">Countries Supported</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3 mb-lg-0">
                    <div class="stat-card border-0">
                        <span class="stat-val">1M+</span>
                        <span class="stat-label">Active Accounts</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3 mb-lg-0">
                    <div class="stat-card border-0">
                        <span class="stat-val">$211M+</span>
                        <span class="stat-label">Monthly Volume</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3 mb-lg-0">
                    <div class="stat-card border-0">
                        <span class="stat-val">99.9%</span>
                        <span class="stat-label">Platform Uptime</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FEATURES / CAPABILITIES -->
    <section class="section" id="markets">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Institutional-Grade Execution</h2>
                    <p class="text-muted">Built for speed, security, and deep liquidity across all global markets.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-zap feature-icon"></i>
                        <h5>Ultra-Low Latency</h5>
                        <p class="text-muted mb-0">Order execution from 0.1 seconds. Experience seamless trading with high-speed connectivity to global liquidity pools.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-shield-lock feature-icon"></i>
                        <h5>Bank-Grade Security</h5>
                        <p class="text-muted mb-0">Multi-layer security protocols, cold storage for digital assets, and full regulatory compliance to safeguard your funds.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="mdi mdi-chart-ppc feature-icon"></i>
                        <h5>Tightest Spreads</h5>
                        <p class="text-muted mb-0">Trade with spreads as low as 0.0 pips. Optimize your profit margins with our competitive pricing engine.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TRADING EXPERIENCE SECTION -->
    <section class="section bg-soft-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="exp-ui-mockup">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-light" style="border-color: var(--inst-border) !important;">
                            <span class="text-white font-weight-bold">Markets Terminal</span>
                            <div class="d-flex gap-2">
                                <div style="width:10px;height:10px;background:#ff5f56;border-radius:50%"></div>
                                <div style="width:10px;height:10px;background:#ffbd2e;border-radius:50%"></div>
                                <div style="width:10px;height:10px;background:#27c93f;border-radius:50%"></div>
                            </div>
                        </div>
                        <table class="market-table">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Price</th>
                                    <th>Change</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BTC/USDT</td>
                                    <td>64,231.50</td>
                                    <td class="price-up">+2.45%</td>
                                </tr>
                                <tr>
                                    <td>ETH/USDT</td>
                                    <td>3,452.12</td>
                                    <td class="price-down">-1.12%</td>
                                </tr>
                                <tr>
                                    <td>AAPL/USD</td>
                                    <td>189.45</td>
                                    <td class="price-up">+0.67%</td>
                                </tr>
                                <tr>
                                    <td>XAU/USD</td>
                                    <td>2,341.20</td>
                                    <td class="price-up">+1.22%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pl-lg-5">
                        <h2 class="mb-4">One Unified Interface for All Markets</h2>
                        <p class="text-muted mb-4">Switch between Forex, Crypto, Stocks, and Commodities in seconds. Our terminal is built for professional traders who require speed and precision.</p>
                        
                        <div class="mt-4">
                            <div class="d-flex mb-3">
                                <i class="mdi mdi-check text-success h5 mr-3"></i>
                                <div>
                                    <h6 class="mb-1">Advanced Charting Tools</h6>
                                    <p class="small text-muted mb-0">Built-in TradingView charts with 100+ indicators and drawing tools.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="mdi mdi-check text-success h5 mr-3"></i>
                                <div>
                                    <h6 class="mb-1">Smart Risk Management</h6>
                                    <p class="small text-muted mb-0">Automated Stop-Loss, Take-Profit, and Trailing orders for every trade.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <i class="mdi mdi-check text-success h5 mr-3"></i>
                                <div>
                                    <h6 class="mb-1">Real-Time Sync</h6>
                                    <p class="small text-muted mb-0">Instant execution across mobile, desktop, and web platforms.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TRUST & CREDIBILITY -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Reliability You Can Bank On</h2>
                    <p class="text-muted">Transparency and trust are the foundation of our trading ecosystem.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="p-4 rounded border border-light text-center h-100" style="border-color: var(--inst-border) !important;">
                        <h6 class="text-uppercase text-muted small mb-3">Licensed & Regulated</h6>
                        <p class="mb-0">Authorized financial services provider and exchange, maintaining full compliance with global regulatory standards.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 rounded border border-light text-center h-100" style="border-color: var(--inst-border) !important;">
                        <h6 class="text-uppercase text-muted small mb-3">Transparent Fees</h6>
                        <p class="mb-0">Zero hidden costs. All fees are clearly disclosed upfront, ensuring you keep more of your trading profits.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 rounded border border-light text-center h-100" style="border-color: var(--inst-border) !important;">
                        <h6 class="text-uppercase text-muted small mb-3">24/7 Global Support</h6>
                        <p class="mb-0">Dedicated expert support team available around the clock with a 30-second average response time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FINAL CTA -->
    <section class="py-5" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('{{ asset('temp/images/bg/cta-bg.jpg') }}') center center; background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Ready to take control of your financial future?</h2>
                    <p class="text-muted mb-5 px-lg-5">Join millions of traders worldwide and start earning with the most advanced copytrading platform in the industry.</p>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Open Your Free Account</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER is handled by layouts.base, but we applied global styles to it -->
@endsection

@section('scripts')
    @parent
    <script>
        // Custom scripts for the new landing page
        $(document).ready(function() {
            // Smooth scroll for internal links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = this.hash;
                var $target = $(target);
                if($target.length) {
                    $('html, body').stop().animate({
                        'scrollTop': $target.offset().top - 70
                    }, 900, 'swing');
                }
            });
        });
    </script>
@endsection
