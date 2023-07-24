<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/userWelcome.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">​
    <title>User Register</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <div class="show_body__section__user-login">
            <div class="col-lg-12 col-md-12 col-sm-12 wget-bg-user-login">


                <div class="col-lg-6 col-md-6 col-sm-12 session-wget-user user-wget-register" id="register-user">
                    <h2 class="title-wget-form-sess">Welcome to</h2>
                    <h2 class="title-wget-form-sess">Moonlight Hotel</h2>
                    <div class="flex-box-wget-register wget-box-session-user">
                        <form class="form-register-horizontal-user form-user-wget" method="POST"
                            action="{{ route('users.user_process_register') }}" id="form-register-action">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="form-control-label">
                                    Username:
                                </label>
                                <input type="text" name="username" id="input-name-regis"
                                    class="form-control input-form-insert" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="alert-error" id="err-name-regis">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">
                                    Email:
                                </label>
                                <input type="text" name="email" id="input-email-regis"
                                    class="form-control input-form-insert" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="alert-error" id="err-email-regis">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">
                                    Password:
                                </label>
                                <input type="password" name="password" id="input-pass-regis"
                                    class="form-control input-form-insert">
                                @if ($errors->has('password'))
                                    <span class="alert-error" id="err-pass-regis">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">
                                    Confirm Password:
                                </label>
                                <input type="password" name="password_confirm" id="input-confirm-pass-regis"
                                    class="form-control input-form-insert">
                                @if ($errors->has('password_confirm'))
                                    <span class="alert-error" id="err-pass-regis">
                                        {{ $errors->first('password_confirm') }}
                                    </span>
                                @endif
                            </div>
                            <button type="submit" id="validateRegister"
                                class="btn btn-action-pri btn-login-user-wget">Sign up</button>
                        </form>
                        <div class="box-form-link-wget">
                            <div class="link-login">
                                Already haved account ?
                                <a href="{{ route('users.user_login') }}" type="button" id="signInUser">Sign in</a>
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
