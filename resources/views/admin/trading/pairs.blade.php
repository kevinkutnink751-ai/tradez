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
                                            <th>Markets</th>
                                            <th>Category</th>
                                            <th>Min/Max</th>
                                            <th>Leverage Options</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pairs as $pair)
                                        <tr>
                                            <td>{{ $pair->id }}</td>
                                            <td>{{ $pair->name }}</td>
                                            <td>{{ $pair->symbol }}/{{ $pair->quote_asset }}</td>
                                            <td>{{ strtoupper(implode(', ', $pair->supported_markets ?? [])) }}</td>
                                            <td>{{ $pair->instrument_category }}</td>
                                            <td>{{ $pair->min_amount }} / {{ $pair->max_amount }}</td>
                                            <td>{{ implode(', ', array_map(fn($item) => $item . 'x', $pair->availableLeverages())) }}</td>
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
                                                                <label class="text-primary">Pair Name (e.g. BTC/USD)</label>
                                                                <input type="text" name="name" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Asset Symbol (e.g. BTC)</label>
                                                                <input type="text" name="symbol" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->symbol }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Quote Asset (e.g. USD)</label>
                                                                <input type="text" name="quote_asset" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->quote_asset }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Supported Markets</label>
                                                                @foreach(['spot' => 'Spot', 'future' => 'Futures', 'binary' => 'Binary', 'option' => 'Options'] as $marketKey => $marketLabel)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="supported_markets[]" value="{{ $marketKey }}" {{ in_array($marketKey, $pair->supported_markets ?? []) ? 'checked' : '' }}>
                                                                        <label class="form-check-label text-primary">{{ $marketLabel }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Instrument Category</label>
                                                                <input type="text" name="instrument_category" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->instrument_category }}" placeholder="Equity Index Futures">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-primary">Chart Symbol</label>
                                                                <input type="text" name="chart_symbol" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->chart_symbol }}" placeholder="CME_MINI:ES1!">
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
                                                                <label class="text-primary">Leverage Options</label>
                                                                <input type="text" name="leverage_options" class="form-control bg-{{$bg}} text-primary" value="{{ implode(',', $pair->availableLeverages()) }}" placeholder="1,5,10,25,50">
                                                            </div>
                                                            <hr class="border-secondary mt-4">
                                                            <h4 class="text-primary font-weight-bold">Binary & Options Configuration</h4>
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label class="text-primary x-small">Min Trade Amount</label>
                                                                    <input type="number" step="any" name="binary_min_amount" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->binary_min_amount }}">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="text-primary x-small">Max Trade Amount</label>
                                                                    <input type="number" step="any" name="binary_max_amount" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->binary_max_amount }}">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="text-primary x-small">Increment Amount</label>
                                                                    <input type="number" step="any" name="binary_increment" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->binary_increment }}">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="text-primary x-small">Profit Percent (%)</label>
                                                                    <input type="number" step="any" name="binary_profit_percent" class="form-control bg-{{$bg}} text-primary" value="{{ $pair->binary_profit_percent }}">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label class="text-primary x-small">Durations (seconds, comma separated)</label>
                                                                    <input type="text" name="binary_durations" class="form-control bg-{{$bg}} text-primary" value="{{ implode(',', $pair->binary_durations ?? [60, 300, 3600]) }}" placeholder="60,300,3600">
                                                                </div>
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
                            <label class="text-primary">Pair Name (e.g. BTC/USD)</label>
                            <input type="text" name="name" class="form-control bg-{{$bg}} text-primary" placeholder="BTC/USD" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Asset Symbol (e.g. BTC)</label>
                            <input type="text" name="symbol" class="form-control bg-{{$bg}} text-primary" placeholder="BTC" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Quote Asset (e.g. USD)</label>
                            <input type="text" name="quote_asset" class="form-control bg-{{$bg}} text-primary" placeholder="USD" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Supported Markets</label>
                            @foreach(['spot' => 'Spot', 'future' => 'Futures', 'binary' => 'Binary', 'option' => 'Options'] as $marketKey => $marketLabel)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="supported_markets[]" value="{{ $marketKey }}" {{ $marketKey === 'spot' ? 'checked' : '' }}>
                                    <label class="form-check-label text-primary">{{ $marketLabel }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Instrument Category</label>
                            <input type="text" name="instrument_category" class="form-control bg-{{$bg}} text-primary" placeholder="Commodity Futures">
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Chart Symbol</label>
                            <input type="text" name="chart_symbol" class="form-control bg-{{$bg}} text-primary" placeholder="COMEX:GC1!">
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
                            <label class="text-primary">Leverage Options</label>
                            <input type="text" name="leverage_options" class="form-control bg-{{$bg}} text-primary" value="1,5,10" placeholder="1,5,10,25,50">
                        </div>
                        <hr class="border-secondary mt-4">
                        <h4 class="text-primary font-weight-bold">Binary & Options Configuration</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-primary x-small">Min Trade Amount</label>
                                <input type="number" step="any" name="binary_min_amount" class="form-control bg-{{$bg}} text-primary" value="1">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-primary x-small">Max Trade Amount</label>
                                <input type="number" step="any" name="binary_max_amount" class="form-control bg-{{$bg}} text-primary" value="10000">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-primary x-small">Increment Amount</label>
                                <input type="number" step="any" name="binary_increment" class="form-control bg-{{$bg}} text-primary" value="0.001">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-primary x-small">Profit Percent (%)</label>
                                <input type="number" step="any" name="binary_profit_percent" class="form-control bg-{{$bg}} text-primary" value="85">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-primary x-small">Durations (seconds, comma separated)</label>
                                <input type="text" name="binary_durations" class="form-control bg-{{$bg}} text-primary" value="60,300,3600" placeholder="60,300,3600">
                            </div>
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
