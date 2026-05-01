@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Contact Our Support Team')

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

        .contact-box {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            padding: 40px;
            border-radius: 4px;
            text-align: center;
            height: 100%;
        }

        .contact-icon {
            font-size: 32px;
            color: var(--inst-accent);
            margin-bottom: 20px;
        }

        .form-card {
            background: var(--inst-bg-sec);
            border: 1px solid var(--inst-border);
            padding: 50px;
            border-radius: 4px;
        }

        .form-control {
            background: var(--inst-bg) !important;
            border: 1px solid var(--inst-border) !important;
            color: var(--inst-text) !important;
            border-radius: 4px !important;
            padding: 12px 15px !important;
            height: auto !important;
        }

        .form-control:focus {
            border-color: var(--inst-accent) !important;
            box-shadow: none !important;
        }

        label { color: var(--inst-text-muted); font-size: 13px; font-weight: 600; margin-bottom: 8px; }
    </style>
@endsection

@inject('content', 'App\Http\Controllers\FrontController')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-3">Get in Touch</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 m-0 bg-transparent breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Support Center</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="contact-box">
                        <i class="mdi mdi-phone contact-icon"></i>
                        <h5>Phone Support</h5>
                        <p class="text-muted small">Available 24/7 for urgent trading inquiries.</p>
                        <a href="tel:{{ $content->getContent('0EXbji', 'description') }}" class="text-warning font-weight-bold">{{ $content->getContent('0EXbji', 'description') }}</a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="contact-box">
                        <i class="mdi mdi-email contact-icon"></i>
                        <h5>Email Inquiries</h5>
                        <p class="text-muted small">Direct access to our expert support desk.</p>
                        <a href="mailto:{{ $content->getContent('HLgyaQ', 'description') }}" class="text-warning font-weight-bold">{{ $content->getContent('HLgyaQ', 'description') }}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-box">
                        <i class="mdi mdi-map-marker contact-icon"></i>
                        <h5>Corporate Office</h5>
                        <p class="text-muted small">Global headquarters and regional hubs.</p>
                        <p class="text-warning mb-0 font-weight-bold">{{ $content->getContent('52GPRA', 'description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-card">
                        <h3 class="mb-4">Submit a Request</h3>
                        <p class="text-muted mb-5">Our average response time for verified accounts is under 30 seconds. Please provide as much detail as possible to help us assist you better.</p>
                        
                        <x-danger-alert />
                        <x-success-alert />

                        <form method="post" action="{{ route('enquiry') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label>Full Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="Institutional or Individual Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label>Email Address</label>
                                        <input name="email" type="email" class="form-control" placeholder="name@company.com" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group mb-0">
                                        <label>Subject</label>
                                        <input name="subject" type="text" class="form-control" placeholder="e.g. Account Security, Deposit Assistance" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <div class="form-group mb-0">
                                        <label>Detailed Message</label>
                                        <textarea name="message" rows="5" class="form-control" placeholder="How can our experts help you today?" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block py-3">Send Secure Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
