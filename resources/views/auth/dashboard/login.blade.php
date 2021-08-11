@extends('layouts.dashboard.auth')

@section('content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">@lang('site.sign_in_to_start_your_session')</p>

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="@lang('site.email')" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="@lang('site.password')" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                </div>


                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> @lang('site.remember_me')
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">@lang('site.login')</button>

            </form>

            <div style="margin-top: 10px">
                <a href="{{ route('password.request') }}">@lang('site.i_forgot_my_password')</a><br>
            </div>

        </div>

    </div>

    {{--<!-- jQuery 3 -->--}}
    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    {{--<!-- Bootstrap 3.3.7 -->--}}
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    {{--<!-- iCheck -->--}}
    <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
    </body>
@endsection
