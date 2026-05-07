@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'About Our Platform')

@inject('content', 'App\Http\Controllers\FrontController')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">About Us</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->site_name }} has been sharing financial freedom with traders since 2014. In a continuous effort to give traders a more comfortable and safe experience, its experts have been improving the platform ensuring traders can enjoy and make use of that freedom to trade whenever and wherever they like.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Mission Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="{{ asset('images/pexels-vlada-karpovich-7433853.jpg')}}"
                            class="img-fluid rounded shadow-lg" style="border-radius: 20px;" alt="">
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="pl-lg-4">
                        <h2 class="mb-4 font-weight-bold" style="color: #000;">Time to take action with the international {{ $settings->site_name }} broker</h2>
                        <p class="text-muted ">Trading will bring you profit with proper support, constant education, and a reasonable approach. {{ $settings->site_name }} is a broker platform that has created all the conditions to help you improve your trading life in every possible way.</p>

                       <p class="text-muted ">From educational broker’s tools, demo accounts, and 24/7 support to your financial success, {{ $settings->site_name }} works tirelessly to remain at the forefront in trading online. Join now! Take full advantage of this online trading leader and make your way into the world of professional trading.</p>

                        <p class="text-muted ">Our people are our greatest asset - we say it often and with good reason. It is only with the determination and dedication of our people that we can serve our clients, generate long-term value for our shareholders and contribute to the broader public. At every step of our employees careers we invest in them, and ensure their interests remain focused on the long term and closely aligned with those of our clients and shareholders.</p>
                        
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0" style="color: #000;">Licensed & Regulated</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0" style="color: #000;">ESG Integration</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0" style="color: #000;">Global Reach (130+ Countries)</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0" style="color: #000;">Institutional Security</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values / Philosophy -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="mb-3 font-weight-bold text-white" style="font-size: 2.5rem;">Our Investment Philosophy</h2>
                    <p class="text-muted">A disciplined approach to wealth creation, built on rigorous research and risk management.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-shield-search h1 text-primary mb-4 d-block"></i>
                        <h5 class="text-white font-weight-bold mb-3">Robust Oversight</h5>
                        <p class="text-muted mb-0">Our independent risk and quantitative analytics team partners with investment groups to measure behavioral biases and systemic risks.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded-lg border" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-leaf h1 text-primary mb-4 d-block"></i>
                        <h5 class="text-white font-weight-bold mb-3">ESG Integration</h5>
                        <p class="text-muted mb-0">We aim to accelerate the evolution of ESG on behalf of clients and communities, driving transparency and positive planetary impact.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded-lg border" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-trending-up h1 text-primary mb-4 d-block"></i>
                        <h5 class="text-white font-weight-bold mb-3">Clear Processes</h5>
                        <p class="text-muted mb-0">Transparent investment processes detailing how each team identifies and implements opportunities with precise risk/return profiles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Security & Insurance Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold" style="color:#000;">Unwavering Security</h2>
                    <p class="text-muted mb-4">Your safety is our priority. We leverage a multi-layer security architecture and rigorous regulatory compliance to protect your assets 24/7.</p>
                    
                    <div class="mb-4">
                        <h6 style="color:#000;"><i class="mdi mdi-bank mr-2 text-primary"></i> Asset Insurance</h6>
                        <p class="small text-muted">A portion of user assets is protected by our global insurance fund, providing an additional layer of security against unforeseen events.</p>
                    </div>
                    <div class="mb-4">
                        <h6 style="color:#000;"><i class="mdi mdi-lock-outline mr-2 text-primary"></i> Cold Storage</h6>
                        <p class="small text-muted">95% of digital assets are held in offline, geographically distributed cold storage vaults with multi-sig authorization.</p>
                    </div>
                    <div>
                        <h6 style="color:#000;"><i class="mdi mdi-file-check mr-2 text-primary"></i> SEC & UK Registration</h6>
                        <p class="small text-muted">We operate under strict global financial standards, registered across multiple jurisdictions for total transparency.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 order-1 order-lg-2" data-aos="fade-left">
                    <div class="p-5 rounded-lg border shadow-lg bg-dark-custom" >
                        <h4 class="text-center mb-4 font-weight-bold text-white" >By the Numbers</h4>
                        <div class="row text-center">
                            <div class="col-6 mb-4">
                                <h3 class="text-primary mb-0 font-weight-bold">1M+</h3>
                                <span class="small text-muted">Active Users</span>
                            </div>
                            <div class="col-6 mb-4">
                                <h3 class="text-primary mb-0 font-weight-bold">$16M+</h3>
                                <span class="small text-muted">Monthly Payouts</span>
                            </div>
                            <div class="col-6">
                                <h3 class="text-primary mb-0 font-weight-bold">$211M</h3>
                                <span class="small text-muted">Trade Turnover</span>
                            </div>
                            <div class="col-6">
                                <h3 class="text-primary mb-0 font-weight-bold">130+</h3>
                                <span class="small text-muted">Countries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.partials.trade-anywhere')
    @include('home.partials.achievement')
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
