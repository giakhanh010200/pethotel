<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cartBoardingAdmin.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart Boarding</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="boarding-body">
        <h2 class="show-header-title">Cart Boarding</h2>
        <section class='alert alert-success' id="alert-info"></section>
        <div class="session-view-all-cart">
            <div class="search-cart-content">
                <form class="form-search-data">
                    <div class="form-search">
                        <input type="text" name="search" placeholder="Search order ....">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="form-sort">
                        @php
                            $array_text = ['Confirmed', 'Processing','Done', 'Cancled', 'Out dated'];
                        @endphp
                        <select name="sort" class="sort-by-status" id="statusSortSelect">
                            <option value="0" selected>All cart</option>
                            @php
                                for ($i = 0; $i < 5; $i++) {
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
            <div class="table-view-list-data">
                <div class="section-title-header">
                    <div class="col-2 header-title orderid-header">Boarding ID</div>
                    <div class="col-2 header-title boarding-header">Boarding Name</div>
                    <div class="col-2 header-title user-header">User Name</div>
                    <div class="col-1 header-title checkin-header">Check-in</div>
                    <div class="col-1 header-title checkout-header">Check-out</div>
                    <div class="col-1 header-title pet-header">Pet</div>
                    <div class="col-1 header-title totalpet-header">Total pet</div>
                    <div class="col-1 header-title totalprice-header">Total price</div>
                    <div class="col-1 header-title action-header">Action</div>
                </div>
                @foreach ($array_cart as $arrc)
                    <div class="section-content-data-list">
                        <div class="col-2 content-text orderid-content">{{ $arrc->cart_id }}</div>
                        <div class="col-2 content-text boarding-content">{{ $arrc->boarding_name }}</div>
                        <div class="col-2 content-text user-content">{{ $arrc->user_name }}</div>
                        <div class="col-1 content-text checkin-content">{{ $arrc->start_date }}</div>
                        <div class="col-1 content-text checkout-content">{{ $arrc->end_date }}</div>
                        <div class="col-1 content-text pet-content">{{ $arrc->pet_name }}</div>
                        <div class="col-1 content-text totalpet-content">{{ $arrc->total_pet }}</div>
                        <div class="col-1 content-text totalprice-content">
                            {{ number_format($arrc->total_price, 0, '', '.') }} VND</div>
                        <div class="col-1 content-text action-content">
                            <button class="btn-view-details btn btn-primary" data-toggle="modal"
                                data-target="#viewOneBoarding" value="{{ $arrc->id }}">Details</button>
                                @php
                                    $level = Session::get('level');
                                    $status = $arrc->status;
                                @endphp
                                @if ($level < 3)
                                    @if ($status == 1)
                                        <button class="btn btn-success btn-change-start" value="{{ $arrc->id }}"
                                            id="btnConfirmStart{{ $arrc->id }}">Start</button>
                                    @endif
                                    @if ($status == 1 || $status == 2)
                                        <button class="btn btn-success btn-change-done" value="{{ $arrc->id }}"
                                            id="btnConfirmDone{{ $arrc->id }}">Complete</button>
                                    @endif
                                    @if ($status == 3)
                                        <button class="btn btn-success" disabled value="{{ $arrc->status }}"
                                            id="btnDone{{ $arrc->id }}">Done</button>
                                    @endif
                                    @if ($status == 4)
                                        <button class="btn btn-danger" id="btnCancled{{ $arrc->id }}" disabled
                                            value="{{ $arrc->id }}">
                                            Cancled
                                        </button>
                                    @endif
                                    @if ($status < 3)
                                        <button class="btn btn-danger btn-cancle-boarding"
                                            id="btnActionCancle{{ $arrc->id }}" value="{{ $arrc->id }}">
                                            Cancle
                                        </button>
                                    @endif
                                @endif
                                @if ($level >= 3)
                                    <button class="btn btn-success btn-change-admin{{ $arrc->id }}"
                                        @if ($arrc->status == 1) disabled @endif value="1"
                                        id="btnConfirmStart{{ $arrc->id }}">Confirmed</button>
                                    <button class="btn btn-success btn-change-admin{{ $arrc->id }}" value="2"
                                        @if ($arrc->status == 2) disabled @endif
                                        id="btnConfirmDone{{ $arrc->id }}">On progress</button>
                                    <button class="btn btn-success btn-change-admin{{ $arrc->id }}"
                                        @if ($arrc->status == 3) disabled @endif value="3"
                                        id="btnDone{{ $arrc->id }}">Done</button>
                                    @if ($status == 4)
                                        <button class="btn btn-danger" id="btnCancled{{ $arrc->id }}" disabled
                                            value="4">
                                            Cancled
                                        </button>
                                    @endif
                                    @if ($status != 4)
                                        <button class="btn btn-danger btn-change-admin"
                                            id="btnActionCancle{{ $arrc->id }}" value="4">
                                            Cancle
                                        </button>
                                    @endif
                                @endif
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#alert-info").hide();


                            $(".btn-change-admin{{ $arrc->id }}").click(function() {
                                url = "/admin/change_stt_processing/" + {{ $arrc->id }};
                                status = $(this).val();
                                _this = $(this)
                                data = {
                                    status: status
                                }
                                $.ajax({
                                    type: "PUT",
                                    url: url,
                                    data: data,
                                    success: function(response) {
                                        console.log(response.id);
                                        console.log(response.boarding.cart_id);
                                        $(".btn-change-admin{{ $arrc->id }}").prop("disabled", false);
                                        _this.attr("disabled", "disabled");
                                        $("#alert-info").show();
                                        document.getElementById("alert-info").innerHTML = response.msg
                                        if (status == 4) {
                                            document.getElementById("btnActionCancle" + {{ $arrc->id }})
                                                .innerHTML = "Cancled"
                                        } else {
                                            document.getElementById("btnActionCancle" + {{ $arrc->id }})
                                                .innerHTML = "Cancle";
                                        }
                                    }
                                })
                            })
                        })
                    </script>
                @endforeach
            </div>
            @if (count($array_cart) > 10)
                {!! $array_cart->links('layout.pagination') !!}
            @endif
        </div>
    </div>
    <div class="modal modal-view-one modal-boarding-details" id="viewOneBoarding">
        <div class="block-widget-details">
            <div class="modal-header">
                <h3 class="modal-title" id="cartTitle"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="each-block">
                    <div class="title-block col-3">Boarding type:</div>
                    <div class="content-block" id="cartBoardType"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Boarding price:</div>
                    <div class="content-block" id="cartBoardPrice"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Check-in:</div>
                    <div class="content-block" id="cartCheckin"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Check-out:</div>
                    <div class="content-block" id="cartCheckout"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Pet:</div>
                    <div class="content-block" id="cartPet"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Number of pets:</div>
                    <div class="content-block" id="cartQuantity"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Boarding at:</div>
                    <div class="content-block" id="cartStore"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Customer name:</div>
                    <div class="content-block" id="cartCusName"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Customer phone:</div>
                    <div class="content-block" id="cartCusPhone"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Customer email:</div>
                    <div class="content-block" id="cartCusEmail"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Total price:</div>
                    <div class="content-block" id="cartPrice"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Status</div>
                    <div class="content-block" id="cartStt"></div>
                </div>
                <div class="each-block">
                    <div class="title-block col-3">Created at</div>
                    <div class="content-block" id="cartCreated"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn-view-details").click(function() {
            id = $(this).val();
            url = "/admin/boarding_render/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response.data)
                    $("#cartTitle").text(response.data.cart_id);
                    $("#cartBoardType").text(response.data.boarding_name);
                    $("#cartBoardPrice").text(response.data.boarding_price);
                    $("#cartCheckin").text(response.data.start_date);
                    $("#cartCheckout").text(response.data.end_date);
                    $("#cartPet").text(response.data.pet_name);
                    $("#cartQuantity").text(response.data.total_pet);
                    $("#cartStore").text(response.data.store_add);
                    $("#cartCusName").text(response.data.user_name);
                    $("#cartCusPhone").text(response.data.user_phone);
                    $("#cartCusEmail").text(response.data.user_email);
                    $("#cartPrice").text(response.data.total_price);
                    $("#cartCreated").text(response.data.created_at);
                    if(response.data.status == 1){
                        $("#cartStt").text("Confirmed")
                    }
                    if(response.data.status == 2){
                        $("#cartStt").text("On Boarding")
                    }
                    if(response.data.status == 3){
                        $("#cartStt").text("Complete Boarding")
                    }
                    if(response.data.status == 4){
                        $("#cartStt").text("Cancled")
                    }
                }
            })


        })
        $(document).ready(function() {
            $(".btn-change-start").click(function() {
                id = $(this).val();
                data = {
                    status: 2
                }
                _this = $(this);
                url = "/admin/change_stt_processing/" + id;
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    success: function(response) {
                        console.log("confirm")
                        _this.remove();
                        $("#alert-info").show();
                        document.getElementById("alert-info").innerHTML = response.msg
                    }
                })

            })
            $(".btn-change-done").click(function() {
                id = $(this).val();
                data = {
                    status: 3
                }
                _this = $(this);
                url = "/admin/change_stt_processing/" + id;
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    success: function(response) {
                        console.log("confirm")
                        document.getElementById("btnConfirmStart" + id).remove();
                        document.getElementById("btnConfirmDone" + id).innerHTML = "Done";
                        _this.attr("disabled", "disabled");
                        _this.removeClass("btn-change-done");
                        document.getElementById("btnActionCancle" + id).remove();
                        $("#alert-info").show();
                        document.getElementById("alert-info").innerHTML = response.msg
                    }
                })

            })
            $(".btn-cancle-boarding").click(function() {
                id = $(this).val();
                url = "/admin/change_stt_processing/" + id;
                data = {
                    status: 4
                }
                _this = $(this);
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    success: function(response) {
                        console.log(response.boarding)
                        document.getElementById("btnConfirmStart" + id).remove();
                        document.getElementById("btnConfirmDone" + id).remove();
                        document.getElementById("btnActionCancle" + id).innerHTML = "Cancled";
                        _this.attr("disabled", "disabled");
                        _this.removeClass("btn-cancle-boarding");
                        $("#alert-info").show();
                        document.getElementById("alert-info").innerHTML = response.msg
                    }
                })
            })
        })
    </script>
</body>

</html>
