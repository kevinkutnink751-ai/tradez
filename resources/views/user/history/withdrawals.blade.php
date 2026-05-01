@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">Withdrawal History</h5>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdrawals as $withdrawal)
                                    <tr>
                                        <td class="text-white font-weight-bold">#WID{{ $withdrawal->id }}</td>
                                        <td class="text-white font-weight-bold">${{ number_format($withdrawal->amount, 2) }}</td>
                                        <td>{{ $withdrawal->payment_mode }}</td>
                                        <td>
                                            <span class="badge badge-soft-{{ $withdrawal->status == 'Processed' ? 'success' : ($withdrawal->status == 'Pending' ? 'warning' : 'danger') }} px-3 py-1">
                                                {{ $withdrawal->status }}
                                            </span>
                                        </td>
                                        <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">No withdrawal history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3">
                        {{ $withdrawals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .table-dark-custom thead th { background: #0d1117; border: 0; text-transform: uppercase; font-size: 0.75rem; color: #8898aa; padding: 1.25rem 1.5rem; }
        .table-dark-custom tbody td { border-top: 1px solid rgba(255,255,255,0.05); padding: 1.25rem 1.5rem; vertical-align: middle; color: #8898aa; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge-soft-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .badge-soft-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
    </style>
@endsection
