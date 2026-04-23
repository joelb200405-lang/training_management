<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasmariñas Training')</title>

    <link rel="stylesheet" href="{{ asset('stylesheet/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheet/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">

    @yield('css')

            <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 300px;
            margin: 15% auto;
            text-align: center;
            border-radius: 10px;
        }

        .modal-actions-centered button {
            margin: 10px;
            padding: 8px 15px;
        }
        </style>
</head>
<body>

    <nav class="topbar">

        <div class="topbar-left">
            <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a href="{{ route('homepage') }}" class="topbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="topbar-logo">
                <span>LEDIPO</span>
            </a>
        </div>

        <div class="topbar-right">
            <button class="avatar-btn" id="avatarBtn" aria-label="Open profile menu">
                {{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}{{ strtoupper(substr(Auth::user()->lastname, 0, 1)) }}
            </button>

        <div class="dropdown" id="dropdown">
            <div class="dropdown-header">
                <div class="dd-avatar">
                    {{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}{{ strtoupper(substr(Auth::user()->lastname, 0, 1)) }}
                </div>
                <div>
                    <div class="dh-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                    <div class="dh-role">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>
        
            <div class="dd-items">
                <a href="{{ route('student.profile') }}" class="dd-item">
                    <i class="fa fa-user dd-icon"></i>
                    Profile
                </a>
        
                <div class="dd-divider"></div>
        
                <a href="#" class="dd-item dd-logout"
                onclick="event.preventDefault(); openLogoutModal();">
                    <i class="fa fa-right-from-bracket dd-icon"></i>
                    Log out
                </a>
            </div>
        
            <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
        </div>
    </nav>
                        <div id="logoutModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <p>Are you sure you want to log out?</p>

                    <div class="modal-actions-centered">
                        <button onclick="confirmLogout()" class="btn-modal-yes">Yes</button>
                        <button onclick="closeLogoutModal()" class="btn-modal-no">Cancel</button>
                    </div>
                </div>
            </div>

    <div class="app-body">

        
        <div class="sidebar-overlay" id="overlay"></div>

       
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-section-label">Menu</div>

            <a href="{{ route('homepage') }}"
               class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                <i class="fa fa-house nav-icon"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('all.courses') }}"
               class="nav-item {{ request()->routeIs('all.courses') ? 'active' : '' }}">
                <i class="fa fa-book-open nav-icon"></i>
                <span>Courses</span>
            </a>
        </aside>

        
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
        </script>
                <script>
            function openLogoutModal() {
                document.getElementById('logoutModal').style.display = 'block';
            }

            function closeLogoutModal() {
                document.getElementById('logoutModal').style.display = 'none';
            }

            function confirmLogout() {
                document.getElementById('logout-form').submit();
            }
            </script>

    @yield('scripts')

</body>
</html>