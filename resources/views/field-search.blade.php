<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/field-search.css') }}">​
    <title>Moonlight Search</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-search-info">

        <h1 class="title-section-showww">Search result for: {{ $search }} </h1>

        <div class="session-block-wget-data">
            {{-- product part --}}
            @foreach ($array_products as $arrp)
                <div class="block-each-wget-prd block-each-wget">
                    <div class="session-each-prd session-each">
                        <div class="col-lg-12 col-sm-12 col-md-12 block-prd-show block-show">
                            <div class="col-lg-6 col-md-6 col-sm-12 block-thumbnail-prd thumb-block">
                                <img class="img-prd-thumb"
                                    src="{{ URL::asset('image/product') }}/{{ $arrp->thumbnail }}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 block-infor-prd block-info">
                                <h3 class="prd-title prd-content">{{ $arrp->name }}</h3>
                                <div class="prd-serial prd-content">Serial: {{ $arrp->serial }}</div>
                                <div class="prd-manufacturer prd-content">Manufacturer: {{ $arrp->manufacturer }}</div>
                                <div class="prd-category prd-content">
                                    @foreach ($array_cate as $arrcate)
                                        @if ($arrcate->id == $arrp->category_id)
                                            Category: {{ $arrcate->name }}
                                        @break
                                    @endif
                                @endforeach
                            </div>
                            <div class="prd-pet prd-content">
                                @foreach ($array_pet as $arrpet)
                                    @if ($arrpet->id == $arrp->category_id)
                                        Pet: {{ $arrpet->name }}
                                    @break
                                @endif
                            @endforeach
                        </div>
                        {{-- <div class="prd-description prd-content">
                            {!! Str::limit($arrp->description, 250, '...') !!}
                        </div> --}}
                        <div class="prd-price prd-content">
                            {{ number_format($arrp->sale_price, 0, '.', '.') }} VND/per
                        </div>
                        <div class="prd-sku prd-content">
                            <button type="button" id="btn__decrease-quantity{{ $arrp->id }}"
                                class="btn-caret-quantity btn-caret_btn__decrease-quantity">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type=text value="1"
                                oninput="this.value= ['','-'].includes(this.value) ? this.value : this.value|0"
                                id="quantity-input_prdQV_{{ $arrp->id }}">
                            <button type="button" id="btn__increase-quantity{{ $arrp->id }}"
                                class="btn-caret-quantity btn-caret_btn__increase-quantity">
                                <i class="fas fa-plus"></i>
                            </button>
                            <span class="product-quantity-prv">({{ $arrp->quantity }} products left)
                            </span>
                        </div>

                        <div class="block-button">
                            <button type="button" value="{{ $arrp->id }}"
                                class="btn btn-ajax-cart-prd btn-ajax-cart-prd-qv">
                                <i class="fas fa-cart-plus"></i>
                                <span>Add to cart</span>
                            </button>
                            <button type="button"
                                class="btn btn-ajax-add-wishlist btn-ajax-add-wishlist-prd @foreach ($array_wishlist as $arrw) @if ($arrw->product_id == $arrp->id)active @break @endif @endforeach"
                                value="{{ $arrp->id }}">
                                <i class="fas fa-heart"></i>
                            </button>

                            <div class="link-view-info-detail">
                                <a href="{{ route('view_one_product', ['name' => $arrp->name]) }}">See more
                                    details -></a>
                            </div>
                            <p class="msg-ajax-rec msg-ajax-rec-{{ $arrp->id }}"></p>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#btn__decrease-quantity{{ $arrp->id }}").click(function() {
                                    var input_val = parseInt($('#quantity-input_prdQV_{{ $arrp->id }}').val());
                                    var max_val = '{{ $arrp->quantity }}';
                                    var min_val = 1;
                                    if (input_val > max_val) {
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(max_val);
                                    } else if (input_val <= min_val) {
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(min_val);
                                    } else {
                                        input_val -= 1;
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(input_val);
                                    }
                                });

                                $("#btn__increase-quantity{{ $arrp->id }}").click(function() {
                                    var input_val = parseInt($('#quantity-input_prdQV_{{ $arrp->id }}').val());
                                    var max_val = '{{ $arrp->quantity }}';
                                    var min_val = 1;
                                    if (input_val < min_val) {
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(min_val);
                                    } else if (input_val >= max_val) {
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(max_val);
                                    } else {
                                        input_val += 1;
                                        $('#quantity-input_prdQV_{{ $arrp->id }}').val(input_val);
                                    }
                                });
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- service part --}}
    @foreach ($array_service as $arrs)
        <div class="block-each-wget-serv block-each-wget">
            <div class="session-each-serv session-each">
                <div class="col-lg-12 col-sm-12 col-md-12 block-serv-show block-show">
                    <div class="col-lg-6 col-md-6 col-sm-12 block-thumbnail-serv thumb-block">
                        @if ($arrs->id == 1)
                            <img class="image-descrip-info"
                                src="{{ URL::asset('image/trainingServices.jpeg') }}">
                        @elseif ($arrs->id == 2)
                            <img class="image-descrip-info"
                                src="{{ URL::asset('image/groomingServices.jpeg') }}">
                        @elseif ($arrs->id == 3)
                            <img class="image-descrip-info"
                                src="{{ URL::asset('image/transportServices.jpeg') }}">
                        @elseif ($arrs->id == 4)
                            <img class="image-descrip-info" src="{{ URL::asset('image/dietServices.jpeg') }}">
                        @elseif ($arrs->id == 5)
                            <img class="image-descrip-info" src="{{ URL::asset('image/vetServices.jpeg') }}">
                        @elseif ($arrs->id == 6)
                            <img class="image-descrip-info"
                                src="{{ URL::asset('image/daycareServices.jpeg') }}">
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 block-infor-serv block-info">
                        <h3 class="serv-title serv-content">{{ $arrs->name }}</h3>
                        <div class="serv-about serv-content">{{ $arrs->about }}</div>
                        <div class="serv-price serv-content">{{ number_format($arrs->price, 0, '.', '.') }} VND
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- blog part --}}
    @foreach ($array_news as $arrn)
        <div class="block-each-wget-news block-each-wget">
            <div class="session-each-news session-each">
                <div class="col-lg-12 col-sm-12 col-md-12 block-news-show block-show">
                    <div class="col-lg-6 col-md-6 col-sm-12 block-thumbnail-news thumb-block">
                        <img class="img-news-thumb"
                                    src="{{ URL::asset('image/blog') }}/{{ $arrn->thumbnail }}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 block-infor-news block-info">
                        <h3 class="news-title news-content">{{ $arrn->title }}</h3>
                        <div class="news-description news-content">
                            {!! Str::limit($arrn->content, 500, '...') !!}
                            <a href="#">See more details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>
@include('footer-page')
</div>
</div>
<div class="popupSuccessMessageSendGGForm" id="submitToLogin">
<div class="my-popup-success">
    <h2 class="popup-title-success" id="titlePopup">You have to login first!</h2>
    <div class="box-btn-popup">
        <button type="button" id="btnClosePopup" class="btn btn-close btn-close-white"
            aria-label="Close">Close</button>
        <button type="button" id="btnSubmitToLogin" class="btn btn-submit" aria-label="Close">Login</button>
    </div>
</div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/field-search.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeStyle() {
        if ($('.msg-ajax-rec').hasClass('alert-danger')) {
            $('.msg-ajax-rec').removeClass('alert-danger');
        }
        if ($('.msg-ajax-rec').hasClass('alert-success')) {
            $('.msg-ajax-rec').removeClass('alert-success');
        }
    };
    $("#btnSubmitToLogin").click(function() {
        window.location.href = '{{ route('users.user_login') }}';
    });
    $("#btnClosePopup").click(function() {
        $("#submitToLogin").fadeOut(300);
    });
    $(".btn-ajax-add-wishlist-prd").click(function() {
        var user_id = '{{ Session::get('user_id') }}';
        if (user_id == "") {
            document.getElementById("submitToLogin").style.visibility =
                "visible";
            document.getElementById("submitToLogin").style.opacity = "1";
            $("#submitToLogin").fadeIn(500);
        } else {
            var btn = $(this);
            var prd_id = $(this).val();
            var url = '/addToWishList/' + prd_id;
            var x = document.getElementsByClassName("msg-ajax-rec-" + prd_id)[0];
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    if (response.log == 200) {

                        btn.addClass('active');
                        changeStyle();
                        $('.msg-ajax-rec-' + prd_id).addClass('alert-success');
                        $('.msg-ajax-rec-' + prd_id).text('Add product to wishlist success');
                        x.style.opacity = 1;
                        setTimeout(function() {
                            x.style.opacity = 0
                        }, 5000);
                    } else if (response.log == 400) {
                        btn.removeClass('active');
                        changeStyle();
                        $('.msg-ajax-rec-' + prd_id).addClass('alert-success');
                        $('.msg-ajax-rec-' + prd_id).text('Remove product from wishlist success');
                        x.style.opacity = 1;
                        setTimeout(function() {
                            x.style.opacity = 0
                        }, 5000);
                    } else {
                        changeStyle();
                        $('.msg-ajax-rec-' + prd_id).addClass('alert-danger');
                        $('.msg-ajax-rec-' + prd_id).text('Error');
                        x.style.opacity = 1;
                        setTimeout(function() {
                            x.style.opacity = 0
                        }, 5000);
                    }
                }
            });
        }
    });

    $(".btn-ajax-cart-prd").click(function() {
            var user_id = '{{ Session::get('user_id') }}';
            if (user_id == "") {
                document.getElementById("submitToLogin").style.visibility =
                    "visible";
                document.getElementById("submitToLogin").style.opacity = "1";
                $("#submitToLogin").fadeIn(300);
            } else {
                var prd_id = $(this).val();
                var url = '/addToCart/' + prd_id;
                var quantity = parseInt($('#quantity-input_prdQV_'+prd_id).val());
                console.log(quantity);
                var x = document.getElementsByClassName("msg-ajax-rec-" + prd_id)[0];
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        prd_id: prd_id,
                        quantity: quantity,
                        user_id: user_id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.log == 300 || response.log == 400 || response.log == 500) {
                            changeStyle();
                            $('.msg-ajax-rec-' + prd_id).addClass('alert-success');
                            x.style.opacity = 1;
                            setTimeout(function() {
                                x.style.opacity = 0
                            }, 5000);
                        } else {
                            changeStyle();
                            $('.msg-ajax-rec-' + prd_id).addClass('alert-danger');
                            x.style.opacity = 1;
                            setTimeout(function() {
                                x.style.opacity = 0
                            }, 5000);
                        }
                        $('.msg-ajax-rec-' + prd_id).text(response.msg);

                    },
                });
            }
        });
</script>
</body>

</html>
