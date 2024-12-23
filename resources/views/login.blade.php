<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | Anywhere, Everywhere </title>
    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <!-- <script>
      (
        function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),
          event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),
            dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;
            j.src=
          'https://www.googletagmanager.com/gtm.js?id='+i+dl;
          f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5DDHKGP');</script> -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon2.svg') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" /> 
    <link rel="stylesheet" href="{{ asset('vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>
<body>
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
      <div class="w-100 d-flex justify-content-center">
        <!-- <img src="{{ asset('img/illustrations/boy-with-rocket-light.png') }}" class="img-fluid" alt="Login image" width="700" data-app-dark-img="{{ asset('illustrations/boy-with-rocket-dark.png') }}" data-app-light-img="{{ asset('illustrations/boy-with-rocket-light.png') }}"> -->
        <img src="{{ asset('img/undraw/login.svg') }}" class="img-fluid" alt="Login image" width="700" data-app-dark-img="{{ asset('undraw/login.svg') }}" data-app-light-img="{{ asset('undraw/login.svg') }}">
      </div>
    </div>
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-5 text-center">
          <a href="#" class="app-brand-link gap-2">
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2" align="center">Welcome to {{ config('app.name') }}</h4>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mb-3">
           @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <x-text-input id="username" placeholder="Enter Username" class="form-control" type="text" name="username" :value="old('username')" autofocus autocomplete="off" value="admin"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2" style="color:red"/>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Password</label>
            <x-text-input id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control" type="password" name="password" :value="old('password')" value="@Mohammed200535"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color:red"/>
          </div>
          <!-- <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>
          </div> -->
          <button class="btn btn-primary d-grid w-100" type="submit">
            Sign in
          </button>
        </form>

        <!-- <p class="text-center"> -->
          <!-- <span>New on our platform?</span> -->
         <!--  <a href="auth-register-cover.html">
            <span>Create an account</span>
          </a> -->
        <!-- </p> -->
        <div class="divider my-4">
          <!-- <div class="divider-text">or</div> -->
        </div>
        <div class="d-flex justify-content-center">
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('vendor/js/menu.js') }}"></script>
  <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('vendor/js/menu.js') }}"></script>
  <script src="{{ asset('vendor/libs/@form-validation/popular.js') }}"></script>
  <script src="{{ asset('vendor/libs/@form-validation/bootstrap5.js') }}"></script>
  <script src="{{ asset('vendor/libs/@form-validation/auto-focus.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/pages-auth.js') }}"></script>
</body>
</html>