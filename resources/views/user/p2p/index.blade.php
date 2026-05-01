@extends('layouts.dash')
@section('title', $title)
@section('content')

    <div class="page-title mb-4">
        <h5 class="mb-0 text-white h3 font-weight-bold">P2P Center</h5>
        <p class="text-white-50 small">Buy and sell crypto directly with other users via our secure escrow service.</p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-dark-card border-0 py-5">
                <div class="card-body text-center">
                    <div class="icon icon-shape bg-soft-primary text-primary rounded-circle mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-white font-weight-bold">P2P Trading coming soon</h3>
                    <p class="text-muted">We are currently building a secure peer-to-peer marketplace. Stay tuned!</p>
                    <button class="btn btn-primary rounded-pill px-4 mt-3" onclick="history.back()">Go Back</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-card { background: #151a24; }
        .bg-soft-primary { background: rgba(21, 114, 232, 0.1); }
    </style>
@endsection
