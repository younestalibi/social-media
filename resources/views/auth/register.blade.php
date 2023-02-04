<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="register_form/fonts/icomoon/style.css">

    <link rel="stylesheet" href="register_form/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="register_form/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="register_form/css/style.css">

    <title>{{ __('Sign Up') }}</title>
  </head>
  <body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="register_form/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign Up</h3>
              <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group first">
                <!-- <label for="name">Name</label>
                <input type="text" class="form-control" id="name"> -->
                <label for="user_name">{{__('User name')}}</label>
                <div>
                    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                    @error('user_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              </div>
              <div class="form-group first">
                <!-- <label for="name">Name</label>
                <input type="text" class="form-control" id="name"> -->
                <label for="name">{{ __('Full name') }}</label>
                <div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label>
                <input type="email" class="form-control" id="email"> -->
                <label for="email">{{ __('Email Address') }}</label>
                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              </div>
              <div class="form-group">
                <!-- <label for="password">Password</label>
                <input type="password" class="form-control" id="password"> -->
                <label for="password">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
              </div>
              <div class="form-group last mb-4">
                <!-- <label for="re-password">Re-type Password</label>
                <input type="password" class="form-control" id="re-password"> -->
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Creating an account means you're okay with our <a href="#">Terms and Conditions</a> and our <a href="#">Privacy Policy</a>.</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
              </div>

              <!-- <input type="submit" value="Register" class="btn text-white btn-block btn-primary"> -->
              <div>
                  <button type="submit" class="btn text-white btn-block btn-primary">
                      {{ __('Register') }}
                  </button>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="register_form/js/jquery-3.3.1.min.js"></script>
    <script src="register_form/js/popper.min.js"></script>
    <script src="register_form/js/bootstrap.min.js"></script>
    <script src="register_form/js/main.js"></script>
  </body>
</html>