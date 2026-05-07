@inject('content', 'App\Http\Controllers\FrontController')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->site_name }} | @yield('title')</title>

    <meta name="description" content="{{ $settings->description }}">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $settings->site_name }} - {{ $settings->site_title }}">
    <meta itemprop="description" content="{{ $settings->description }}">
    <meta itemprop="image" content="{{ asset('themes/purposeTheme/temp/images/meta.png') }}">

    <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />
    @section('styles')

        <link href="{{ asset('themes/purposeTheme/temp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="{{ asset('themes/purposeTheme/temp/css/materialdesignicons.min.css') }}" rel="stylesheet"
            type="text/css" />

        <!-- Magnific -->
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/temp/css/line.css') }}">
        <link href="{{ asset('themes/purposeTheme/temp/css/flexslider.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/purposeTheme/temp/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css')}}" />

        <!-- Slider -->
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/temp/css/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/temp/css/owl.theme.default.min.css') }}" />
        @php
            $theme = $settings->website_theme == 'purpose.css' ? 'default.css' : $settings->website_theme;
        @endphp
        <!-- Main Css -->
        <link href="{{ asset('themes/purposeTheme/temp/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/purposeTheme/temp/css/colors/' . $theme) }}" rel="stylesheet">
        <link href="{{ asset('assets/css/home-modern.css') }}" rel="stylesheet" />
        
        <style>
               /* Institutional Design System Overrides */
           :root {
            --inst-bg: #0B0E11;
            --inst-bg-sec: #161A1E;
            --inst-border: #2B3139;
            --inst-light-bg-alt: #EAECEF;
            --inst-text: #EAECEF;
            --inst-text-muted: #848E9C;
            --inst-primary: #0e4152;
            --inst-accent:  #2980b9; /* Professional Muted Gold */
            --inst-success: #0ECB81;
            --inst-danger: #F6465D;
            --inst-radius: 4px;
        }
            /* Institutional Navigation & Megamenu */
            #topnav { 
                background-color: var(--inst-bg) !important; 
                border-bottom: 1px solid var(--inst-border) !important;
                transition: none;
            }
            #topnav.scroll { background-color: rgba(11, 14, 17, 0.98) !important; }
            
            #topnav .navigation-menu > li > a {
                color: var(--inst-text) !important;
                font-weight: 500;
                letter-spacing: 0.5px;
            }
            #topnav .navigation-menu > li:hover > a, #topnav .navigation-menu > li.active > a {
                color: var(--inst-accent) !important;
            }

            #topnav .navigation-menu > li .submenu.megamenu {
                width: 650px;
                display: flex !important;
                padding: 30px;
                left: -100px;
                background: var(--inst-bg-sec) !important;
                border: 1px solid var(--inst-border) !important;
                border-radius: var(--inst-radius);
                box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            }
            #topnav .navigation-menu > li .submenu.megamenu > li {
                width: 50%;
                float: none;
            }
            .megamenu-head {
                color: var(--inst-accent) !important;
                font-size: 11px !important;
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                padding: 0 20px 15px 20px !important;
                border-bottom: 1px solid var(--inst-border);
                margin-bottom: 15px;
            }
            #topnav .navigation-menu > li .submenu li a {
                color: var(--inst-text-muted) !important;
                transition: none;
                font-size: 13px;
                padding: 8px 20px !important;
                display: block;
            }
            #topnav .navigation-menu > li .submenu li a:hover {
                color: var(--inst-accent) !important;
                background: rgba(252, 213, 53, 0.05);
            }
            #topnav .menu-overlay {
                display: none;
            }
            
            /* Global Page Consolidations & Background Variations */
            .section { padding: 80px 0 !important; transition: all 0.3s; position: relative; overflow: hidden; }
            
            .bg-inst-dark { background-color: var(--inst-bg) !important; }
            .bg-inst-secondary { background-color: var(--inst-bg-sec) !important; }
            
            .bg-inst-gradient { 
                background: radial-gradient(circle at 100% 0%, rgba(252, 213, 53, 0.03) 0%, transparent 40%),
                            radial-gradient(circle at 0% 100%, rgba(252, 213, 53, 0.02) 0%, transparent 40%),
                            var(--inst-bg) !important;
            }
            
            .bg-inst-grid {
                background-color: var(--inst-bg) !important;
                background-image: linear-gradient(rgba(43, 49, 57, 0.2) 1px, transparent 1px),
                                  linear-gradient(90deg, rgba(43, 49, 57, 0.2) 1px, transparent 1px);
                background-size: 50px 50px;
            }
            
            .bg-inst-mesh {
                background-color: var(--inst-bg) !important;
                background-image: radial-gradient(at 50% 0%, rgba(252, 213, 53, 0.05) 0%, transparent 50%),
                                  radial-gradient(at 100% 100%, rgba(22, 26, 30, 1) 0%, transparent 100%);
            }

            .bg-inst-stripe {
                background: repeating-linear-gradient(45deg, rgba(43, 49, 57, 0.1), rgba(43, 49, 57, 0.1) 1px, transparent 1px, transparent 10px);
                background-color: var(--inst-bg-sec);
            }
            
            .border-bottom, .border-secondary { border-color: var(--inst-border) !important; }
            
            /* Remove white borders/lines from common components */
          
            .text-muted { color: var(--inst-text-muted) !important; }
           

            /* Institutional Footer Styling */
            .footer {
                background-color: var(--inst-bg) !important;
                border-top: 1px solid var(--inst-border) !important;
                padding: 80px 0 40px 0 !important;
            }
            .footer .footer-head {
                font-size: 14px !important;
                font-weight: 700 !important;
                color: var(--inst-text) !important;
                margin-bottom: 25px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .footer .footer-list li a {
                color: var(--inst-text-muted) !important;
                font-size: 13px !important;
                transition: all 0.3s;
                text-decoration: none !important;
            }
            .footer .footer-list li a:hover {
                color: var(--inst-accent) !important;
            }
            .legal-disclaimer-box {
                background: var(--inst-bg-sec);
                border: 1px solid var(--inst-border);
                padding: 30px;
                border-radius: var(--inst-radius);
                margin-top: 50px;
                font-size: 11px;
                line-height: 1.8;
                color: var(--inst-text-muted);
            }
            .footer-bar {
                background: var(--inst-bg) !important;
                border-top: 1px solid var(--inst-border) !important;
                padding: 30px 0 !important;
            }
            .btn-primary { 
                background-color: var(--inst-accent) !important; 
                border-color: var(--inst-accent) !important; 
                color: #000 !important; 
                font-weight: 600;
                border-radius: 2px;
            }
            .btn-outline-light {
                border-color: var(--inst-border) !important;
                color: var(--inst-text) !important;
                border-radius: 2px;
            }
            .btn-outline-light:hover {
                background: var(--inst-border) !important;
            }
            .topnav-shell {
                display: flex;
                align-items: center;
                gap: 1.25rem;
                min-height: 76px;
            }
            #topnav .logo {
                display: inline-flex;
                align-items: center;
                flex: 0 0 auto;
            }
            #topnav .buy-button {
                flex: 0 0 auto;
                display: flex;
                align-items: center;
                gap: 0.65rem;
            }
            #topnav .buy-button .btn,
            #topnav .buy-menu-btn .btn {
                white-space: nowrap;
            }
            #topnav #navigation {
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 1 1 auto;
                min-width: 0;
                margin-left: 0;
            }
            #topnav .navigation-menu {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 0;
                gap: 0.25rem;
            }
            #topnav .buy-menu-btn {
                display: none;
            }
            #topnav .menu-extras {
                display: none;
            }
            .menu-extras .menu-item {
                display: flex;
                align-items: center;
            }
            #topnav .navbar-toggle {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            #topnav .navigation-menu > li > a {
                padding: 0.7rem 0.85rem;
                border-radius: 10px;
                line-height: 1.2;
            }
            #topnav .navigation-menu > li:hover > a,
            #topnav .navigation-menu > li.active > a {
                background: rgba(255,255,255,0.03);
            }
            .buy-button .btn,
            .buy-menu-btn .btn {
                border-radius: 10px;
                padding: 0.78rem 1.05rem !important;
            }
            #topnav .buy-button .btn:first-child {
                background: rgba(255,255,255,0.04) !important;
                border-color: rgba(255,255,255,0.1) !important;
                color: var(--inst-text) !important;
            }
            @media (min-width: 992px) {
                #topnav .navigation-menu > li {
                    position: relative;
                }
                #topnav .navigation-menu > li .submenu.megamenu {
                    top: calc(100% + 14px);
                }
            }
            @media (max-width: 991.98px) {
                body.mobile-nav-open {
                    overflow: hidden;
                }
                .topnav-shell {
                    gap: 1rem;
                    padding: 0.85rem 0;
                }
                #topnav .buy-button {
                    display: none;
                }
                #topnav .menu-extras {
                    display: flex;
                    margin-left: auto;
                }
                #topnav .menu-overlay {
                    display: none;
                    position: fixed;
                    inset: 0;
                    background: rgba(4, 8, 14, 0.72);
                    z-index: 900;
                }
                body.mobile-nav-open #topnav .menu-overlay {
                    display: block;
                }
                #topnav #navigation {
                    position: fixed;
                    top: 0;
                    right: 0;
                    box-sizing: border-box;
                    display: none !important;
                    flex-direction: column;
                    align-items: stretch;
                    justify-content: flex-start;
                    width: min(100vw, 390px);
                    height: 100vh;
                    height: 100dvh;
                    max-height: 100vh;
                    max-height: 100dvh;
                    margin-left: 0;
                    padding: 5.5rem 1.5rem max(1.5rem, env(safe-area-inset-bottom));
                    border-top: 0;
                    background: linear-gradient(180deg, #0b0e11 0%, #13181f 100%);
                    border-left: 1px solid var(--inst-border);
                    overflow-x: hidden;
                    overflow-y: auto;
                    overscroll-behavior: contain;
                    z-index: 1000;
                    filter: none !important;
                    transform: none !important;
                    transition: none !important;
                    box-shadow: -12px 0 32px rgba(0, 0, 0, 0.32);
                }
                body.mobile-nav-open #topnav #navigation {
                    display: flex !important;
                }
                #topnav .navigation-menu {
                    display: block;
                    width: 100%;
                    flex: 0 0 auto;
                    padding: 0;
                    margin: 0;
                    list-style: none;
                }
                #topnav .navigation-menu > li {
                    position: relative;
                    float: none;
                    margin: 0;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                }
                #topnav .navigation-menu > li:last-child {
                    border-bottom: 0;
                }
                #topnav .navigation-menu > li > a {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 1rem 0;
                    border-radius: 0;
                    color: var(--inst-text) !important;
                    font-size: 1.05rem;
                    line-height: 1.35;
                    width: 100%;
                }
                #topnav .navigation-menu > li > .menu-arrow {
                    position: absolute;
                    top: 1.12rem;
                    right: 0;
                    pointer-events: none;
                    opacity: 0.7;
                    transition: none;
                }
                #topnav .navigation-menu > li.open > .menu-arrow {
                    transform: rotate(180deg);
                    opacity: 1;
                }
                #topnav .navigation-menu > li .submenu.megamenu,
                #topnav .navigation-menu > li .submenu {
                    position: static;
                    width: 100%;
                    display: none !important;
                    left: auto;
                    padding: 0.25rem 0 1rem;
                    margin: 0 0 1em 0;
                    border: 1px solid rgba(255, 255, 255, 0.05) !important;
                    border-radius: 18px;
                    box-shadow: none;
                    background: rgba(255,255,255,0.025) !important;
                }
                #topnav .navigation-menu > li.open > .submenu.megamenu,
                #topnav .navigation-menu > li.open > .submenu {
                    display: block !important;
                }
                #topnav .navigation-menu > li .submenu.megamenu > li {
                    width: 100%;
                }
                .megamenu-head {
                    padding: 1rem 1rem 0.5rem !important;
                    margin-bottom: 0.5rem;
                }
                #topnav .navigation-menu > li .submenu li a {
                    padding: 0.75rem 1rem !important;
                    font-size: 0.92rem;
                    color: #d7dde7 !important;
                }
                #topnav .navigation-menu > li .submenu li a:hover {
                    transform: none;
                    background: transparent;
                }
                #topnav .buy-menu-btn {
                    display: flex;
                    flex-direction: column;
                    gap: 0.75rem;
                    flex: 0 0 auto;
                    padding-top: 1.25rem;
                    width: 100%;
                }
                #topnav .buy-menu-btn .btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    max-width: none;
                    margin: 0 !important;
                    border-radius: 14px;
                    min-height: 52px;
                }
                #topnav .buy-menu-btn .btn:first-child {
                    background: rgba(255,255,255,0.04) !important;
                    border-color: rgba(255,255,255,0.1) !important;
                    color: var(--inst-text) !important;
                }
                #topnav .navbar-toggle {
                    position: relative;
                    z-index: 1001;
                }
                body.mobile-nav-open #topnav .navbar-toggle {
                    position: fixed;
                    top: 1rem;
                    right: 1rem;
                    z-index: 1001;
                }
                #topnav .navbar-toggle .lines {
                    width: 22px;
                }
                #topnav .navbar-toggle .lines span {
                    display: block;
                    height: 2px;
                    margin: 5px 0;
                    background: var(--inst-text);
                    transition: none;
                }
                body.mobile-nav-open #topnav .navbar-toggle .lines span:nth-child(1) {
                    transform: translateY(7px) rotate(45deg);
                }
                body.mobile-nav-open #topnav .navbar-toggle .lines span:nth-child(2) {
                    opacity: 0;
                }
                body.mobile-nav-open #topnav .navbar-toggle .lines span:nth-child(3) {
                    transform: translateY(-7px) rotate(-45deg);
                }
            }
            @media (max-width: 420px) {
                #topnav #navigation {
                    width: 100vw;
                    padding-left: 1.5rem;
                    padding-right: 1.5rem;
                    border-left: 0;
                }
            }
        </style>
    @show

</head>

<body>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        {{!! $settings->tawk_to !!}}
    </script>


    <!-- Navbar STart -->
    <header id="topnav" class="sticky defaultscroll">
        <div class="container">
            <div class="topnav-shell">
            <!-- Logo container-->
            <div>
                <a class="logo" href="/">
                    <img src="{{ asset('storage/app/public/' . $settings->logo) }}" height="35" alt=""
                        class="mr-2">
                </a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" href="#" aria-label="Toggle navigation">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="javascript:void(0)">Products</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li class="megamenu-head">Trading Markets</li>
                                    <li><a href="{{ route('product.forex') }}">Forex Trading</a></li>
                                    <li><a href="{{ route('product.spot') }}">Spot Trading</a></li>
                                    <li><a href="{{ route('product.swing') }}">Swing Trading</a></li>
                                    <li><a href="{{ route('product.futures') }}">Futures Contracts</a></li>
                                    <li><a href="{{ route('product.options') }}">Options Trading</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="megamenu-head">Digital Assets</li>
                                    <li><a href="{{ route('product.cryptoSpot') }}">Crypto Spot</a></li>
                                    <li><a href="{{ route('product.nft') }}">NFT Marketplace</a></li>
                                    
                                    <li><a href="{{ route('product.defiStaking') }}">DeFi Staking</a></li>
                                    <li><a href="{{ route('product.yieldFarming') }}">Yield Farming</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Copy Trading</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li class="megamenu-head">Social Mirroring</li>
                                    <li><a href="{{ route('product.optionCopy') }}">Option Copy Trading</a></li>
                                    <li><a href="{{ route('product.mirroring') }}">Expert Mirroring</a></li>
                                    <li><a href="{{ route('masterAccount') }}">Expert Accounts</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="megamenu-head">Strategies</li>
                                    <li><a href="{{ route('product.strategy') }}">Strategy Marketplace</a></li>
                                    <li><a href="{{ url('/login') }}">Algorithm Signals</a></li>
                                    <li><a href="{{ url('/login') }}">Performance Analytics</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Tools</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li class="megamenu-head">Trading Desks</li>
                                    <li><a href="{{ route('product.liveTrading') }}">Live Trading</a></li>
                                    <li><a href="{{ route('product.advanceTrading') }}">Advanced Trading</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="megamenu-head">Resources</li>
                                    <li><a href="{{ url('/faq') }}">Market Analysis</a></li>
                                    <li><a href="{{ url('/faq') }}">Economic Calendar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Company</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li class="megamenu-head">About Us</li>
                                    <li><a href="{{ url('/about') }}">Our Story</a></li>
                                    <li><a href="{{ route('insurance') }}">Insurance</a></li>
                                    <li><a href="{{ route('security') }}">Security Protocol</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="megamenu-head">Compliance</li>
                                    <li><a href="{{ route('regulations') }}">Regulatory Framework</a></li>
                                    <li><a href="{{ url('/terms') }}">Client Agreement</a></li>
                                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ url('/contact') }}">Support</a></li>
                </ul>

                <!--end navigation menu-->
                
                <div class="buy-menu-btn gap-2">
                @guest
                    <a href="{{ url('/login') }}" target="_blank" class="btn btn-primary login-btn-success ">Login</a>
                    <a href="{{ url('/register') }}" target="_blank" class="btn btn-outline-primary login-btn-success "  >Get Started</a>
                @endguest
                @auth
                     <a href="{{ route('dashboard') }}" target="_blank" class="btn btn-primary login-btn-success " >Dashboard</a>
                @endauth
                </div>

                <!--end login button-->
            </div>
            <div class="buy-button">
             @guest
                <a href="{{ url('/login') }}" class="btn btn-primary login-btn-success " style="margin: 0 1em 0 1em;">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-primary login-btn-success " style="margin: 0 1em 0 1em;">Get Started</a>
                 @endguest
                  @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary login-btn-success " style="margin: 0 1em 0 1em;">Dashboard</a>
                @endauth
            </div>
            <div class="menu-overlay"></div>
            <!--end navigation-->
            </div>
        </div>
        <!--end container-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    @yield('content')



    <!-- Footer Start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 mb-4 mb-md-0">
                    <a href="/" class="logo-footer">
                        <img src="{{ asset('storage/app/public/' . $settings->logo) }}" height="28" alt="">
                    </a>
                    <p class="mt-4 text-muted small">{{ $settings->description }}</p>
                    <ul class="list-unstyled social-icon social mb-0 mt-4">
                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="instagram" class="fea icon-sm"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm"></i></a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mt-4 mt-sm-0">
                    <h5 class="footer-head">Trades</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ route('product.futures') }}">FX & Futures</a></li>
                        <li><a href="{{ route('product.options') }}">Buy Options</a></li>
                        <li><a href="{{ url('/login') }}">Oil & Gas</a></li>
                        <li><a href="{{ url('/login') }}">Swing Trading</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mt-4 mt-sm-0">
                    <h5 class="footer-head">Tools</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ route('product.optionCopy') }}">Option Copy Trading</a></li>
                        <li><a href="{{ route('product.advanceTrading') }}">FX & Advance Trading</a></li>
                        <li><a href="{{ route('product.liveTrading') }}">Buy Live Trading</a></li>
                        <li><a href="{{ route('masterAccount') }}">Master Account</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mt-4 mt-sm-0">
                    <h5 class="footer-head">Company</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ url('/about') }}">About us</a></li>
                        <li><a href="{{ route('insurance') }}">Insurance</a></li>
                        <li><a href="{{ url('/login') }}">Demo Account</a></li>
                        <li><a href="{{ route('security') }}">Security</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mt-4 mt-sm-0">
                    <h5 class="footer-head">Support</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        <li><a href="{{ url('/faq') }}">System Status</a></li>
                        <li><a href="{{ url('/faq') }}">Market News</a></li>
                        <li><a href="{{ url('/contact') }}">Refer a Friend</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="legal-disclaimer-box">
                        <p class="mb-3"><b>Risk Warning:</b> CFDs are complex instruments and come with a high risk of losing money rapidly due to leverage. You should consider copying a Lead Trader we provide that understand how CFDs work without the risk of losing your money. Trading derivatives is risky. It isn't suitable for everyone but only suitable for Lead Traders; you could lose substantially more than your initial investment if you don't copy trades from Lead Traders.</p>
                        
                        <p class="mb-3"><b>{{ $settings->site_name }}</b> is a global financial services provider. {{ $settings->site_name }} is a registered trademark of the group, that operates among various entities.</p>
                        
                        <p class="mb-3">{{ $settings->site_name }} is registered in Canada, registration number: 2023-00465. Registered address: 11264 Playa Court, Culver City, CA 90230, Canada.</p>
                        
                        <p class="mb-3">{{ $settings->site_name }} is registered in the United Kingdom, Company number 1054675. Registered address: 100 Pall Mall, St. James's London SW1Y 5NQ, United Kingdom.</p>
                        
                        <p class="mb-0">© {{ date('Y') }} This website and technology/platform services are owned and operated by CLT Global Markets (Aust) Pty Limited, with Registered address: 11264 Playa Court Culver City, California. SEC: (000-56441).</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->




    @section('scripts')
        <!-- javascript -->
        <script src="{{ asset('themes/purposeTheme/temp/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/temp/js/bootstrap.bundle.min.js') }}"></script>

        <!-- SLIDER -->
        <script src="{{ asset('themes/purposeTheme/temp/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/temp/js/owl.init.js') }}"></script>
        <!-- Icons -->
        <script src="{{ asset('themes/purposeTheme/temp/js/feather.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/temp/js/bundle.js') }}"></script>

        <script src="{{ asset('themes/purposeTheme/temp/js/app.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/temp/js/widget.js') }}"></script>
    @show
        <script src="{{ asset('themes/purposeTheme/assets/js/scriptfile.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const body = document.body;
                const navToggle = document.querySelector('#topnav .navbar-toggle');
                const navPanel = document.getElementById('navigation');
                const overlay = document.querySelector('#topnav .menu-overlay');
                const submenuParents = document.querySelectorAll('#topnav .has-submenu');
                const desktopBreakpoint = window.matchMedia('(min-width: 992px)');

                if (!navToggle || !navPanel) {
                    return;
                }

                const closeMobileNav = function() {
                    body.classList.remove('mobile-nav-open');
                    navPanel.removeAttribute('style');
                    submenuParents.forEach(function(item) {
                        item.classList.remove('open');
                    });
                };

                const handleBreakpointChange = function(event) {
                    if (event.matches) {
                        closeMobileNav();
                    }
                };

                navToggle.addEventListener('click', function(event) {
                    if (window.innerWidth >= 992) {
                        return;
                    }
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    navPanel.removeAttribute('style');
                    body.classList.toggle('mobile-nav-open');
                }, true);

                if (overlay) {
                    overlay.addEventListener('click', closeMobileNav);
                }

                navPanel.addEventListener('click', function(event) {
                    if (window.innerWidth >= 992) {
                        return;
                    }

                    const trigger = event.target.closest('.has-submenu > a, .has-submenu > .menu-arrow');
                    if (!trigger || !navPanel.contains(trigger)) {
                        return;
                    }

                    const item = trigger.closest('.has-submenu');
                    if (!item) {
                        return;
                    }

                    event.preventDefault();
                    event.stopImmediatePropagation();

                    const isOpen = item.classList.contains('open');
                    submenuParents.forEach(function(otherItem) {
                        if (otherItem !== item) {
                            otherItem.classList.remove('open');
                        }
                    });
                    item.classList.toggle('open', !isOpen);
                }, true);

                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        closeMobileNav();
                    }
                });

                desktopBreakpoint.addEventListener('change', handleBreakpointChange);
            });
        </script>
    @stack('scripts')
</body>

</html>
