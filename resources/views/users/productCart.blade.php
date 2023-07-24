<!DOCTYPE html>
<html lang="en">

<head>

    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/productCart.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Cart</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-cart-prd">
        <div class="show_body__section__cart-prd">
            <h1 class="title-section-showww">Shopping Cart</h1>
            <div class="wget-cart-prd-section-view col-lg-12 col-sm-12 col-md-12">
                @if ($check == 0)
                    <div class="notification-empty-cart">Your cart is empty</div>
                @else
                    <script type="text/javascript">
                        const cart_id = [];
                        const product_quantity = [];
                        var totalprice = 0;
                    </script>
                    <div class="col-lg-8 col-sm-12 col-md-8 widget-view-cart-section">
                        @foreach ($array_cart as $arrc)
                            <div class="block-product-view-cart wgetBlockPrd{{ $arrc->id }}">
                                @foreach ($array_products as $arr_prds)
                                    @if ($arr_prds->id == $arrc->product_id)
                                        <div
                                            class="block-widget-{{ $arrc->id }} widget-block-info-content-cart widget-info-block col-lg-9 col-md-9 col-sm-12">
                                            <div class="content-prd-content-block">
                                                <h4 class="title-wget-prd">
                                                    {{ $arr_prds->name }}
                                                </h4>
                                                <h6 class="subtitle-wget-prd">
                                                    (Serial: {{ $arr_prds->serial }})
                                                </h6>
                                            </div>
                                            <div class="content-prd-info-block">
                                                <div
                                                    class="content-about-product content-block col-lg-6 col-md-6 col-sm-12">
                                                    <div class="content-prd-about-cate">
                                                        @foreach ($array_cate as $arrcate)
                                                            @if ($arrcate->id == $arr_prds->category_id)
                                                                <p>
                                                                    Product category: {{ $arrcate->name }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="content-prd-about-pet">
                                                        @foreach ($array_pet as $arrpet)
                                                            @if ($arrpet->id == $arr_prds->pet_id)
                                                                <p>Product for: {{ $arrpet->name }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="content-prd-price-block">
                                                        <p>Product price:
                                                            {{ number_format($arr_prds->sale_price, 0, '.', '.') }}
                                                            VND</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="content-quantity-prd content-block col-lg-2 col-md-2 col-sm-6">
                                                    <div>
                                                        <button type="button" value="{{ $arrc->id }}"
                                                            class="btn-caret-quantity btn-caret_btn__decrease-quantity_{{ $arrc->id }}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type=text value="{{ $arrc->quantity }}"
                                                            oninput="this.value= ['','-'].includes(this.value) ? this.value : this.value|0"
                                                            class="quantity-input-prd quantity-input_prd_{{ $arrc->id }}" id="quantity-input_prd_{{ $arrc->id }}">
                                                        <button type="button" value="{{ $arrc->id }}"
                                                            class="btn-caret-quantity btn-caret_btn__increase-quantity_{{ $arrc->id }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                                <div
                                                    class="content-subtotal-price-prd content-block col-lg-4 col-md-4 col-sm-6">
                                                    <p class="title-subtotal">Subtotal price</p>
                                                    <p class="price-subtotal" id="price-subtotal-{{ $arrc->id }}">
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="block-button-remove-prd">
                                                <button
                                                    class="btn-remove-product btn-remove-product-{{ $arrc->id }}"
                                                    value="{{ $arrc->id }}">Delete
                                                    this product</button>
                                            </div>
                                        </div>
                                        <div
                                            class="widget-block-info-image-cart widget-info-block col-lg-3 col-md-3 col-sm-12">
                                            <img class="img-cart-for-prd-cart"
                                                src="{{ URL::asset('image/product') }}/{{ $arr_prds->thumbnail }}">
                                        </div>
                                        <script type="text/javascript">
                                            $(".btn-remove-product-{{ $arrc->id }}").click(function() {
                                                document.getElementById("submitToDelete").style.visibility =
                                                    "visible";
                                                document.getElementById("submitToDelete").style.opacity = "1";
                                                $("#submitToDelete").fadeIn(500);
                                            });


                                            function currency(data) {
                                                return data = data.toLocaleString('it-IT', {
                                                    style: 'currency',
                                                    currency: 'VND'
                                                });
                                            }
                                            cart_id.push({{ $arrc->id }});
                                            product_quantity.push({{ $arrc->quantity }});
                                            var quantity = {{ $arrc->quantity }};
                                            var price = {{ $arr_prds->sale_price }};
                                            var subtotal_price = quantity * price;
                                            document.getElementById("price-subtotal-{{ $arrc->id }}").innerHTML = currency(subtotal_price);
                                            totalprice = totalprice + (quantity * price);
                                            $(".quantity-input_prd_{{ $arrc->id }}").change(function() {
                                                console.log("null")
                                                let input_val = parseInt($('.quantity-input_prd_{{ $arrc->id }}').val());
                                                let max_val = "{{ $arr_prds->quantity }}";
                                                let min_val = 1;
                                                let subtotal = "{{ $arrc->total_prices }}";
                                                let prd_price = "{{ $arr_prds->sale_price }}"

                                                if (input_val > max_val) {
                                                   document.getElementById("quantity-input_prd_{{ $arrc->id }}").value = max_val;
                                                   input_val = max_val;
                                                }
                                                if (input_val < min_val) {
                                                    document.getElementById("quantity-input_prd_{{ $arrc->id }}").value = min_val;
                                                    input_val = min_val
                                                }
                                                let x = cart_id.indexOf({{ $arrc->id }});
                                                let quantity = product_quantity[x];
                                                product_quantity.splice(x, 1, input_val);
                                                subtotal = prd_price * input_val;
                                                totalprice = totalprice + subtotal;
                                                document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);
                                                $('.quantity-input_prd_{{ $arrc->id }}').val(input_val);
                                                document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);
                                            });
                                            $(".btn-caret_btn__increase-quantity_{{ $arrc->id }}").click(function() {
                                                let input_val_inc = parseInt($('.quantity-input_prd_{{ $arrc->id }}').val());
                                                let max_val = "{{ $arr_prds->quantity }}";
                                                let min_val = 1;
                                                let subtotal = "{{ $arrc->total_prices }}";
                                                let prd_price = "{{ $arr_prds->sale_price }}"
                                                if (input_val_inc >= max_val) {
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(max_val);
                                                    input_val_inc = max_val
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    subtotal = prd_price * input_val_inc;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_inc);
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);

                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);
                                                }
                                                else if (input_val_inc < min_val) {
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(min_val);
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    subtotal = prd_price * input_val_inc;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_inc);
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);

                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);
                                                }else{
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    input_val_inc += 1;
                                                    subtotal = prd_price * input_val_inc;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_inc);
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(input_val_inc);
                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);

                                                }

                                            });


                                            $(".btn-caret_btn__decrease-quantity_{{ $arrc->id }}").click(function() {
                                                let input_val_dec = parseInt($('.quantity-input_prd_{{ $arrc->id }}').val());
                                                let min_val = 1;
                                                let max_val = "{{ $arr_prds->quantity }}";
                                                let subtotal = "{{ $arrc->total_prices }}";
                                                let prd_price = "{{ $arr_prds->sale_price }}"
                                                if (input_val_dec <= min_val) {
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(min_val);
                                                    input_val_dec = min_val
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    subtotal = prd_price * input_val_dec;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_dec);
                                                    subtotal = prd_price * input_val_dec;
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);

                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);
                                                }
                                                else if(input_val_dec > max_val){
                                                    input_val_dec = max_val
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(max_val);
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    subtotal = prd_price * input_val_dec;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_dec);
                                                    subtotal = prd_price * input_val_dec;
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);

                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);
                                                }else{
                                                    let x = cart_id.indexOf({{ $arrc->id }});
                                                    let quantity = product_quantity[x];
                                                    totalprice = totalprice - quantity * prd_price;
                                                    input_val_dec -= 1;
                                                    subtotal = prd_price * input_val_dec;
                                                    totalprice = totalprice + subtotal;
                                                    product_quantity.splice(x, 1, input_val_dec);
                                                    subtotal = prd_price * input_val_dec;
                                                    document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);
                                                    $('.quantity-input_prd_{{ $arrc->id }}').val(input_val_dec);
                                                    document.getElementById('price-subtotal-{{ $arrc->id }}').innerHTML = currency(subtotal);

                                                }


                                            });
                                        </script>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 widget-view-payment-section">
                        <div class="block-wget-payment-info">
                            <h3 class=payment-block-title>Cart payment information</h3>
                            <div class="subtotal-price-wget">
                                <p>Total price:</p>
                                <p id="total_price_all_prds"></p>
                            </div>
                        </div>
                        <div class="block-button-payment">
                            <button class="btn btn-pri-submit btn-submit-update_cart" id="updateBtnSubmt">UPDATE
                                CART</button>
                            <a class="btn btn-pri-submit btn-submit-to_checkout" type="button" id="checkoutBtnSubmit"
                                href="{{ route('users.checkout_cart_product') }}">NEXT
                                STEP</a>

                        </div>
                        @if (Session::has('delete'))
                            <p id="msg-delete" class="alert alert-success">
                                {{ Session::get('delete') }}
                            </p>
                            <script type="text/javascript">
                                var msgDelete = document.getElementById('msg-delete');
                                setTimeout(function() {
                                    msgDelete.style.display = "none";
                                }, 5000);
                            </script>
                        @endif
                        <p id="msg-ajax" class="alert alert-success" style="opacity: 0;">

                        </p>
                    </div>
                @endif
            </div>
            <a href="{{ route('shop') }}" class="btn btn-continue-shopping btn-back">Continue Shopping</a>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
    <div class="popupSuccessMessageSendGGForm" id="submitToDelete">
        <div class="my-popup-success">
            <h2 class="popup-title-success" id="titlePopup">Sure to delete this product?</h2>
            <div class="box-btn-popup">
                <button type="button" id="btnClosePopupDelete" class="btn btn-close btn-close-white"
                    aria-label="Close">Close</button>
                <button type="button" id="btnSubmitToDelete" class="btn btn-submit" aria-label="Close">Delete</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".btn-remove-product").click(function() {
            var val = $(this).val();
            $("#btnClosePopupDelete").click(function() {
                $("#submitToDelete").fadeOut(500);
            });
            $("#btnSubmitToDelete").click(function() {
                console.log(val);
                var url = '{{ route('users.delete_product_cart', ':id') }}';
                url = url.replace(':id', val);
                window.location.href = url;
            });
        });



        document.getElementById("total_price_all_prds").innerHTML = currency(totalprice);
        $("#updateBtnSubmt").click(function() {
            console.log(product_quantity);
            url = "/updateProductInCart";
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    cart_id: cart_id,
                    product_quantity: product_quantity
                },
                success: function(response) {
                    console.log(response);
                    $('#msg-ajax').text('Update product quantity success');
                    var x = document.getElementById("msg-ajax");
                    x.style.opacity = 1;
                    setTimeout(function() {
                        x.style.opacity = 0
                    }, 5000);
                }
            });
        });
    </script>
</body>

</html>
