@extends('layouts.base')
@section('title', 'Institutional DeFi Staking')

@section('content')
    <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="position-absolute" style="background-image: url('{{ asset('images/assets/hero-bg.png') }}'); background-position: right center; background-size: contain; background-repeat: no-repeat; bottom: 0; top: 0; right: 0; width: 50%; z-index: 2; opacity: 0.8;"></div>
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row align-items-center w-100">
                <div class="col-lg-7" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">DeFi Staking</h1>
                    <p class="lead text-muted mb-5 max-width-700">Put your digital assets to work. Earn competitive yields through our secure, non-custodial staking infrastructure. Access the best of decentralized finance with the simplicity of institutional tools.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-warning text-dark font-weight-bold btn-lg mr-3 px-5 mb-3 shadow-lg">Start Staking</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg mb-3">Staking Rewards</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Staking Overview Section -->
    <section class="section py-5 bg-light-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; left:0; width:40%; height:100%; z-index:1; opacity:0.15;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 font-weight-bold text-dark">Unlock the Power of DeFi</h2>
                    <p class="text-muted mb-4">DeFi Staking allows you to earn rewards by participating in the security and operation of blockchain networks. Instead of letting your assets sit idle, you can "stake" them in smart contracts to generate passive income.</p>
                    <p class="text-muted">We handle the technical complexity of node management, validator selection, and reward compounding, giving you a seamless entry into the decentralized economy.</p>
                    
                    <div class="p-4 mt-4 shadow-sm rounded border bg-white" style="border-left: 4px solid var(--inst-accent);">
                        <h6 class="font-weight-bold text-dark mb-2">Automated Rewards</h6>
                        <p class="small text-muted mb-0">Your rewards are automatically calculated and distributed daily, ensuring maximum compounding efficiency.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-5 rounded-lg border shadow-lg bg-white">
                        <h4 class="font-weight-bold text-dark mb-4 text-center">Estimated Annual Yields</h4>
                        <div class="staking-list">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="https://cryptologos.cc/logos/ethereum-eth-logo.png?v=032" style="width: 32px;" class="mr-3">
                                    <h6 class="mb-0 font-weight-bold">Ethereum (ETH)</h6>
                                </div>
                                <span class="badge badge-success p-2">Up to 6.5%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="https://cryptologos.cc/logos/solana-sol-logo.png?v=032" style="width: 32px;" class="mr-3">
                                    <h6 class="mb-0 font-weight-bold">Solana (SOL)</h6>
                                </div>
                                <span class="badge badge-success p-2">Up to 8.2%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="https://cryptologos.cc/logos/polkadot-new-dot-logo.png?v=032" style="width: 32px;" class="mr-3">
                                    <h6 class="mb-0 font-weight-bold">Polkadot (DOT)</h6>
                                </div>
                                <span class="badge badge-success p-2">Up to 12.5%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://cryptologos.cc/logos/cardano-ada-logo.png?v=032" style="width: 32px;" class="mr-3">
                                    <h6 class="mb-0 font-weight-bold">Cardano (ADA)</h6>
                                </div>
                                <span class="badge badge-success p-2">Up to 5.4%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Staking Features Grid -->
    <section class="section py-5 bg-dark-custom position-relative">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:100%; height:100%; z-index:1; opacity:0.1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="font-weight-bold text-white">Staking Advantages</h2>
                    <p class="text-muted">Simple, secure, and highly rewarding.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 rounded border h-100 shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-lock-open-outline h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">No Lock-up Periods</h4>
                        <p class="text-muted small">Choose between flexible staking options that allow you to withdraw your assets whenever you need them.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 rounded border h-100 shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-trending-up h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Compound Rewards</h4>
                        <p class="text-muted small">Reinvest your rewards automatically to maximize your long-term growth and total return.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 rounded border h-100 shadow-sm" style="background: rgba(255,255,255,0.02); border-color: var(--inst-border) !important;">
                        <i class="mdi mdi-security h1 text-warning mb-4 d-block"></i>
                        <h4 class="text-white font-weight-bold mb-3">Validator Security</h4>
                        <p class="text-muted small">We only stake with top-rated, highly secure validators to minimize slashing risks.</p>
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
