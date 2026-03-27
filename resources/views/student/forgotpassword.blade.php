<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/login.css') }}">
    
    <!-- bootstrap link -->
     <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">

    <!-- bootstrap link -->
     <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">

</head>
<body>

    <div class="container-fluid p-0">

      <div class="parent-login">
            <div class="login-image">
            </div>
            <div class="login-form">
                <div class="forms">
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(session('error'))
                     {{ session('error') }}
                </div>
                @endif 

                <form action="{{ route('SendResetLink') }}" method="post">

                @csrf

                <span> FORGOT PASSWORD</span>
                <h2><b>Reset</b> your <b>password</h2>

                <p class="text-muted mt-2"> Enter your email address and we'll send you a link to reset your passord.</p>

                <div class="mt-4">
                    <label> Email address </label>
                    <input type="email" name="email" class="form-control mt-1" placeholder="Enter your email address" required>
                </div>
                <div class="mt-4 login-btn">
                    <button class="btn w-100" type="submit"> Send Reset Link</button>
                </div>

                <div class="mt-4 signup text-center">
                    <label>Remember your password? <a href="{{ route('Login') }}"> Back to login </a></label>
                </div>

            </div>
        </div>
    </div>

    <!-- bootstrap link javascript -->
      <script defer src="../bootstrap_folder/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>