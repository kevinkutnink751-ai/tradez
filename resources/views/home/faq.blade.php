@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Frequently Asked Questions')

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

        .page-header {
            padding: 120px 0 60px 0;
            background: var(--inst-bg-sec);
            border-bottom: 1px solid var(--inst-border);
        }

        .faq-card {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            border-radius: 4px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-header {
            padding: 20px 25px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--inst-bg-sec);
            transition: background 0.3s;
        }

        .faq-header:hover { background: #1c2127; }
        .faq-header h6 { margin: 0; font-weight: 600; font-size: 15px; }

        .faq-body {
            padding: 0 25px 25px 25px;
            color: var(--inst-text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .category-box {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            padding: 30px;
            border-radius: 4px;
            text-align: center;
            transition: all 0.3s;
        }
        .category-box:hover { border-color: var(--inst-accent); transform: translateY(-5px); }
        .category-box i { font-size: 28px; color: var(--inst-accent); margin-bottom: 15px; display: block; }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="mb-3">Support Center & FAQ</h1>
                    <p class="text-muted mb-0">Search our knowledge base for answers to common trading questions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="category-box">
                        <i class="mdi mdi-account-cog-outline"></i>
                        <h5>Account & Security</h5>
                        <p class="small text-muted mb-0">Managing your profile, 2FA, and verification.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="category-box">
                        <i class="mdi mdi-cash-multiple"></i>
                        <h5>Deposits & Withdrawals</h5>
                        <p class="small text-muted mb-0">Funding options, processing times, and fees.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="category-box">
                        <i class="mdi mdi-chart-line-variant"></i>
                        <h5>Trading & Products</h5>
                        <p class="small text-muted mb-0">Leverage, spreads, and market operations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faqAccordion">
                        @foreach ($faqs as $item)
                            <div class="faq-card">
                                <div class="faq-header" data-toggle="collapse" data-target="#collapse{{ $item->id }}">
                                    <h6>{{ $item->question }}</h6>
                                    <i class="mdi mdi-chevron-down text-muted"></i>
                                </div>
                                <div id="collapse{{ $item->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#faqAccordion">
                                    <div class="faq-body">
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

    <!-- Still Need Help? -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3 class="mb-4">Still have questions?</h3>
                    <p class="text-muted mb-5">Our global support team is available 24/7 to assist you with any technical or account-related inquiries.</p>
                    <a href="{{ url('/contact') }}" class="btn btn-primary px-5 py-3">Submit a Support Ticket</a>
                </div>
            </div>
        </div>
    </section>
@endsection
