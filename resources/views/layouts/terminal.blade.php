@inject('content', 'App\Http\Controllers\FrontController')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->site_name }} | @yield('title')</title>

    <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />
    
    <link href="{{ asset('themes/purposeTheme/temp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/purposeTheme/temp/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/purposeTheme/temp/css/style.css') }}" rel="stylesheet" type="text/css" />
    @php
        $theme = $settings->website_theme == 'purpose.css' ? 'default.css' : $settings->website_theme;
    @endphp
    <link href="{{ asset('themes/purposeTheme/temp/css/colors/' . $theme) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/terminal.css') }}" rel="stylesheet">
    
    <style>
        html, body { min-height: 100vh; margin: 0; padding: 0; background: #0b1217; }
        body { font-family: 'Inter', sans-serif; display: flex; flex-direction: column; overflow-x: hidden; }
        #topnav { background: #161a1e; border-bottom: 1px solid #2b3139; padding: 0 20px; height: 60px; min-height: 60px; flex-shrink: 0; display: flex; align-items: center; justify-content: space-between; z-index: 1000; position: relative; }
        .logo img { height: 26px; }
        .nav-link-custom { color: #848e9c !important; font-size: 13px !important; font-weight: 500; padding: 0 15px; transition: color 0.2s; text-decoration: none !important; }
        .nav-link-custom:hover { color: #fff !important; }
        .header-right .btn-dashboard { background: #1bd1c7; color: #0b1217; border: 0; font-size: 12px; font-weight: 700; padding: 6px 18px; border-radius: 4px; text-decoration: none !important; }
        .header-right .btn-logout { color: #848e9c; font-size: 13px; font-weight: 500; text-decoration: none; margin-left: 20px; }
        .header-right .btn-logout:hover { color: #f6465d; }
        main { flex-grow: 1; display: flex; flex-direction: column; overflow: hidden; position: relative; }
    </style>
    @yield('styles')
</head>

<body>
    <header id="topnav" class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a class="logo mr-4 d-flex align-items-center" href="/">
                <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Logo" class="mr-2">
                <span class="h5 mb-0 text-white font-weight-bold" style="letter-spacing: 1px;">{{ strtoupper($settings->site_name) }}</span>
            </a>
            <nav class="d-none d-lg-flex">
                <a href="#" class="nav-link-custom">Market</a>
                <a href="{{ route('spot.trade') }}" class="nav-link-custom">Trade</a>
                <a href="#" class="nav-link-custom">Crypto Currency</a>
                <a href="#" class="nav-link-custom">About</a>
                <a href="#" class="nav-link-custom">Contact</a>
            </nav>
        </div>
        
        <div class="header-right d-flex align-items-center">
            <div class="d-flex align-items-center mr-4 d-none d-sm-flex">
                <img src="https://flagcdn.com/w20/us.png" width="20" alt="English" class="mr-2">
                <span class="x-small text-muted">English</span>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-dashboard mr-3">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link btn-logout p-0 border-0">Logout</button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('themes/purposeTheme/temp/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('themes/purposeTheme/temp/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
