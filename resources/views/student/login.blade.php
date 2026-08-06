<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('stylesheet/login.css') }}">
  <link rel="stylesheet"
    href="{{ asset('bootstrap_folder/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('font-awesome-icon/css/all.min.css') }}">
</head>

<body>

  <div class="container-fluid p-0">
    <div class="parent-login">
      <div class="login-image"></div>

      <div class="login-form">
        <div class="forms">
          <form action="{{ route('LoginUser') }}" method="post">
            @csrf

            <div class="login-logo">
              <img src="{{ asset('images/logo.png') }}" alt="Logo"
                class="logo-img">
            </div>

            <span>WELCOME BACK</span>
            <h2><b>Sign</b> in to your <b>account</b></h2>

            {{-- Display Session Error --}}
            @if (session('error'))
              <div class="alert alert-danger mt-3 mb-0">
                {{ session('error') }}
              </div>
            @endif

            <div class="mt-4">
              <label for="email">Email address</label>
              <input type="email" id="email" name="email"
                value="{{ old('email') }}" class="form-control mt-1"
                placeholder="Enter email address" required>
              @error('email')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mt-4">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                class="form-control mt-1" placeholder="Enter password" required>
              @error('password')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
              <div class="form-check">
                <input type="checkbox" name="remember" id="remember"
                  class="form-check-input">
                <label class="form-check-label" for="remember">Remember
                  Me</label>
              </div>
              <div class="forgot">
                <a href="{{ route('ForgotPassword') }}">Forgot Password?</a>
              </div>
            </div>

            <div class="mt-4 login-btn">
              <button class="btn w-100" type="submit">Login</button>
            </div>

            <div class="mt-4 signup text-center">
              <label>Don't have an account? <a
                  href="{{ route('SignupPage') }}">Signup</a></label>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script defer src="{{ asset('bootstrap_folder/js/bootstrap.bundle.min.js') }}">
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="{{ asset('stylesheet/login.css') }}">
  <link rel="stylesheet"
    href="{{ asset('bootstrap_folder/css/bootstrap.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('font-awesome-icon/css/all.min.css') }}">
</head>

<body>

  <div class="container-fluid p-0">
    <div class="parent-login">

      <!-- Background / Graphic Section -->
      <div class="login-image"></div>

      <!-- Form Container -->
      <div class="login-form">
        <div class="forms">
          <form action="{{ route('LoginUser') }}" method="post">
            @csrf

            <!-- Logo -->
            <div class="login-logo">
              <img src="{{ asset('images/logo.png') }}" alt="Logo"
                class="logo-img">
            </div>

            <span>WELCOME BACK</span>
            <h2><b>Sign</b> in to your <b>account</b></h2>

            <!-- Global Success / Status Message (e.g. after password reset) -->
            @if (session('status'))
              <div class="alert alert-success mt-3 mb-0" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <!-- Global Error Message (e.g. wrong credentials or custom controller feedback) -->
            @if (session('error'))
              <div class="alert alert-danger mt-3 mb-0" role="alert">
                {{ session('error') }}
              </div>
            @endif

            <!-- Email Field -->
            <div class="mt-4">
              <label for="email">Email address</label>
              <input type="email" id="email" name="email"
                value="{{ old('email') }}"
                class="form-control mt-1 @error('email') is-invalid @enderror"
                placeholder="Enter email address" required>
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <!-- Password Field -->
            <div class="mt-4">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                class="form-control mt-1 @error('password') is-invalid @enderror"
                placeholder="Enter password" required>
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="mt-3 d-flex justify-content-between align-items-center">
              <div class="form-check">
                <input type="checkbox" name="remember" id="remember"
                  class="form-check-input">
                <label class="form-check-label" for="remember">Remember
                  Me</label>
              </div>
              <div class="forgot">
                <a href="{{ route('ForgotPassword') }}">Forgot Password?</a>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 login-btn">
              <button class="btn w-100" type="submit">Login</button>
            </div>

            <!-- Signup Redirect -->
            <div class="mt-4 signup text-center">
              <label>Don't have an account? <a
                  href="{{ route('SignupPage') }}">Signup</a></label>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- JavaScript Files -->
  <script defer src="{{ asset('bootstrap_folder/js/bootstrap.bundle.min.js') }}">
  </script>
</body>

</html>
