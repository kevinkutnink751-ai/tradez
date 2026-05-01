<!-- Modal for Sending Signal -->
<div class="modal fade" id="signalModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Trade Signal from {{ $item->account_name }} ({{ $item->login }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('master.send_signal') }}" method="POST">
                @csrf
                <input type="hidden" name="master_id" value="{{ $item->id }}">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Symbol</label>
                            <select name="symbol" class="form-control" required>
                                @php
                                    $pairs = \App\Models\TradingPair::distinct()->get(['symbol', 'base_currency', 'quote_currency']);
                                @endphp
                                @foreach($pairs as $pair)
                                    <option value="{{ $pair->symbol }}">{{ $pair->symbol }} ({{ $pair->base_currency }}/{{ $pair->quote_currency }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Trade Type</label>
                            <select name="type" class="form-control" required>
                                <option value="BUY">BUY</option>
                                <option value="SELL">SELL</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Volume (Lot Size)</label>
                            <input type="number" name="volume" step="0.01" class="form-control" placeholder="0.10" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Price</label>
                            <input type="number" name="price" step="0.00001" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Stop Loss (Optional)</label>
                            <input type="number" name="sl" step="0.00001" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Take Profit (Optional)</label>
                            <input type="number" name="tp" step="0.00001" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Signal & Replicate</button>
                </div>
            </form>
        </div>
    </div>
</div>
