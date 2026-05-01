<!-- Main nav -->
<nav class="navbar navbar-main navbar-expand-lg navbar-dark border-bottom border-white-10" id="navbar-main" style="background: #11151d; padding-top: 0.75rem; padding-bottom: 0.75rem;">
    <div class="container-fluid">
        <!-- Brand + Toggler (for mobile devices) -->
        <div class="pl-0 d-block d-md-none">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('storage/app/public/' . $settings->logo) }}" class="navbar-brand-img" alt="..." style="max-height: 35px; filter: brightness(0) invert(1);">
            </a>
        </div>

        <div class="d-none d-lg-flex align-items-center">
            <a href="#" class="nav-link nav-link-icon sidenav-toggler mr-3" data-action="sidenav-pin" data-target="#sidenav-main">
                <i class="fas fa-bars"></i>
            </a>
            <div class="search-bar-mock ml-2">
                <div class="input-group input-group-sm bg-dark-input rounded px-2" style="border: 1px solid rgba(255,255,255,0.05);">
                    <div class="input-group-prepend"><span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span></div>
                    <input type="text" class="form-control bg-transparent border-0 text-white" placeholder="Search markets, trades..." style="width: 250px;">
                    <div class="input-group-append"><span class="input-group-text bg-transparent border-0 text-muted small">⌘K</span></div>
                </div>
            </div>
        </div>

        <!-- User's navbar -->
        <div class="ml-auto navbar-user">
            <ul class="flex-row navbar-nav align-items-center">
                {{-- Notifications Mock --}}
                <li class="nav-item dropdown dropdown-animate mr-3 d-none d-md-block">
                    <a class="nav-link nav-link-icon text-white-50" href="#" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-dot bg-danger position-absolute" style="top: 10px; right: 10px;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark p-0" style="width: 300px;">
                        <div class="p-3 border-bottom border-white-10">
                            <h6 class="text-white font-weight-bold mb-0">Notifications</h6>
                        </div>
                        <div class="p-4 text-center">
                            <small class="text-muted">No new notifications</small>
                        </div>
                    </div>
                </li>

                {{-- KYC Status --}}
                @if ($settings->enable_kyc == 'yes')
                    <li class="nav-item mr-3 d-none d-md-block">
                        @if (Auth::user()->account_verify == 'Verified')
                            <span class="badge badge-soft-success py-2 px-3 border border-success-transparent">
                                <i class="fas fa-check-circle mr-1"></i> Verified
                            </span>
                        @else
                            <a href="{{ route('account.verify') }}" class="badge badge-soft-warning py-2 px-3 border border-warning-transparent">
                                <i class="fas fa-exclamation-circle mr-1"></i> Verify Account
                            </a>
                        @endif
                    </li>
                @endif

                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm rounded-circle bg-white-10 text-white d-flex align-items-center justify-content-center overflow-hidden" style="width: 35px; height: 35px;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold text-white">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-white-50 small"></i>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark mt-3 shadow-lg">
                        <div class="p-3 border-bottom border-white-10">
                            <h6 class="text-white font-weight-bold mb-0">{{ Auth::user()->name }}</h6>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="far fa-user mr-2"></i> My Profile
                        </a>
                        <a href="{{ route('manage.wallet') }}" class="dropdown-item">
                            <i class="fas fa-wallet mr-2"></i> My Wallet
                        </a>
                        <div class="dropdown-divider border-white-10"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    {{-- </div> --}}
</nav>

<style>
    .navbar-main { border-radius: 0; box-shadow: none; }
    .bg-white-10 { background: rgba(255,255,255,0.05); }
    .badge-soft-success { background: rgba(0, 200, 83, 0.1); color: #00c853; border-radius: 20px; font-weight: 600; font-size: 0.7rem; }
    .badge-soft-warning { background: rgba(255, 171, 0, 0.1); color: #ffab00; border-radius: 20px; font-weight: 600; font-size: 0.7rem; }
    .success-transparent { border-color: rgba(0, 200, 83, 0.2); }
    .warning-transparent { border-color: rgba(255, 171, 0, 0.2); }
    .dropdown-menu-dark { background: #1a1f2c; border: 1px solid rgba(255,255,255,0.05); }
    .dropdown-item { color: rgba(255,255,255,0.7); font-size: 0.85rem; padding: 0.6rem 1.25rem; transition: all 0.2s; }
    .dropdown-item:hover { background: rgba(255,255,255,0.03); color: #fff; }
    .text-white-50 { color: rgba(255,255,255,0.5) !important; }
</style>
