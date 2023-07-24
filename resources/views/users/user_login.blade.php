<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/userWelcome.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>User Login</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <div class="show_body__section__user-login">
            <div class="col-lg-12 col-md-12 col-sm-12 wget-bg-user-login">

                <div class="col-lg-6 col-md-6 col-sm-12 session-wget-user user-wget-login active" id="sign-in-user">
                    <h2 class="title-wget-form-sess">Sign in</h2>
                    <h6 class="sub-title">( Log in and enjoy our services !!! Thank you )</h6>
                    <div class="flex-box-wget-login wget-box-session-user">
                        <form class="form-login-horizontal-user form-user-wget" method="POST" id="form-login-action"
                            action="{{ route('users.user_process_login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="form-control-label">
                                    Username \ Email:
                                </label>
                                <input type="text" name="name" id="input-name-login"
                                    class="form-control  input-form-insert" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">
                                    Password:
                                </label>
                                <input type="password" name="password" id="input-pass-login"
                                    class="form-control  input-form-insert" required>
                            </div>
                            <button type="submit" onclick="return myValidateSignIn()"
                                class="btn btn-action-pri btn-login-user-wget">Sign in</button>
                        </form>
                        @if (session()->has('msg'))
                            <div class="alert-error">
                                {{ session()->get('msg') }}
                            </div>
                        @endif
                        @if (session()->has('msgs'))
                            <div class="alert-success alert">
                                {{ session()->get('msgs') }}
                            </div>
                        @endif
                        <div class="box-form-link-wget">
                            <div class="link-register">
                                Don't have account ?
                                <a href="{{ route('users.user_register') }}" id="registerUser"> Register</a>
                            </div>
                            <div class="link-forgot-pass">
                                <a href="{{ route('users.user_reset_password') }}" id="forgotPassword">Forgot password ?</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/userWelcome.js') }}"></script>
</body>

</html>
