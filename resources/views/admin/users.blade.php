<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-user.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Users</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="users-body">
        <h2 class="show-header-title">Users</h2>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        @if (session('error'))
            <section class='alert alert-danger'>{{ session('error') }}</section>
        @endif
        <div class="search-product-content">
            <div class="search-product-content">
                <form class="form-search">
                    <input type="text" name="search" id="search-product" placeholder="Find user ...">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="session-show-add col-12">
            <div class="session-add-new-user col-lg-5 col-md-5 col-sm-12">
                <h3 class="title-add-new">Create new user</h3>
                <form class="form-horizontal form-add-new-user" method="post"
                    action="{{ route('users.user_process_register') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label label-group-add" for="username">Username:</label>
                        <input class="form-control" type="text" placeholder="Username ..." name="username">
                        @if ($errors->has('username'))
                            <span class="alert-error" id="err-name-regis">
                                {{ $errors->first('username') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label label-group-add" for="username">Email:</label>
                        <input class="form-control" type="email" placeholder="Email ..." name="email">
                        @if ($errors->has('email'))
                            <span class="alert-error" id="err-name-regis">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label label-group-add" for="username">Password:</label>
                        <input class="form-control" type="password" placeholder="Password ..." name="password">
                        @if ($errors->has('password'))
                            <span class=" alert-error" id="err-name-regis">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label label-group-add" for="username">Password confirm:</label>
                        <input class="form-control" type="password" placeholder="Password ..." name="password_confirm">
                        @if ($errors->has('password_confirm'))
                            <span class=" alert-error" id="err-name-regis">
                                {{ $errors->first('password_confirm') }}
                            </span>
                        @endif
                    </div>
                    <div class="block-button">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
            <div class="session-view-all-user col-lg-7 col-md-7 col-sm-12">
                <div class="block-list-user session-list">
                    @foreach ($users as $us)
                        <div class="block-each-user-showwwww">
                            <div class="block-content-shown col-lg-8 col-md-8 col-sm-12">
                                <div class="group-block">
                                    <div class="title-block col-3">Username: </div>
                                    <div class="content-block">{{ $us->username }}</div>
                                </div>
                                <div class="group-block">
                                    <div class="title-block col-3">Email: </div>
                                    <div class="content-block">{{ $us->email }}</div>
                                </div>
                            </div>
                            <div class="block-button-shown col-lg-4 col-md-4 col-sm-12">
                                @php
                                    $level = Session::get('level');
                                @endphp
                                <div class="block-button-left block-button">
                                    <button class="btn btn-primary btn-view-address" id="btnAddress{{ $us->id }}"
                                        data-toggle="modal" data-target="#formAdd{{ $us->id }}">View
                                        Address</button>
                                    @if ($level >= 4)
                                        <button class="btn btn-danger btn-delete-user" id="btnDel{{ $us->id }}"
                                            value="{{ $us->id }}">Delete</button>
                                    @endif
                                </div>
                                <div class="block-button-right block-button">
                                    <button class="btn btn-primary btn-view-cart-prd" id="btnCart{{ $us->id }}"
                                        data-toggle="modal" data-target="#viewCart{{ $us->id }}">Check all
                                        cart</button>

                                </div>

                            </div>
                        </div>
                        {{-- modal view all cart --}}
                        <div class="modal modal-view-cart" id="viewCart{{ $us->id }}">
                            <div class="feature-address-check">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ $us->username }} all ordered</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body modal-view-all-of-cart">
                                    <div class="first-section-modal section-cart section-product">
                                        <h5 class="title-section-body">Cart Product</h5>
                                        <div class="row-title-header ">
                                            <div class="title-row-cart title-cart-prd col-5">Cart ID</div>
                                            <div class="title-row-cart title-cart-prd col-3">Total Product Quantity
                                            </div>
                                            <div class="title-row-cart title-cart-prd col-4">Total Prices</div>
                                        </div>
                                        @php
                                            $cart_id = '';
                                            $full_price = 0;
                                            $total_quantity = 0;
                                            $all_price_prd = 0;
                                            $all_price_board = 0;
                                            $all_price_serv = 0;
                                            $all_price = 0;
                                        @endphp
                                        @foreach ($cart_prd as $arrc)
                                            @if ($arrc->user_id == $us->id)
                                                @if ($arrc->cart_id_render != $cart_id)
                                                    <div class="row-content-description">

                                                        @php
                                                            $cart_id = $arrc->cart_id_render;
                                                            $full_price = 0;
                                                            $total_quantity = 0;
                                                        @endphp
                                                        <div class="content-row-cart content-cart-prd col-5">
                                                            <a target="_blank"
                                                                href="{{ route('users.cart_details', ['id' => $arrc->cart_id_render]) }}">{{ $arrc->cart_id_render }}</a>
                                                        </div>
                                                        @foreach ($cart_prd as $arrcs)
                                                            @if ($arrcs->cart_id_render == $cart_id)
                                                                @php
                                                                    $full_price = $full_price + $arrcs->total_prices;
                                                                    $total_quantity = $total_quantity + $arrcs->quantity;

                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $all_price = $all_price + $full_price;
                                                            $all_price_prd = $all_price_prd + $full_price;
                                                        @endphp
                                                        <div class="content-row-cart content-cart-prd col-3 ">
                                                            {{ $total_quantity }} products
                                                        </div>
                                                        <div class="content-row-cart content-cart-prd col-4">
                                                            {{ number_format($full_price, 0, '', '.') }} VND
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        <div class="cart-prd-row-all all-prices-cart-prd">
                                            Total price of all cart product order:
                                            {{ number_format($all_price_prd, 0, '', '.') }} VND
                                        </div>
                                    </div>
                                    <div class="second-section-modal section-cart section-boarding">
                                        <h5 class="title-section-body">Cart Boarding</h5>
                                        <div class="row-title-header ">
                                            <div class="title-row-cart title-cart-board col-5">Cart ID</div>
                                            <div class="title-row-cart title-cart-board col-3">Boarding type</div>
                                            <div class="title-row-cart title-cart-board col-4">Total Prices</div>
                                        </div>
                                        @foreach ($cart_board as $arrb)
                                            @if ($arrb->user_id == $us->id)
                                                <div class="row-content-description">
                                                    <div class="content-row-cart content-cart-board col-5">
                                                        <a target="_blank"
                                                            href="{{ route('users.boarding_details', ['id' => $arrb->cart_id]) }}">{{ $arrb->cart_id }}</a>
                                                    </div>
                                                    <div class="content-row-cart content-cart-board col-3">
                                                        {{ $arrb->boarding_name }}
                                                    </div>
                                                    <div class="content-row-cart content-cart-board col-4">
                                                        {{ number_format($arrb->total_price, 0, '', '.') }} VND
                                                    </div>
                                                </div>
                                                @php
                                                    $all_price_board = $all_price_board + $arrb->total_price;
                                                    $all_price = $all_price + $arrb->all_price_board;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <div class="cart-prd-row-all all-prices-cart-board">
                                            Total price of all boarding:
                                            {{ number_format($all_price_board, 0, '', '.') }} VND
                                        </div>
                                    </div>
                                    <div class="third-section-modal section-cart section-service">
                                        <h5 class="title-section-body">Cart Service</h5>
                                        <div class="row-title-header ">
                                            <div class="title-row-cart title-cart-board col-5">Cart ID</div>
                                            <div class="title-row-cart title-cart-board col-3">Service Name</div>
                                            <div class="title-row-cart title-cart-board col-4">Total Prices</div>
                                        </div>

                                        @foreach ($cart_service as $arrs)
                                            @if ($arrs->user_id == $us->id)
                                                @if ($arrs->cart_id != $cart_id)
                                                    <div class="row-content-description">
                                                        @php
                                                            $cart_id = $arrs->cart_id;
                                                            // $all_price_serv = 0;
                                                            $full_price = 0;
                                                        @endphp
                                                        <div class="content-row-cart content-cart-serv col-5">
                                                            <a target="_blank"
                                                                href="{{ route('admin.service_one', ['id' => $arrs->cart_id]) }}">{{ $arrs->cart_id }}</a>
                                                        </div>
                                                        <div class="content-row-cart content-cart-serv col-3">
                                                            @foreach ($cart_service as $arrss)
                                                                @if ($arrss->cart_id == $cart_id)
                                                                    <div class="each-serv">{{ $arrss->service_name }}</div>
                                                                    @php
                                                                        $full_price = $full_price + $arrss->service_price;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="content-row-cart content-cart-board col-4">
                                                            @php
                                                                $full_price = $full_price * $arrs->total_pet;
                                                            @endphp
                                                            {{ number_format($full_price, 0, '', '.') }} VND
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="total-all-full-cart-price">
                                        Total amount paid: {{ number_format($all_price, 0, '', '.') }} VND
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                        {{-- modal add user --}}
                        <div class="modal modal-address-check" id="formAdd{{ $us->id }}">
                            <div class="feature-address-check">
                                <div class="modal-header">
                                    <h4 class="title-modal">User {{ $us->username }}</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body modal-scroll-overlay">
                                    <input type="hidden" id="uname{{ $us->id }}"
                                        value="{{ $us->username }}">
                                    <div class="block-button-add-user-address">
                                        <button class="btn btn-add-address btn-primary" data-toggle="modal"
                                            data-target="#formAddAddress" value="{{ $us->id }}">Add new
                                            address</button>
                                    </div>
                                    <div class="list-address-view" id="listAdd{{ $us->id }}">
                                        <form class="form-data-add" id="formAddCheck{{ $us->id }}">
                                            @foreach ($user_add as $ua)
                                                @if ($ua->user_id == $us->id)
                                                    <div class="group-each-address" id="group-{{ $ua->id }}">
                                                        <div class="group-address-user col-lg-10 col-md-10 col-sm-12">
                                                            <div class="group-block">
                                                                <label class="title-block label-control col-2">Name:
                                                                </label>
                                                                <input
                                                                    class="content-block other-input form-control inactive content-{{ $ua->id }}"
                                                                    disabled name="name"
                                                                    id="name{{ $ua->id }}"
                                                                    value="{{ $ua->name }}">
                                                            </div>
                                                            <div class="alert alert-danger"
                                                                id="errName{{ $ua->id }}"></div>
                                                            <div class="group-block">
                                                                <label class="title-block label-control col-2">Phone:
                                                                </label>
                                                                <input
                                                                    class="content-block other-input form-control inactive content-{{ $ua->id }}"
                                                                    disabled name="phone"
                                                                    id="phone{{ $ua->id }}"
                                                                    value="{{ $ua->phone }}">
                                                            </div>
                                                            <div class="alert alert-danger"
                                                                id="errPhone{{ $ua->id }}"></div>
                                                            <div class="group-block">
                                                                <label
                                                                    class="title-block  label-control  col-2">Address:
                                                                </label>
                                                                <input
                                                                    class="content-block other-input form-control inactive content-{{ $ua->id }}"
                                                                    disabled name="address"
                                                                    id="address{{ $ua->id }}"
                                                                    value="{{ $ua->address }}">
                                                            </div>
                                                            <div class="alert alert-danger"
                                                                id="errAddress{{ $ua->id }}"></div>
                                                        </div>
                                                        <div class="group-button-address col-lg-2 col-md-2 col-sm-12">
                                                            <div
                                                                class="group-btn group-btn-default group-default-{{ $ua->id }}">
                                                                <button type="button"
                                                                    class="btn-edit-add btn btn-warning"
                                                                    id="btnEdit{{ $ua->id }}"
                                                                    value="{{ $ua->id }}">Edit</button>
                                                                <button type="button"
                                                                    class="btn-delete-add btn btn-danger"
                                                                    id="btnDel{{ $ua->id }}"
                                                                    value="{{ $ua->id }}">Delete</button>
                                                            </div>
                                                            <div
                                                                class="group-btn group-btn-edit group-edit-{{ $ua->id }}">
                                                                <button type="button"
                                                                    class="btn-confirm-edit btn btn-warning"
                                                                    id="btnSubmitEdit{{ $ua->id }}"
                                                                    value="{{ $ua->id }}">Save</button>
                                                                <button type="reset"
                                                                    class="btn-cancle-edit-add btn btn-danger"
                                                                    id="btnCancleEdit{{ $ua->id }}"
                                                                    value="{{ $ua->id }}">Cancle</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-add-address-user" id="formAddAddress">
        <div class="form-add-new-address feature-address-check ">
            <form class="form-add" id="formAddress">
                <div class="modal-header">
                    <h3 class="title-modal" id="titleModalAddAdd"></h3>
                    <button type="button" class="close-add-add close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="addAddUserId">
                    <div class="group-add-add">
                        <label class="control-label" for="name">Name: </label>
                        <input type="text" name="name" class="form-control" id="formAddAddName">
                        <div class="alert alert-danger" id="errNameAdd"></div>
                    </div>
                    <div class="group-add-add">
                        <label class="control-label" for="name">Phone: </label>
                        <input type="text" name="phone" class="form-control" id="formAddAddPhone">
                        <div class="alert alert-danger" id="errPhoneAdd"></div>
                    </div>
                    <div class="group-add-add">
                        <label class="control-label" for="name">Address: </label>
                        <input type="text" name="address" class="form-control" id="formAddAddAddress">
                        <div class="alert alert-danger" id="errAddressAdd"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-add-add" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let scroll_to_bottom = document.getElementsByClassName('modal-scroll-overlay');
        scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
        $(".group-btn-edit").hide();
        $(document).ready(function() {
            $(".btn-edit-add").click(function() {
                var id = $(this).val();
                console.log(id);
                var x = document.querySelectorAll(".other-input");
                for (var i = 0; i < x.length; i++) {
                    x[i].value = x[i].defaultValue;
                }
                $(".group-btn-edit").hide();
                $(".group-btn-default").show();
                $(".other-input").attr("disabled", "disabled");
                $(".other-input").addClass("inactive");
                $(".content-" + id).removeClass("inactive");
                $(".content-" + id).removeAttr("disabled");
                $(".group-default-" + id).hide();
                $(".group-edit-" + id).show();
            })
        });
        $(".alert").hide();
        $(".btn-cancle-edit-add").click(function() {
            $(".other-input").attr("disabled", "disabled");
            $(".other-input").addClass("inactive");
            $(".group-btn-edit").hide();
            $(".group-btn-default").show();
        })
        $(".btn-confirm-edit").click(function() {
            var id = $(this).val();
            var url = "/users/user_address_update/" + id;
            var phone = $("#phone" + id).val();
            var name = $("#name" + id).val();
            var address = $("#address" + id).val();
            var err = false
            const regexPhone =
                /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(phone);
            if (regexPhone == false) {
                err = true;
                $("#errPhone" + id).show();
                document.getElementById("errPhone" + id).innerHTML = "*Invalid phone number";
            }
            if (name == "") {
                err = true;
                $("#errName" + id).show();
                document.getElementById("errName" + id).innerHTML = "*Invalid name";
            }
            if (address == "") {
                err = true;
                $("#errAddress" + id).show();
                document.getElementById("errAddress" + id).innerHTML = "*Invalid address";
            }
            if (err = false) {
                var data = {
                    name: $("#name" + id).val(),
                    phone: $("#phone" + id).val(),
                    address: $("#address" + id).val()
                }
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    success: function(response) {
                        console.log(response.user_address.name);
                        $("#name" + id).removeAttr("value");
                        $("#name" + id).attr("value", response.user_address.name)
                        $("#phone" + id).removeAttr("value");
                        $("#phone" + id).attr("value", response.user_address.phone)
                        $("#address" + id).removeAttr("value");
                        $("#address" + id).attr("value", response.user_address.address)
                        $(".other-input").attr("disabled", "disabled");
                        $(".other-input").addClass("inactive");
                        $(".group-btn-edit").hide();
                        $(".group-btn-default").show();
                    }
                });
            }
        })

        $(".btn-delete-add").click(function() {
            var id = $(this).val();
            var url = "/users/user_address_del/" + id;
            $.ajax({
                type: "DELETE",
                url: url,
                success: function(response) {
                    $("#group-" + id).remove();
                }
            })
        })
        $(".btn-add-address").click(function() {
            var id = $(this).val();
            $("#formAdd" + id).hide();
            var uname = $("#uname" + id).val();
            $("#addAddUserId").attr("value", id);
            $("#formAddress").show();
            document.getElementById("formAddAddPhone").removeAttr("value");
            document.getElementById("formAddAddName").removeAttr("value");
            document.getElementById("formAddAddAddress").removeAttr("value");
            document.getElementById("titleModalAddAdd").innerHTML = "Create new address for " + uname;
        })
        $(".close-add-add").click(function() {
            id = $("#addAddUserId").val();
            $("#formAdd" + id).show();

        })
        $("#formAddress").submit(function(e) {
            e.preventDefault();
            var phone = $("#formAddAddPhone").val();
            var name = $("#formAddAddName").val();
            var address = $("#formAddAddAddress").val();
            var err = false;
            const regexPhone =
                /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(phone);
            if (regexPhone == false) {
                err = true;
                $("#errPhoneAdd").show();
                document.getElementById("errPhoneAdd").innerHTML = "*Invalid phone number";
            }
            if (name == "") {
                err = true;
                $("#errNameAdd").show();
                document.getElementById("errNameAdd").innerHTML = "*Invalid name";
            }
            if (address == "") {
                err = true;
                $("#errAddressAdd").show();
                document.getElementById("errAddressAdd").innerHTML = "*Invalid address";
            }
            if (err == false) {
                id = $("#addAddUserId").val()
                url = "/users/user_address_add";
                var data = {
                    user_id: $("#addAddUserId").val(),
                    name: $("#formAddAddName").val(),
                    phone: $("#formAddAddPhone").val(),
                    address: $("#formAddAddAddress").val()
                }
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(response) {
                        $("#formAddCheck" + id).prepend(
                            '<div class="group-each-address" id="group-' + response.data.id +
                            '">\
                                                                    <div class="group-address-user col-lg-10 col-md-10 col-sm-12">\
                                                                        <div class="group-block">\
                                                                            <label class="title-block label-control col-2">Name:</label>\
                                                                            <input class="content-block other-input form-control inactive content-' +
                            response.data.id + '" disabled name="name" id="name' + response.data
                            .id + '" value="' + response.data.name +
                            '">\
                                                                        </div>\
                                                                        <div class="group-block">\
                                                                            <label class="title-block label-control col-2">Phone:</label>\
                                                                            <input class="content-block other-input form-control inactive content-' +
                            response.data.id + '" disabled name="name" id="phone' + response.data
                            .id + '" value="' + response.data.phone +
                            '">\
                                                                        </div>\
                                                                        <div class="group-block">\
                                                                            <label class="title-block label-control col-2">Address:</label>\
                                                                            <input class="content-block other-input form-control inactive content-' +
                            response.data.id + '" disabled name="name" id="address' + response.data
                            .id + '" value="' + response.data.address +
                            '">\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="group-button-address col-lg-2 col-md-2 col-sm-12">\
                                                                        <div class="group-btn group-btn-default group-default-' +
                            response
                            .data
                            .id +
                            '">\
                                                                            <button type="button" class="btn-edit-add btn btn-warning" id="btnEdit' +
                            response.data.id + '" value="' + response.data.id +
                            '">Edit</button>\
                                                                            <button type="button" class="btn-delete-add btn btn-danger" id="btnDel' +
                            response.data.id + '" value="' + response.data.id + '">Delete</button>\
                                                                        </div>\
                                                                        '
                        );
                        $("#formAdd" + id).show();
                        $("#formAddress").hide();
                    }
                })
            };
        })
    </script>
</body>

</html>
