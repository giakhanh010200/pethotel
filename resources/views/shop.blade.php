<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/shopProducts.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Shop</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-shop">
        <div class="show_body__section__shop">
            <h1 class="title-section-showww">Shop Products For Your Pet's Happiness</h1>

            <div class="section__showww-product-filters col-lg-12 col-md-12 col-sm-12">
                <div class="aside-filters__product column-product-site col-lg-3 col-md-3 col-sm-12">

                    <form class="form-filter form-submit" id="ajax-form-checkbox" method="GET"
                        action="{{ URL::current() }}">
                        {{ csrf_field() }}
                        <div class="slider-price-on-aside filters-product-row">
                            <h5 class="price-title title-price-filters" for="price">Price range:</h5>
                            <input type="hidden" name="minamount" id="hidden_minimum_price"
                                value="{{ request()->has('minamount') ? request()->get('minamount') : '0' }}">
                            <input type="hidden" name="maxamount" id="hidden_maximum_price"
                                value="{{ request()->has('maxamount') ? request()->get('maxamount') : '1000000' }}">
                            <p type="text" id="amount"
                                style="border:0; width:100%; color:#f6931f; font-weight:bold;">
                            </p>
                            <div id="price_range_prd" class="price_range_show_for">
                            </div>
                        </div>

                        <div class="check-box-pet-on-aside filters-product-row">
                            <div class="list-group">
                                <h5 class="price-title title-pet-filters">Sort By:</h5>
                                <div class="list-group-sort-filters common__selector">
                                    <div class="sort-group">
                                        <input type="radio" id="sort_relevance" name="sortorder"
                                            value="product_relevance" checked
                                            @if (request()->sortorder == 'product_relevance') checked @endif>
                                        <label for="sort_relevance"><i class="fas fa-paw"></i></label>
                                        <p>Relevance Products</p>
                                    </div>
                                    <div class="sort-group">
                                        <input type="radio" id="product_price_low_high" name="sortorder"
                                            value="product_price_low_high"
                                            @if (request()->sortorder == 'product_price_low_high') checked @endif>
                                        <label for="product_price_low_high"><i class="fas fa-paw"></i></label>
                                        <p>Price: Low to High</p>
                                    </div>
                                    <div class="sort-group">
                                        <input type="radio" id="product_price_high_low" name="sortorder"
                                            value="product_price_high_low"
                                            @if (request()->sortorder == 'product_price_high_low') checked @endif>
                                        <label for="product_price_high_low"><i class="fas fa-paw"></i></label>
                                        <p>Price: High to Low</p>
                                    </div>
                                    <div class="sort-group">
                                        <input type="radio" id="product_latest" name="sortorder"
                                            value="product_latest" @if (request()->sortorder == 'product_latest') checked @endif>
                                        <label for="product_latest"><i class="fas fa-paw"></i></label>
                                        <p>Latest Products</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="check-box-cate-on-aside filters-product-row">
                            <div class="list-group">
                                <h5 class="price-title title-cate-filters">Categories:</h5>
                                <div class="list-group-cate-filters common__selector">
                                    @foreach ($array_category as $arrcate)
                                        @php
                                            $checked = [];
                                            if (isset($_GET['category_id'])) {
                                                $checked = $_GET['category_id'];
                                            }
                                        @endphp
                                        <div class="list-gr-item-cate list-item-gr">
                                            <div class="item-checkbox">
                                                <input type="checkbox" name="category_id[]"
                                                    id="checkboxcate{{ $arrcate->id }}"
                                                    class="cate__selector-common checkbox-common-select"
                                                    value="{{ $arrcate->name }}"
                                                    @if (in_array($arrcate->name, $checked)) checked @endif>
                                                <label for="checkboxcate{{ $arrcate->id }}"><i
                                                        class="fas fa-paw"></i></label>
                                                <p>{{ $arrcate->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="check-box-pet-on-aside filters-product-row">
                            <div class="list-group">
                                <h5 class="price-title title-pet-filters">Pets:</h5>
                                <div class="list-group-pet-filters common__selector">
                                    @php
                                        if (isset($_GET['pet_id'])) {
                                            $checked = $_GET['pet_id'];
                                        }
                                    @endphp
                                    @foreach ($array_pet as $arrpet)
                                        <div class="list-gr-item-pet list-item-gr">
                                            <div class="item-checkbox">
                                                <input type="checkbox" name="pet_id[]"
                                                    id="checkboxpet{{ $arrpet->id }}"
                                                    class="pet__selector-common checkbox-common-select"
                                                    value="{{ $arrpet->name }}"
                                                    @if (in_array($arrpet->name, $checked)) checked @endif>
                                                <label for="checkboxpet{{ $arrpet->id }}"><i
                                                        class="fas fa-paw"></i></label>
                                                <p>{{ $arrpet->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>




                        <button type="submit" class="btn-submit-onchange-checked">Filters</button>
                    </form>
                </div>
                <div class="show-all__product column-product-site col-lg-9 col-md-9 col-sm-12">
                    @if (count($array_products) > 0)
                        <div class="prds-table-site__show col-lg-12 col-md-12 col-sm-12">
                            @foreach ($array_products as $arrprds)
                                <div class="col-lg-4 col-md-6 col-sm-12 each-products-item"
                                    id="prdItem{{ $arrprds->id }}">
                                    <div class="prds-item-as-each">
                                        <div class="image-prds-itemm">
                                            <a href="{{ asset('view_one_product/' . $arrprds->name) }}">
                                                <img height="350px"
                                                    src="{{ URL::asset('image/product') }}/{{ $arrprds->thumbnail }}">
                                            </a>
                                            <button type="button"
                                                class="btn btn-ajax-add-wishlist-prd @if ($count != 0) @foreach ($wishlist as $wishlist_item)@if ($wishlist_item->product_id == $arrprds->id)active @endif @endforeach @endif"
                                                value="{{ $arrprds->id }}">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                        <div class="infor-prds-item">
                                            <div class="infor-form-item">
                                                <a
                                                    href="{{ asset('view_one_product/' . $arrprds->name) }}">{{ $arrprds->name }}</a>
                                                <p class="msg-ajax-rec msg-ajax-rec-{{ $arrprds->id }}"></p>
                                                <div class="prd-item-list-action">
                                                    {{ number_format($arrprds->sale_price, 0, '.', '.') }} VND
                                                    <button
                                                        type="
                                                        button"
                                                        value="{{ $arrprds->id }}" title="Add To Cart"
                                                        class="btn btn-ajax-cart-prd btn-ajax-prd">
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
                    @elseif (count($array_products) > 12)
                        <div class="prds-table-site__show col-lg-12 col-md-12 col-sm-12">
                            @foreach ($array_products as $arrprds)
                                <div class="col-lg-4 col-md-6 col-sm-12 each-products-item"
                                    id="prdItem{{ $arrprds->id }}">
                                    <div class="prds-item-as-each">
                                        <div class="image-prds-itemm">
                                            <a href="{{ asset('view_one_product/' . $arrprds->name) }}">
                                                <img height="350px"
                                                    src="{{ URL::asset('image/product') }}/{{ $arrprds->thumbnail }}">
                                            </a>
                                            <button type="button"
                                                class="btn btn-ajax-add-wishlist-prd @if ($count != 0) @foreach ($wishlist as $wishlist_item)@if ($wishlist_item->product_id == $arrprds->id)active @endif @endforeach @endif"
                                                value="{{ $arrprds->id }}">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                        <div class="infor-prds-item">
                                            <div class="infor-form-item">
                                                <a
                                                    href="{{ asset('view_one_product/' . $arrprds->name) }}">{{ $arrprds->name }}</a>
                                                <p class="msg-ajax-rec msg-ajax-rec-{{ $arrprds->id }}"></p>
                                                <div class="prd-item-list-action">
                                                    {{ $arrprds->sale_price }} VNĐ
                                                    <button value="{{ $arrprds->id }}" type="button"
                                                        title="Add To Cart"
                                                        class="btn btn-ajax-cart-prd btn-ajax-prd">
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
                        {!! $array_products->links('layout.pagination') !!}
                    @else
                        <div class="infomation-text-column">No products found</div>
                    @endif
                </div>
            </div>
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
                <button type="button" id="btnSubmitToLogin" class="btn btn-submit"
                    aria-label="Close">Login</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/shop.js') }}"></script>
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
                var quantity = 1;
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
