@extends('layouts.base')
@section('title', 'Global Regulations & Compliance')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Regulations</h1>
                    <p class="text-muted lead mb-5 max-width-700">We operate under the highest standards of regulatory oversight. Our global licensing ensures your investments are protected by world-class compliance frameworks.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Regulation Tabs Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="font-weight-bold text-dark">Global Licensing</h2>
                    <p class="text-muted">Explore our regulatory status across different jurisdictions.</p>
                </div>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center mb-5" id="reg-tabs">
                        @php
                            $regs = [
                                ['id' => 'SEC', 'name' => 'SEC', 'flag' => 'us.png', 'active' => true],
                                ['id' => 'ASIC', 'name' => 'ASIC', 'flag' => 'au.png'],
                                ['id' => 'AUSTRAC', 'name' => 'AUSTRAC', 'flag' => 'au.png'],
                                ['id' => 'BaFin', 'name' => 'BaFin', 'flag' => 'de.png'],
                                ['id' => 'CIMA', 'name' => 'CIMA', 'flag' => 'ky.png'],
                                ['id' => 'ESCA', 'name' => 'ESCA', 'flag' => 'ae.png'],
                                ['id' => 'FSC', 'name' => 'FSC', 'flag' => 'bvi.png'],
                                ['id' => 'FMA', 'name' => 'FMA', 'flag' => 'at.png'],
                                ['id' => 'MAS', 'name' => 'MAS', 'flag' => 'MS.png'],
                                ['id' => 'TFG', 'name' => 'TFG', 'flag' => 'cn.png'],
                                ['id' => 'VFSC', 'name' => 'VFSC', 'flag' => 'vu.png'],
                            ];
                        @endphp
                        @foreach($regs as $reg)
                            <button class="btn m-2 reg-tab-btn @if($reg['active'] ?? false) active @endif" 
                                    data-target="#reg-{{ $reg['id'] }}"
                                    style="border-radius: 50px; padding: 10px 25px; min-width: 130px; display: flex; align-items: center; justify-content: center; gap: 10px; border: 1px solid #dee2e6; background: #fff; transition: all 0.3s; font-weight: 600;">
                                <img src="{{ asset('images/assets/' . $reg['flag']) }}" alt="{{ $reg['name'] }}" style="width: 24px; height: 24px; object-fit: contain;">
                                <span>{{ $reg['name'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="tab-content-wrapper mt-4">
                        <div id="reg-SEC" class="reg-pane active" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> USA (<span class="text-uppercase">{{ $settings->site_name }}</span>)</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> is authorised and regulated by the Securities & Exchange Commission (“SEC”) with number 000-56441.</p>
                            </div>
                        </div>

                        <div id="reg-ASIC" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> AUSTRALIA (<span class="text-uppercase">{{ $settings->site_name }}</span>)</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> is authorised and regulated by the Australian Securities & Investments Commission (“ASIC”) with AFSL number 416259.</p>
                            </div>
                        </div>

                        <div id="reg-AUSTRAC" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> DIGITAL PTY LTD (AUSTRALIA)</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Digital Pty Ltd is licensed by ASIC as a Corporate Authorised Representative (AFS Representative Number 001285278) of <span class="text-uppercase">{{ $settings->site_name }}</span> Australia Pty Ltd (AFSL 416279) and is registered as a Digital Currency Exchange with AUSTRAC with Registration No. 100284469.</p>
                            </div>
                        </div>

                        <div id="reg-BaFin" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> ASSET MANAGEMENT (GERMANY)</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Asset Management GmbH is authorised and regulated by the German Federal Financial Supervisory Authority (“BaFin”) with license number HRB 73417.</p>
                            </div>
                        </div>

                        <div id="reg-CIMA" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4 text-uppercase">{{ $settings->site_name }} ATLANTIC CORPORATION</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Atlantic Corporation is authorised and regulated by the Cayman Islands Monetary Authority (“CIMA”) with license number 1811356.</p>
                            </div>
                        </div>

                        <div id="reg-ESCA" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> GLOBAL FINANCIAL SERVICES LLC</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Global Financial Services LLC of the UAE is regulated by the Securities and Commodities Authority of the UAE, as a Category 1 Trading Broker for Over-the-Counter Derivatives Contracts and Foreign Exchange Spot Markets, under ESCA license number 20200000088.</p>
                            </div>
                        </div>

                        <div id="reg-FSC" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> FX INTERNATIONAL</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> FX International Corporation is authorized and regulated by the Financial Services Commission of the British Virgin Islands (“FSC”) with license number SIBA/L/14/1098.</p>
                            </div>
                        </div>

                        <div id="reg-FMA" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> AUSTRIA</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Asset Management GmbH-Austria branch is authorised and regulated by the Financial Markets Authority (“FMA”) with license number 491179z.</p>
                            </div>
                        </div>

                        <div id="reg-MAS" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> GLOBAL MARKETS PTE. LTD</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Global Markets PTE. LTD. is authorised and regulated by the Monetary Authority of Singapore (“MAS”) with license number CMS101144.</p>
                            </div>
                        </div>

                        <div id="reg-TFG" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> FINANCIAL SERVICES CORPORATION LTD</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Financial Services Corporation Ltd is regulated by the Tianjin Financial Government (“TFG”) under the registration number 120000400164019.</p>
                            </div>
                        </div>

                        <div id="reg-VFSC" class="reg-pane d-none" data-aos="fade-up">
                            <div class="p-5 bg-white rounded border shadow-sm text-center">
                                <h3 class="font-weight-bold text-dark mb-4"><span class="text-uppercase">{{ $settings->site_name }}</span> PACIFIC</h3>
                                <p class="text-muted" style="font-size: 1.1rem;"><span class="text-uppercase">{{ $settings->site_name }}</span> Pacific (V) Ltd is authorised and regulated by the Vanuatu Financial Services Commission (“VFSC”) with license number 700497.</p>
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

    <style>
        .reg-tab-btn.active {
            background-color: var(--inst-accent) !important;
            border-color: var(--inst-accent) !important;
            color: #000 !important;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }
        .reg-tab-btn:hover {
            border-color: var(--inst-accent) !important;
            transform: translateY(-2px);
        }
        .reg-pane {
            transition: all 0.4s ease-in-out;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: false,
                offset: 50
            });

            const tabBtns = document.querySelectorAll('.reg-tab-btn');
            const panes = document.querySelectorAll('.reg-pane');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active from all buttons
                    tabBtns.forEach(b => b.classList.remove('active'));
                    // Add active to clicked button
                    this.classList.add('active');

                    // Hide all panes
                    panes.forEach(pane => pane.classList.add('d-none'));
                    
                    // Show target pane
                    const target = document.querySelector(this.getAttribute('data-target'));
                    if (target) {
                        target.classList.remove('d-none');
                        // Re-trigger AOS for new content
                        AOS.refresh();
                    }
                });
            });
        });
    </script>
@endsection
