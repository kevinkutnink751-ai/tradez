@extends('layouts.base')
@section('title', 'Global Regulations & Compliance')
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
        .reg-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 30px; border-radius: 4px; margin-bottom: 20px; }
        .reg-flag { width: 30px; height: 20px; margin-right: 15px; border-radius: 2px; }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Regulatory Compliance</h1>
            <p class="text-muted">A global framework of trust and transparency.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5 text-center">
                <div class="col-lg-8">
                    <h2>Global Standards</h2>
                    <p class="text-muted">We operate under a strict global regulatory framework, ensuring the highest levels of transparency, accountability, and security for our clients worldwide.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">United Kingdom</h6>
                        <h5>FCA Authorized</h5>
                        <p class="small text-muted mb-0">Registered and authorized to provide financial services. Company number 1054675.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">USA</h6>
                        <h5>SEC Regulated</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Securities & Exchange Commission (SEC) with number 000-56441.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Australia</h6>
                        <h5>ASIC Licensed</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Australian Securities & Investments Commission (ASIC). AFSL: 416259.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Germany</h6>
                        <h5>BaFin Authorized</h5>
                        <p class="small text-muted mb-0">Regulated by the German Federal Financial Supervisory Authority. License: HRB 73417.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Singapore</h6>
                        <h5>MAS Licensed</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Monetary Authority of Singapore (MAS). License: CMS101144.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">UAE</h6>
                        <h5>SCA Regulated</h5>
                        <p class="small text-muted mb-0">Category 1 Trading Broker for OTC Derivatives. ESCA license number 20200000088.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Austria</h6>
                        <h5>FMA Licensed</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Financial Markets Authority (FMA). License: 491179z.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Cayman Islands</h6>
                        <h5>CIMA Licensed</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Cayman Islands Monetary Authority. License: 1811356.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="reg-card h-100">
                        <h6 class="text-warning small text-uppercase mb-2">Vanuatu</h6>
                        <h5>VFSC Authorized</h5>
                        <p class="small text-muted mb-0">Authorized and regulated by the Vanuatu Financial Services Commission. License: 700497.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
