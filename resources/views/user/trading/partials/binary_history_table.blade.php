<table class="history-table">
    <thead>
        <tr>
            <th>TRX | Coin Pair</th>
            <th>Trade Date</th>
            <th>Invest</th>
            <th>Duration</th>
            <th>Direction</th>
            <th>Win Amount</th>
            <th>Win Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($trades as $trade)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-white">#{{ $trade->id }}</span>
                        <span class="text-muted">{{ $trade->coin_pair }}</span>
                    </div>
                </td>
                <td>{{ $trade->created_at->format('M d, H:i:s') }}</td>
                <td class="text-white">{{ number_format($trade->amount, 2) }}</td>
                <td>{{ $trade->duration >= 60 ? ($trade->duration/60).'m' : $trade->duration.'s' }}</td>
                <td>
                    @if(in_array($trade->direction, ['Call', 'Rise', 'Higher']))
                        <span class="text-success">HIGHER <i class="mdi mdi-arrow-up-bold"></i></span>
                    @else
                        <span class="text-danger">LOWER <i class="mdi mdi-arrow-down-bold"></i></span>
                    @endif
                </td>
                <td class="{{ $trade->status == 'Won' ? 'text-success' : ($trade->status == 'Lost' ? 'text-danger' : 'text-muted') }}">
                    {{ $trade->status == 'Won' ? '+'.number_format($trade->amount * 1.85, 2) : '0.00' }}
                </td>
                <td>
                    @if($trade->status == 'Pending')
                        <span class="badge badge-warning">Running</span>
                    @elseif($trade->status == 'Won')
                        <span class="badge badge-success">Win</span>
                    @elseif($trade->status == 'Lost')
                        <span class="badge badge-danger">Loss</span>
                    @else
                        <span class="badge badge-secondary">{{ $trade->status }}</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <div class="empty-history">
                        <i class="mdi mdi-package-variant"></i>
                        <p>No {{ $tab }} trades found</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@if($trades->hasPages())
    <div class="p-3">
        {{ $trades->links() }}
    </div>
@endif
