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
                        <li class="breadcrumb-item"><a href="s">Trading Settings</a></li>
                        <li class="breadcrumb-item active">{{ $master->account_name ?? $master->mt4_id }}</li>
                    </ol>
                </nav>

                {{-- Master Header --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="width:56px;height:56px;background:linear-gradient(135deg,#f5a623,#e85d1c);color:#fff;font-size:1.5rem;">
                                        <i class="fa fa-crown"></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-0 font-weight-bold">{{ $master->account_name ?? 'Master Account' }}</h2>
                                        <span class="text-muted">MT4: {{ $master->mt4_id }} &middot; {{ $master->server }} &middot; {{ $master->account_type }}</span>
                                        <br>
                                        @if($master->strategy_name)
                                            <span class="badge badge-primary mt-1" style="font-size:.8rem;">{{ $master->strategy_name }}</span>
                                            <span class="badge badge-outline-secondary mt-1">{{ $master->strategy_mode ?? 'Default' }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                <span class="badge badge-{{ $master->is_active ? 'success' : 'danger' }}" style="font-size:.85rem;">
                                    {{ $master->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <h3 class="font-weight-bold mb-0 mt-1">${{ number_format($master->account_balance, 2) }}</h3>
                                <small class="text-muted">Account Balance</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="row mb-4">
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#6861ce;">{{ $stats['subscriber_count'] }}</h2>
                                <small class="text-muted">Subscribers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#1572e8;">{{ $stats['total_signals'] }}</h2>
                                <small class="text-muted">Total Signals</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#f5a623;">{{ $stats['open_count'] }}</h2>
                                <small class="text-muted">Open Signals</small>
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
                                <h2 class="font-weight-bold mb-0">{{ $stats['win_rate'] }}%</h2>
                                <small class="text-muted">Win Rate</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0">
                                    <span class="text-success">{{ $stats['win_count'] }}</span>
                                    /
                                    <span class="text-danger">{{ $stats['loss_count'] }}</span>
                                </h2>
                                <small class="text-muted">W / L</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Subscriber Accounts --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-users mr-2 text-primary"></i>Subscriber Accounts</h5>
                        <span class="badge badge-primary">{{ $stats['subscriber_count'] }} subscribers</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Account</th>
                                        <th>MT4 ID</th>
                                        <th>Balance</th>
                                        <th>Trades Copied</th>
                                        <th>Success</th>
                                        <th>Failed</th>
                                        <th>P&L</th>
                                        <th>Status</th>
                                        <th>Linked Since</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subscriberStats as $sub)
                                        <tr>
                                            <td class="font-weight-bold">{{ $sub['name'] }}</td>
                                            <td>{{ $sub['mt4_id'] }}</td>
                                            <td>${{ number_format($sub['balance'], 2) }}</td>
                                            <td>{{ $sub['total_copied'] }}</td>
                                            <td class="text-success">{{ $sub['successful'] }}</td>
                                            <td class="text-danger">{{ $sub['failed'] }}</td>
                                            <td>
                                                <span class="font-weight-bold {{ $sub['pnl'] >= 0 ? 'text-success' : 'text-danger' }}">
                                                    ${{ number_format($sub['pnl'], 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $sub['status'] === 'ACTIVE' ? 'success' : ($sub['status'] === 'PAUSED' ? 'warning' : 'secondary') }}">
                                                    {{ $sub['status'] }}
                                                </span>
                                            </td>
                                            <td>{{ $sub['enabled_at'] ? \Carbon\Carbon::parse($sub['enabled_at'])->diffForHumans() : '-' }}</td>
                                            <td>
                                                @if($sub['id'])
                                                    <a href="{{ route('account.detail', $sub['id']) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">No subscribers linked to this master account.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Trade Signals Log --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-signal mr-2 text-primary"></i>Trade Signals</h5>
                        <span class="badge badge-primary">{{ $signals->count() }} signals</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="signalsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Symbol</th>
                                        <th>Volume</th>
                                        <th>Open Price</th>
                                        <th>Close Price</th>
                                        <th>SL</th>
                                        <th>TP</th>
                                        <th>P&L</th>
                                        <th>Status</th>
                                        <th>Opened</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($signals as $sig)
                                        <tr>
                                            <td>{{ $sig->id }}</td>
                                            <td>
                                                <span class="badge badge-{{ $sig->trade_type === 'BUY' ? 'success' : 'danger' }}">
                                                    {{ $sig->trade_type }}
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">{{ $sig->symbol }}</td>
                                            <td>{{ $sig->volume }}</td>
                                            <td>{{ $sig->open_price }}</td>
                                            <td>{{ $sig->close_price ?? '-' }}</td>
                                            <td>{{ $sig->stop_loss ?? '-' }}</td>
                                            <td>{{ $sig->take_profit ?? '-' }}</td>
                                            <td>
                                                @if($sig->status === 'CLOSED')
                                                    <span class="font-weight-bold {{ $sig->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                                        ${{ number_format($sig->profit_loss, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($sig->status === 'CLOSED')
                                                    <span class="badge badge-secondary">CLOSED</span>
                                                @elseif($sig->status === 'REPLICATED')
                                                    <span class="badge badge-info">REPLICATED</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $sig->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $sig->signal_timestamp ? $sig->signal_timestamp->diffForHumans() : '-' }}</td>
                                            <td>
                                                @if($sig->status !== 'CLOSED')
                                                    <form action="{{ route('master.close_signal') }}" method="POST" class="form-inline">
                                                        @csrf
                                                        <input type="hidden" name="signal_id" value="{{ $sig->id }}">
                                                        <input type="number" name="close_price" step="0.00001" class="form-control form-control-sm mr-1"
                                                            placeholder="Close" value="{{ $sig->open_price }}" style="width:100px" required>
                                                        <button type="submit" class="btn btn-sm btn-warning">Close</button>
                                                    </form>
                                                @else
                                                    <small class="text-muted">{{ $sig->closed_timestamp ? $sig->closed_timestamp->diffForHumans() : '' }}</small>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center py-4 text-muted">No signals generated yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Strategy Description --}}
                @if($master->strategy_description)
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fa fa-book mr-2 text-primary"></i>Strategy Description</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $master->strategy_description }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script>
            $(document).ready(function() {
                $('#signalsTable').DataTable({
                    "pageLength": 25,
                    "order": [[0, "desc"]],
                    "responsive": true
                });
            });
        </script>
    @endsection
@endsection
