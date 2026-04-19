<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LEDIPO') — Trainer</title>

    <link rel="stylesheet" href="{{ asset('stylesheet/trainer.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/layout.css') }}">
    @yield('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    {{-- ===== TOPBAR (same as student) ===== --}}
    <nav class="topbar">

        <div class="topbar-left">
            <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a href="{{ route('teacher') }}" class="topbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="topbar-logo">
                <span>LEDIPO</span>
            </a>
        </div>



        <div class="topbar-right">
            {{-- Avatar / Profile Dropdown --}}
            <button class="avatar-btn" id="avatarBtn" aria-label="Open profile menu">
                {{ strtoupper(substr(Auth::user()->firstname ?? 'T', 0, 1)) }}{{ strtoupper(substr(Auth::user()->lastname ?? '', 0, 1)) }}
            </button>

            <div class="dropdown" id="dropdown">
                <div class="dropdown-header">
                    <div class="dh-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                    <div class="dh-role">{{ ucfirst(Auth::user()->role) }}</div>
                </div>

                <a href="" class="dd-item">
                    <i class="fa fa-user dd-icon"></i>
                    Profile
                </a>

                <div class="dd-divider"></div>

                <a href="#" class="dd-item dd-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-right-from-bracket dd-icon"></i>
                    Log out
                </a>

                <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="app-body">

        <div class="sidebar-overlay" id="overlay"></div>

        {{-- ===== SIDEBAR (trainer links) ===== --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-section-label">Menu</div>

            <a href="{{ route('teacher') }}"
               class="nav-item {{ request()->routeIs('teacher') ? 'active' : '' }}">
                <i class="fa fa-table-cells nav-icon"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('trainer.courses') }}"
               class="nav-item {{ request()->routeIs('trainer.courses') ? 'active' : '' }}">
                <i class="fa fa-book-open nav-icon"></i>
                <span>Courses</span>
            </a>

            <a href="{{ route('learner') }}"
               class="nav-item {{ request()->routeIs('learner') ? 'active' : '' }}">
                <i class="fa fa-users nav-icon"></i>
                <span>Trainees</span>
            </a>

            <div class="sidebar-section-label">Manage</div>

            <a href="{{ route('assessment') }}"
               class="nav-item {{ request()->routeIs('assessment') ? 'active' : '' }}">
                <i class="fa fa-clipboard-check nav-icon"></i>
                <span>Assessment</span>
            </a>
        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar   = document.getElementById('sidebar');
        const overlay   = document.getElementById('overlay');
        const avatarBtn = document.getElementById('avatarBtn');
        const dropdown  = document.getElementById('dropdown');

        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('show');
        });

        avatarBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.topbar-right')) {
                dropdown.classList.remove('open');
            }
        });
    </script>

    @yield('scripts')

</body>
</html>