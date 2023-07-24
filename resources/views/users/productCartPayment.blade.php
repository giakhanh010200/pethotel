<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/productCartPay.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart Product Payment</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-cart-prd">
        <div class="show_body__section__cart-prd">
            <h1 class="title-section-showww">Cart Payment</h1>
            <div class="col-lg-12 col-md-12 col-sm-12 table-show-cart-data">
                <div class="box-show-cart-product">
                    <script type="text/javascript">
                        var total_prices = 0;
                    </script>
                    @foreach ($array_cart as $arrc)
                        <div class="each-prd-in-cart" id="eachBox{{ $arrc->id }}">
                            @foreach ($array_products as $arrprds)
                                @if ($arrprds->id == $arrc->product_id)
                                    <div class="col-lg-12 col-md-12 col-sm-12 block-chain-each-prd">
                                        <div id="block-product-{{ $arrc->id }}"
                                            class="block-prd-show col-lg-9 col-md-9 col-sm-12">
                                            <h3 class="cart-head-prd-name cart-prd-show">{{ $arrprds->name }}</h4>
                                                <p class="cart-head-prd-serial cart-prd-show">Serial:
                                                    {{ $arrprds->serial }}
                                                </p>
                                                <p class="cart-head-prd-manufacturer cart-prd-show">
                                                    Manufacturer: {{ $arrprds->manufacturer }}</p>
                                                <p class="cart-head-prd-manufacturer cart-prd-show">Quantity:
                                                    {{ $arrc->quantity }}</p>
                                                <p class="cart-head-prd-price cart-prd-show">Total price:
                                                    {{ number_format($arrc->total_prices, 0, '.', '.') }} VND</p>
                                        </div>
                                        <div class="block-img-thumbnail-prd col-lg-3 col-md-3 col-sm-12">
                                            <img class="cart-head-prd-thumnail"
                                                src="{{ URL::asset('image/product') }}/{{ $arrprds->thumbnail }}"
                                                width="300px">
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        var price = {{ $arrc->total_prices }}
                                        total_prices = price + total_prices
                                        console.log(total_prices)
                                    </script>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    <div class="box-show-user-address">
                        <button class="button" id="btn-select-address" class="btn btn-primary btn-get-data"
                            data-target="#modalSelectAddress" data-toggle="modal">Choose Shipping Address</button>
                        <div class="show-data-add-choose">
                            <p class="name-show-add" id="show-add-name"></p>
                            <p class="phone-show-add" id="show-add-phone"></p>
                            <p class="address-show-add" id="show-add-address"></p>
                        </div>
                        <div class="modal modal-show-address" id="modalSelectAddress">
                            <div class="show-select-address">
                                <div class="modal-header">
                                    <h4 class="modal-title">Choose Address</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($array_add as $arra)
                                        <button type="button" class="btn-select-address-user btn-choose"
                                            id="btn-value-{{ $arra->id }}" value="{{ $arra->id }}">
                                            <span class="data-address-name" id="name-add-{{ $arra->id }}">Name:
                                                {{ $arra->name }}</span>
                                            <span class="data-address-phone" id="phone-add-{{ $arra->id }}">Phone:
                                                {{ $arra->phone }}</span>
                                            <span class="data-address-add" id="add-add-{{ $arra->id }}">Address:
                                                {{ $arra->address }}</span>
                                        </button>
                                    @endforeach

                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('users.user_info') }}" class="routing-add-address">Add new
                                        address
                                        -></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <hr>
                <div class="payment-container">
                    <div class="alert alert-danger" id="message-alert"></div>
                    <div class="block-payment">
                        <div id="cart-prd-prices"></div>
                        <button type="button" class="btn btn-primary btn-payment-next" id="btn-payment-next"
                            value="{{ $array_cart[0]->cart_id_render }}">Payment</button>
                    </div>
                </div>
                <div class="modal modal-success-payment-inform" id="modal-success-inform">
                    <div class="block-section-modal">
                        <div class="modal-header">
                            <h1>You have successfully placed your order !!!</h1>
                            <h3>Thank you !!! Have a nice day!</h3>
                        </div>
                        <div class="modal-body">
                            <a class="btn btn-primary btn-back-homepage" href="{{ route('welcome') }}">Go to
                                homepage</a>
                            <a class="btn btn-success btn-show-order" href="{{ route('users.user_info') }}">Check your
                                order</a>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function currency(data) {
                        return data = data.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        });
                    }
                    document.getElementById('cart-prd-prices').innerHTML = 'Total order price: ' + currency(total_prices)
                    $("#message-alert").hide();
                    var id_add;
                    var name_add, phone_add, address_add;
                    $(document).ready(function() {
                        $(".btn-choose").click(function() {
                            id_add = $(this).val();
                            console.log(id_add);
                            name_add = document.getElementById("name-add-" + id_add).innerHTML;
                            phone_add = document.getElementById("phone-add-" + id_add).innerHTML;
                            address_add = document.getElementById("add-add-" + id_add).innerHTML;
                            document.getElementById("show-add-name").innerHTML = name_add;
                            document.getElementById("show-add-phone").innerHTML = phone_add;
                            document.getElementById("show-add-address").innerHTML = address_add;
                            document.getElementById("btn-select-address").innerHTML = "Change Shipping Address"
                            $(".modal").hide();
                            $('.modal-backdrop.show').hide();
                        });

                        $("#btn-payment-next").click(function() {
                            if (id_add == null) {
                                document.getElementById("message-alert").innerHTML = "You have to choose your address";
                                $("#message-alert")
                                    .fadeIn(1000)
                                    .fadeTo(2000, 5)
                                    .fadeOut(1000, function() {
                                        $("#message-alert").fadeOut(1000);
                                    });
                            } else {
                                cart_id = $(this).val();
                                address_id = id_add;
                                var data = {
                                    address_id,
                                    cart_id
                                };
                                url = "/users/cart_success_payment";
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: "POST",
                                    url: url,
                                    data: data,
                                    success: function(response) {
                                        console.log(response.data);
                                        console.log(response.data2);
                                        $("#modal-success-inform").show();
                                    }
                                })

                            }
                        })
                    })
                </script>
            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
</body>

</html>
