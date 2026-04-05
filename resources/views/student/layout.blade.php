<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasmariñas Training')</title>

    <link rel="stylesheet" href="{{ asset('stylesheet/homepage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        * { font-family: "Open Sans", sans-serif; }

        .user-welcome {
            position: relative;
            cursor: pointer;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid rgba(0,0,0,0.1);
            user-select: none;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 110%;
            background: white;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            min-width: 140px;
            z-index: 999;
        }
        .dropdown-content.show { display: block; }
        .dropdown-content a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 14px;
            color: #333;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background: #f5f5f5;
            border-radius: 6px;
        }
    </style>

    @yield('css')
</head>
<body>

    {{-- NAVBAR 1 --}}
    <div class="navbar-1">
        <span></span>
        <p>Dasmarinas: Tulong sa Kabuhayan, Tuloy ang kaunlaran!</p>
        <select>
            <option>English</option>
            <option>Tagalog</option>
        </select>
    </div>

    {{-- NAVBAR 2 --}}
    <div class="navbar-2">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <p><a href="{{ route('homepage') }}" style="text-decoration:none; color:inherit;">Home</a></p>
        <p>About</p>
        <p>Contact</p>
        <p><a href="{{ route('all.courses') }}" style="text-decoration:none; color:inherit;">Courses</a></p>

        <form action="" method="Get">
            <div class="nav-search-icons">
                <div class="search">
                    <input type="text" placeholder="What are you looking for?">
                    <i class="fa fa-search"></i>
                </div>
            </div>
        </form>

        @if(Auth::check())
            <div class="user-welcome" onclick="toggleDropdown(event)">
                Welcome, <strong>{{ Auth::user()->username }}</strong>!
                <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; margin-left: 5px;"></i>
                <div id="logout-dropdown" class="dropdown-content">
                    <form action="{{ route('Logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background:none; border:none; cursor:pointer; color:#333; font-size:14px; padding: 10px 16px;">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    {{-- PAGE CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    <div class="footer-container">
        <div class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
        </div>
        <div class="logo-text">
            <div>
                <p>Support</p>
                <p>Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                <p>Regals@gmail.com</p>
                <p>+88015-88888-9999</p>
            </div>
            <div>
                <p>Account</p>
                <p>My Account</p>
                <p>Login/Register</p>
                <p>Likes</p>
            </div>
            <div>
                <p>Quick Links</p>
                <p>Privacy Policy</p>
                <p>Terms of Use</p>
                <p>FAQ</p>
                <p>Contact</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            document.getElementById("logout-dropdown").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.closest('.user-welcome')) {
                const dropdown = document.getElementById("logout-dropdown");
                if (dropdown) dropdown.classList.remove("show");
            }
        }
    </script>

    @yield('scripts')

</body>
</html>
