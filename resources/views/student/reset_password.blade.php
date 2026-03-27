<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/login.css') }}">
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
</head>
<body>
    <div class="container-fluid p-0">
        <div class="parent-login">
            <div class="login-image"></div>
            <div class="login-form">
                <div class="forms">

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('ResetPassword') }}" method="post">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <span>RESET PASSWORD</span>
                        <h2><b>Create</b> new <b>password</b></h2>

                        <div class="mt-4">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control mt-1" 
                                   placeholder="Enter new password" required>
                        </div>

                        <div class="mt-4">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control mt-1" 
                                   placeholder="Re-enter new password" required>
                        </div>

                        <div class="mt-4 login-btn">
                            <button class="btn w-100" type="submit">Reset Password</button>
                        </div>

                        <div class="mt-4 signup text-center">
                            <label>Remember your password? <a href="{{ route('Login') }}">Back to Login</a></label>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script defer src="../bootstrap_folder/js/bootstrap.bundle.min.js"></script>
</body>
</html>