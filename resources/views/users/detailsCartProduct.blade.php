<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cartPrdDetail.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Cart Information</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <h1 class="title-section-showww">Cart Information</h1>
        <div class="block-session-show-data data-cart">
            <div class="data-title-first">
                <h3 class="cart-title">Cart order {{ $array_cart[0]->cart_id_render }}</h3>
            </div>
            <div class="table-product-list">
                <div class="col-lg-12 col-md-12 col-sm-12 data-view-list">
                    <div class="block-title-col block-data">
                        <div class="col-lg-3 col-md-3 list-title thumbail-title">Thumbnail</div>
                        <div class="col-lg-4 col-md-4 list-title product-title">Product</div>
                        <div class="col-lg-1 col-md-1 list-title quantity-title">Quantity</div>
                        <div class="col-lg-2 col-md-2 list-title price-title">Price</div>
                        <div class="col-lg-2 col-md-2 list-title totalprice-title">Total price</div>
                    </div>

                    @foreach ($array_cart as $arrc)
                        <div class="block-data-col block-data">
                            <div class="col-lg-3 col-md-3 list-content thumbail-content">
                                <img src="{{ URL::asset('image/product') }}/{{ $arrc->product_thumbnail }}">
                            </div>
                            <div class="col-lg-4 col-md-4 list-content product-content">{{ $arrc->product_name }}</div>
                            <div class="col-lg-1 col-md-1 list-content quantity-content">{{ $arrc->quantity }}</div>
                            <div class="col-lg-2 col-md-2 list-content price-content">
                                {{ number_format($arrc->product_price, 0, '.', '.') }} VND</div>
                            <div class="col-lg-2 col-md-2 list-content totalprice-content">
                                {{ number_format($arrc->total_prices, 0, '.', '.') }} VND</div>
                        </div>
                    @endforeach
                    <div class="block-totalprice">
                        <div class="col-lg-10 col-md-10 list-title">Total price</div>
                        <div class="col-lg-2 col-md-2 list-content_full">{{ number_format($full_price, 0, '.', '.') }}
                            VND</div>
                    </div>
                </div>
            </div>
            <div class="block-widget-view-user">
                <h4 class="title-list">User Information</h4>
                <div class="sesstion-table-view">
                    <div class="col-title-widget-top col-wg">
                        <div class="title-wget name-title">Name:</div>
                        <div class="title-wget phone-title">Phone:</div>
                        <div class="title-wget address-title">Address:</div>
                    </div>
                    <div class="col-title-widget col-wg">
                        <div class="content-wget name-content">{{ $array_cart[0]->user_name }}</div>
                        <div class="content-wget phone-content">{{ $array_cart[0]->user_phone }}</div>
                        <div class="content-wget address-content">{{ $array_cart[0]->user_address }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
</body>

</html>
