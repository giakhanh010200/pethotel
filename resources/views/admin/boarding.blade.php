<!DOCTYPE html>
<html lang="en">
<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boarding</title>
</head>
<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
    </div>
</div>
</body>
</html>
