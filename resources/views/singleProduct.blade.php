<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/singleProduct.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">​
    <title>{{ $product_data[0]->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-product-info">
        <h1 class="title-section-showww">Product Information</h1>
        <div class="col-lg-12 col-md-12 col-sm-12 product-info-wget">
            <div class="col-lg-6 col-md-6 col-sm-12 prd-thumb-left">
                <img class="thumb-prd-image-shown"
                    src="{{ URL::asset('image/product/' . $product_data[0]->thumbnail) }}">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 prd-about-right">
                <div class="product-title-block-wget">
                    <h3 class="product-title-prv">{{ $product_data[0]->name }}</h3>
                    <h5 class="product-serial-prv">(Serial: {{ $product_data[0]->serial }})</h5>
                </div>
                <div class="product-info-block-wget">
                    <div class="product-category-prv">
                        <p>
                            Category: {{ $category_data[0]->name }}
                        </p>
                    </div>
                    <div class="product-category-prv">
                        <p>
                            Pet: {{ $pet_data[0]->name }}
                        </p>
                    </div>
                </div>
                <div class="prd-price prd-content">
                    {{ number_format($product_data[0]->sale_price, 0, '.', '.') }} VND/per
                </div>
                <div class="product-sku-block-wget">
                    <button type="button" id="btn__decrease-quantity"
                        class="btn-caret-quantity btn-caret_btn__decrease-quantity">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type=text value="1"
                        oninput="this.value= ['','-'].includes(this.value) ? this.value : this.value|0"
                        id="quantity-input_prdQV">
                    <button type="button" id="btn__increase-quantity"
                        class="btn-caret-quantity btn-caret_btn__increase-quantity">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="product-quantity-prv">({{ $product_data[0]->quantity }} products left)</div>
                </div>
                <div class="button-primary-block-wget">
                    <button type="button" value="{{ $product_data[0]->id }}"
                        class="btn btn-ajax-cart-prd btn-ajax-cart-prd-qv">
                        <i class="fas fa-cart-plus"></i>
                        <span>Add to cart</span>
                    </button>
                    <button type="button" value="{{ $product_data[0]->id }}"
                        class="btn btn-ajax-add-wishlist btn-ajax-wishlist-prd-qv @if ($check == 1) active @endif">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <p id="msg-ajax"></p>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 product-descrip-wget">
            <h4 class="title-description">Description</h4>
            <div class="product-description-prv">
                {!! $product_data[0]->description !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 recommend-product-same-cate">
        <h2 class="title-prd-same">Related Products</h2>
        <div class="prd-cate-prv-rec product-recommend">
            <div class="products-list-view">
                @foreach ($product_category as $prd_cate)
                    <div class="col-lg-3 col-md-3 col-sm-6 prd-item-list">
                        <div class="col-item-list-rec">
                            <div class="thumbnail-block-item">
                                <img height="350px" src="{{ URL::asset('image/product/' . $prd_cate->thumbnail) }}">
                                <button type="button"
                                    class="btn btn-ajax-add-wishlist btn-ajax-add-wishlist-prd @foreach ($wishlist as $wishlist_item) @if ($wishlist_item->product_id == $prd_cate->id)active @endif @endforeach"
                                    value="{{ $prd_cate->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="content-block-item">
                                <div class="form-info">
                                    <a href="{{ asset('view_one_product/' . $prd_cate->name) }}"
                                        class="title-product-each-item">
                                        {{ $prd_cate->name }}</a>
                                    <div class="box-price">
                                        <div class="item-price">
                                            {{ number_format($prd_cate->sale_price, 0, '.', '.') }} VND
                                        </div>
                                        <button value="{{ $prd_cate->id }}" type="button" title="Add To Cart"
                                            class="btn btn-ajax-cart-prd btn-ajax-prd btn-ajax-prd-rec">
                                            <i class="fas fa-cart-plus"></i>
                                            <span class="show-full-cart">Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <p id="msg-ajax-rec"></p>
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
</body>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeStyle() {
        if ($('#msg-ajax-rec').hasClass('alert-danger')) {
            $('#msg-ajax-rec').removeClass('alert-danger');
        }
        if ($('#msg-ajax-rec').hasClass('alert-success')) {
            $('#msg-ajax-rec').removeClass('alert-success');
        }
        var x = document.getElementById("msg-ajax-rec");
        x.style.opacity = 1;
        setTimeout(function() {
            x.style.opacity = 0
        }, 5000);
    };

    function changeStyle1() {
        if ($('#msg-ajax').hasClass('alert-danger')) {
            $('#msg-ajax').removeClass('alert-danger');
        }
        if ($('#msg-ajax').hasClass('alert-success')) {
            $('#msg-ajax').removeClass('alert-success');
        }
        var x = document.getElementById("msg-ajax");
        x.style.opacity = 1;
        setTimeout(function() {
            x.style.opacity = 0
        }, 5000);
    };
    $("#btnSubmitToLogin").click(function() {
        window.location.href = '{{ route('users.user_login') }}';
    });
    $("#btnClosePopup").click(function() {
        $("#submitToLogin").fadeOut(300);
    });

    $(".btn-ajax-prd-rec").click(function() {
        var user_id = '{{ Session::get('user_id') }}';
        if (user_id == "") {
            document.getElementById("submitToLogin").style.visibility =
                "visible";
            document.getElementById("submitToLogin").style.opacity = "1";
            $("#submitToLogin").fadeIn(300);
        } else {
            var prd_id = $(this).val();
            var url = '/addToCart/' + prd_id;
            var quantity = 1;
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
                    changeStyle();
                    if (response.log == 300 || response.log == 400 || response.log == 500) {
                        $('#msg-ajax-rec').addClass('alert-success');
                    } else {
                        $('#msg-ajax-rec').addClass('alert-danger');
                    }
                    $('#msg-ajax-rec').text(response.msg);

                },
            });
        }
    });

    $(".btn-ajax-cart-prd-qv").click(function() {
        var user_id = '{{ Session::get('user_id') }}';
        if (user_id == "") {
            document.getElementById("submitToLogin").style.visibility =
                "visible";
            document.getElementById("submitToLogin").style.opacity = "1";
            $("#submitToLogin").fadeIn(300);
        } else {
            var prd_id = $(this).val();
            var url = '/addToCart/' + prd_id;
            var quantity = parseInt($('#quantity-input_prdQV').val());
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
                    changeStyle1();
                    if (response.log == 300 || response.log == 400 || response.log == 500) {
                        $('#msg-ajax').addClass('alert-success');
                    } else {
                        $('#msg-ajax').addClass('alert-danger');
                    }
                    $('#msg-ajax').text(response.msg);

                },
            });
        }
    });


    $(".btn-ajax-add-wishlist").click(function() {
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
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    if (response.log == 200) {
                        changeStyle()
                        changeStyle1()
                        btn.addClass('active');
                        $('#msg-ajax').addClass('alert-success');
                        $('#msg-ajax').text('Add product to wishlist success');

                    } else if (response.log == 400) {
                        changeStyle()
                        changeStyle1()
                        btn.removeClass('active');
                        $('#msg-ajax').addClass('alert-success');
                        $('#msg-ajax').text('Remove product from wishlist success');
                    } else {
                        changeStyle()
                        $('#msg-ajax').addClass('alert-danger');
                        $('#msg-ajax').text('Error');
                    }

                }
            });
        }
    });



    $(".btn-caret_btn__increase-quantity").click(function() {
        var input_val = parseInt($('#quantity-input_prdQV').val());
        var max_val = '{{ $product_data[0]->quantity }}';
        var min_val = 1;
        console.log(max_val);
        if (input_val >= max_val) {
            $('#quantity-input_prdQV').val(max_val);
        } else if (input_val < min_val) {
            $('#quantity-input_prdQV').val(min_val);
        } else {
            input_val += 1;
            $('#quantity-input_prdQV').val(input_val);
        }
    });
    $(".btn-caret_btn__decrease-quantity").click(function() {
        var input_val = parseInt($('#quantity-input_prdQV').val());
        var max_val = '{{ $product_data[0]->quantity }}';
        var min_val = 1;
        if (input_val <= 1) {
            $('#quantity-input_prdQV').val(min_val);
        } else if (input_val > max_val) {
            $('#quantity-input_prdQV').val(max_val);
        } else {
            let x = input_val - 1;
            $('#quantity-input_prdQV').val(x);
        }
    });
</script>

</html>
