@extends('layouts.base')
@section('title', 'Institutional Grade Security')
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
        .security-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; }
        .security-icon { font-size: 32px; color: var(--inst-accent); margin-bottom: 25px; display: block; }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Security Architecture</h1>
            <p class="text-muted">Fortress-level protection for your digital wealth.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5 pb-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">Multi-Layer Defense</h2>
                    <p class="text-muted mb-4">Security isn't a feature; it's our core foundation. We employ a defense-in-depth strategy, combining physical security, sophisticated encryption, and rigorous internal protocols.</p>
                    <div class="d-flex mb-3">
                        <i class="mdi mdi-check-circle text-success h5 mr-3"></i>
                        <p class="mb-0">95% of digital assets held in offline cold storage.</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="mdi mdi-check-circle text-success h5 mr-3"></i>
                        <p class="mb-0">OTP Verification for sensitive account actions.</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="mdi mdi-check-circle text-success h5 mr-3"></i>
                        <p class="mb-0">Bank-grade SSL/TLS 1.3 encryption for all data.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-check-circle text-success h5 mr-3"></i>
                        <p class="mb-0">Compulsory 2FA (Two-Factor Authentication) for all withdrawals.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="security-card border-success">
                                <h6 class="text-success font-weight-bold mb-3">DO's</h6>
                                <ul class="list-unstyled small text-muted">
                                    <li class="mb-2">✓ Always log out after sessions</li>
                                    <li class="mb-2">✓ Question suspicious emails</li>
                                    <li class="mb-2">✓ Update password every 90 days</li>
                                    <li>✓ Enable 2FA immediately</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="security-card border-danger">
                                <h6 class="text-danger font-weight-bold mb-3">DON'Ts</h6>
                                <ul class="list-unstyled small text-muted">
                                    <li class="mb-2">✗ Never share login credentials</li>
                                    <li class="mb-2">✗ Do not engage with fraudsters</li>
                                    <li class="mb-2">✗ Never allow 3rd party access</li>
                                    <li>✗ Avoid public Wi-Fi for trading</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="security-card">
                        <i class="mdi mdi-cloud-lock security-icon"></i>
                        <h5>Infrastructure Security</h5>
                        <p class="text-muted small mb-0">Distributed DDoS protection and hardware security modules (HSM) to protect our core infrastructure from all vectors of attack.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="security-card">
                        <i class="mdi mdi-shield-account security-icon"></i>
                        <h5>User Protection</h5>
                        <p class="text-muted small mb-0">Biometric login, device whitelisting, and anti-phishing codes to ensure your account access is yours and yours alone.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="security-card">
                        <i class="mdi mdi-file-document-edit-outline security-icon"></i>
                        <h5>Regular Audits</h5>
                        <p class="text-muted small mb-0">Regular penetration testing and financial audits conducted by world-renowned third-party security firms.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
