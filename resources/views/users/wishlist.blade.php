<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/productWishlist.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Wishlist</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-cart-prd">
        <div class="show_body__section__cart-prd">
            <h1 class="title-section-showww">Wishlist</h1>
        </div>
        <div id="alert-section"></div>
        <div class="container-wistlist-products">
            <div class="widget-wishlist-filter container">
                @foreach ($array_wishlist as $arrw)
                    <div class="row block-wget-each-products theme{{ $arrw->id }}">
                        <div class="col-lg-12 col-md-12 col-sm-12 each-prds-block">
                            @foreach ($array_products as $arr_prds)
                                @if ($arr_prds->id == $arrw->product_id)
                                    <div class="col-lg-2 col-md-4 col-sm-6 wget-prd-thumbnail">
                                        <img class="img-thumbnail-alt prds-widget-ct"
                                            src="{{ URL::asset('image/product') }}/{{ $arr_prds->thumbnail }}">
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-sm-6 wget-prd-information">
                                        <div class="prds-widget-title prds-widget-ct">
                                            <h3>{{ $arr_prds->name }}</h3>
                                        </div>

                                        <div class="block-widget-bottom-prds">
                                            <div class="prds-widget-content prds-content-wget">
                                                <div class="prds-widget-cate prds-widget-ct">
                                                    @foreach ($array_category as $arr_cate)
                                                        @if ($arr_prds->category_id == $arr_cate->id)
                                                            Category: {{ $arr_cate->name }}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="prds-widget-pet prds-widget-ct">
                                                    @foreach ($array_pet as $arr_pet)
                                                        @if ($arr_prds->pet_id == $arr_pet->id)
                                                            Product for: {{ $arr_pet->name }}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="prds-widget-price prds-widget-ct">
                                                    Price: {{ number_format($arr_prds->sale_price, 0, '.', '.') }} VND
                                                </div>
                                                <p class="msg-ajax-rec-{{ $arr_prds->id }}"></p>
                                            </div>

                                            <div class="prds-widget-button prds-content-wget">
                                                <button
                                                    type="
                                                            button"
                                                    value="{{ $arr_prds->id }}" title="Add To Cart"
                                                    class="btn btn-ajax-cart-prd btn-ajax-prd">
                                                    <i class="fas fa-cart-plus"></i>
                                                    <span class="show-full-btn">Add to cart</span>
                                                </button>
                                                <button type="button" value="{{ $arrw->id }}"
                                                    class="btn btn-delete-prd-from-cart">
                                                    <i class="fa-solid fa-square-xmark"></i>
                                                    <span class="show-full-btn">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
    <script type="text/javascript">
    console.log("wishlist page")
        function changeStyle() {
            if ($('.msg-ajax-rec').hasClass('alert-danger')) {
                $('.msg-ajax-rec').removeClass('alert-danger');
            }
            if ($('.msg-ajax-rec').hasClass('alert-success')) {
                $('.msg-ajax-rec').removeClass('alert-success');
            }
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn-ajax-cart-prd").click(function() {
            var user_id = '{{ Session::get('user_id') }}';
            console.log('your id : ' + user_id);
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

        $(".btn-delete-prd-from-cart").click(function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "/users/delete_product_wishlist/" + id;
            var _this = $(this);

            $.ajax({
                type: "DELETE",
                url: url,
                success: function(response) {
                    console.log(response.data)
                    _this.parents().find(".theme"+id).remove();
                    _this.parent().remove;
                    $("#alert-section").addClass("alert alert-success");
                    $("#alert-section").text(response.msg);
                }
            })
        })
    </script>
</body>

</html>
