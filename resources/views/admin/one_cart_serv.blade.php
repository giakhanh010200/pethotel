<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cartServDetail.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Cart Service Information</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <h1 class="title-section-showww">Cart Service Information</h1>

        <div class="widget-section-view-details">
            <h3 class="cart-title">Boarding order {{ $array_cart[0]->cart_id }}</h3>
            <div class="table-product-list">
                <div class="col-lg-12 col-md-12 col-sm-12 data-view-list">
                    <div class="block-title-col block-data">
                        <div class="col-lg-4 col-md-4 list-title serv-title">Service used</div>
                        <div class="col-lg-2 col-md-2 list-title quantity-title">Number of pets</div>
                        <div class="col-lg-3 col-md-3 list-title price-title">Price</div>
                        <div class="col-lg-3 col-md-3 list-title totalprice-title">Total price</div>
                    </div>
                    @php
                        $all_prices = 0;
                    @endphp
                    @foreach ($array_cart as $arrc)
                        <div class="block-data-col block-data">
                            <div class="col-lg-4 col-md-4 list-content serv-content">
                                {{ $arrc->service_name }}
                            </div>
                            <div class="col-lg-2 col-md-2 list-content quantity-content">{{ $arrc->total_pet }}</div>
                            <div class="col-lg-3 col-md-3 list-content price-content">{{ number_format($arrc->service_price, 0, '.', '.') }} VND</div>
                            @php
                                $total_prices = $arrc->service_price * $arrc->total_pet;
                                $all_prices = $all_prices + $total_prices;
                            @endphp
                            <div class="col-lg-3 col-md-3 list-content totalprice-content">
                                {{ number_format($total_prices, 0, '.', '.') }} VND
                            </div>
                        </div>
                    @endforeach
                    <div class="block-totalprice">
                        <div class="col-lg-9 col-md-9 list-title">Total price: </div>
                        <div class="col-lg-3 col-md-3 list-content_full">{{ number_format($all_prices, 0, '.', '.') }}
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
                        <div class="title-wget address-title">Email:</div>
                    </div>
                    <div class="col-title-widget col-wg">
                        <div class="content-wget name-content">{{ $array_cart[0]->user_name }}</div>
                        <div class="content-wget phone-content">{{ $array_cart[0]->user_phone }}</div>
                        <div class="content-wget address-content">{{ $array_cart[0]->user_email }}</div>
                    </div>
                </div>

            </div>
        </div>
        @include('footer-page')
    </div>
    </div>
</body>
</body>

</html>
