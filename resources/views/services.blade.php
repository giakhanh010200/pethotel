<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/shopServices.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Services</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-shop">
        <div class="show_body__section__shop">
            <h1 class="title-section-showww">Pet Care With Love</h1>

            <div class="section-view-demo-services">
                <div class="col-lg-12 col-md-12 col-sm-12 wget-block-all-sers">
                    @foreach ($array_services as $array_sev)
                        <div class="navigation-bar-services non-active">
                            <!-- view when click thubnail icon -->
                            <div class="nav nav-menu-bar bar-change-tab-icon">
                                <button id="icon-services-{{ $array_sev->id }}" value="{{ $array_sev->id }}"
                                    class="icon-services-{{ $array_sev->id }} item-navbar-change">
                                    <img class="image-toggle-service"
                                        src="{{ URL::asset('image/service') }}/{{ $array_sev->image }}">
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($array_services as $arr_serv)
                        <div id="about-services-{{ $arr_serv->id }}"
                            class="about-services-{{ $arr_serv->id }} toggle-view-change-by-nav view-content-services non-active">
                            <div class="col-lg-12 col-md-12 col-sm-12 about-servs content-info">
                                <div class="info-image-wget col col-lg-6 col-md-6 col-sm-12">
                                    @if ($arr_serv->id == 1)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/trainingServices.jpeg') }}">
                                    @elseif ($arr_serv->id == 2)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/groomingServices.jpeg') }}">
                                    @elseif ($arr_serv->id == 3)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/transportServices.jpeg') }}">
                                    @elseif ($arr_serv->id == 4)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/dietServices.jpeg') }}">
                                    @elseif ($arr_serv->id == 5)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/vetServices.jpeg') }}">
                                    @elseif ($arr_serv->id == 6)
                                        <img class="image-descrip-info"
                                            src="{{ URL::asset('image/daycareServices.jpeg') }}">
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 info-content-wget">
                                    <div>
                                        <h1 class="wget-item-title">{{ $arr_serv->name }}</h1>
                                        <p class="wget-item-content">
                                            {{ $arr_serv->about }}
                                        </p>
                                    </div>
                                    <h4 class="wget-item-price">
                                        @if ($arr_serv->price == 0)
                                            Price: free
                                        @else
                                            Price: {{ number_format($arr_serv->price, 0, '.', '.') }} VND
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($array_services as $array_service)
                        <!-- view thubnail not click-->
                        <div class="col-lg-4 col-md-6 col-sm-12 wget-each-service-show">
                            <button value="{{ $array_service->id }}"
                                class="block-columns-{{ $array_service->id }} block-each-service">
                                <div class="image-block-container wget-service-image-{{ $array_service->id }}">
                                    <img class="image-thumb-service"
                                        src="{{ URL::asset('image/service') }}/{{ $array_service->image }}">
                                </div>
                                <div class="title-block-container wget-service-title">
                                    {{ $array_service->name }}
                                </div>
                            </button>
                        </div>
                    @endforeach

                </div>
            </div>




            <div class="wget-block-section-clients">

                <div class="first-section-client wget-client">
                    <div class="block-column-group-wget col-lg-12 col-md-12 col-sm-12 ">
                        <div class="col-lg-6 col-md-6 col-sm-12 widget-col-main-content">
                            <h2 class="widget-col-title">Our Clients</h2>
                            <h4 class="widget-col-sub-title">Owner Testimonials</h4>
                            <p class="widget-col-content">To anyone who is nervous or unsure about leaving their beloved
                                pet, I would recommend Petotel. The staff are fantastic – so helpful and completely put
                                your mind at ease. Thank you so much!</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 widget-col-main-image">
                            <img class="widget-img-block widget-col-image"
                                src="{{ URL::asset('image/service/clients/main-clients.png') }}">
                        </div>
                    </div>
                </div>

                <div class="third-section-client wget-client">
                    <div class="block-column-group-wget col-lg-12 col-md-12 col-sm-12">
                        <h3 class="title-group-wid title-block-facilities">
                            Spacious modern facilities
                        </h3>
                        <div class="col-block-widget-image facilities-img">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="img-block-inner-group col-lg-4 col-md-4 col-sm-12">
                                    <img
                                        src="{{ URL::asset('image/service/clients/clients_facility_') }}{{ $i + 1 }}.jpeg">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="fourth-section-client wget-client">
                    <div class="block-column-group-wget col-lg-12 col-md-12 col-sm-12">
                        <h3 class="title-group-wid title-block-food">
                            Nutritional rations
                        </h3>
                        <div class="col-block-widget-image foods-img">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="img-block-inner-group col-lg-3 col-md-3 col-sm-12">
                                    <img
                                        src="{{ URL::asset('image/service/clients/clients_food_') }}{{ $i + 1 }}.jpeg">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="fifth-section-client wget-client">
                    <div class="block-column-group-wget col-lg-12 col-md-12 col-sm-12">
                        <h3 class="title-group-wid title-block-play">
                            Play time
                        </h3>
                        <div class="col-block-widget-image plays-img">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="img-block-inner-group col-lg-4 col-md-4 col-sm-12">
                                    <img
                                        src="{{ URL::asset('image/service/clients/clients_play_') }}{{ $i + 1 }}.jpeg">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/shopServices.js') }}"></script>
</body>

</html>
