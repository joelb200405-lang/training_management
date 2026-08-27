<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - LEDIPO</title>
  <link rel="stylesheet" href="{{ asset('stylesheet/sign_up.css') }}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Tab Icon -->
 <link rel="icon" type="image/png" href="{{ asset('images/logo_ledipo.png') }}">
</head>

<body>

  <div class="signup-card">
    <div class="card-logo">
      <img src="{{ asset('images/logo.png') }}" alt="LEDIPO Logo">
      <h2>Create an Account</h2>
      <p>Start your learning journey with LEDIPO today.</p>
    </div>

    <div class="divider"></div>

    @if ($errors->any())
      <div class="error-box">
        @foreach ($errors->all() as $error)
          <div><i class="fa-solid fa-triangle-exclamation"></i>
            {{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('SignUp') }}" method="POST">
      @csrf
      <input type="hidden" name="role" value="student">

      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <div class="input-wrap">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="firstname" placeholder="Juan" required
              value="{{ old('firstname') }}">
          </div>
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <div class="input-wrap">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="lastname" placeholder="Dela Cruz"
              required value="{{ old('lastname') }}">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <div class="input-wrap">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email"
            placeholder="juandelacruz@gmail.com" required
            value="{{ old('email') }}">
        </div>
      </div>

      <div class="form-group">
        <label>Username</label>
        <div class="input-wrap">
          <i class="fa-solid fa-at"></i>
          <input type="text" name="username" placeholder="juan_dc12" required
            value="{{ old('username') }}">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Password</label>
          <div class="input-wrap">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="New password"
              required>
          </div>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <div class="input-wrap">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password_confirmation"
              placeholder="Re-enter password" required>
          </div>
        </div>
      </div>

      <button type="submit" class="btn-submit">
        <i class="fa-solid fa-user-plus"></i> Create Account
      </button>
    </form>

    <div class="login-link">
      Already have an account? <a href="{{ route('Login') }}">Login here</a>
    </div>
  </div>

</body>

</html>
