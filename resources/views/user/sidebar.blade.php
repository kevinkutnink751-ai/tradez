<!-- Sidenav -->
<div class="sidenav" id="sidenav-main" style="background: #11151d; border-right: 1px solid rgba(255,255,255,0.05);">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center justify-content-center py-4 border-bottom border-white-10">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" class="navbar-brand-img" alt="logo" style="max-height: 40px; filter: brightness(0) invert(1);">
        </a>
    </div>

    <div class="scrollbar-inner">
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
            <div class="balance-card p-3 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                <small class="text-muted d-block mb-1 text-uppercase font-weight-bold" style="font-size: 0.6rem; letter-spacing: 0.5px;">Account Equity</small>
                <h5 class="text-white mb-0 font-weight-bold">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal + Auth::user()->spot_bal + Auth::user()->future_bal, 2) }}</h5>
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
                
                <li class="nav-header">Trading Terminals</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['spot.trade', 'future.trade', 'binary.trade', 'options.trade', 'copy.trade']) ? '' : 'collapsed' }}" data-toggle="collapse" href="#tradingDropdown" role="button" aria-expanded="{{ request()->routeIs(['spot.trade', 'future.trade', 'binary.trade', 'options.trade', 'copy.trade']) ? 'true' : 'false' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Markets</span>
                        <i class="fas fa-chevron-right ml-auto nav-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs(['spot.trade', 'future.trade', 'binary.trade', 'options.trade', 'copy.trade']) ? 'show' : '' }}" id="tradingDropdown">
                        <ul class="nav flex-column ml-4 mt-1 border-left border-white-10">
                            @if(isset($mod['spot']) && $mod['spot'])
                            <li class="nav-item">
                                <a class="nav-link py-2 {{ request()->routeIs('spot.trade') ? 'active' : '' }}" href="{{ route('spot.trade') }}">
                                    <span>Spot Terminal</span>
                                </a>
                            </li>
                            @endif
                            @if(isset($mod['future']) && $mod['future'])
                            <li class="nav-item">
                                <a class="nav-link py-2 {{ request()->routeIs('future.trade') ? 'active' : '' }}" href="{{ route('future.trade') }}">
                                    <span>Futures Terminal</span>
                                </a>
                            </li>
                            @endif
                            @if(isset($mod['binary']) && $mod['binary'])
                            <li class="nav-item">
                                <a class="nav-link py-2 {{ request()->routeIs('binary.trade') ? 'active' : '' }}" href="{{ route('binary.trade') }}">
                                    <span>Binary Trading</span>
                                </a>
                            </li>
                            @endif
                            @if(isset($mod['options']) && $mod['options'])
                            <li class="nav-item">
                                <a class="nav-link py-2 {{ request()->routeIs('options.trade') ? 'active' : '' }}" href="{{ route('options.trade') }}">
                                    <span>Options Market</span>
                                </a>
                            </li>
                            @endif
                            @if(isset($mod['subscription']) && $mod['subscription'])
                            <li class="nav-item">
                                <a class="nav-link py-2 {{ request()->routeIs('copy.trade') ? 'active' : '' }}" href="{{ route('copy.trade') }}">
                                    <span>Copy Trading</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['tradinghistory', 'future.history', 'binary.history', 'options.history', 'accounthistory']) ? '' : 'collapsed' }}" data-toggle="collapse" href="#historyDropdown" role="button" aria-expanded="{{ request()->routeIs(['tradinghistory', 'future.history', 'binary.history', 'options.history', 'accounthistory']) ? 'true' : 'false' }}">
                        <i class="fas fa-history"></i>
                        <span>Reporting</span>
                        <i class="fas fa-chevron-right ml-auto nav-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs(['tradinghistory', 'future.history', 'binary.history', 'options.history', 'accounthistory', 'spot.history']) ? 'show' : '' }}" id="historyDropdown">
                        <ul class="nav flex-column ml-4 mt-1 border-left border-white-10">
                            @if(isset($mod['spot']) && $mod['spot'])
                            <li class="nav-item"><a class="nav-link py-2 {{ request()->routeIs('spot.history') ? 'active' : '' }}" href="{{ route('spot.history') }}"><span>Spot History</span></a></li>
                            @endif
                            @if(isset($mod['future']) && $mod['future'])
                            <li class="nav-item"><a class="nav-link py-2 {{ request()->routeIs('future.history') ? 'active' : '' }}" href="{{ route('future.history') }}"><span>Futures Log</span></a></li>
                            @endif
                            @if(isset($mod['binary']) && $mod['binary'])
                            <li class="nav-item"><a class="nav-link py-2 {{ request()->routeIs('binary.history') ? 'active' : '' }}" href="{{ route('binary.history') }}"><span>Binary Log</span></a></li>
                            @endif
                            @if(isset($mod['options']) && $mod['options'])
                            <li class="nav-item"><a class="nav-link py-2 {{ request()->routeIs('options.history') ? 'active' : '' }}" href="{{ route('options.history') }}"><span>Options History</span></a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link py-2 {{ request()->routeIs('accounthistory') ? 'active' : '' }}" href="{{ route('accounthistory') }}"><span>Transaction History</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-header">Financial Center</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('manage.wallet') ? 'active' : '' }}" href="{{ route('manage.wallet') }}">
                        <i class="fas fa-wallet"></i>
                        <span>Asset Manager</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['deposit.history', 'withdraw.history']) ? '' : 'collapsed' }}" data-toggle="collapse" href="#fundDropdown" role="button" aria-expanded="false">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Funds Control</span>
                        <i class="fas fa-chevron-right ml-auto nav-arrow"></i>
                    </a>
                    <div class="collapse" id="fundDropdown">
                        <ul class="nav flex-column ml-4 mt-1 border-left border-white-10">
                            <li class="nav-item"><a class="nav-link py-2" href="{{ route('deposits') }}"><span>Add Funds</span></a></li>
                            <li class="nav-item"><a class="nav-link py-2" href="{{ route('withdrawalsdeposits') }}"><span>Withdraw</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('referuser') ? 'active' : '' }}" href="{{ route('referuser') }}">
                        <i class="fas fa-users"></i>
                        <span>Partner Program</span>
                    </a>
                </li>

                <li class="nav-header">Configuration</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <i class="fas fa-cog"></i>
                        <span>Account Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('support') ? 'active' : '' }}" href="{{ route('support') }}">
                        <i class="fas fa-headset"></i>
                        <span>Help Center</span>
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
        </div>
    </div>
</div>

<style>
    .sidenav {
        width: 260px;
        transition: all 0.3s;
        z-index: 1000;
    }
    .nav-wrapper .nav-link {
        color: rgba(255, 255, 255, 0.45);
        padding: 0.8rem 1.25rem;
        /* font-size: 0.88rem; */
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: all 0.2s;
        border-radius: 4px;
        margin-bottom: 2px;
    }
    .nav-wrapper .nav-link i:first-child {
        width: 20px;
        margin-right: 15px;
        font-size: 1.1rem;
        text-align: center;
    }
    .nav-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.03);
    }
    .nav-wrapper .nav-link.active {
        color: #fff;
        background: linear-gradient(90deg, rgba(21, 114, 232, 0.15) 0%, transparent 100%);
        border-left: 3px solid #1572e8;
        font-weight: 600;
    }
    .nav-header {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 800;
        color: rgba(255, 255, 255, 0.25);
        padding: 1.5rem 1.25rem 0.75rem;
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
</style>
