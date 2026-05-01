@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />

                {{-- Page Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="mb-1" style="font-size:1.75rem; font-weight:700;">Trading Accounts</h1>
                        <p class="text-muted mb-0">Manage all connected subscriber accounts, copy-trade links, and performance.</p>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addccount">
                            <i class="fa fa-plus mr-1"></i> Add Account
                        </button>
                    </div>
                </div>

                {{-- Stats Cards --}}
                <div class="row mb-4">
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#1572e8;">{{ $stats['total'] }}</h2>
                                <small class="text-muted">Total Accounts</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#2eca6a;">{{ $stats['active'] }}</h2>
                                <small class="text-muted">Active</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#6861ce;">{{ $stats['copy_enabled'] }}</h2>
                                <small class="text-muted">Copy Active</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0" style="color:#1572e8;">{{ $stats['open_trades'] }}</h2>
                                <small class="text-muted">Open Trades</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center py-3">
                                <h2 class="font-weight-bold mb-0">${{ number_format($stats['total_balance'], 2) }}</h2>
                                <small class="text-muted">Total Balance</small>
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
                </div>

                {{-- Navigation Tabs --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a href="{{ route('msubtrade') }}" class="nav-link">Submitted</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tacnts') }}" class="nav-link active">Connected Accounts</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="accountsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:50px;">#</th>
                                        <th>Account</th>
                                        <th>Owner</th>
                                        <th>Balance</th>
                                        <th>Strategy</th>
                                        <th>Copy Trade</th>
                                        <th>Status</th>
                                        <th>Deployment</th>
                                        <th>Open Trades</th>
                                        <th>P&L</th>
                                        <th style="width:120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accounts as $item)
                                        @php
                                            $rel = $item->copyTradeRelationship;
                                            $masterForItem = $item->master_account_id ? $masters->firstWhere('id', $item->master_account_id) : null;
                                            $openCount = $item->copyTradeLogs->where('status', 'OPEN')->count();
                                            $pnl = $item->copyTradeLogs->where('status', 'CLOSED')->sum('profit_loss');
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">Sub-{{ $item->id }}</span>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $item->account_name ?? 'Virtual Account' }}</strong>
                                                    <br><small class="text-muted">{{ $item->account_type ?? 'Standard' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->tuser)
                                                    <span>{{ $item->tuser->name }}</span>
                                                    <br><small class="text-muted">{{ $item->tuser->email }}</small>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">${{ number_format($item->balance ?? 0, 2) }}</span>
                                            </td>
                                            <td>
                                                @if($masterForItem)
                                                    <a href="{{ route('master.audit', $masterForItem->id) }}" class="badge badge-primary" onclick="event.stopPropagation();">
                                                        {{ $masterForItem->strategy_name ?? $masterForItem->account_name }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not linked</span>
                                                @endif
                                            </td>
                                            <td onclick="event.stopPropagation();">
                                                @if($item->copy_trade_enabled)
                                                    <a href="{{ route('toggle.copytrade', $item->id) }}" class="badge badge-success" style="cursor:pointer;">
                                                        <i class="fa fa-check-circle mr-1"></i>ON
                                                    </a>
                                                @else
                                                    <a href="{{ route('toggle.copytrade', $item->id) }}" class="badge badge-secondary" style="cursor:pointer;">
                                                        <i class="fa fa-times-circle mr-1"></i>OFF
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status == 'Active')
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($item->status == 'Expired')
                                                    <span class="badge badge-danger">Expired</span>
                                                @elseif($item->status == 'CREDENTIALS_VERIFIED')
                                                    <span class="badge badge-info">Verified</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $item->status ?? 'Pending' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->deployment_status == 'DEPLOYED' || $item->deployment_status == 'Deployed')
                                                    <span class="badge badge-success">Deployed</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $item->deployment_status ?? 'Not deployed' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($openCount > 0)
                                                    <span class="badge badge-primary">{{ $openCount }} open</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="font-weight-bold {{ $pnl >= 0 ? 'text-success' : 'text-danger' }}">
                                                    ${{ number_format($pnl, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('account.detail', $item->id) }}">
                                                            <i class="fa fa-eye mr-2"></i>View Details
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                            <i class="fa fa-edit mr-2"></i>Edit Dates
                                                        </a>
                                                        @if(!$item->copy_trade_enabled && !$rel)
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copytrade{{ $item->id }}">
                                                                <i class="fa fa-copy mr-2"></i>Start CopyTrade
                                                            </a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('toggle.copytrade', $item->id) }}">
                                                            <i class="fa fa-{{ $item->copy_trade_enabled ? 'pause' : 'play' }} mr-2"></i>
                                                            {{ $item->copy_trade_enabled ? 'Disable' : 'Enable' }} Copy
                                                        </a>
                                                        @if($item->deployment_status == 'DEPLOYED' || $item->deployment_status == 'Deployed')
                                                            <a class="dropdown-item" href="{{ route('acnt.deployment', ['id' => $item->id, 'deployment' => 'Undeploy']) }}">
                                                                <i class="fa fa-stop mr-2"></i>Undeploy
                                                            </a>
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('acnt.deployment', ['id' => $item->id, 'deployment' => 'Deploy']) }}">
                                                                <i class="fa fa-rocket mr-2"></i>Deploy
                                                            </a>
                                                        @endif
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#stopCopyingModal{{ $item->id }}">
                                                            <i class="fa fa-ban mr-2"></i>Stop Copying
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                                            <i class="fa fa-trash mr-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>

                                                {{-- Modals --}}
                                                @include('admin.subscription.subscriber.edit-subscriber')
                                                @if(!$item->copy_trade_enabled && !$rel)
                                                    @include('admin.subscription.subscriber.copytrade')
                                                @endif

                                                {{-- Delete Modal --}}
                                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Trading Account</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete account <strong>{{ $item->account_name ?? 'Sub-'.$item->id }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <a href="{{ route('del.sub', ['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Stop Copying Modal --}}
                                                <div class="modal fade" id="stopCopyingModal{{ $item->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Stop Copying</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to stop copy trading for account <strong>{{ $item->account_name ?? 'Sub-'.$item->id }}</strong>? This will detach it from the master bot and set it to Expired, but retain its history.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <a href="{{ route('stop.sub', ['id' => $item->id]) }}" class="btn btn-warning">Stop Copying</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Renew Modal --}}
                                                <div class="modal fade" id="renewModal{{ $item->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Renew Trading Account</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <h3>Renewal fee: ${{ $amountPerSlot }}</h3>
                                                                <form action="{{ route('renew.acnt') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="account_id" value="{{ $item->id }}">
                                                                    <button type="submit" class="btn btn-primary">Confirm Renewal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center py-5">
                                                <i class="fa fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                                <h5 class="text-muted">No trading accounts found</h5>
                                                <p class="text-muted">Accounts submitted by users will appear here after approval.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Add Account Modal --}}
                <div class="modal fade" id="addccount" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="mb-1"><i class="fa fa-plus mr-2"></i>Add Subscriber Account</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('create.sub') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Account Name*</label>
                                            <input class="form-control" type="text" name="name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Account Type</label>
                                            <input class="form-control" placeholder="e.g. Standard" type="text" name="acntype" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Leverage</label>
                                            <input class="form-control" placeholder="e.g. 1:500" type="text" name="leverage" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Currency</label>
                                            <input class="form-control" placeholder="e.g. USD" type="text" name="currency" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">Add Account</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                $('#accountsTable').DataTable({
                    "pageLength": 25,
                    "order": [[0, "desc"]],
                    "responsive": true,
                    "language": {
                        "emptyTable": "No trading accounts available"
                    }
                });
            });
        </script>
    @endsection
@endsection
