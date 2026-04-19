<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="{{ asset('stylesheet/sign_up.css') }}">

    <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap_folder/css/bootstrap.min.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="../font-awesome-icon/css/all.min.css">
</head>

<body>

    <div class="container-fluid p-0">

        <form action="{{ route("SignUp") }}" method="post">

            @csrf

            <div class="login-parent">
                <div class="form-extension image-container">
                    <img src="{{ asset('images/4.jpg') }}" alt="welder">
                </div>
                <div class="form-extension form">

                    <div class="form-logo">
                        <div class="parent-logo">
                       <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img"> 
                        </div>
                        <h2>Livelihood Program</h2>
                        <h2>Start your learning journey today.</h2>
                        <p>Create an account and start learning today.</p>
                    </div>

                    <div class="row">

                        <div class="col-lg-4 mt-3">
                            <div class="text-box">
                                <label>Firstname: </label>
                               
                                <input type="text" class="form-control" placeholder=" Juan" name="firstname" id="" required>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-3">
                            <div class="text-box">
                                <label>Lastname: </label>
                                <input type="text" class="form-control" placeholder=" Dela Cruz" name="lastname" id="" required>
                                
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="text-box">
                                <label>Email: </label>
                                <input type="email" class="form-control" placeholder=" juandelacruz@gmail.com" name="email" id="" required>
                                
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="text-box">
                                <label>Username: </label>
                                <input type="text" class="form-control" placeholder=" juan_dc12" name="username" id="" required>
                               
                            </div>
                        </div>
                         

                        <div class="col-lg-12 mt-3">
                            <div class="text-box">
                                <label>Password: </label>
                                <input type="password" class="form-control" placeholder=" new password" name="password"
                                        id="" required>
                                
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="text-box">
                                <label>Confirm Password: </label>
                                <input type="password" class="form-control" placeholder=" Re-enter password" name="password_confirmation"
                                        id="" required>
                               
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="text-box">
                                <label>Role: </label>
                                <select class="form-control" name="role" id="" required>
                                <option value="" disabled selectd>-- Select Role --</option>
                                <option value="student">student</option>
                                <option value="trainer">trainer</option>
                                </select>
                            </div>
                        </div>
                     </div>

                    <div class="button">
                        <button type="submit">Signup</button>
                    </div>

                    <h4>Or Login with</h4>

                    <div class="change">
                        <label>Already have an account? <a href="{{ asset('login') }}">Login</a></label>
                    </div>

                </div>

            </div>
        </form>
    </div>

    <!-- bootstrap link javascript -->
    <script defer src="../bootstrap_folder/js/bootstrap.bundle.min.js"></script>
</body>

</html>