<!-- Modal for Closing Open Signals -->
<div class="modal fade" id="closeSignalModal{{ $item->id }}" tabindex="-1" aria-labelledby="closeSignalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeSignalLabel">Close Open Signals — {{ $item->account_name }} ({{ $item->login }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $openSignals = \App\Models\TradeSignal::where('master_account_id', $item->id)
                        ->whereIn('status', ['NEW', 'REPLICATED'])
                        ->whereNull('close_price')
                        ->orderBy('created_at', 'desc')
                        ->get();
                @endphp

                @if($openSignals->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Symbol</th>
                                    <th>Volume</th>
                                    <th>Open Price</th>
                                    <th>SL</th>
                                    <th>TP</th>
                                    <th>Opened</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($openSignals as $sig)
                                <tr>
                                    <td>{{ $sig->id }}</td>
                                    <td>
                                        <span class="badge badge-{{ $sig->trade_type === 'BUY' ? 'success' : 'danger' }}">
                                            {{ $sig->trade_type }}
                                        </span>
                                    </td>
                                    <td>{{ $sig->symbol }}</td>
                                    <td>{{ $sig->volume }}</td>
                                    <td>{{ $sig->open_price }}</td>
                                    <td>{{ $sig->stop_loss ?? '-' }}</td>
                                    <td>{{ $sig->take_profit ?? '-' }}</td>
                                    <td>{{ $sig->signal_timestamp->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('master.close_signal') }}" method="POST" class="form-inline">
                                            @csrf
                                            <input type="hidden" name="signal_id" value="{{ $sig->id }}">
                                            <input type="number" name="close_price" step="0.00001" class="form-control form-control-sm mr-1" 
                                                placeholder="Close Price" value="{{ $sig->open_price }}" style="width:120px" required>
                                            <button type="submit" class="btn btn-sm btn-warning">Close</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No open signals for this master account.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
