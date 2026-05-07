@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 text-white h3 font-weight-bold">Binary Trades</h5>
                <p class="text-white-50 small mb-0">{{ ($currentMode ?? 'Live') === 'Demo' ? 'Demo (Virtual)' : 'Live' }} trading history &mdash; {{ $trades->total() }} total records</p>
            </div>
            <a href="{{ route('binary.trade') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                <i class="mdi mdi-plus mr-1"></i> New Trade
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                @include('user.trading.partials.history_toolbar', ['historyType' => 'binary'])

                <!-- Stats Summary -->
                <div class="stats-bar px-4 pb-3">
                    <div class="stat-chip">
                        <span class="stat-label">Total Invested</span>
                        <span class="stat-value">${{ number_format($trades->sum('amount'), 2) }}</span>
                    </div>
                    <div class="stat-chip">
                        <span class="stat-label">Wins</span>
                        <span class="stat-value text-success">{{ $trades->where('result', 'Win')->count() }}</span>
                    </div>
                    <div class="stat-chip">
                        <span class="stat-label">Losses</span>
                        <span class="stat-value text-danger">{{ $trades->where('result', 'Loss')->count() }}</span>
                    </div>
                    <div class="stat-chip">
                        <span class="stat-label">Pending</span>
                        <span class="stat-value text-warning">{{ $trades->where('status', 'Pending')->count() }}</span>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>TRX | Coin Pair</th>
                                    <th>Trade Date</th>
                                    <th>Invest</th>
                                    <th>Duration</th>
                                    <th>Direction</th>
                                    <th>Strike Price</th>
                                    <th>Status</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trades as $trade)
                                    <tr onclick="toggleDetail({{ $trade->id }})">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="trx-id mr-2">#{{ $trade->id }}</div>
                                                <div class="font-weight-bold text-white">{{ $trade->coin_pair }}</div>
                                                @if($trade->is_demo)
                                                    <span class="badge-demo">DEMO</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $trade->created_at->format('M d, Y H:i') }}</td>
                                        <td class="text-white font-weight-bold">${{ number_format($trade->amount, 2) }}</td>
                                        <td>{{ $trade->duration }}s</td>
                                        <td>
                                            <span class="text-{{ in_array($trade->direction, ['Higher', 'Rise', 'Call']) ? 'success' : 'danger' }} font-weight-bold">
                                                <i class="mdi mdi-arrow-{{ in_array($trade->direction, ['Higher', 'Rise', 'Call']) ? 'up' : 'down' }}-thick mr-1"></i>
                                                {{ $trade->direction }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($trade->strike_price, 2) }}</td>
                                        <td>
                                            @php
                                                $statusColors = ['Pending' => 'warning', 'Won' => 'success', 'Lost' => 'danger', 'Completed' => 'info'];
                                            @endphp
                                            <span class="badge badge-soft-{{ $statusColors[$trade->status] ?? 'secondary' }} px-3 py-1">
                                                {{ $trade->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-{{ $trade->result == 'Win' ? 'success' : ($trade->result == 'Loss' ? 'danger' : 'warning') }} px-3 py-1">
                                                {{ $trade->result ?? 'Pending' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Drill-down Detail Row -->
                                    <tr class="trade-detail-row" id="detail-{{ $trade->id }}">
                                        <td colspan="8" style="padding:0; border:0;">
                                            <div class="trade-detail-content">
                                                <div class="detail-grid">
                                                    <div class="detail-item">
                                                        <span class="label">Trade ID</span>
                                                        <span class="value">#{{ $trade->id }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Asset Pair</span>
                                                        <span class="value">{{ $trade->coin_pair }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Direction</span>
                                                        <span class="value text-{{ in_array($trade->direction, ['Higher', 'Rise', 'Call']) ? 'success' : 'danger' }}">{{ $trade->direction }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Amount</span>
                                                        <span class="value">${{ number_format($trade->amount, 4) }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Strike Price</span>
                                                        <span class="value">${{ number_format($trade->strike_price, 4) }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">End Price</span>
                                                        <span class="value">${{ $trade->end_price ? number_format($trade->end_price, 4) : '--' }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Duration</span>
                                                        <span class="value">{{ $trade->duration }}s</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Win Amount</span>
                                                        <span class="value text-success">${{ number_format($trade->win_amount ?? 0, 2) }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Account Type</span>
                                                        <span class="value">{{ $trade->is_demo ? '🧪 Demo' : '🔴 Live' }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Created</span>
                                                        <span class="value">{{ $trade->created_at->format('M d, Y H:i:s') }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="label">Updated</span>
                                                        <span class="value">{{ $trade->updated_at->format('M d, Y H:i:s') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-history">
                                                <i class="mdi mdi-chart-timeline-variant-shimmer" style="font-size: 48px; color: rgba(255,255,255,0.1);"></i>
                                                <div class="text-muted mt-2">No {{ ($currentMode ?? 'Live') === 'Demo' ? 'demo' : 'live' }} binary trades found.</div>
                                                <a href="{{ route('binary.trade') }}" class="btn btn-primary mt-3 rounded-pill px-4 btn-sm">Start Trading</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3">
                        {{ $trades->appends(['mode' => $currentMode ?? 'Live'])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #11151d; border: 1px solid rgba(255,255,255,0.04); border-radius: 16px; }
        .bg-dark-input { background: #0d1117; }

        .stats-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .stat-chip {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 10px 18px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            min-width: 120px;
        }

        .stat-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.3);
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
        }

        .table-dark-custom { color: #8898aa; margin-bottom: 0; }
        .table-dark-custom thead th {
            background: #090c10;
            border: 0;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.3);
            padding: 1rem 1.5rem;
        }
        .table-dark-custom tbody td {
            border-top: 1px solid rgba(255,255,255,0.04);
            padding: 1rem 1.5rem;
            vertical-align: middle;
            font-size: 0.8rem;
        }
        .trx-id { font-size: 0.65rem; color: #1572e8; background: rgba(21, 114, 232, 0.08); padding: 2px 6px; border-radius: 4px; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.08); color: #28a745; border-radius: 6px; }
        .badge-soft-danger { background: rgba(220, 53, 69, 0.08); color: #dc3545; border-radius: 6px; }
        .badge-soft-warning { background: rgba(255, 193, 7, 0.08); color: #ffc107; border-radius: 6px; }
        .badge-soft-info { background: rgba(23, 162, 184, 0.08); color: #17a2b8; border-radius: 6px; }
        .badge-soft-secondary { background: rgba(108, 117, 125, 0.08); color: #6c757d; border-radius: 6px; }

        .empty-history {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }
    </style>
@endsection
