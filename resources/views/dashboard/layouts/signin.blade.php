<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EmailCleaner.com | SignUp</title>
    <meta name="description" content="">
    <meta name="keywords" content="admin, dashboard, template, react, reactjs, html, jquery, clean">
    <meta name="author" content="nK">
    <link rel="icon" type="image/png" href="./assets/images/favicon-32x32.png">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400%7cOpen+Sans:300,400,600%7cPT+Serif:400i">
    <link rel="stylesheet" href="./assets/css/bootstrap-custom.css">
    <link rel="stylesheet" href="./assets/vendor/overlayscrollbars/css/OverlayScrollbars.css">
    <link rel="stylesheet" href="./assets/css/yaybar.css">
    <link rel="stylesheet" href="./assets/vendor/fancybox/dist/jquery.fancybox.css">
    <link rel="stylesheet" href="./assets/vendor/emojionearea/dist/emojionearea.css">
    <link rel="stylesheet" href="./assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="./assets/vendor/chartist/dist/chartist.css">
    <link rel="stylesheet" href="./assets/vendor/jqvmap/dist/jqvmap.css">
    <link rel="stylesheet" href="./assets/vendor/highlightjs/styles/default.css">
    <link rel="stylesheet" href="./assets/vendor/dropzone/dist/dropzone.css">
    <link rel="stylesheet" href="./assets/css/rootui.css">
    <link rel="stylesheet" href="./assets/css/rootui-night.css" media="(night)" class="rui-nightmode-link">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <!-- Style css -->
    <link rel="stylesheet" href="assets_landing/css/style.css">
  </head>
  <body>
    <div class="rui-page-preloader" role="status">
      <div class="rui-page-preloader-inner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="rui-main">
      <div class="rui-sign">
        <div class="row w-100">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <!-- <div class="form rui-sign-form"> -->
              <div class="row vertical-gap justify-content-center">
                <div class="col-12">
                  <h1 class="display-4 mb-10 text-center">Sign In</h1>
                </div>
                <x-guest-layout>
                         <x-jet-validation-errors class="mb-4" />

                          @if (session('status'))
                              <div class="mb-4 font-medium text-sm text-green-600">
                                  {{ session('status') }}
                              </div>
                          @endif

                          <form method="POST" action="{{ route('login') }}">
                              @csrf

                              <div>
                                  <x-jet-label for="email" value="{{ __('Email') }}" />
                                  <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                              </div>

                              <div class="mt-4">
                                  <x-jet-label for="password" value="{{ __('Password') }}" />
                                  <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                              </div>

                              <div class="block mt-4">
                                  <label for="remember_me" class="flex items-center">
                                      <x-jet-checkbox id="remember_me" name="remember" />
                                      <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                  </label>
                              </div>

                              <div class="flex items-center justify-end mt-4">
                                  @if (Route::has('password.request'))
                                      <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                          {{ __('Forgot your password?') }}
                                      </a>
                                  @endif

                                  <x-jet-button class="ml-4">
                                      {{ __('Log in') }}
                                  </x-jet-button>
                              </div>
                          </form>
                  </x-guest-layout>
                  <form method="POST" class="form rui-sign-form" action="{{ route('login') }}">
                              @csrf
                    <div class="col-12">
                      <input id="email" type="email" class="form-control" id="email" placeholder="Email" :value="old('email')" required autofocus>
                    </div>
                    <div class="col-12">
                      <input type="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password" >
                    </div>
                    <div class="col-sm-6">
                      <div class="custom-control custom-checkbox d-flex justify-content-start"><input id="remember_me" name="remember" type="checkbox" class="custom-control-input" ><label class="custom-control-label fs-13" for="rememberMe">Remember me</label></div>
                    </div>
                    <div class="col-sm-6">
                      <div class="d-flex justify-content-end"><a href="{{ route('password.request') }}" class="fs-13">Forget password?</a></div>
                    </div>
                    <div class="col-12"><a href="dashboard.html" class="btn btn-brand btn-block text-center">Sign in</a></div>
                  </form>
                  <div class="col-12 text-center text-grey-5 fs-13">Don't you have an account? <a href="register" class="text-2">Register</a></div>
              </div>
            <!-- </div> -->
          </div>
          <div class="col-lg-6">
            <div class="bg-image">
              <div style="background-image: url('./assets/images/front.png');"></div>
            </div>
            <div class="col-12 col-lg-6" >
              <!-- Content Inner -->
              <br/>
              <br/>
              <br/>
              <br/>
              <br/>
              <div class="content-inner text-center pt-sm-4 pt-lg-0 mt-sm-5 mt-lg-0" >
                  <!-- Section Heading -->
                  <div class="section-heading text-center mb-3">
                      <h1 class="text-white display-4 mb-10 text-center">Why EmailCleaner.com? not other.</h1>
                     <!--  <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                      <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p> -->
                  </div>
                  <!-- Content List -->
                  <ul class="content-list text-left">
                      <!-- Single Content List -->
                      <li class="single-content-list media py-2">
                          <div class="content-icon pr-4">
                              <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                          </div>
                          <div class=" text-white content-text media-body">
                              <span><b>Highest Accuracy</b><br>Accuracy of QuickEmailVerification is unmatched. Our real-time email verification has ensured 99% email deliverability in the past five years.</span>
                          </div>
                      </li>
                      <!-- Single Content List -->
                      <li class="single-content-list media py-2">
                          <div class="content-icon pr-4">
                              <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                          </div>
                          <div class="text-white content-text media-body">
                              <span><b>Enterprise Security</b><br>We use encrypted storage because protecting your data is our highest priority. We follow security best practices and comply with international regulations.</span>
                          </div>
                      </li>
                      <!-- Single Content List -->
                      <li class="single-content-list media py-2">
                          <div class="content-icon pr-4">
                              <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                          </div>
                          <div class="text-white content-text media-body">
                              <span><b>Lowwest Cost</b><br>Lets Compare to the other validation services an you will love our service with lower cost but you get best benefit</span>
                          </div>
                      </li>
                      <li class="single-content-list media py-2">
                          <div class="content-icon pr-4">
                              <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                          </div>
                          <div class="text-white content-text media-body">
                              <span><b>Free Testing</b><br>Every customer gets a free trial of 100 email verifications daily on our free-tier plan. Explore the best email verification service without any commitment.</span>
                          </div>
                      </li>
                  </ul>
                  <br/>
                  <br/>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="./assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/vendor/feather-icons/dist/feather.min.js"></script>
    <script src="./assets/vendor/fontawesome-free/js/all.js"></script>
    <script src="./assets/vendor/fontawesome-free/js/v4-shims.js"></script>
    <script src="./assets/js/rootui.js"></script>
    <script src="./assets/js/rootui-init.js"></script>
  </body>
</html>