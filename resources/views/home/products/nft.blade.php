@extends('layouts.base')
@section('title', 'Institutional NFT Marketplace')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/hero-img1.svg') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 20%; right: 10%; width: 50%; height: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">NFT Marketplace</h1>
                    <p class="lead text-muted mb-5 max-width-700">Discover, collect, and trade extraordinary NFTs. Our institutional-grade marketplace provides a secure gateway to the world of digital art, collectibles, and utility-based tokens.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary text-white font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Browse Collections</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Create NFT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0" data-aos="fade-left">
                    <h2 class="mb-4 font-weight-bold text-dark">A Curated Digital Economy</h2>
                    <p class="text-muted mb-4">NFTs (Non-Fungible Tokens) are unique digital assets verified by blockchain technology. From rare digital art to virtual real estate and exclusive access tokens, our marketplace curates high-value assets for serious collectors and investors.</p>
                    <p class="text-muted">We bridge the gap between traditional finance and the decentralized web, offering a user-friendly interface backed by institutional security protocols.</p>
                    
                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <h3 class="font-weight-bold text-primary">0%</h3>
                            <p class="small text-muted">Buyer Fees</p>
                        </div>
                        <div class="col-6 mb-3">
                            <h3 class="font-weight-bold text-primary">Sub-Sec</h3>
                            <p class="small text-muted">Minting Speed</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <div class="p-4 rounded-lg shadow-lg bg-white border h-100">
                        <div class="position-relative mb-4">
                            <img src="{{ asset('images/assets/mutant-ape-nft.avif') }}" alt="NFT" class="img-fluid rounded shadow-sm">
                            <div class="position-absolute" style="top: 15px; right: 15px;">
                                <span class="badge badge-dark p-2 px-3">Live Auction</span>
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-1">Mutant Ape Yacht Club #001</h5>
                        <p class="text-muted small mb-3">Created by YUGA Labs</p>
                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <div>
                                <p class="text-muted small mb-0">Current Bid</p>
                                <h6 class="font-weight-bold text-dark">4.25 ETH</h6>
                            </div>
                            <button class="btn btn-primary btn-sm px-4 font-weight-bold">Place Bid</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why NFTs? Grid -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="font-weight-bold text-white">Marketplace Features</h2>
                    <p class="text-muted">Built for speed, security, and scalability.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-shield-key h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Custodial Security</h4>
                        <p class="text-muted small">Cold-storage options for your high-value digital assets, managed by our institutional custody partners.</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-swap-horizontal h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Cross-Chain Support</h4>
                        <p class="text-muted small">Trade NFTs across Ethereum, Solana, and Polygon with zero-latency bridging.</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded border shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-palette h1 text-primary mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Creator Launchpad</h4>
                        <p class="text-muted small">Exclusive access for artists to mint and launch collections with built-in marketing support.</p>
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
