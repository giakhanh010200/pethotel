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
    <title>User Reset Password</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <div class="show_body__section__user-login">
            <div class="col-lg-12 col-md-12 col-sm-12 wget-bg-user-login">

                <div class="col-lg-6 col-md-6 col-sm-12 session-wget-user user-wget-reset-password"
                    id="reset-password-user">
                    <h2 class="title-wget-form-sess">Reset password</h2>
                    {{ csrf_field() }}
                    <form class="form-register-horizontal-user form-user-wget"
                        action="{{ route('users.forgot_password_reset') }}" method="post" id="form-reset-sendmail">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-control-label">
                                Email:
                            </label>
                            <input type="text" name="email" id="input-email-reset"
                                class="form-control  input-form-insert" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="alert-error" id="err-email-reset">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-action-pri btn-login-user-wget">Recover account</button>
                    </form>
                    <div class="box-form-link-wget">
                        <div class="link-login">
                            <a href="{{ route('users.user_login') }}" id="returnSignIn">
                                <<< Return <<<</a>
                        </div>
                    </div>
                    @if (Session::has('msg'))
                        <span class="alert-success alert">
                            {{ Session::get('msg') }}
                        </span>
                    @endif
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
