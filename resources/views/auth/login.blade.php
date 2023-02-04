<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="login_form/fonts/icomoon/style.css">

    <link rel="stylesheet" href="login_form/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login_form/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="login_form/css/style.css">

    <title>{{ __('Login') }}</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="login_form/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In to <strong>social-media</strong></h3>
              <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group first">

                <!-- <label for="username">Username</label>
                <input type="text" class="form-control" id="username"> -->
                <label for="email" >{{ __('Email Address') }}</label>
                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              </div>
              <div class="form-group last mb-4">

                <!-- <label for="password">Password</label>
                <input type="password" class="form-control" id="password"> -->
                
                <label for="password">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              
              <div class="d-flex mb-5 align-items-center">

                <label class="control control--checkbox mb-0" for="remember"><span class="caption">{{ __('Remember Me') }}</span>
                  <input type="checkbox" name="remember" checked="checked" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <div class="control__indicator"></div>
                </label>


                <!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  -->

                @if (Route::has('password.request'))
                <span class="ml-auto">
                    <a class="forgot-pass" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                  </span>
                @endif
              </div>

              <!-- <input type="submit" value="Log In" class="btn text-white btn-block btn-primary"> -->
              <button type="submit" class="btn text-white btn-block btn-primary">
                  {{ __('Log In') }}
              </button>

               
              @if (Route::has('register'))
                <span class="d-block text-left my-4 text-muted">{{__('Don\'t have an account?')}}
                <a class="text-info" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                </span>
              @endif
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="login_form/js/jquery-3.3.1.min.js"></script>
    <script src="login_form/js/popper.min.js"></script>
    <script src="login_form/js/bootstrap.min.js"></script>
    <script src="login_form/js/main.js"></script>
  </body>
</html>