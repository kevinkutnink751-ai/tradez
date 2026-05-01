<table class="history-table">
    <thead>
        <tr>
            <th>ID | Asset</th>
            <th>Type</th>
            <th>Investment</th>
            <th>Strike Price</th>
            <th>Expiration</th>
            <th>Status</th>
            <th>P&L</th>
        </tr>
    </thead>
    <tbody>
        @forelse($trades as $trade)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-white">#{{ $trade->id }}</span>
                        <span class="text-muted">{{ $trade->pair }}</span>
                    </div>
                </td>
                <td>
                    @if($trade->type == 'Call')
                        <span class="text-success"><i class="mdi mdi-arrow-up-bold"></i> CALL</span>
                    @else
                        <span class="text-danger"><i class="mdi mdi-arrow-down-bold"></i> PUT</span>
                    @endif
                </td>
                <td class="text-white">{{ number_format($trade->amount, 2) }}</td>
                <td class="text-white">{{ number_format($trade->strike_price, 5) }}</td>
                <td>
                    @php
                        $exp = (int)$trade->expiration;
                    @endphp
                    {{ $exp >= 3600 ? floor($exp/3600).'h' : ($exp >= 60 ? floor($exp/60).'m' : $exp.'s') }}
                </td>
                <td>
                    @if($trade->status == 'Pending')
                        <span class="badge badge-warning">Running</span>
                    @elseif($trade->status == 'Won' || $trade->status == 'Settled' && $trade->pnl > 0)
                        <span class="badge badge-success">Won</span>
                    @elseif($trade->status == 'Lost')
                        <span class="badge badge-danger">Lost</span>
                    @else
                        <span class="badge badge-secondary">{{ $trade->status }}</span>
                    @endif
                </td>
                <td class="{{ $trade->pnl > 0 ? 'text-success' : ($trade->pnl < 0 ? 'text-danger' : 'text-muted') }}">
                    {{ $trade->pnl > 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <div class="empty-history">
                        <i class="mdi mdi-package-variant"></i>
                        <p>No {{ $tab }} options trades found</p>
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
