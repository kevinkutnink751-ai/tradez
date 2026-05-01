@extends('layouts.base')
@section('title', 'Verified Master Accounts')
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
        .trader-card { background: var(--inst-bg-sec); border: 1px solid var(--inst-border); border-radius: 4px; padding: 30px; transition: all 0.3s; }
        .trader-card:hover { border-color: var(--inst-accent); transform: translateY(-5px); }
        .trader-avatar { width: 64px; height: 64px; border-radius: 50%; background: #222; border: 2px solid var(--inst-border); margin-bottom: 20px; }
        .metric-label { font-size: 10px; color: var(--inst-text-muted); text-transform: uppercase; letter-spacing: 1px; }
        .metric-val { font-size: 18px; font-weight: 700; color: var(--inst-text); }
        .win-rate { color: #0ecb81; }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Expert Master Accounts</h1>
            <p class="text-muted">Directly mirror the success of proven market veterans.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5 text-center">
                <div class="col-lg-8">
                    <h2>Verified Market Masters</h2>
                    <p class="text-muted">Every master account on our platform undergoes a rigorous performance audit. Follow seasoned professionals with proven track records and disciplined risk management.</p>
                </div>
            </div>

            <div class="row">
                @forelse($masters as $master)
                    <div class="col-lg-6 mb-4">
                        <div class="trader-card h-100">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="trader-avatar mr-3 mb-0 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-account h3 mb-0 text-muted"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 text-white">{{ $master->name }}</h5>
                                        <span class="text-muted small">{{ $master->strategy_name }}</span>
                                    </div>
                                </div>
                                <span class="badge {{ $master->risk_level == 'Low' ? 'badge-success' : ($master->risk_level == 'Moderate' ? 'badge-warning' : 'badge-danger') }} px-3 py-2">
                                    {{ $master->risk_level }} Risk
                                </span>
                            </div>
                            <p class="small text-muted mb-4">"{{ Str::limit($master->strategy_description, 120) }}"</p>
                            <div class="row no-gutters mb-4 bg-dark p-3 rounded border border-secondary">
                                <div class="col-4">
                                    <div class="metric-label">Win Rate</div>
                                    <div class="metric-val text-success">{{ $master->win_rate }}%</div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="metric-label">ROI</div>
                                    <div class="metric-val text-warning">{{ $master->roi }}%</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="metric-label">Max DD</div>
                                    <div class="metric-val text-danger">{{ $master->drawdown }}%</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">Total Trades: <b>{{ $master->total_trades }}</b></span>
                                <a href="{{ url('/register') }}" class="btn btn-primary px-4">Mirror Strategy</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="mdi mdi-account-off-outline h1 text-muted"></i>
                        <p class="text-muted mt-3">No active master traders found at this time.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted small mb-4">Risk Warning: Every Master Account is audited, but past results never guarantee future success.</p>
                <a href="{{ url('/register') }}" class="btn btn-outline-light px-5">Join Global Network</a>
            </div>
        </div>
    </section>


@endsection

