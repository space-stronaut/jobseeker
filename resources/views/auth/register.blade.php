<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                <a href="index.html"><img src="{{ asset('mazer/assets/images/logo/logo.svg') }}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="new-password">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                        </div>
                      </div>
                    {{-- <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" >
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div> --}}
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    {{-- <input type="password" class="form-control " placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div> --}}
                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="toggleConfirmation">Show</button>
                        </div>
                      </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control " required></textarea>
                    {{-- <input type="a" class="form-control " placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"> --}}
                    {{-- <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div> --}}
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <label for="">Jenis Kelamin</label>
                    {{-- <textarea name="alamat" id="" cols="30" rows="10" class="form-control " required></textarea> --}}
                    <input type="radio" name="jenis_kelamin" value="L" id="">L
                    <input type="radio" name="jenis_kelamin" value="P" id="">P
                    {{-- <input type="a" class="form-control " placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"> --}}
                    {{-- <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div> --}}
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}" class="font-bold">Log
                        in</a>.</p>
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

      var toggleConfirmation = document.getElementById('toggleConfirmation');
      var password_confirmation = document.getElementById('password_confirmation');

      toggleConfirmation.addEventListener('click', function() {
        if (password_confirmation.type === 'password') {
          password_confirmation.type = 'text';
          toggleConfirmation.textContent = 'Hide';
        } else {
          password_confirmation.type = 'password';
          toggleConfirmation.textContent = 'Show';
        }
      });
    });

    
</script>
</html>
