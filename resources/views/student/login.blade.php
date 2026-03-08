<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/login.css') }}">

    <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
</head>

<body>

    <div class="container-fluid p-0">

        <div class="parent-login">
            <div class="login-image">

            </div>

            <div class="login-form">
                <div class="forms">
                    <form action="" method="post">
                        <span>WELCOME BACK</span>

                        <h2><b>Sign</b> in to your <b>account</b></h2>

                        <div class="mt-4">
                            <label>Email address</label>
                            <input type="text" name="email" class="form-control mt-1" placeholder="Enter email address">
                        </div>

                        <div class="mt-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control mt-1"
                                placeholder="Enter password">
                        </div>

                        <div class="mt-4 text-end forgot">
                            <a href="#">Forgot Password</a>
                        </div>

                        <div class="mt-4 login-btn">
                            <button class="btn w-100">Login</button>
                        </div>

                        <div class="mt-4 signup text-center">
                            <label>Don't have an account? <a href="{{ route("SignupPage") }}">Signup</a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- <form action="?url=login" method="post">

            <div class="login-parent">
                <div class="form-extension image-container">
                    <img src="../../images/bead.jpg" alt="bread">
                </div>
                <div class="form-extension form">

                    <div class="form-logo">
                        <div class="parent-logo">
                            <div class="logo"></div>
                            <h2>Livelihood Program</h2>
                        </div>
                        <h2 class="fw-semibold">Let's the learning journey begin.</h2>
                        <p>Unlock a world of learning with just one click. Log in to get started.</p>
                    </div>

                    <div class="text-box">
                        <label>Username: </label>
                        <input type="text" class="form-control" placeholder="Enter username or email" name="email" id=""
                            required>
                    </div>

                    <div class="text-box">
                        <label>Password: </label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password" id=""
                            required>
                    </div>

                    <div class="forgot text-end">
                        <a href="#">Forgot Password</a>
                    </div>

                    <div class="button">
                        <button class="submit">Login</button>
                    </div>

                    <h4>Or Login with</h4>

                    <div class="accounts">
                        <a href="#">
                            <i class="fa-brands fa-google"></i>
                            <p class="m-0">Google</p>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-facebook"></i>
                            <p class="m-0">Facebook</p>
                        </a>
                    </div>

                    <div class="change">
                        <label>Don't have an account? <a href="/sign_up">Signup</a>
                        </label>
                    </div>

                </div>

            </div>
        </form> -->
    </div>

    <!-- bootstrap link javascript -->
    <script defer src="../bootstrap_folder/js/bootstrap.bundle.min.js"></script>
</body>

</html>