<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/admin-login.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
</head>

<body>
    <div class="box-login">
        <div class="group-admin-login">
            <div class="login-header">
                <img class="header-image" src="{{ URL::asset('image/logo.jpg') }}" class="logo-login">
                <h3 class="header-text">
                    Admin Site
                </h3>
            </div>
            <form method="POST" action="{{ route('admin/admin_process_login') }}" class="form-login-admin">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="login-label">
                        Name \ Email:
                    </label>
                    <input type="text" name="name" class="form-control login-input" id="name">
                </div>
                <div class="form-group">
                    <label for="password" class="login-label">
                        Password:
                    </label>
                    <input type="password" name="password" id="password" class="form-control login-input">
                </div>
                <button type="submit" class="btn btn-success">
                    Login
                </button>
            </form>
            @if (session()->has('msg'))
                <div class="alert-error">
                    {{ session()->get('msg') }}
                </div>
            @endif
            <div class="login-footer">
                <p class="content">
                    You are not admin?
                </p>
                <a href="{{ route('welcome') }}" class="back-home-content">
                    Back to page
                </a>
            </div>
        </div>
    </div>
</body>

</html>
