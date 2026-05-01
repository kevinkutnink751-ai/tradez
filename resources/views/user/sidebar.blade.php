<!-- Sidenav -->
<div class="sidenav dashboard-sidenav" id="sidenav-main" style="background: #11151d; border-right: 1px solid rgba(255,255,255,0.05);">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center justify-content-between py-4 px-4 border-bottom border-white-10">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" class="navbar-brand-img" alt="logo" style="max-height: 40px; filter: brightness(0) invert(1);">
        </a>
        <button type="button" class="btn btn-link text-white p-0 d-xl-none" data-dashboard-sidebar-close aria-label="Close menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="sidenav-scroll">
        <!-- User mini profile - Institutional Style -->
        <div class="sidenav-user px-4 py-4 mb-2">
            <div class="d-flex align-items-center mb-3">
                <div class="avatar-container position-relative">
                    <div class="avatar avatar-md rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-lg" style="width: 45px; height: 45px;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <span class="status-indicator bg-success"></span>
                </div>
                <div class="ml-3">
                    <h6 class="mb-0 text-white font-weight-bold" style="font-size: 0.95rem;">{{ Auth::user()->name }}</h6>
                    <small class="text-muted text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Verified Trader</small>
                </div>
            </div>
            
        </div>

        <!-- Navigation -->
        <div class="nav-wrapper px-3 pb-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-header">Trade</li>

                @if(isset($mod['spot']) && $mod['spot'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('spot.trade') ? 'active' : '' }}" href="{{ route('spot.trade') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Spot Trading</span>
                    </a>
                </li>
                @endif

                @if(isset($mod['future']) && $mod['future'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('future.trade') ? 'active' : '' }}" href="{{ route('future.trade') }}">
                        <i class="fas fa-bolt"></i>
                        <span>Futures</span>
                    </a>
                </li>
                @endif

                @if(isset($mod['subscription']) && $mod['subscription'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('copy.trade') ? 'active' : '' }}" href="{{ route('copy.trade') }}">
                        <i class="fas fa-copy"></i>
                        <span>Copy Trading</span>
                    </a>
                </li>
                @endif

                @if(isset($mod['binary']) && $mod['binary'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('binary.trade') ? 'active' : '' }}" href="{{ route('binary.trade') }}">
                        <i class="fas fa-sliders-h"></i>
                        <span>Binary Options</span>
                    </a>
                </li>
                @endif

                @if(isset($mod['options']) && $mod['options'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('options.trade') ? 'active' : '' }}" href="{{ route('options.trade') }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Vanilla Options</span>
                    </a>
                </li>
                @endif

                <li class="nav-header">Funds</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('manage.wallet') ? 'active' : '' }}" href="{{ route('manage.wallet') }}">
                        <i class="fas fa-wallet"></i>
                        <span>Wallets</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('deposits') ? 'active' : '' }}" href="{{ route('deposits') }}">
                        <i class="fas fa-arrow-down"></i>
                        <span>Deposit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('withdrawalsdeposits') ? 'active' : '' }}" href="{{ route('withdrawalsdeposits') }}">
                        <i class="fas fa-arrow-up"></i>
                        <span>Withdraw</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('accounthistory') ? 'active' : '' }}" href="{{ route('accounthistory') }}">
                        <i class="fas fa-receipt"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="nav-header">Reports</li>

                @if(isset($mod['spot']) && $mod['spot'])
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('spot.history') ? 'active' : '' }}" href="{{ route('spot.history') }}"><i class="fas fa-list-alt"></i><span>Spot History</span></a></li>
                @endif
                @if(isset($mod['future']) && $mod['future'])
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('future.history') ? 'active' : '' }}" href="{{ route('future.history') }}"><i class="fas fa-clipboard-list"></i><span>Futures History</span></a></li>
                @endif
                @if(isset($mod['binary']) && $mod['binary'])
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('binary.history') ? 'active' : '' }}" href="{{ route('binary.history') }}"><i class="fas fa-history"></i><span>Binary History</span></a></li>
                @endif
                @if(isset($mod['options']) && $mod['options'])
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('options.history') ? 'active' : '' }}" href="{{ route('options.history') }}"><i class="fas fa-history"></i><span>Options History</span></a></li>
                @endif

                <li class="nav-header">Account</li>

                @if ($settings->enable_kyc == 'yes' && Auth::user()->account_verify != 'Verified')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('account.verify') ? 'active' : '' }}" href="{{ route('account.verify') }}">
                        <i class="fas fa-user-check"></i>
                        <span>Verify Account</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('referuser') ? 'active' : '' }}" href="{{ route('referuser') }}">
                        <i class="fas fa-users"></i>
                        <span>Referrals</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('support') ? 'active' : '' }}" href="{{ route('support') }}">
                        <i class="fas fa-headset"></i>
                        <span>Support</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
                        <span>Secure Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>

            <div class="sidebar-footer-card mt-4">
                <small class="sidebar-footer-label">Need help?</small>
                <h6 class="text-white mb-2">Talk to the trading desk</h6>
                <p class="text-muted mb-3">Get support for funding, account access, and active market sessions.</p>
                <a href="{{ route('support') }}" class="btn btn-primary btn-sm btn-block">Open Support</a>
            </div>
        </div>
    </div>
</div>

<style>
    .sidenav {
        width: var(--sidebar-width);
        min-width: var(--sidebar-width);
        transition: transform 0.18s ease;
        z-index: 1000;
        background:
            linear-gradient(180deg, rgba(255,255,255,0.03), transparent 16%),
            #0d1219 !important;
        border-right: 1px solid var(--border-color) !important;
        box-shadow: none;
    }
    .dashboard-shell .container-application {
        min-height: 100vh;
        padding-left: 0;
        padding-right: 0;
    }
    .dashboard-shell .dashboard-sidenav {
        display: flex !important;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        height: 100vh;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
    }
    .sidenav-scroll {
        flex: 1 1 auto;
        overflow-x: hidden;
        overflow-y: auto;
        min-height: 0;
    }
    .sidenav-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .sidenav-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidenav-scroll::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.14);
        border-radius: 999px;
    }
    .dashboard-shell .main-content {
        width: 100%;
        margin-left: var(--sidebar-width);
        min-height: 100vh;
    }
    .nav-wrapper .nav-link {
        color: rgba(255, 255, 255, 0.64);
        padding: 0.78rem 0.9rem;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        transition: background-color 0.12s ease, border-color 0.12s ease, color 0.12s ease;
        border-radius: 8px;
        margin-bottom: 0.18rem;
        border: 1px solid transparent;
    }
    .nav-wrapper .nav-link i:first-child {
        width: 20px;
        margin-right: 14px;
        font-size: 1rem;
        text-align: center;
    }
    .nav-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.045);
        border-color: rgba(255, 255, 255, 0.05);
    }
    .nav-wrapper .nav-link.active {
        color: #fff;
        background: rgba(21, 114, 232, 0.16);
        border: 1px solid rgba(21, 114, 232, 0.26);
        font-weight: 600;
    }
    .nav-header {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 800;
        color: rgba(255, 255, 255, 0.28);
        padding: 1.25rem 0.9rem 0.55rem;
    }
    .nav-arrow {
        font-size: 0.7rem;
        transition: transform 0.3s;
        opacity: 0.5;
    }
    .nav-link:not(.collapsed) .nav-arrow {
        transform: rotate(90deg);
    }
    .border-white-10 { border-color: rgba(255, 255, 255, 0.05) !important; }
    .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        border: 2px solid #11151d;
        border-radius: 50%;
    }
    .logout-link:hover {
        background: rgba(255, 61, 0, 0.05) !important;
    }
    .sidebar-footer-card {
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.06);
        background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.015));
    }
    .sidebar-footer-label {
        display: inline-block;
        margin-bottom: 0.6rem;
        color: rgba(255,255,255,0.46);
        font-size: 0.68rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
    .balance-card {
        border-radius: 8px !important;
    }
    .sidenav-user {
        border-bottom: 1px solid rgba(255,255,255,0.04);
    }
    @media (max-width: 1199.98px) {
        .dashboard-shell .dashboard-sidenav {
            transform: translateX(-100%);
            box-shadow: 24px 0 60px rgba(0, 0, 0, 0.35);
        }
        .dashboard-shell .main-content {
            margin-left: 0;
        }
        .dashboard-shell.dashboard-sidebar-open .dashboard-sidenav {
            transform: translateX(0);
        }
        .dashboard-shell.dashboard-sidebar-open .dashboard-sidebar-overlay {
            opacity: 1;
            visibility: visible;
        }
        .sidenav {
            width: min(88vw, var(--sidebar-width));
            min-width: 0;
        }
        .dashboard-shell .dashboard-sidenav {
            margin-left: 0;
        }
    }
    @media (min-width: 1200px) {
        .dashboard-shell .dashboard-sidenav {
            transform: none !important;
        }
    }
</style>
