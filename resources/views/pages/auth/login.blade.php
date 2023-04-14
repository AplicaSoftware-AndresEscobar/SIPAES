<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('assets/gentelella/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/gentelella/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="form login_form">
                <section class="login_content">
                    <img src="{{ asset('assets/images/logo-fesc') }}" alt="" class="img-fluid">
                    <form action="{{ url('login') }}" method="POST">
                        @csrf

                        <p>@lang('title.login')</p>
                        <div>
                            <input type="text" name="email" class="form-control @error('email') parsley-error @enderror"
                                placeholder="{{ __('field.email') }}" />
                        </div>
                        @error('email')
                            <p class="text-danger text-left">
                                {{ $message }}
                            </p>
                        @enderror

                        <div>
                            <input type="password" name="password" class="form-control @error('password') parsley-error @enderror"
                                placeholder="{{ __('field.password') }}" />
                        </div>
                        @error('password')
                            <p class="text-danger text-left">
                                {{ $message }}
                            </p>
                        @enderror

                        <div>
                            <button class="btn btn-danger">@lang('button.login')</button>
                            <a class="reset_pass" href="#">@lang('button.forgot-password')</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-institution"></i> @lang('title.login-bottom')!</h1>
                                <p>@lang('title.login-footer')</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
