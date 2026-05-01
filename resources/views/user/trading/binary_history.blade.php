@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">All Binary Trade</h5>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="nav nav-pills nav-pills-custom">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Win</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Lose</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Refund</a>
                            </li>
                        </ul>
                        <div class="search-box">
                            <div class="input-group input-group-sm bg-dark-input rounded">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control bg-transparent border-0 text-white" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-dark-custom table-hover align-items-center">
                            <thead>
                                <tr>
                                    <th>TRX | Coin Pair</th>
                                    <th>Trade Date</th>
                                    <th>Invest</th>
                                    <th>Duration</th>
                                    <th>Direction</th>
                                    <th>Win Amount</th>
                                    <th>Status</th>
                                    <th>Win Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trades as $trade)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="trx-id mr-2">#{{ $trade->id }}</div>
                                                <div class="font-weight-bold text-white">{{ $trade->coin_pair }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $trade->created_at->format('M d, Y H:i') }}</td>
                                        <td class="text-white font-weight-bold">${{ number_format($trade->amount, 2) }}</td>
                                        <td>{{ $trade->duration }}s</td>
                                        <td>
                                            <span class="text-{{ $trade->direction == 'Higher' ? 'success' : 'danger' }} font-weight-bold">
                                                <i class="fas fa-arrow-{{ $trade->direction == 'Higher' ? 'up' : 'down' }} mr-1"></i>
                                                {{ $trade->direction }}
                                            </span>
                                        </td>
                                        <td class="text-success font-weight-bold">${{ number_format($trade->win_amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $trade->status == 'Open' ? 'primary' : 'secondary' }} rounded-pill px-3">
                                                {{ $trade->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-{{ $trade->result == 'Win' ? 'success' : ($trade->result == 'Loss' ? 'danger' : 'warning') }} px-3 py-1">
                                                {{ $trade->result }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">No binary trades found.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3">
                        {{ $trades->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .bg-dark-input { background: #0d1117; }
        .nav-pills-custom .nav-link {
            color: #8898aa;
            background: transparent;
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            margin-right: 10px;
        }
        .nav-pills-custom .nav-link.active {
            background: rgba(21, 114, 232, 0.1);
            color: #1572e8;
        }
        .table-dark-custom { color: #8898aa; margin-bottom: 0; }
        .table-dark-custom thead th {
            background: #0d1117;
            border: 0;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1.25rem 1.5rem;
        }
        .table-dark-custom tbody td {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
        }
        .trx-id { font-size: 0.7rem; color: #1572e8; background: rgba(21, 114, 232, 0.1); padding: 2px 6px; border-radius: 4px; }
        .badge-soft-success { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge-soft-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .badge-soft-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
    </style>
@endsection
