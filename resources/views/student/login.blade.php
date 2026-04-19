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
                    <form action="{{ route('LoginUser') }}" method="post">

                      @csrf

                      <div class="login-logo">
                         <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
                     </div>

                        <span>WELCOME BACK</span>

                        <h2><b>Sign</b> in to your <b>account</b></h2>

                        <div class="mt-4">
                            <label>Email address</label>
                            <input type="text" name="email" class="form-control mt-1" placeholder="Enter email address" required>
                        </div>

                        <div class="mt-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control mt-1" placeholder="Enter password" required>
                        </div>

                        <div class="mt-4 text-end forgot">
                            <a href="{{  route('ForgotPassword') }}">Forgot Password</a>
                        </div>

                        <div class="mt-4 login-btn">
                            <button class="btn w-100" type="submit">Login</button>
                        </div>

                        <div class="mt-4 signup text-center">
                            <label>Don't have an account? <a href="{{ route("SignupPage") }}">Signup</a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap link javascript -->
    <script defer src="../bootstrap_folder/js/bootstrap.bundle.min.js"></script>
</body>

</html>