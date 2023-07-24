<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cartBoardDetail.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Boarding Information</title>
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-product-info">
        <h1 class="title-section-showww">Boarding Information</h1>

        <div class="widget-section-view-details">
            <h3 class="boarding-title">Boarding order {{ $array_boarding[0]->cart_id }}</h3>
            <div class="block-section-boarding">
                <h4 class="title-block">Accommodation order</h4>
                <div class="each-block block-content">
                    <div class="title-block col-3">Accommodation type:</div>
                    <div class="content-block">{{ $array_boarding[0]->boarding_name }}</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Check-in:</div>
                    <div class="content-block">{{ $array_boarding[0]->start_date }}</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Check-out:</div>
                    <div class="content-block">{{ $array_boarding[0]->end_date }}</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Accommodation for pet:</div>
                    <div class="content-block">{{ $array_boarding[0]->pet_name }}</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Numbers of pet:</div>
                    <div class="content-block">{{ $array_boarding[0]->total_pet }}</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Status:</div>
                    <div class="content-block">
                        @if ($array_boarding[0]->status == 1)
                            Confirmed
                        @endif
                        @if ($array_boarding[0]->status == 2)
                            Processing
                        @endif
                        @if ($array_boarding[0]->status == 3)
                            Cancled
                        @endif
                    </div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Boarding price:</div>
                    <div class="content-block">{{ number_format($array_boarding[0]->boarding_price, 0, '.', '.') }} VND</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Accommodation total price:</div>
                    <div class="content-block">{{ number_format($array_boarding[0]->total_price, 0, '.', '.') }} VND</div>
                </div>
                <div class="each-block block-content">
                    <div class="title-block col-3">Accommodation at:</div>
                    <div class="content-block">{{ $array_boarding[0]->store_add }}</div>
                </div>
                <div class="view-map-place">
                    {!! $store[0]->map_place !!}
                </div>
            </div>
            <div class="block-section-user">
                <h4 class="title-block">Customer details</h4>
                <div class="data-user">
                    <div class="each-block block-content each-block-user">
                        <div class="title-block col-1">Name:</div>
                        <div class="content-block">{{ $array_boarding[0]->user_name }}</div>
                    </div>
                    <div class="each-block block-content each-block-user">
                        <div class="title-block col-1">Phone:</div>
                        <div class="content-block">{{ $array_boarding[0]->user_phone }}</div>
                    </div>
                    <div class="each-block block-content each-block-user">
                        <div class="title-block col-1">Email:</div>
                        <div class="content-block">{{ $array_boarding[0]->user_email }}</div>
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
