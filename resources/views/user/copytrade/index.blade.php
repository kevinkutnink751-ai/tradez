@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 text-white h3 font-weight-bold">Copy Professional Traders</h5>
                <p class="text-white-50 mb-0 small">Mirror the trades of top-performing professionals and grow your portfolio automatically.</p>
            </div>
            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                <div class="d-flex justify-content-md-end align-items-center">
                    <div class="search-box mr-3">
                        <div class="input-group input-group-sm bg-dark-card border border-secondary rounded-xs px-2">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span></div>
                            <input type="text" class="form-control bg-transparent border-0 text-white" placeholder="Search traders...">
                        </div>
                    </div>
                    <a href="{{ route('user.my.subscriptions') }}" class="btn btn-sm btn-primary  px-4">My Subscriptions</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($masters as $master)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card bg-dark-card border-0 h-100 trader-card overflow-hidden">
                    <div class="card-body p-4 text-center">
                        <div class="avatar-container mb-3 position-relative d-inline-block">
                            <div class="avatar avatar-xl rounded-circle bg-soft-primary text-primary d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 2rem;">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <span class="badge badge-success position-absolute" style="bottom: 0; right: 0; border: 3px solid #151a24;"><i class="fas fa-check small"></i></span>
                        </div>
                        <h5 class="text-white font-weight-bold mb-1">{{ $master->name }}</h5>
                        <p class="text-muted small mb-3">Professional Crypto Trader</p>

                        <div class="stats-row d-flex justify-content-between mb-4 bg-dark-input rounded p-3">
                            <div class="text-center w-50 border-right border-secondary">
                                <small class="text-muted d-block mb-1">Win Rate</small>
                                <h6 class="text-success mb-0 font-weight-bold">{{ $master->win_rate }}%</h6>
                            </div>
                            <div class="text-center w-50">
                                <small class="text-muted d-block mb-1">Total Trades</small>
                                <h6 class="text-white mb-0 font-weight-bold">{{ $master->total_trades }}</h6>
                            </div>
                        </div>

                        <div class="pnl-section mb-4">
                            <small class="text-muted d-block mb-2">Profit / Loss (30d)</small>
                            <h3 class="text-success font-weight-bold mb-0">+{{ number_format($master->pnl, 2) }}%</h3>
                        </div>

                        <button class="btn btn-primary btn-block rounded-sm font-weight-bold py-2 " data-toggle="modal" data-target="#subscribeModal{{ $master->id }}">
                            <i class="fas fa-copy mr-2"></i> Copy Trader
                        </button>
                    </div>
                    <div class="card-footer bg-transparent border-top border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                        <div class="trader-tags">
                            <span class="badge badge-soft-primary px-2 mr-1">{{ ucfirst($master->risk_level) }} Risk</span>
                            <span class="badge badge-soft-info px-2">{{ ucfirst($master->bot_type) }}</span>
                        </div>
                        <small class="text-muted"><i class="fas fa-users mr-1"></i> {{ rand(50, 500) }}</small>
                    </div>
                </div>
            </div>

            <!-- Subscribe Modal -->
            <div class="modal fade" id="subscribeModal{{ $master->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-dark-card text-white border-secondary">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title">Subscribe to {{ $master->name }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.copy.subscribe') }}" method="POST">
                            @csrf
                            <input type="hidden" name="master_id" value="{{ $master->id }}">
                            <div class="modal-body p-4">
                                <div class="alert alert-info bg-soft-info border-0 text-info mb-4">
                                    <i class="fas fa-info-circle mr-2"></i> Target ROI: {{ $master->roi }}% | Max Drawdown: {{ $master->drawdown }}%
                                </div>
                                <div class="form-group">
                                    <label>Allocation Amount ($)</label>
                                    <input type="number" name="amount" class="form-control bg-dark-input text-white border-secondary" required min="10" placeholder="Minimum $10">
                                </div>
                                <div class="form-group">
                                    <label>Duration</label>
                                    <select name="duration" class="form-control bg-dark-input text-white border-secondary" required>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quaterly">Quarterly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted h4">No master traders available at the moment.</div>
            </div>
        @endforelse
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .bg-dark-input { background: #0d1117; }
        .bg-soft-primary { background: rgba(21, 114, 232, 0.1); }
        .text-white-50 { color: rgba(255, 255, 255, 0.5) !important; }
        .border-secondary { border-color: rgba(255,255,255,0.05) !important; }
        .trader-card { transition: all 0.3s ease; }
        .trader-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .shadow-primary { box-shadow: 0 4px 15px rgba(21, 114, 232, 0.2); }
        .badge-soft-primary { background: rgba(21, 114, 232, 0.1); color: #1572e8; }
        .badge-soft-info { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
    </style>
@endsection
