@extends('layouts.base')
@section('title', 'Insurance & Security')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Your security is our top priority</h1>
                    <p class="text-muted lead mb-5 max-width-700">protecting your funds and personal data is of paramout importance to us. that is why we employ the latest the security protocols, so you can trade with confidence</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Insurance 4-Grid Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold" style="color: #000;" data-aos="fade-up">Insurance</h2>
            <div class="row">
                <div class="col-lg-3 d-flex col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 rounded-lg border shadow-sm bg-white ">
                        <h4 class="font-weight-bold mb-3" style="color: #000;">segregated client accounts</h4>
                        <p class="text-muted small mb-0">We maintain seperate client accounts without merging and company investments. Giving our clients the ultimate investment safety</p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 rounded-lg border shadow-sm bg-white ">
                        <h4 class="font-weight-bold mb-3" style="color: #000;">US $32 million paid out capitals</h4>
                        <p class="text-muted small mb-0">Due to our accumulated paid-up capital, we are globaly recognized as one of the largest online financial deerivates providers.</p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 rounded-lg border shadow-sm bg-white ">
                        <h4 class="font-weight-bold mb-3" style="color: #000;">B rated with S&P</h4>
                        <p class="text-muted small mb-0">rated by standard and poor's confirming our ability to meet out financial commitments</p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="p-4 rounded-lg border shadow-sm bg-white ">
                        <h4 class="font-weight-bold mb-3" style="color: #000;">Tier 1 banking</h4>
                        <p class="text-muted small mb-0">We want you to have peace of mind when it comes to where your funds are kept, so all our client's capitals is stored in tier 1 banks</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Financial Commission Member Section -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="mb-5 font-weight-bold text-white" data-aos="fade-up">We are a financial commission member</h2>
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="overflow-hidden shadow-lg">
                        <img src="{{ asset('images/assets/coi.jpeg') }}" alt="Financial Commission Member" style="object-fit: cover; height: 100%; width: 100%;">
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center" data-aos="fade-left">
                    <div class="p-5 rounded-lg border shadow-lg d-flex flex-column justify-content-center" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <p class="text-muted mb-4" style="font-size: 1.1rem;">
                            Being a Member of the Financial commission, we'er able to offer you and all oir clients an extra layer of security. This is in addition to our existing high level of safety, including using the latest security protocol to protect the client's data and funds .
                        </p>
                        <hr style="border-top: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-muted mb-3">
                            Compansation Fund: <strong class="text-white">US $1,000,000.00 per complaint</strong>
                        </p>
                        <hr style="border-top: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-muted mb-3">
                            Date of Membership: <strong class="text-white">27/08/2022</strong>
                        </p>
                        <hr style="border-top: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-muted mb-0">
                            Membership Status: <strong class="text-success">Active</strong>
                        </p>
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
