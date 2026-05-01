@extends('layouts.base')
@section('title', 'Asset Insurance & Protection')
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
        .page-header { padding: 120px 0 60px 0; background: var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .section { padding: 100px 0 !important; background-color: var(--inst-bg) !important; }
        .info-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; }
        .icon-box { font-size: 32px; color: var(--inst-accent); margin-bottom: 20px; }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Insurance & Fund Protection</h1>
            <p class="text-muted">Safeguarding your assets with multi-layered insurance protocols.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5 pb-5 border-bottom border-secondary">
                <div class="col-lg-6">
                    <h2>Your Safety, Guaranteed.</h2>
                    <p class="text-muted lead">We maintain extensive insurance coverage to protect our clients' interests against unforeseen events and platform-level risks.</p>
                    <p class="text-muted">Our insurance fund is capitalized by a portion of our trading revenue and is held in independent, audited accounts. This ensures that even in extreme market conditions, our obligations to our clients remain fully backed.</p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="info-card text-center py-4">
                                <div class="h3 text-warning font-weight-bold mb-1">$32M</div>
                                <h6 class="text-uppercase text-muted small">Paid-up Capital</h6>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="info-card text-center py-4">
                                <div class="h3 text-warning font-weight-bold mb-1">B Rated</div>
                                <h6 class="text-uppercase text-muted small">S&P Rating</h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-card text-center py-4">
                                <div class="h2 text-warning font-weight-bold mb-1">$1,000,000</div>
                                <h6 class="text-uppercase text-muted small">Per Complaint Coverage</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 mb-4">
                    <div class="info-card">
                        <i class="mdi mdi-shield-account info-card-icon h2 text-warning mb-4 d-block"></i>
                        <h5>Financial Commission Member</h5>
                        <p class="text-muted small mb-0">As an active member since 2022, we offer an extra layer of security via the Compensation Fund, covering up to $1M per complaint.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="info-card">
                        <i class="mdi mdi-bank info-card-icon h2 text-warning mb-4 d-block"></i>
                        <h5>Tier 1 Banking</h5>
                        <p class="text-muted small mb-0">Client capital is stored exclusively in Tier 1 banks, ensuring the highest level of custodial safety and liquidity.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="info-card">
                        <i class="mdi mdi-lock-check info-card-icon h2 text-warning mb-4 d-block"></i>
                        <h5>Segregated Accounts</h5>
                        <p class="text-muted small mb-0">We maintain strictly separate client accounts. Client funds are never merged with company operational investments.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
