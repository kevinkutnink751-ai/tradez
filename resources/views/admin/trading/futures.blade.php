@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-primary">Manage Futures Trades</h1>
                    <p class="text-muted">Monitor and manage all user futures positions and history.</p>
                </div>
                
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card p-4 bg-{{$bg}} shadow">
                            <div class="table-responsive">
                                <table class="table table-hover text-primary">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Pair</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                            <th>PNL</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trades as $trade)
                                        <tr>
                                            <td>
                                                <a href="{{ route('viewuser', $trade->user->id) }}" class="text-info font-weight-bold">
                                                    {{ $trade->user->name }}
                                                </a>
                                            </td>
                                            <td>{{ $trade->pair }} <span class="badge badge-info">{{ $trade->leverage }}x</span></td>
                                            <td>
                                                <span class="badge badge-{{ $trade->type == 'Buy' ? 'success' : 'danger' }}">
                                                    {{ $trade->type == 'Buy' ? 'LONG' : 'SHORT' }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($trade->amount, 4) }}</td>
                                            <td>{{ number_format($trade->price, 2) }}</td>
                                            <td>
                                                <span class="text-{{ $trade->pnl >= 0 ? 'success' : 'danger' }} font-weight-bold">
                                                    {{ $trade->pnl >= 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $trade->status == 'Open' ? 'warning' : 'success' }}">
                                                    {{ $trade->status }}
                                                </span>
                                            </td>
                                            <td>{{ $trade->created_at->format('M d, H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @if($trade->status == 'Open')
                                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#closeTrade{{$trade->id}}" title="Close Position">
                                                        <i class="fa fa-times-circle"></i>
                                                    </button>
                                                    @endif
                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPnl{{$trade->id}}" title="Edit PNL">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.futures.destroy', $trade->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Close Trade Modal -->
                                        <div id="closeTrade{{$trade->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-{{$bg}}">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-primary">Close Futures Position</h4>
                                                        <button type="button" class="close text-primary" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="{{ route('admin.futures.close') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $trade->id }}">
                                                        <div class="modal-body">
                                                            <p class="text-primary">Closing position for <strong>{{ $trade->user->name }}</strong> on {{ $trade->pair }}</p>
                                                            <div class="form-group">
                                                                <label class="text-primary">Final PNL (USDT)</label>
                                                                <input type="number" step="any" name="pnl" class="form-control bg-{{$bg}} text-primary" value="{{ $trade->pnl }}" required>
                                                                <small class="text-muted">Enter positive for profit, negative for loss.</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Close Position Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit PNL Modal -->
                                        <div id="editPnl{{$trade->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-{{$bg}}">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-primary">Edit Trade PNL</h4>
                                                        <button type="button" class="close text-primary" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="{{ route('admin.futures.edit_pnl') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $trade->id }}">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="text-primary">Current PNL</label>
                                                                <input type="number" step="any" name="pnl" class="form-control bg-{{$bg}} text-primary" value="{{ $trade->pnl }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Update PNL</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $trades->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
