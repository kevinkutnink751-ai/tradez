@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-primary">Manage Trading Pairs</h1>
                </div>
                @if(Session::has('message'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <div class="mb-5 row">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPairModal">
                            <i class="fa fa-plus"></i> Add New Pair
                        </button>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="card p-4 bg-{{$bg}} shadow">
                            <div class="table-responsive">
                                <table class="table table-hover text-primary">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Symbol</th>
                                            <th>Type</th>
                                            <th>Min/Max</th>
                                            <th>Leverage</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pairs as $pair)
                                        <tr>
                                            <td>{{ $pair->id }}</td>
                                            <td>{{ $pair->name }}</td>
                                            <td>{{ $pair->symbol }}/{{ $pair->base_asset }}</td>
                                            <td><span class="badge badge-info">{{ $pair->type }}</span></td>
                                            <td>{{ $pair->min_amount }} / {{ $pair->max_amount }}</td>
                                            <td>{{ $pair->leverage }}x</td>
                                            <td>
                                                @if($pair->status)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPair{{$pair->id}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a href="{{ route('admin.trading.pairs.toggle', $pair->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-power-off"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.trading.pairs.delete', $pair->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> --}}
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div id="editPair{{$pair->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-{{$bg}}">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-primary">Edit Trading Pair</h4>
                                                        <button type="button" class="close text-primary" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="{{ route('admin.trading.pairs.update', $pair->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="text-primary">Pair Name (e.g. BTC/USDT)</label>
                                                                <input type="text" name="name" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Asset Symbol (e.g. BTC)</label>
                                                                <input type="text" name="symbol" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->symbol }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Base Asset (e.g. USDT)</label>
                                                                <input type="text" name="base_asset" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->base_asset }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Type</label>
                                                                <select name="type" class="form-control bg-{{$bg}} text-primary">
                                                                    <option value="Spot" {{ $pair->type == 'Spot' ? 'selected' : '' }}>Spot</option>
                                                                    <option value="Future" {{ $pair->type == 'Future' ? 'selected' : '' }}>Future</option>
                                                                    <option value="Binary" {{ $pair->type == 'Binary' ? 'selected' : '' }}>Binary</option>
                                                                    <option value="Option" {{ $pair->type == 'Option' ? 'selected' : '' }}>Option</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Min Trade Amount</label>
                                                                <input type="number" step="any" name="min_amount" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->min_amount }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Max Trade Amount</label>
                                                                <input type="number" step="any" name="max_amount" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->max_amount }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Default Leverage (Futures only)</label>
                                                                <input type="number" step="any" name="leverage" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->leverage }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Update Pair</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addPairModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content bg-{{$bg}}">
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Add New Trading Pair</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('admin.trading.pairs.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-primary">Pair Name (e.g. BTC/USDT)</label>
                            <input type="text" name="name" class="form-control bg-{{$bg}} text-primary" placeholder="BTC/USDT" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Asset Symbol (e.g. BTC)</label>
                            <input type="text" name="symbol" class="form-control bg-{{$bg}} text-primary" placeholder="BTC" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Base Asset (e.g. USDT)</label>
                            <input type="text" name="base_asset" class="form-control bg-{{$bg}} text-primary" placeholder="USDT" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Type</label>
                            <select name="type" class="form-control bg-{{$bg}} text-primary">
                                <option value="Spot">Spot</option>
                                <option value="Future">Future</option>
                                <option value="Binary">Binary</option>
                                <option value="Option">Option</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Min Trade Amount</label>
                            <input type="number" step="any" name="min_amount" class="form-control bg-{{$bg}} text-primary" value="10" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Max Trade Amount</label>
                            <input type="number" step="any" name="max_amount" class="form-control bg-{{$bg}} text-primary" value="10000" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Default Leverage (Futures only)</label>
                            <input type="number" step="any" name="leverage" class="form-control bg-{{$bg}} text-primary" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Pair</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
