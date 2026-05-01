@extends('layouts.base')
@section('title', 'Institutional Advanced Trading')
@section('styles')
    @parent
    <style>
        .product-hero { padding: 160px 0 100px 0; background: radial-gradient(circle at 80% 80%, rgba(252, 213, 53, 0.05) 0%, transparent 50%), var(--inst-bg-sec); border-bottom: 1px solid var(--inst-border); }
        .feature-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); padding: 40px; border-radius: 4px; height: 100%; transition: all 0.3s; }
        .feature-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); background: var(--inst-bg); }
        .feature-icon { font-size: 32px; color: var(--inst-accent); margin-bottom: 25px; display: block; }
    </style>
@endsection

@section('content')
    <section class="product-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 font-weight-bold mb-4">Advanced Trading</h1>
                    <p class="lead text-muted mb-5">Unleash the power of mechanical trading systems. Execute high-frequency, algorithmic strategies with institutional-grade precision, zero emotional bias, and custom API access.</p>
                    <div class="d-flex flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mr-3 px-5 mb-3 shadow-lg">Deploy Algorithm</a>
                        <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg mb-3">API Documentation</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <h6 class="text-uppercase text-muted small mb-4">Institutional Benchmark</h6>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">Order Execution Latency</span>
                                <span class="text-warning small">14ms</span>
                            </div>
                            <div class="progress" style="height: 4px; background: #2B3139;">
                                <div class="progress-bar bg-warning" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">WebSocket Uptime</span>
                                <span class="text-success small">99.99%</span>
                            </div>
                            <div class="progress" style="height: 4px; background: #2B3139;">
                                <div class="progress-bar bg-success" style="width: 99%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The Mechanical Edge -->
    <section class="section bg-inst-grid border-bottom border-secondary">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4 font-weight-bold">The Mechanical Execution Edge</h2>
                    <p class="text-muted mb-4">In modern markets, speed and consistency are the only sustainable advantages. Our Advanced Trading suite allows you to codify your strategy and execute with cold, robotic precision.</p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="p-3 bg-inst-secondary rounded border border-secondary shadow-sm">
                                <h6 class="text-warning small font-weight-bold">Zero Slip Engine</h6>
                                <p class="text-muted x-small mb-0">Direct Market Access (DMA) ensuring your algorithmic entries are filled at the best available price.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="p-3 bg-inst-secondary rounded border border-secondary shadow-sm">
                                <h6 class="text-warning small font-weight-bold">PDT Exemption</h6>
                                <p class="text-muted x-small mb-0">Accounts structured for unlimited day-trading cycles across US and Global markets.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="feature-card">
                                <i class="mdi mdi-brain feature-icon"></i>
                                <h6>Minimizing Emotion</h6>
                                <p class="small text-muted mb-0">Automated systems ensure you stick to the plan. No hesitation or "pulling the trigger" anxiety.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="feature-card">
                                <i class="mdi mdi-history feature-icon"></i>
                                <h6>High-Fidelity Backtesting</h6>
                                <p class="small text-muted mb-0">Verify your strategy against 15+ years of tick-by-tick historical data before going live.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quantitative Toolset -->
    <section class="section bg-inst-mesh border-bottom border-secondary">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold">Quantitative Toolset</h2>
                <p class="text-muted">Professional tools for professional developers.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-dark rounded border border-secondary h-100 shadow-sm">
                        <i class="mdi mdi-api h1 text-warning mb-4 d-block"></i>
                        <h5>REST & WebSocket APIs</h5>
                        <p class="small text-muted">Full-featured API suite with extensive documentation in Python, Node.js, and C#. Stream live market data and manage orders programmatically.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-dark rounded border border-secondary h-100 shadow-sm">
                        <i class="mdi mdi-server-network h1 text-warning mb-4 d-block"></i>
                        <h5>Co-Located Hosting</h5>
                        <p class="small text-muted">Host your trading bots on our ultra-low latency servers located within the same data centers as major exchange matching engines (LD5/NY4).</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="p-4 bg-inst-dark rounded border border-secondary h-100 shadow-sm">
                        <i class="mdi mdi-shield-check-outline h1 text-warning mb-4 d-block"></i>
                        <h5>Script Verification</h5>
                        <p class="small text-muted">Submit your custom scripts for a security and performance audit by our technical team to ensure optimal execution stability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Institutional Comparison -->
    <section class="section bg-inst-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="mb-4 font-weight-bold text-white">Why Upgrade to Advanced?</h2>
                    <p class="text-muted mb-4">Standard accounts are built for retail "click" trading. Advanced accounts are built for system-level scale.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Custom leverage up to 1:500</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Priority API rate limits</li>
                        <li class="mb-3 small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> 24/7 dedicated technical support</li>
                        <li class="small text-muted"><i class="mdi mdi-check text-warning mr-2"></i> Volume-based commission rebates</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="p-4 bg-inst-dark rounded border border-secondary shadow-lg">
                        <div class="table-responsive">
                            <table class="table table-borderless text-muted mb-0">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th>Feature</th>
                                        <th>Standard</th>
                                        <th class="text-warning font-weight-bold">Advanced</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Execution</td>
                                        <td>Standard</td>
                                        <td class="text-white font-weight-bold">Priority Direct</td>
                                    </tr>
                                    <tr>
                                        <td>API Access</td>
                                        <td>Limited</td>
                                        <td class="text-white font-weight-bold">Full (REST/WS)</td>
                                    </tr>
                                    <tr>
                                        <td>VPS Hosting</td>
                                        <td>Paid Add-on</td>
                                        <td class="text-white font-weight-bold">Included</td>
                                    </tr>
                                    <tr>
                                        <td>Support</td>
                                        <td>Email/Chat</td>
                                        <td class="text-white font-weight-bold">Dedicated Quant Lead</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section bg-inst-stripe">
        <div class="container text-center">
            <div class="p-5 bg-inst-dark rounded border border-warning shadow-lg">
                <h2 class="mb-4 text-warning font-weight-bold">Scale Your Edge</h2>
                <p class="text-muted mb-5 lead">Join the 5% of traders who operate with a mechanical advantage.</p>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg px-5 shadow-lg">Open Advanced Account</a>
            </div>
        </div>
    </section>
@endsection
