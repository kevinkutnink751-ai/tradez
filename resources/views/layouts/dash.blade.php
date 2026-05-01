<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->site_name }} | @yield('title')</title>
    @section('styles')
        <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />
        <!-- Font Awesome 5 -->
        <link rel="stylesheet"
            href="{{ asset('themes/purposeTheme/assets/libs/%40fortawesome/fontawesome-pro/css/all.min.css') }}">
        <!-- Page CSS -->
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
        <!-- Purpose CSS -->
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/css/' . $settings->website_theme) }}"
            id="stylesheet">
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/libs/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
        <script src="{{ asset('themes/purposeTheme/assets/libs/sweetalert/sweetalert.min.js') }} "></script>
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('themes/purposeTheme/assets/libs/flatpickr/dist/flatpickr.min.css') }}">
        <style>
            :root {
                --bg-main: #090c10;
                --bg-card: #11151d;
                --bg-card-soft: #151b24;
                --bg-surface: #0d1219;
                --border-color: rgba(255, 255, 255, 0.05);
                --sidebar-width: 280px;
            }
            html,
            body {
                min-height: 100%;
            }
            body.dashboard-shell {
                background:
                    radial-gradient(circle at top right, rgba(21, 114, 232, 0.12), transparent 24%),
                    linear-gradient(180deg, #0a0f15 0%, #090c10 100%) !important;
                color: #fff !important;
                font-family: 'Inter', sans-serif;
                overflow-x: hidden;
            }
            .dashboard-shell .container-application:before {
                display: none !important;
            }
            .dashboard-shell .container-application {
                display: flex;
                align-items: stretch;
                width: 100%;
                max-width: none;
                min-height: 100vh;
                padding: 0 !important;
                margin: 0 !important;
                overflow: visible !important;
            }
            .dashboard-shell .main-content {
                display: flex;
                flex: 1 1 auto;
                flex-direction: column;
                width: calc(100% - var(--sidebar-width));
                min-height: 100vh;
                background: transparent !important;
            }
            .dashboard-shell .page-content {
                flex: 1 1 auto;
                width: 100%;
                padding: 2rem !important;
            }
            .dashboard-shell .footer {
                margin-top: auto;
                background: rgba(9, 12, 16, 0.82) !important;
                backdrop-filter: blur(16px);
            }
            .card {
                background-color: var(--bg-card);
                border: 1px solid var(--border-color);
            }
            .scrollbar-inner::-webkit-scrollbar { width: 4px; }
            .scrollbar-inner::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
            .bg-dark-input { background: #090c10 !important; }
            .border-white-10 { border-color: rgba(255,255,255,0.05) !important; }
            .text-white-50 { color: rgba(255,255,255,0.5) !important; }
            .dashboard-sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(4, 8, 14, 0.74);
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.15s ease, visibility 0.15s ease;
                z-index: 995;
            }
            @media (max-width: 1199.98px) {
                .dashboard-shell .main-content {
                    width: 100%;
                }
                .dashboard-shell .page-content {
                    padding: 1rem !important;
                }
            }
        </style>
    @show
    @livewireStyles
</head>

<body class="dashboard-shell">
    <script>
        {!! $settings->tawk_to !!}
    </script>
    <!-- Application container -->
    <div class="container-fluid container-application">
        {{-- Side Bar --}}
        @include('user.sidebar')
        <div class="dashboard-sidebar-overlay" data-dashboard-sidebar-close></div>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            @include('user.topmenu')

            <!-- Page content -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- Footer -->
            <footer class="footer pt-5 pb-4 bg-dark-main border-top border-white-10" id="footer-main">
                <div class="row align-items-center justify-content-between px-4">
                    <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                        <p class="text-sm text-white-50 mb-0">&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-center justify-content-md-end">
                            <li class="nav-item"><a href="#" class="nav-link text-sm text-white-50 px-3">Terms</a></li>
                            <li class="nav-item"><a href="#" class="nav-link text-sm text-white-50 px-3">Privacy</a></li>
                            <li class="nav-item"><a href="#" class="nav-link text-sm text-white-50 px-3">Support</a></li>
                            @if ($settings->google_translate == 'on')
                                <li class="nav-item"><div id="google_translate_element" class="ml-3"></div></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @section('scripts')
        <!-- Scripts -->
        <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
        <script src="{{ asset('themes/purposeTheme/assets/js/purpose.core.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('themes/purposeTheme/assets/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>
        <!-- Page JS -->
        <script src="{{ asset('themes/purposeTheme/assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/sweetalert/sweetalert.min.js') }} "></script>
        <!-- Purpose JS -->
        <script src="{{ asset('themes/purposeTheme/assets/js/purpose.js') }}"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js">
        </script>
        {{-- my custom javascript file --}}
        <script src="{{ asset('themes/purposeTheme/assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>

    @show

    <script src="{{ asset('themes/purposeTheme/assets/js/scriptfile.js') }}"></script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    @include('user.modals')
    @livewireScripts
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shell = document.body;
            const openers = document.querySelectorAll('[data-dashboard-sidebar-open]');
            const closers = document.querySelectorAll('[data-dashboard-sidebar-close]');
            const syncSidebarState = function() {
                if (window.innerWidth >= 1200) {
                    shell.classList.remove('dashboard-sidebar-open');
                }
            };

            openers.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    shell.classList.add('dashboard-sidebar-open');
                });
            });

            closers.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    shell.classList.remove('dashboard-sidebar-open');
                });
            });

            window.addEventListener('resize', syncSidebarState);
            syncSidebarState();
        });
    </script>
</body>
