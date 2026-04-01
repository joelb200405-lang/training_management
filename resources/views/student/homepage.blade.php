<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasmarinas</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/landingpage.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }

        .user-welcome{
            position: relative;
            cursor: pointer;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid rgba(0,0,0,0.1);
            user-select: none;
        }
        .dropdown-content{
            display: none;
            position: absolute;
            right: 0;
            top: 110%;
            background: white;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,1);
            min-width: 140px;
            z-index: 999;
        }
        .dropdown-content.show{
            display: block;
        }
        .dropdown-content a{
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 14px;
            color: #333;
            text-decoration: none;  
        }
        .dropdown-content a:hover{
            background: #f5f5f5;
            border-radius: 6px;
        }
    </style>
    
 
</head>

<body>


    <div class="navbar-1">
    <span></span>
    <p>Dasmarinas: Tulong sa Kabuhayan, Tuloy ang kaunlaran!</p>
    <select>
        <option>English</option>
        <option>Tagalog</option>
    </select>
</div>

<div class="navbar-2">

    <img src="../images/logo_hill.png" alt="logo">

    <p> Home </p>
    <p> About </p>
    <p> Contact </p>
    <p> Courses </p>

    <form action="" method="Get">

        <div class="nav-search-icons">

            <div class="search">
                <input type="text" placeholder="What are you looking for? ">
                <i class="fa fa-search"></i>
            </div>

        </div>
    </form>

               @if ($username)
                <div class="user-welcome" onclick="toggleDropdown(event)">
                    Welcome, <strong>{{ $username }}</strong>!
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; margin-left: 5px;"></i>
                    <div id="logout-dropdown" class="dropdown-content">
                        <form action="{{ route('Logout') }}" method="post">
                            @csrf
                        <button type="submit" style="background:none; border:none; cursor:pointer; color:#333; font-size:14px; padding: 10px 16px;">
                            <i class="fa-solid fa-right-from-bracket"></i>Logout
                        </button>
                        </form>
                    </div>
                </div>
           @endif


</div>


    <div class="container-fluid p-0">
       

        <main>
            <div class="parent-box">
                <img src="../images/Sulongna.jpg" alt="Sulongna">
            </div>
        </main>

        <section>
            <div class="text-1">
                <div class="box">

                </div>
                <p>Today's</p>

            </div>

            <h3>What's New</h3>

            <div class="course-parent">
                <div class="child child-1">


                    <div class="child-header">
                        <i class="fa-solid fa-bread-slice"></i>



                        <div class="heart">

                            <i class="fa fa-heart"></i>


                            <i class="fa fa-eye"></i>
                        </div>
                    </div>

                    <p>Baking(cake,bread,pastries)</p>
                    <h5>Mon-Tue 10:00am</h5>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>

                </div>

                <div class="child child-2">

                    <div class="child-header">

                        <i class="fa-solid fa-truck"></i>

                        <div class="heart">

                            <i class="fa fa-heart"></i>


                            <i class="fa fa-eye"></i>
                        </div>

                    </div>

                    <p>Street food and snack</p>
                    <h5>Mon-Tue 10:00am</h5>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>

                </div>

                <div class="child child-3">

                    <div class="child-header">

                        <i class="fa-solid fa-shirt"></i>

                        <div class="heart">

                            <i class="fa fa-heart"></i>


                            <i class="fa fa-eye"></i>
                        </div>

                    </div>

                    <p>Basic sewing</p>
                    <h5>Wed-Thu 10:00am</h5>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>

                </div>

                <div class="child child-4">

                    <div class="child-header">

                        <i class="fa-solid fa-cake-candles"></i>

                        <div class="heart">

                            <i class="fa fa-heart"></i>


                            <i class="fa fa-eye"></i>
                        </div>

                    </div>

                    <p>Candle making</p>
                    <h5>Wed-Thu 10:00am</h5>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>

                </div>
            </div>


            <div class="view-parent">
                <div class="view-child">
                    <button class="btn_view_courses">View All Courses</button>
                </div>
            </div>
        </section>




    </div>



    <div class="container-1">

        <section class="section-3">
            <div class="text-2">
                <div class="box">

                </div>
                <p>AVAILABLE COURSE</p>

            </div>

            <h3>OTHER COURSES</h3>

            <div class="course-parent">
                <div class="child child-1">

                    <div class="child-header">

                    </div>
                </div>
                <div class="child child-2">

                    <div class="child-header">

                    </div>

                </div>

                <div class="child child-3">

                    <div class="child-header">


                    </div>

                </div>

                <div class="child child-4">

                    <div class="child-header">


                    </div>

                </div>
            </div>


    </div>

    <div class="container-2">

        <section class="section-4">
            <div class="text-1">
                <div class="box">

                </div>
                <p>Community</p>

            </div>

            <div class="commercial parent">
                <div class="photo-1">


                </div>
                <div class="commercial parent">
                    <div class="photo-2">

                        <div class="photo-child-1">

                        </div>

                        <div class="photo-child-2">


                        </div>


                    </div>



                </div>
            </div>
    </div>

    <div class="footer-container">
        <div class="logo-section">
            <img src="../images/logo_hill.png" alt="logo">
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
                <p>Quick Linkp>

                <p>Privacy Policy</p>

                <p>Team of Use</p>

                <p>FaQ</p>

                <p>Contact</p>
            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        function toggleDropdown(event){
            event.stopPropagation();
            document.getElementById("logout-dropdown").classList.toggle("show");
        }
        window.onclick = function(event){
            if (!event.target.closest('.user-welcome')) {
                const dropdown = document.getElementById("logout-dropdown");
                if (dropdown) dropdown.classList.remove("show");
            }
        }
    </script>

</body>

</html>