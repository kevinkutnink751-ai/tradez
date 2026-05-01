@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'About Our Platform')

@section('styles')
    @parent
    <style>
         :root {
            --inst-bg: #0B0E11;
            --inst-bg-sec: #161A1E;
            --inst-border: #2B3139;
            --inst-text: #EAECEF;
            --inst-text-muted: #848E9C;
            --inst-accent: #FCD535;
        }
       
        body { background-color: var(--inst-bg) !important; color: var(--inst-text) !important; }
        .section { padding: 100px 0 !important; background-color: var(--inst-bg) !important; }
        .bg-light { background-color: var(--inst-bg-sec) !important; }
        h1, h2, h3, h4, h5, h6 { color: var(--inst-text) !important; }
        .text-muted { color: var(--inst-text-muted) !important; }

        .page-header {
            padding: 120px 0 60px 0;
            background: var(--inst-bg-sec);
            border-bottom: 1px solid var(--inst-border);
        }

        .breadcrumb-item + .breadcrumb-item::before { color: var(--inst-text-muted); }
        .breadcrumb-item a { color: var(--inst-accent); }
        .breadcrumb-item.active { color: var(--inst-text-muted); }

        .about-card {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            padding: 40px;
            border-radius: var(--inst-radius);
            height: 100%;
        }

        .icon-box {
            width: 64px;
            height: 64px;
            background: rgba(252, 213, 53, 0.1);
            color: var(--inst-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--inst-radius);
            font-size: 24px;
            margin-bottom: 24px;
        }
    </style>
@endsection

@inject('content', 'App\Http\Controllers\FrontController')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-3">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 m-0 bg-transparent breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">About Our Mission</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Mission Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="position-relative">
                        <img src="{{ asset('storage/app/public/' . $content->getImage('iAwfKe', 'img_path')) }}"
                            class="img-fluid rounded border border-light" style="border-color: var(--inst-border) !important;" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="pl-lg-4">
                        <h2 class="mb-4">{{ $content->getContent('epJ4LI', 'title') }}</h2>
                        <p class="text-muted mb-4 lead">Sharing financial freedom since 2014. Our platform is built on the principles of transparency, security, and continuous innovation.</p>
                        <p class="text-muted mb-5">{{ $content->getContent('epJ4LI', 'description') }}</p>
                        
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0">Licensed & Regulated</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0">ESG Integration</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0">Global Reach (130+ Countries)</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-check-circle text-success h4 mb-0 mr-3"></i>
                                    <h6 class="mb-0">Institutional Security</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values / Philosophy -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Our Investment Philosophy</h2>
                    <p class="text-muted">A disciplined approach to wealth creation, built on rigorous research and risk management.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="about-card">
                        <div class="icon-box"><i class="mdi mdi-shield-search"></i></div>
                        <h5>Robust Oversight</h5>
                        <p class="text-muted mb-0">Our independent risk and quantitative analytics team partners with investment groups to measure behavioral biases and systemic risks.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="about-card">
                        <div class="icon-box"><i class="mdi mdi-leaf"></i></div>
                        <h5>ESG Integration</h5>
                        <p class="text-muted mb-0">We aim to accelerate the evolution of ESG on behalf of clients and communities, driving transparency and positive planetary impact.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="about-card">
                        <div class="icon-box"><i class="mdi mdi-trending-up"></i></div>
                        <h5>Clear Processes</h5>
                        <p class="text-muted mb-0">Transparent investment processes detailing how each team identifies and implements opportunities with precise risk/return profiles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Security & Insurance Section (New) -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="mb-4">Unwavering Security</h2>
                    <p class="text-muted mb-4">Your safety is our priority. We leverage a multi-layer security architecture and rigorous regulatory compliance to protect your assets 24/7.</p>
                    
                    <div class="mb-4">
                        <h6 class="text-white"><i class="mdi mdi-bank mr-2 text-warning"></i> Asset Insurance</h6>
                        <p class="small text-muted">A portion of user assets is protected by our global insurance fund, providing an additional layer of security against unforeseen events.</p>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-white"><i class="mdi mdi-lock-outline mr-2 text-warning"></i> Cold Storage</h6>
                        <p class="small text-muted">95% of digital assets are held in offline, geographically distributed cold storage vaults with multi-sig authorization.</p>
                    </div>
                    <div>
                        <h6 class="text-white"><i class="mdi mdi-file-check mr-2 text-warning"></i> SEC & UK Registration</h6>
                        <p class="small text-muted">We operate under strict global financial standards, registered across multiple jurisdictions for total transparency.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 order-1 order-lg-2">
                    <div class="p-5 bg-light rounded border border-light" style="border-color: var(--inst-border) !important;">
                        <h4 class="text-center mb-4">By the Numbers</h4>
                        <div class="row text-center">
                            <div class="col-6 mb-4">
                                <h3 class="text-warning mb-0">1M+</h3>
                                <span class="small text-muted">Active Users</span>
                            </div>
                            <div class="col-6 mb-4">
                                <h3 class="text-warning mb-0">$16M+</h3>
                                <span class="small text-muted">Monthly Payouts</span>
                            </div>
                            <div class="col-6">
                                <h3 class="text-warning mb-0">$211M</h3>
                                <span class="small text-muted">Trade Turnover</span>
                            </div>
                            <div class="col-6">
                                <h3 class="text-warning mb-0">130+</h3>
                                <span class="small text-muted">Countries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sign up Section -->
    <section class="py-5" style="background: var(--inst-bg-sec); border-top: 1px solid var(--inst-border);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-center text-md-left mb-4 mb-md-0">
                    <h3 class="mb-2">Join the future of professional trading.</h3>
                    <p class="text-muted mb-0">Create your institutional-grade account in less than 5 minutes.</p>
                </div>
                <div class="col-md-4 text-center text-md-right">
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Get Started Now</a>
                </div>
            </div>
        </div>
    </section>
@endsection
