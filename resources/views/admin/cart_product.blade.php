<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-cart.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart product</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="products-body">
        <h2 class="show-header-title">Cart Product</h2>
        {{-- <button class="btn btn-add-new" id="btnCreateOrder" data-toggle="modal" data-target="#createNewOrder">Create new
            order</button> --}}
        <section class='alert alert-change' id="alert-info"></section>
        {{-- <div class="modal modal-block-create-order"></div> --}}
        <div class="session-view-all-cart">
            <div class="search-cart-content">
                <form class="form-search-data">
                    <div class="form-search">
                        <input type="text" name="search" placeholder="Search order ....">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="form-sort">
                        @php
                            $array_text = ['Not confirmed', 'Confirmed', 'Order confirmation(Delivery)', 'Cancled by customer', 'Out of stock', 'Success delivery', 'No recipient'];
                        @endphp
                        <select name="sort" class="sort-by-status" id="statusSortSelect">
                            <option value="0" selected>All cart</option>
                            @php
                                for ($i = 0; $i < 7; $i++) {
                                    $j = $i + 1;
                                    echo "'<option value='$j'>";
                                    echo $array_text[$i];
                                    echo '</option>';
                                }
                            @endphp
                        </select>
                    </div>
                </form>
            </div>

            <div class="show-cart-product-content">
                <div class="show__cart__title col-12">
                    <div class="col-2 title-area header-title-items">Order ID</div>
                    <div class="col-2 title-area header-title-items">Customer Name</div>
                    <div class="middle-title-for-prd col-4">
                        <div class="col-9 title-area header-title-items">List products</div>
                        <div class="col-3 title-area header-title-items">Quantity</div>
                    </div>
                    <div class="col-2 title-area header-title-items">Ship Address</div>
                    <div class="col-1 title-area header-title-items">Total Price</div>
                    <div class="col-1 title-area header-title-items">Action</div>
                </div>
                <div class="show__cart__content">
                    @if (count($array_cart) > 0)
                        @php
                            $cart_id = '';
                            $j = 0;
                            $fake_cart_id = $array_cart[0]->cart_id_render;
                        @endphp
                        @foreach ($array_cart as $arrc)
                            @if ($cart_id != $arrc->cart_id_render)
                                <div class="showing__content col-12 lineCartRender"
                                    id="lineCartRender{{ $arrc->cart_id_render }}">
                                    @php
                                        $total_prices = 0;
                                        $cart_id = $arrc->cart_id_render;
                                    @endphp
                                    <div class="content-cart-id col-2">{{ $arrc->cart_id_render }}</div>
                                    <div class="content-cart-customer-name col-2">{{ $arrc->user_name }}</div>
                                    <div class="each-product-show-list col-4">
                                        @foreach ($array_cart as $arrcs)
                                            @if ($arrcs->cart_id_render == $arrc->cart_id_render)
                                                @if ($arrcs->product_name == null)
                                                    @foreach ($array_product as $arrp)
                                                        @if ($arrcs->product_id == $arrp->id)
                                                            <div class="each-prd-show">
                                                                <div class="content-cart-product-name col-9">
                                                                    {{ $arrp->name }}</div>
                                                                <div class="content-cart-quantity col-3">
                                                                    {{ $arrcs->quantity }}</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="each-prd-show">
                                                        <div class="content-cart-product-name col-9">
                                                            {{ $arrcs->product_name }}</div>
                                                        <div class="content-cart-quantity col-3">
                                                            {{ $arrcs->quantity }}</div>
                                                    </div>
                                                @endif
                                                @php
                                                    $total_prices = $total_prices + $arrcs->total_prices;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="content-cart-customer-address col-2">{{ $arrc->user_address }}</div>
                                    <div class="content-cart-total-prices col-1">@php
                                        echo number_format($total_prices, 0, '', '.');
                                    @endphp VND</div>
                                    <div class="content-cart-action-change-status">
                                        <button class="btn btn-primary btn-view-cart" data-toggle="modal"
                                            data-target="#viewDetailCart"
                                            value="{{ $arrc->cart_id_render }}">Details</button>
                                        <select class="form-control status-change-action"
                                            id="select-change-status-{{ $arrc->cart_id_render }}">
                                            @php

                                                $level = Session::get('level');
                                                $status = $arrc->status;

                                                for ($i = 0; $i < 7; $i++) {
                                                    $j = $i + 1;
                                                    if ($status == 1) {
                                                        if ($status == $j) {
                                                            echo "<option value ='$j' disabled selected>";
                                                            echo $array_text[$i];
                                                            echo '</option>';
                                                        } else {
                                                            echo "<option value ='$j' disabled>";
                                                            echo $array_text[$i];
                                                            echo '</option>';
                                                        }
                                                    } else {
                                                        if ($level < 4) {
                                                            if ($status == 2) {
                                                                if ($j == 1 || $j == 6) {
                                                                    echo "<option value ='$j' disabled>";
                                                                } elseif ($j == $status) {
                                                                    echo "<option value ='$j' disabled selected>";
                                                                } else {
                                                                    echo "<option value ='$j'>";
                                                                }
                                                                echo $array_text[$i];
                                                                echo '</option>';
                                                            } else {
                                                                if ($status == $j) {
                                                                    echo "<option value ='$j' disabled selected>";
                                                                } else {
                                                                    echo "<option value ='$j' disabled>";
                                                                }
                                                                echo $array_text[$i];
                                                                echo '</option>';
                                                            }
                                                        } else {
                                                            if ($status == $j) {
                                                                echo "<option value ='$j' disabled selected>";
                                                            } elseif ($j == 1 || $j == 2) {
                                                                echo "<option value ='$j' disabled>";
                                                            } else {
                                                                echo "<option value ='$j'>";
                                                            }
                                                            echo $array_text[$i];
                                                            echo '</option>';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            {{-- <option class="set-value-status click-change-status" value="1">Not confirmed</option>
                                    <option class="set-value-status click-change-status" value="2">Confirmed</option>
                                    <option class="set-value-status click-change-status" value="3">On delivery</option>
                                    <option class="set-value-status click-change-status" value="4">Cancled by customer</option>
                                    <option class="set-value-status click-change-status" value="5">Out of stock</option>
                                    <option class="set-value-status click-change-status" value="6" disabled>Success delivery</option>
                                    <option class="set-value-status click-change-status" value="7">No recipient</option> --}}

                                        </select>
                                    </div>
                                    <script type="text/javascript">
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        document.getElementById('lineCartRender{{ $arrc->cart_id_render }}').style.borderTop = "2px solid #000";
                                        $(document).ready(function() {
                                            $("#select-change-status-{{ $arrc->cart_id_render }}").change(function() {
                                                var value = $(this).val();
                                                var cart_id = "{{ $arrc->cart_id_render }}";
                                                console.log(value, cart_id);
                                                url = "/admin/cart_change_status";
                                                data = {
                                                    value: value,
                                                    cart_id: cart_id
                                                }
                                                $.ajax({
                                                    type: "POST",
                                                    url: url,
                                                    data: data,
                                                    success: function(response) {
                                                        if (response.err == false) {
                                                            document.getElementById("alert-info").innerHTML = "order (" +
                                                                cart_id + ") status change successful";
                                                            $("#alert-info").addClass("alert-success")
                                                            $("#alert-info").removeClass("alert-warning")
                                                        } else {
                                                            document.getElementById("alert-info").innerHTML =
                                                                "you dont have enough permission to change order " + cart_id +
                                                                " status ";
                                                            $("#alert-info").removeClass("alert-success")
                                                            $("#alert-info").addClass("alert-warning")
                                                        }
                                                    }
                                                })
                                            })

                                        })
                                    </script>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- {!! $array_cart->links('layout.pagination') !!} --}}
        </div>

    </div>
    <div class="modal modal-view-details-cart" id="viewDetailCart">
        <div class="block-widget-details">
            <div class="modal-header">
                <h3 class="cart-title" id="titleCart"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="data-list-inline" id="dataList">
                    <div class="title-heading-top">
                        <div class="title-heading title-name col-6">Product name</div>
                        <div class="title-heading title-quantity col-2">Quantity</div>
                        <div class="title-heading title-price col-2">Product price</div>
                        <div class="title-heading title-totalprice col-2">Total prices</div>
                    </div>
                    <div class="title-bot" id="titleBottom">
                    </div>
                    <div class="block-each">
                        <div class="title-block col-3">Total Price:</div>
                        <div class="content-block" id="cartPrice"></div>
                    </div>
                    <div class="block-each">
                        <div class="title-block col-3">Customer name:</div>
                        <div class="content-block" id="cartCusName"></div>
                    </div>
                    <div id="userInfo"></div>
                    <div class="block-each">
                        <div class="title-block col-3">Status:</div>
                        <div class="content-block" id="cartStt"></div>
                    </div>
                    <div class="block-each">
                        <div class="title-block col-3">Created at:</div>
                        <div class="content-block" id="cartCreated"></div>
                    </div>
                    <div id="paymentAt"></div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function currency(data) {
                return data = data.toLocaleString('it-IT', {
                    style: 'currency',
                    currency: 'VND'
                });
            }
            $(".btn-view-cart").click(function() {
                id = $(this).val();
                url = "/admin/cart_full_render/" + id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response.data)
                        $("#titleBottom").html("");
                        $("#userInfo").html("");
                        $("#titleCart").text("Order " + response.data[0].cart_id_render);
                        for (var i = 0; i < response.count; i++) {
                            var price = response.data[i].product_price
                            var total = response.data[i].total_prices
                            console.log(total);
                            $("#titleBottom").append(
                                '<div class="block-each-prd">\
                                                        <div class = "content-table content-name col-6" >' + response.data[
                                    i]
                                .product_name + '</div>\
                                                        <div class="content-table content-quantity col-2">' + response
                                .data[i]
                                .quantity + '</div>\
                                                        <div class="content-table content-price col-2">' + price + ' VND</div>\
                                                        <div class="content-table content-totalprice col-2">' + total + ' VND</div>\
                                                        </div>'
                            )
                        }

                        $("#cartPrice").text(response.full_price + " VND");
                        $("#cartCusName").text(response.data[0].user_name);
                        $("#cartCreated").text(response.data[0].created_at);
                        if (response.data[0].user_phone != null) {
                            $("#userInfo").append(
                                '<div class="block-each">\
                                            <div class="title-block col-3">Customer phone:</div>\
                                            <div class="content-block">' + response.data[0].user_phone + '</div>\
                                        </div>\
                                        <div class="block-each">\
                                            <div class="title block col-3">Customer address:</div>\
                                            <div class="content-block">' + response.data[0].user_address + '</div>\
                                        </div>'
                            )
                        }
                        if (response.data[0].payment_at != null) {
                            $("#paymentAt").append(
                                '<div class="block-each">\
                                            <div class="title-block col-3">Payment at</div>\
                                            <div class="content-block">' + response.data[0].payment_at + '</div>\
                                    </div>'
                            )
                        }
                        var stt = response.data[0].status;
                        console.log(stt);
                        if (stt == 1) {
                            $("#cartStt").text("Not confirmed");
                        }
                        if (stt == 2) {
                            $("#cartStt").text("Confirmed");
                        }
                        if (stt == 3) {
                            $("#cartStt").text("'Order confirmation(Delivery)");
                        }
                        if (stt == 4) {
                            $("#cartStt").text("Cancled by customer");
                        }
                        if (stt == 5) {
                            $("#cartStt").text("Out of stock");
                        }
                        if (stt == 6) {
                            $("#cartStt").text("Success delivery");
                        }
                        if (stt == 7) {
                            $("#cartStt").text("No recipient");
                        }

                    }
                })
            })
        })
    </script>
</body>

</html>
