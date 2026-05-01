@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />
                @include('admin.subscription.master.statistics')
                <div class="mb-5 row">
                    <div class="col-md-12">
                        @if ($accounts and count($accounts) < 1)
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title">No Master Trading Account</h5>
                                        <p>Add a master account</p>
                                        <a href="{{ route('create.master') }}" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>Add a master account</p>
                                        <a href="{{ route('create.master') }}" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h1 class=" font-weight-bold d-md-block d-none">Your Master(Provider) Accounts
                                            </h1>
                                            <h2 class=" font-weight-bold d-md-none d-block">Your Master(Provider) Accounts
                                            </h2>
                                            <p class="text-primary font-weight-bold">
                                                NOTE: Your master Account will be
                                                deleted after
                                                10 days of
                                                expiration and have not been renewed.
                                            </p>
                                            <div class=" table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Bot Name</th>
                                                            <th>Bot Type</th>
                                                            <th>Strategy</th>
                                                            <th>Risk Level</th>
                                                            <th>Win Rate</th>
                                                            <th>ROI</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($accounts as $item)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $item->name }}</strong>
                                                                </td>
                                                                <td>
                                                                    <span class="badge badge-{{ $item->bot_type == 'winning' ? 'success' : ($item->bot_type == 'losing' ? 'danger' : 'info') }}">
                                                                        {{ ucfirst($item->bot_type) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $item->strategy_mode }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->risk_level }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->win_rate }}%
                                                                </td>
                                                                <td>
                                                                    <span class="{{ $item->roi >= 0 ? 'text-success' : 'text-danger' }}">{{ $item->roi }}%</span>
                                                                </td>
                                                                <td>
                                                                    @if ($item->is_active)
                                                                        <h2 class="badge badge-success">Active</h2>
                                                                    @else
                                                                        <h2 class="badge badge-warning">Inactive</h2>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#signalModal{{ $item->id }}"
                                                                        class="btn btn-success btn-sm m-1">
                                                                        <i class="fa fa-signal"></i>
                                                                        <span> Send Signal</span>
                                                                    </button>
                                                                    <a href="{{ route('master.audit', $item->id) }}"
                                                                        class="btn btn-info btn-sm m-1">
                                                                        <i class="fa fa-chart-bar"></i>
                                                                        <span> Audit</span>
                                                                    </a>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#closeSignalModal{{ $item->id }}"
                                                                        class="btn btn-warning btn-sm m-1">
                                                                        <i class="fa fa-times-circle"></i>
                                                                        <span> Close Signals</span>
                                                                    </button>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#strategyModal{{ $item->id }}"
                                                                        class="btn btn-secondary btn-sm m-1">
                                                                        <span> Update Strategy</span>
                                                                    </button>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#deleteModal{{ $item->id }}"
                                                                        class="btn btn-danger btn-sm m-1">
                                                                        <i class="fa fa-trash"></i>
                                                                        <span> Delete</span>
                                                                    </button>
                                                                    @include('admin.subscription.master.delete-master')
                                                                    @include('admin.subscription.master.signal-master')
                                                                    @include('admin.subscription.master.close-signal')
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" class="text-center">
                                                                    No Data Available
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @include('admin.subscription.master.create-master')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
