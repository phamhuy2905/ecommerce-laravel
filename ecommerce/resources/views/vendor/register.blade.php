<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register Vendor</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

      <!-- BEGIN: Theme CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/components.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/dark-layout.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/semi-dark-layout.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="{{ asset('img/login.png') }}" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Register</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Welcome back, please register to your account.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                @foreach ($errors->all() as $message )
                                                <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                                <form method="POST" action="{{ route('vendor.process_register') }}" id="form">
                                                    @csrf
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input class="form-control" id="name" placeholder="Full name"  name="name">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Full name</label>
                                                        <span class="text-danger" style="font-size: 12px; margin-top: 5px"></span>
                                                    </fieldset>

                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input class="form-control" id="email" placeholder="Email"  name="email">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                        <span class="text-danger" style="font-size: 12px; margin-top: 5px"></span>
                                                    </fieldset>

                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input class="form-control" id="shop_name" placeholder="Shop name"  name="shop_name">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Shop name</label>
                                                        <span class="text-danger" style="font-size: 12px; margin-top: 5px"></span>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" class="form-control" id="password" placeholder="Password" required name="password">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                        <span class="text-danger" style="font-size: 12px; margin-top: 5px"></span>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required name="confirm_password">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Confirm Password</label>
                                                        <span class="text-danger" style="font-size: 12px; margin-top: 5px"></span>
                                                    </fieldset>

                                                    {{-- // address  --}}

                                                        <div class="font-small-3">
                                                            Address
                                                        </div>
                                                        <div class="form-group" data-select2-id="186">
                                                            <select class="select2 js-example-programmatic form-control select2-hidden-accessible " id="programmatic-single" tabindex="-1" aria-hidden="true" data-select2-id="programmatic-single" name="address">
                                                                @foreach ($province as $each )
                                                                <option value="{{ $each->id }}" data-select2-id="">{{ $each->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    {{-- // end address  --}}

                                                    <div class="form-floating" style="margin-bottom: 20px">
                                                        <label for="floatingTextarea">Comments</label>
                                                        <textarea class="form-control" placeholder="Vendor info" id="floatingTextarea" name="vendor_info"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-left btn-inline">Register</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer">
                                            <div class="divider">
                                                <div class="divider-text">OR</div>
                                            </div>
                                            <div class="footer-btn d-inline">
                                                <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                                <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                                <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                                                <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>


    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
  
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('js/app-menu.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    <!-- END: Theme JS-->
    <script>
        Validation({
            form: "#form",
            rule: [
                ValidateEmail("#email",'Trường này phải là email!'),
                ValidateRequired("#shop_name",'Trường này bắt buộc nhập'),
                ValidateRequired("#name",'Trường này bắt buộc nhập'),
                ValidatePassword("#password",'Mật khẩu tối thiểu 8 kí tự'),
                ValidateConfirm("#confirm_password",'Mật khẩu xác thực không trùng khớp!','#password'),
            ]
        }, 'span')
    </script>
</html>