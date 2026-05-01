@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{$text}}">Manage Options Trades</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-{{$bg}} shadow-lg">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover text-{{$text}}">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Pair</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Strike Price</th>
                                                <th>Expiration</th>
                                                <th>Status</th>
                                                <th>PnL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($trades as $trade)
                                                <tr>
                                                    <td>{{ $trade->user->name }}</td>
                                                    <td>{{ $trade->pair }}</td>
                                                    <td>{{ $trade->type }}</td>
                                                    <td>{{ number_format($trade->amount, 2) }}</td>
                                                    <td>{{ number_format($trade->strike_price, 2) }}</td>
                                                    <td>{{ $trade->expiration }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $trade->status == 'Won' ? 'success' : ($trade->status == 'Lost' ? 'danger' : 'warning') }}">
                                                            {{ $trade->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($trade->pnl, 2) }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{$trade->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.options.destroy', $trade->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Edit Modal --}}
                                                <div class="modal fade" id="editModal{{$trade->id}}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content bg-{{$bg}} text-{{$text}}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Trade</h5>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form action="{{ route('admin.options.update', $trade->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select name="status" class="form-control bg-{{$bg}} text-{{$text}}">
                                                                            <option value="Open" {{ $trade->status == 'Open' ? 'selected' : '' }}>Open</option>
                                                                            <option value="Won" {{ $trade->status == 'Won' ? 'selected' : '' }}>Won</option>
                                                                            <option value="Lost" {{ $trade->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>PnL</label>
                                                                        <input type="number" step="any" name="pnl" value="{{ $trade->pnl }}" class="form-control bg-{{$bg}} text-{{$text}}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
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
