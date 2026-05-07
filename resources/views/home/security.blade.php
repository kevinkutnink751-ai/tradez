@extends('layouts.base')
@section('title', 'Security & Asset Protection')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Security</h1>
                    <p class="text-muted lead mb-5 max-width-700">Your security is our top priority. We employ industry-leading encryption, multi-factor authentication, and continuous monitoring to ensure your data and transactions remain safe at all times.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fund Security Grid -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 bg-dark rounded-md border shadow-sm  text-center">
                        <img src="{{ asset('images/assets/segregated-funds.svg') }}" style="width: 50px; margin-bottom: 25px;" alt="Segregated funds">
                        <h4 class="font-weight-bold text-white mb-3">Segregated funds</h4>
                        <p class="text-muted small mb-0">Your capital is segregated from the company’s funds and is never used for the company’s business interests.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flexmb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 bg-dark rounded-md border shadow-sm  text-center">
                        <img src="{{ asset('images/assets/top-tier-banks.svg') }}" style="width: 50px; margin-bottom: 25px;" alt="Top-tier banks">
                        <h4 class="font-weight-bold text-white mb-3">Top-tier banks</h4>
                        <p class="text-muted small mb-0">We only partner with top-tier, low-credit-risk banks to ensure our clients’ funds are protected.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flexmb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 bg-dark rounded-md border shadow-sm  text-center">
                        <img src="{{ asset('images/assets/capital-adequacy.svg') }}" style="width: 50px; margin-bottom: 25px;" alt="Capital adequacy">
                        <h4 class="font-weight-bold text-white mb-3">Capital adequacy</h4>
                        <p class="text-muted small mb-0">We maintain sufficient liquid capital to safeguard our clients’ funds and assets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Account Security Section -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 p-5 rounded-lg overflow-hidden shadow-lg" style="background: rgba(255,255,255,0.02); border: 1px solid var(--inst-border);" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold text-white">Security of accounts</h2>
                    <p class="text-muted lead mb-0">Ensuring your personal data is secure and protected is a key priority for us, that’s why we have a range of measures in place to detect and prevent potential security breaches.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-lg overflow-hidden shadow-lg d-flex align-items-center justify-content-center" >
                        <img src="{{ asset('images/assets/11463297.png') }}" alt="Security" style="width: 50%; height: 50%; object-fit: contain;" >
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h5 class="text-primary font-weight-bold mb-3">Two-factor authentication (2FA)</h5>
                        <p class="text-muted small mb-0">We promote using 2FA – a security enhancement feature to improve your account’s protection against unauthorised access.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h5 class="text-primary font-weight-bold mb-3">One-time password verification</h5>
                        <p class="text-muted small mb-0">OTP provides you with an opportunity to verify the agent contacting you by phone, as an additional measure to prevent our clients from being contacted by fraudsters.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 rounded border  shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <h5 class="text-primary font-weight-bold mb-3">Risk awareness and education</h5>
                        <p class="text-muted small mb-0">We encourage responsible trading and value your safety, ensuring all our clients are informed and educated about potential risks a trading activity may involve.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Staying Safe Online Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="font-weight-bold text-dark">Staying safe online</h2>
                <p class="text-muted">It is important to be vigilant both online and offline.</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6 d-flex mb-4" data-aos="fade-right">
                    <div class="p-5 bg-dark-custom rounded-md  border shadow-sm ">
                        <h4 class="font-weight-bold text-success mb-4"><i class="mdi mdi-check-circle-outline mr-2"></i>DO's</h4>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-3 d-flex align-items-start"><i class="mdi mdi-circle-medium text-success mr-2 mt-1"></i>Always log out of your account at the end of a session.</li>
                            <li class="mb-3 d-flex align-items-start"><i class="mdi mdi-circle-medium text-success mr-2 mt-1"></i>Stay alert, question any communications you receive.</li>
                            <li class="mb-3 d-flex align-items-start"><i class="mdi mdi-circle-medium text-success mr-2 mt-1"></i>Update your password at least every 3 months.</li>
                            <li class="d-flex align-items-start"><i class="mdi mdi-circle-medium text-success mr-2 mt-1"></i>Enable two-factor authentication where possible.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-flex mb-4" data-aos="fade-left">
                    <div class="p-5 bg-dark-custom rounded-md border shadow-sm ">
                        <h4 class="font-weight-bold text-danger mb-4"><i class="mdi mdi-close-circle-outline mr-2"></i>DON’Ts</h4>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-3 d-flex align-items-start"><i class="mdi mdi-circle-medium text-danger mr-2 mt-1"></i>Never share your login credentials.</li>
                            <li class="mb-3 d-flex align-items-start"><i class="mdi mdi-circle-medium text-danger mr-2 mt-1"></i>Do not engage with fraudsters.</li>
                            <li class="d-flex align-items-start"><i class="mdi mdi-circle-medium text-danger mr-2 mt-1"></i>Never allow a third party to access your device.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reporting Section -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0 d-flex"  data-aos="fade-left">
                    <div class="rounded-lg overflow-hidden shadow-sm p-5" style="background: rgba(255,255,255,0.02); border: 1px solid var(--inst-border);">
                    <h2 class="mb-4 font-weight-bold text-white">Report Suspicious Activity</h2>
                    <p class="text-muted mb-4">If you receive suspicious communication - email, phone call, WhatsApp, or SMS from someone claiming to be from, or affiliated with {{ $settings->site_title }}, please do not disclose any information, or click on any links.</p>
                    <p class="text-muted mb-0">Update your passwords directly through {{ $settings->site_title }} Portal, and report any suspicious activity as soon as possible.</p>
                </div>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <div class="rounded-lg overflow-hidden shadow-lg d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/assets/2512687.png') }}" alt="Support" style="width: 50%; height: 50%; object-fit: contain;" >
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.partials.trade-anywhere')
    @include('home.partials.achievement')
    @include('home.partials.cta')

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
