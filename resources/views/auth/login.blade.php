<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="/"><img src="{{ asset('mazer/assets/images/logo/logo.svg') }}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input id="email" placeholder="Email" type="email" class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    {{-- <div class="input-group" id="show_hide_password">
                        <input class="form-control form-control-xl" type="password">
                        <div class="input-group-addon">
                          <a href="">Hide</a>
                        </div>
                      </div> --}}
                    {{-- <input type="password" class="form-control form-control-xl" placeholder="Password"> --}}
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                        </div>
                      </div>
                      {{-- <div class="form-control-icon">
                        <i class="bi bi-shield-lock" id="lock-pw"></i>
                    </div> --}}
                    {{-- <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock" id="lock-pw"></i>
                    </div> --}}
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign
                        up</a>.</p>
                {{-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var togglePassword = document.getElementById('togglePassword');
      var passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          togglePassword.textContent = 'Hide';
        } else {
          passwordInput.type = 'password';
          togglePassword.textContent = 'Show';
        }
      });
    });
</script>
</html>
