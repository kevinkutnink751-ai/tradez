@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Frequently Asked Questions')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Support Center & FAQ</h1>
                    <p class="text-muted lead mb-5 max-width-700">Search our knowledge base for answers to common trading questions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row">
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded-lg border shadow-sm text-center bg-dark-custom " >
                        <i class="mdi mdi-account-cog-outline h1 text-primary mb-4 d-block"></i>
                        <h5 class="font-weight-bold text-white" >Account & Security</h5>
                        <p class="small text-muted mb-0">Managing your profile, 2FA, and verification.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded-lg border shadow-sm text-center bg-dark-custom " >
                        <i class="mdi mdi-cash-multiple h1 text-primary mb-4 d-block"></i>
                        <h5 class="font-weight-bold text-white" >Deposits & Withdrawals</h5>
                        <p class="small text-muted mb-0">Funding options, processing times, and fees.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded-lg border shadow-sm text-center bg-dark-custom " >
                        <i class="mdi mdi-chart-line-variant h1 text-primary mb-4 d-block"></i>
                        <h5 class="font-weight-bold text-white" >Trading & Products</h5>
                        <p class="small text-muted mb-0">Leverage, spreads, and market operations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row justify-content-center">
                <div class="col-lg-9" data-aos="fade-up">
                    <div class="accordion" id="faqAccordion">
                        @foreach ($faqs as $item)
                            <div class="card mb-3 border-0 rounded-lg" style="background: rgba(255,255,255,0.02); border: 1px solid var(--inst-border) !important; overflow: hidden;">
                                <div class="card-header border-0 bg-transparent p-4" id="heading{{ $item->id }}" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="true" aria-controls="collapse{{ $item->id }}" style="cursor: pointer;">
                                    <h6 class="mb-0 text-white font-weight-bold d-flex justify-content-between align-items-center">
                                        {{ $item->question }}
                                        <i class="mdi mdi-chevron-down text-muted"></i>
                                    </h6>
                                </div>

                                <div id="collapse{{ $item->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $item->id }}" data-parent="#faqAccordion">
                                    <div class="card-body p-4 pt-0 text-muted">
                                        {{ $item->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.partials.our-values')
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
