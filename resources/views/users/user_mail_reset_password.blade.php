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
    <title>Reset Password</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <div class="show_body__section__user-login">
            <div class="col-lg-12 col-md-12 col-sm-12 wget-bg-user-login">

                <div class="col-lg-6 col-md-6 col-sm-12 session-wget-user user-wget-register">
                    <h2 class="title-wget-form-sess">Reset password</h2>
                    <form class="form-register-horizontal-user form-user-wget" id="form-reset-password" method="post"
                        action="{{ route('users.user_submit_reset_password') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="form-control-label">
                                Email:
                            </label>
                            <input type="email" name="email" class="form-control input-form-insert">
                            @if ($errors->has('email'))
                                <span class="alert-error" id="err-email-res">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">
                                Password:
                            </label>
                            <input type="password" name="password" class="form-control input-form-insert">
                            @if ($errors->has('password'))
                                <span class="alert-error" id="err-pass-res">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">
                                Confirm Password:
                            </label>
                            <input type="password" name="password_confirm" class="form-control input-form-insert">
                            @if ($errors->has('password_confirm'))
                                <span class="alert-error" id="err-pass_confirm-regis">
                                    {{ $errors->first('password_confirm') }}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-action-pri btn-login-user-wget">Resset password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
</body>

</html>
