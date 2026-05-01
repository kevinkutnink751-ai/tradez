@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('tacnts') }}">Trading Accounts</a></li>
                        <li class="breadcrumb-item active">{{ $account->account_name ?? $account->mt4_id }}</li>
                    </ol>
                </nav>

                {{-- Account Header --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="width:56px;height:56px;background:linear-gradient(135deg,#1572e8,#6861ce);color:#fff;font-size:1.5rem;">
                                        <i class="fa fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-0 font-weight-bold">{{ $account->account_name ?? 'Account' }}</h2>
                                        <span class="text-muted">MT4: {{ $account->mt4_id }} &middot; {{ $account->server }} &middot; {{ $account->account_type }}</span>
                                        <br>
                                        @if($account->tuser)
                                            <small class="text-muted"><i class="fa fa-user mr-1"></i>{{ $account->tuser->name }} ({{ $account->tuser->email }})</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                <span class="badge badge-{{ $account->status == 'Active' ? 'success' : ($account->status == 'Expired' ? 'danger' : 'warning') }} mr-2" style="font-size:.85rem;">
                                    {{ $account->status ?? 'Pending' }}
                                </span>
                                <span class="badge badge-{{ ($account->deployment_status == 'DEPLOYED' || $account->deployment_status == 'Deployed') ? 'success' : 'warning' }} mr-2" style="font-size:.85rem;">
                                    {{ $account->deployment_status ?? 'Not deployed' }}
                                </span>
                                @if($account->copy_trade_enabled)
                                    <a href="{{ route('toggle.copytrade', $account->id) }}" class="badge badge-success" style="font-size:.85rem;">
                                        <i class="fa fa-check-circle mr-1"></i>Copy ON
                                    </a>
                                @else
                                    <a href="{{ route('toggle.copytrade', $account->id) }}" class="badge badge-secondary" style="font-size:.85rem;">
                                        <i class="fa fa-times-circle mr-1"></i>Copy OFF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="row mb-4">
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0">${{ number_format($account->balance ?? 0, 2) }}</h2>
                                <small class="text-muted">Balance</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0 {{ $stats['total_pnl'] >= 0 ? 'text-success' : 'text-danger' }}">${{ number_format($stats['total_pnl'], 2) }}</h2>
                                <small class="text-muted">Total P&L</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#1572e8;">{{ $stats['total_trades'] }}</h2>
                                <small class="text-muted">Total Trades</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#f5a623;">{{ $stats['open_count'] }}</h2>
                                <small class="text-muted">Open Trades</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0 text-success">{{ $stats['win_count'] }}</h2>
                                <small class="text-muted">Wins</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0">{{ $stats['win_rate'] }}%</h2>
                                <small class="text-muted">Win Rate</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Copy Trade Strategy Info --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="fa fa-link mr-2 text-primary"></i>Copy Trade Link</h5>
                            </div>
                            <div class="card-body">
                                @if($master)
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" style="width:40%;">Master Account</td>
                                            <td>
                                                <a href="{{ route('master.audit', $master->id) }}" class="font-weight-bold">
                                                    {{ $master->account_name }} ({{ $master->mt4_id }})
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Strategy</td>
                                            <td><span class="badge badge-primary">{{ $master->strategy_name ?? 'Default' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Strategy Mode</td>
                                            <td>{{ $master->strategy_mode ?? '-' }}</td>
                                        </tr>
                                        @if($account->copyTradeRelationship)
                                            <tr>
                                                <td class="text-muted">Sizing Strategy</td>
                                                <td>{{ $account->copyTradeRelationship->risk_settings['sizing_strategy'] ?? 'exact' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Trades Copied</td>
                                                <td>{{ $account->copyTradeRelationship->total_trades_copied ?? 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Last Copied At</td>
                                                <td>{{ $account->copyTradeRelationship->last_trade_copied_at ? $account->copyTradeRelationship->last_trade_copied_at->diffForHumans() : 'Never' }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted mb-2">This account is not linked to any master.</p>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#copytrade{{ $account->id }}">
                                            <i class="fa fa-link mr-1"></i>Link to Master
                                        </button>
                                        @php $item = $account; @endphp
                                        @include('admin.subscription.subscriber.copytrade')
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="fa fa-info-circle mr-2 text-primary"></i>Account Details</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted" style="width:40%;">Currency</td>
                                        <td>{{ $account->currency ?? 'USD' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Leverage</td>
                                        <td>{{ $account->leverage ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Duration</td>
                                        <td>{{ $account->duration ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Start Date</td>
                                        <td>{{ $account->start_date ? $account->start_date->format('M d, Y H:i') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Expiry Date</td>
                                        <td>
                                            @if($account->end_date)
                                                <span class="{{ now()->greaterThan($account->end_date) ? 'text-danger font-weight-bold' : '' }}">
                                                    {{ $account->end_date->format('M d, Y H:i') }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Created</td>
                                        <td>{{ $account->created_at->diffForHumans() }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Trade Log --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-exchange-alt mr-2 text-primary"></i>Trade History</h5>
                        <span class="badge badge-primary">{{ $trades->count() }} trades</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tradeLogTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Signal</th>
                                        <th>Type</th>
                                        <th>Symbol</th>
                                        <th>Volume</th>
                                        <th>Open Price</th>
                                        <th>Close Price</th>
                                        <th>P&L</th>
                                        <th>Status</th>
                                        <th>Copied At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trades as $trade)
                                        <tr>
                                            <td>#{{ $trade->trade_signal_id }}</td>
                                            <td>
                                                @if($trade->signal)
                                                    <span class="badge badge-{{ $trade->signal->trade_type === 'BUY' ? 'success' : 'danger' }}">
                                                        {{ $trade->signal->trade_type }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $trade->signal->symbol ?? '-' }}</td>
                                            <td>{{ $trade->executed_volume }}</td>
                                            <td>{{ $trade->executed_price }}</td>
                                            <td>{{ $trade->closed_price ?? '-' }}</td>
                                            <td>
                                                @if($trade->status === 'CLOSED')
                                                    <span class="font-weight-bold {{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                                        ${{ number_format($trade->profit_loss, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($trade->status === 'OPEN')
                                                    <span class="badge badge-info">OPEN</span>
                                                @elseif($trade->status === 'CLOSED')
                                                    <span class="badge badge-secondary">CLOSED</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $trade->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $trade->copied_at ? $trade->copied_at->diffForHumans() : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">No trades recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Audit Log --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fa fa-history mr-2 text-primary"></i>Audit Log</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Action</th>
                                        <th>Before</th>
                                        <th>After</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($account->transactionLogs->sortByDesc('created_at') as $log)
                                        <tr>
                                            <td><span class="badge badge-outline-primary">{{ $log->action }}</span></td>
                                            <td>{{ $log->before_status ?? '-' }}</td>
                                            <td>{{ $log->after_status ?? '-' }}</td>
                                            <td><small>{{ is_array($log->details) ? json_encode($log->details) : ($log->details ?? '-') }}</small></td>
                                            <td>{{ $log->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-3 text-muted">No audit records.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script>
            $(document).ready(function() {
                $('#tradeLogTable').DataTable({
                    "pageLength": 25,
                    "order": [[8, "desc"]],
                    "responsive": true
                });
            });
        </script>
    @endsection
@endsection
