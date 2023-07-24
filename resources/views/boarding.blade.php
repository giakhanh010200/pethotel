<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/shopBoarding.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">​
    <title>Boarding</title>
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-boarding-info">
        <h1 class="title-section-showww">Boarding</h1>
        <div class="boarding-container section-show-view-boarding">
            @foreach ($array_boarding as $arrbd)
                <div class="box-container-section-boarding">
                    <div class="col-lg-6 col-md-6 col-sm-12 column-image-slide">
                        @if ($arrbd->name == 'Deluxe Boarding')
                            <div class="image-deluxe-boarding-heading">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="my-deluxe-slide">
                                        <img src="{{ URL::asset('image/deluxe-boarding-') }}{{ $i + 1 }}.jpeg"
                                            class="deluxe__slide__image img-preview__slide-big">
                                    </div>
                                @endfor
                                <a class="prev-slide-image prev-deluxe button-deluxe" onclick="plusSlidesDeluxe(-1)"><i
                                        class="fas fa-angle-double-left"></i></a>
                                <a class="next-slide-image next-deluxe button-deluxe" onclick="plusSlidesDeluxe(1)"><i
                                        class="fas fa-angle-double-right"></i></a>
                            </div>
                            <div class="row-image-click">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="col-image-slide">
                                        <img src="{{ URL::asset('image/deluxe-boarding-') }}{{ $i + 1 }}.jpeg"
                                            onclick="currentSlideDeluxe({{ $i + 1 }})"
                                            class="img-description__slide_deluxe __slide__image">
                                    </div>
                                @endfor
                            </div>
                        @endif
                        @if ($arrbd->name == 'Standard Boarding')
                            <div class="image-standard-boarding-heading">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="my-standard-slide">
                                        <img src="{{ URL::asset('image/regular-boarding-') }}{{ $i + 1 }}.jpeg"
                                            class="standard__slide__image img-preview__slide-big">
                                    </div>
                                @endfor
                                <a class="prev-slide-image prev-standard button-standard"
                                    onclick="plusSlidesStandard(-1)"><i class="fas fa-angle-double-left"></i></a>
                                <a class="next-slide-image next-standard button-standard"
                                    onclick="plusSlidesStandard(1)"><i class="fas fa-angle-double-right"></i></a>
                            </div>
                            <div class="row-image-click">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="col-image-slide">
                                        <img src="{{ URL::asset('image/regular-boarding-') }}{{ $i + 1 }}.jpeg"
                                            onclick="currentSlideStandard({{ $i + 1 }})"
                                            class="img-description__slide_standard __slide__image">
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 column-description-slide">
                        <div class="title-heading-name">
                            <h2>{{ $arrbd->name }}</h2>
                        </div>
                        <div class="detail-description">
                            {!! $arrbd->details !!}
                        </div>
                        <div class="price-show">
                            Price: <span>{{ number_format($arrbd->price, 0, '.', '.') }} VND</span>/per night
                        </div>
                        <div class="block-widget-btn">
                            <a class="btn btn-booking-boarding" href="{{ asset('singleBoarding/'. $arrbd->name) }}">Book</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('footer-page')
    <script type="text/javascript" src="{{ URL::asset('js/boarding.js') }}">

    </script>
    </div>
    </div>
</body>

</html>
