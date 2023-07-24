<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-dashboard.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="dashboard-body">
        <h2 class="show-header-title">Dashboard</h2>
        <div class="box-dashboard-welcome">
            <h4>Welcome to admin dashboard !!!</h4>
            <p>Animals are reliable, many full of love, true in their affections, predictable in their actions, grateful
                and loyal. Difficult standards for people to live up to.
            </p>
        </div>
        <div class="revenue-box-session">
            <div class="revenue-wrapper-4-block">
                <div class="first-block wrapper-block ">
                    <p class="block-text-wrapper">
                        Total guests use boarding:
                    </p>
                    <p class="block-content">
                        {{ $total_use_boarding ?? '' }} guests
                    </p>
                </div>
                <div class="second-block wrapper-block">
                    <p class="block-text-wrapper">
                        Total guests use service:
                    </p>
                    <p class="block-content">
                        {{ $total_use_service ?? '' }} guests
                    </p>
                </div>
                <div class="third-block wrapper-block">
                    <p class="block-text-wrapper">
                        Total earning:
                    </p>
                    <p class="block-content">
                        {{ number_format($total_earn, 0, '', '.') }} VND
                    </p>
                </div>
                <div class="fourth-block wrapper-block">
                    <p class="block-text-wrapper">
                        Total expense:
                    </p>
                    <p class="block-content">
                        {{ number_format($expense_price, 0, '', '.') }} VND
                    </p>
                </div>
            </div>
        </div>
        <div class="statistical-box-wrapper col-lg-12">
            <div class="box-right-bottom bottom-wrapper-box col-lg-4">
                <div class="todos-box-top">
                    <h3 class="title-box">Daily work todos</h3>
                    <div class="content-box">
                        <p>- Check list products and orders</p>
                        <p>- Take care for 10 products best seller always more than 50, and other is more than 30</p>
                        <p>- Check all of carts</p>
                        <p>- Check all of carts</p>
                        <p> - Check statistical</p>
                    </div>
                </div>
            </div>
            <div class="box-left-bottom bottom-wrapper-box col-lg-8">
                <div class="box-top-blog-content">
                    This box is for 2 news blog
                </div>
                <div class="box-bottom-statistical">
                    <div class="statistical-box-title">
                        <h3>Carts Infomation</h3>
                    </div>
                    <div class="statistical-box-content">
                        <div class="statistical-cart-products box-content">
                            <h5 class="box-bottom-title">
                                product statistics
                            </h5>
                            <div class="content-cart-products">
                                <p class="success cart-status">
                                    <i class="fas fa-circle"></i>
                                    Sucess: {{ $cart_prd_success }} orders
                                </p>
                                <p class="pending cart-status">
                                    <i class="fas fa-circle"></i>
                                    Pending: {{ $cart_prd_pending }} orders
                                </p>
                                <p class="cancle cart-status">
                                    <i class="fas fa-circle"></i>
                                    Cancle: {{ $cart_prd_cancle }} orders
                                </p>
                            </div>
                        </div>
                        {{-- <div class="statistical-cart-services box-content">
                            <h5 class="box-bottom-title">
                                service statistics
                            </h5>
                            <div class="box-services-statistical">
                                <p class="success count-quantity">
                                    {{ $cart_serv_count }} carts
                                </p>
                            </div>
                        </div> --}}
                        <div class="statistical-boarding box-content">
                            <h5 class="box-bottom-title ">
                                boarding statistics
                            </h5>
                            <div class="content-boarding">
                                <p class="success cart-status">
                                    {{ $cart_board_success }} boarding :Done
                                    <i class="fas fa-circle"></i>
                                </p>
                                <p class="pending cart-status">
                                    {{ $cart_board_pending }} boarding :On Service
                                    <i class="fas fa-circle"></i>
                                </p>
                                <p class="cancle cart-status">
                                    {{ $cart_board_cancle }} boarding :Cancle
                                    <i class="fas fa-circle"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
