<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dasmariñas Skill-Building System</title>
    <link rel="stylesheet" href="stylesheet/adminlogin.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Specific Styles for Login Page */
        
    </style>
</head>
<body class="login-body">

    <div class="login-card">
        <img src="images/logo.png" alt="Logo" class="login-logo">
        <h2>Admin Portal</h2>
        <p>Please enter your credentials to continue.</p>

        <form action="index.php" method="GET"> <div class="input-group">
                <label>Email Address</label>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="ledipoadmin@gmail.com" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="••••••••" required>
            </div>

            <div class="login-options">
                <label><input type="checkbox"> Remember me</label>
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-login">Login to Dashboard</button>
        </form>
    </div>

</body>
</html>