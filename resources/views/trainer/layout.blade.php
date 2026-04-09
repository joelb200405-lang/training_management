<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LEDIPO Trainer Dashboard')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">

    @yield('css')
</head>

<body>

    <div class="top-strip">
         <div class="language-selector">
            English <i class="fas fa-chevron-down"></i>
         </div>
    </div>

    <div class="container" style="margin: 0; padding: 0;">

        <nav class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
                <p class="sidebar-title">Dasmariñas City Training Center</p>
            </div>
            <ul>
                <li class="{{ request()->routeIs('teacher') ? 'active' : '' }}">
                    <a href="{{ route('teacher') }}"><i class="fas fa-th-large"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('trainer.courses') ? 'active' : '' }}">
                    <a href="{{ route('trainer.courses') }}"><i class="fas fa-book"></i> Courses</a>
                </li>
                <li class="{{ request()->routeIs('learner') ? 'active' : '' }}">
                    <a href="{{ route('learner') }}"><i class="fas fa-users"></i> Trainees</a>
                </li>
                <li class="{{ request()->routeIs('assessment') ? 'active' : '' }}">
                    <a href="{{ route('assessment') }}"><i class="fas fa-clipboard-check"></i> Assessment</a>
                </li>
                <li class="{{ request()->routeIs('certificates') ? 'active' : '' }}">
                    <a href="{{ route('certificates') }}"><i class="fas fa-certificate"></i> Certificates</a>
                </li>
                <li class="{{ request()->routeIs('reports') ? 'active' : '' }}">
                    <a href="{{ route('reports') }}"><i class="fas fa-chart-line"></i> Reports</a>
                </li>
                <li class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="fas fa-gear"></i> Settings</a>
                </li>
            </ul>
        </nav>

                <main class="main-content">

            <header class="main-header">
                <div class="search-box">
                    <input type="text" placeholder="What are you looking for?">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                <div class="icon-buttons">
                    <div class="icon-item"><i class="fas fa-bell"></i></div>
                    <form action="{{ route('Logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="icon-item logout" style="background:none; border:none; cursor:pointer;">
                            <i class="fas fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </header>

            @yield('content')

        </main>
    </div>

            <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Support</h3>
                <p>Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                <p><a href="mailto:Regals@gmail.com">Regals@gmail.com</a></p>
                <p>+88015-88888-9999</p>
            </div>
            <div class="footer-col">
                <h3>Account</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Login / Register</a></li>
                    <li><a href="#">Likes</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Copyright Rimel 2022. All right reserved</p>
        </div>
    </footer>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>
</html>