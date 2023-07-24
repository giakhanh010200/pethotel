<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-cartService.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart Service</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="service-body">
        <h2 class="show-header-title">Cart Service</h2>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        @if (session('error'))
            <section class='alert alert-danger'>{{ session('error') }}</section>
        @endif
        <button class="btn btn-add-new" id="btnShowAddServiceCart">
            @if ($errors->has('user_id') || $errors->has('user_phone'))
                Cancle
            @else
                Create cart service
            @endif
        </button>
        {{-- view add service --}}
        <div class="block-panel-add-new-service-cart @if ($errors->has('id') || $errors->has('user_phone')) active @endif"
            id="viewAddService">
            <h3 class="title-block-addd">Create new cart service</h3>

            <form class="form-horizontal form-create-service" method="post"
                action="{{ route('admin.cart_service_add') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="form-label label-select-user">Choose user: </label>
                    <input list="chooseUser" required class="form-control user-id-serv" name="id" id="userIdServ">
                    <datalist id="chooseUser">
                        @foreach ($array_users as $arru)
                            <option class="choose-user" value="{{ $arru->id }}">{{ $arru->username }}</option>
                        @endforeach
                    </datalist>
                    @if ($errors->has('id'))
                        <span class="alert-error" id="err-name-regis">
                            {{ $errors->first('id') }}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label label-customer-name">Customer Name: </label>
                    <input type="text" name="user_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label label-customer-name">Customer Phone: </label>
                    <input type="text" name="user_phone" class="form-control" required>
                    @if ($errors->has('user_phone'))
                        <span class="alert-error" id="err-name-regis">
                            {{ $errors->first('user_phone') }}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label label-customer-name">Customer Email: </label>
                    <input type="email" name="user_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label label-customer-name">Choose services: </label>
                    <div class="list-service">
                        @foreach ($array_service as $arrs)
                            <div class="checkbox-each-services">
                                <input type="checkbox" name="service_id[]" class="checkboxes"
                                    value="{{ $arrs->id }}" required>{{ $arrs->name }}
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="form-group context-choose-pet">
                    <label class="form-label label-customer-name">Choose pet: </label>
                    @foreach ($pet as $pt)
                        <input type="radio" name="pet_id" value="{{ $pt->id }}" class="choose-pet"
                            required>{{ $pt->name }}</option>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="form-label label-customer-name">Number of pets: </label>
                    <input type="number" name="total_pet" id="totalPetInput" class="form-control">
                </div>
                <div class="show-price-total" id="totalPricePay"></div>
                <div class="block-button" id="blockButton">
                    <div class="block-btn-check">
                        <button type="reset" class="btn btn-primary" id="btnReset">Reset</button>
                        <button type="button" class="btn btn-primary" id="btnCheckPrice">Check price</button>
                        <button type="button" class="btn btn-primary btn-create-cart"
                            id="btnSubmitCreate">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            $("#btnSubmitCreate").hide();
        </script>
        {{-- view table service --}}
        <div class="list-view-cart-serv @if ($errors->has('id') || $errors->has('user_phone')) unactive @endif" id="tableListServ">
            <div class="row-title-header">
                <div class="title-cart title-cart-id col-3">Cart ID</div>
                <div class="title-cart title-cus-name col-2">Customer Name</div>
                <div class="title-cart title-service col-2">Service Name</div>
                <div class="title-cart title-service col-1">Pet</div>
                <div class="title-cart title-service col-1">Total pets</div>
                <div class="title-cart title-service col-2">Cart Price</div>
                <div class="title-cart title-service col-1">Action</div>
            </div>
            @php
                $cart_id = '';
                $cart_price = 0;
            @endphp
            @foreach ($array_cart as $arrc)
                @if ($arrc->cart_id != $cart_id)
                    <div class="row-content-cart-serv">
                        @php
                            $cart_id = $arrc->cart_id;
                            $cart_price = 0;
                        @endphp
                        <div class="content-row-cart content-cart-id col-3">
                            {{ $arrc->cart_id }}
                        </div>
                        <div class="content-row-cart content-cus-name col-2">
                            {{ $arrc->user_name }}
                        </div>
                        <script type="text/javascript">
                            const service_id_{{ $arrc->id }} = [];
                        </script>
                        <div class="content-row-cart content-service-name col-2">
                            @foreach ($array_cart as $arrcs)
                                @if ($arrcs->cart_id == $cart_id)
                                    <div class="serv-each-cart">
                                        {{ $arrcs->service_name }}
                                    </div>
                                    <script type="text/javascript">
                                        service_id_{{ $arrc->id }}.push({{ $arrcs->service_id }})
                                    </script>
                                    @php
                                        $cart_price = $cart_price + $arrcs->service_price;
                                    @endphp
                                @endif
                            @endforeach
                            <script type="text/javascript"></script>
                        </div>
                        <div class="content-row-cart content-pet-name col-1">
                            {{ $arrc->pets->name }}
                        </div>
                        <div class="content-row-cart content-pet-number col-1">
                            {{ $arrc->total_pet }}
                        </div>
                        <div class="content-row-cart content-pet-number col-2">
                            @php
                                $quantity = $arrc->total_pet;
                                $cart_price = $cart_price * $quantity;
                            @endphp
                            {{ number_format($cart_price, 0, '', '.') }} VND
                        </div>
                        <div class="content-row-cart block-panel-button col-1">
                            <button type="button" class="btn btn-success btn-view-data" data-toggle="modal"
                                data-target="#viewData{{ $arrc->id }}">View</button>
                            <button type="button" class="btn btn-warning btn-edit-data" data-toggle="modal"
                                data-target="#viewEdit{{ $arrc->id }}">Edit</button>

                        </div>
                    </div>
                    {{-- modal view cart --}}
                    <div class="modal modal-view-cart" id="viewData{{ $arrc->id }}">
                        <div class="feature-box-modal">
                            <div class="modal-header">
                                <h4 class="title-modal">Detail order {{ $arrc->cart_id }}</h4>
                                <button type="button" class="close-add-add close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="first-panel-modal">
                                    <h5 class="title-panel">User Information</h5>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">User booking:</div>
                                        <div class="user-info block-content">
                                            {{-- @foreach ($arrc->user_id as $arrcus)
                                                {{ $arrcus->username }}
                                            @endforeach --}}
                                            {{ $arrc->users->username }}
                                        </div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Customer name:</div>
                                        <div class="user-info block-content">{{ $arrc->user_name }}</div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Customer phone:</div>
                                        <div class="user-info block-content">{{ $arrc->user_phone }}</div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Customer email:</div>
                                        <div class="user-info block-content">{{ $arrc->user_email }}</div>
                                    </div>
                                </div>
                                <div class="second-panel-modal">
                                    <h5 class="title-panel">Serivce Information</h5>
                                    <div class="each-block-panel">
                                        <div class="serv-info block-title col-2">Serivce name:</div>
                                        <div class="serv-info block-content">
                                            {{-- @foreach ($arrc->user_id as $arrcus)
                                                {{ $arrcus->username }}
                                            @endforeach --}}
                                            @foreach ($array_cart as $arrcc)
                                                @if ($arrcc->cart_id == $cart_id)
                                                    <div class="each-serv-show"> {{ $arrcc->service_name }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Service price:</div>
                                        <div class="user-info block-content">
                                            {{ number_format($arrc->service_price, 0, '', '.') }} VND</div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Pet:</div>
                                        <div class="user-info block-content">{{ $arrc->pets->name }}</div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Total pet:</div>
                                        <div class="user-info block-content">{{ $arrc->total_pet }}</div>
                                    </div>
                                    <div class="each-block-panel">
                                        <div class="user-info block-title col-2">Cart total price:</div>
                                        <div class="user-info block-content">
                                            {{ number_format($cart_price, 0, '', '.') }} VND</div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default close-add-add"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                    {{-- modal edit carrt --}}
                    <div class="modal modal-edit-cart" id="viewEdit{{ $arrc->id }}">
                        <div class="feature-box-modal">
                            <form class="form-horizontal form-create-service" method="post"
                                action="{{ route('admin.update_cart_serv', ['id' => $arrc->cart_id]) }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h4 class="title-modal">Edit order {{ $arrc->cart_id }}</h4>
                                    <button type="button" class="close-add-add close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label label-select-user">Choose user: </label>
                                        <input list="chooseUser" value="{{ $arrc->user_id }}" required
                                            class="form-control user-id-serv" name="id" id="userIdServ">
                                        <datalist id="chooseUser">
                                            @foreach ($array_users as $arru)
                                                <option class="choose-user" value="{{ $arru->id }}">
                                                    {{ $arru->username }}</option>
                                            @endforeach
                                        </datalist>
                                        <span class="alert-error" id="err-name-edit">
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label-customer-name">Customer Name: </label>
                                        <input type="text" name="user_name" value="{{ $arrc->user_name }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label-customer-name">Customer Phone: </label>
                                        <input type="text" name="user_phone" value="{{ $arrc->user_phone }}"
                                            class="form-control" required>
                                        <span class="alert-error" id="err-phone-edit">
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label-customer-name">Customer Email: </label>
                                        <input type="email" name="user_email" value="{{ $arrc->user_email }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label-customer-name">Choose services: </label>
                                        <div class="list-service">
                                            @foreach ($array_service as $arrs)
                                                <div class="checkbox-each-services">
                                                    <input type="checkbox" name="service_id[]"
                                                        class="checkboxesEdit{{ $arrc->id }}"
                                                        value="{{ $arrs->id }}">{{ $arrs->name }}
                                                </div>
                                            @endforeach
                                            <script type="text/javascript">
                                                var checked = document.querySelectorAll(".checkboxesEdit" + {{ $arrc->id }})
                                                var data = (service_id_{{ $arrc->id }});
                                                for ($i = 0; $i < checked.length; $i++) {
                                                    for ($j = data.length - 1; $j >= 0; $j--) {
                                                        if (checked[$i].value == service_id_{{ $arrc->id }}[$j]) {

                                                            checked[$i].setAttribute("checked", "checked");
                                                        }
                                                    }
                                                    // console.log(checked[$i].value)

                                                }
                                                var checkboxesEdit = $(".checkboxesEdit" + {{ $arrc->id }});
                                                checkboxesEdit.change(function() {
                                                    var x = $('.checkboxesEdit{{ $arrc->id }}:checked').length;
                                                    console.log(x)
                                                    if (x > 0) {
                                                        $(".checkboxesEdit" + {{ $arrc->id }}).removeAttr('required');
                                                    } else {
                                                        $(".checkboxesEdit" + {{ $arrc->id }}).attr('required', 'required');
                                                    }

                                                    var checked = $(this).val();
                                                    if ($(this).is(':checked')) {
                                                        service_id_{{ $arrc->id }}.push(checked);
                                                    } else {
                                                        service_id_{{ $arrc->id }}.splice($.inArray(checked, service_id_{{ $arrc->id }}), 1);
                                                    }
                                                });
                                            </script>
                                        </div>

                                    </div>
                                    <div class="form-group context-choose-pet">
                                        <label class="form-label label-customer-name">Choose pet: </label>
                                        @foreach ($pet as $pt)
                                            <input type="radio" name="pet_id" value="{{ $pt->id }}"
                                                class="choose-pet" required
                                                @if ($arrc->pet_id == $pt->id) checked @endif>{{ $pt->name }}
                                            </option>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label-customer-name">Number of pets: </label>
                                        <input type="number" name="total_pet" value="{{ $arrc->total_pet }}"
                                            id="totalPetEdit{{ $arrc->id }}" class="form-control">
                                    </div>
                                    <div class="show-price-total" id="totalPricePay{{ $arrc->id }}"></div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                    <div class="block-button" id="blockButton">
                                        <div class="block-btn-check">
                                            <button type="reset" class="btn btn-primary"
                                                id="btnReset">Reset</button>
                                            <button type="button" class="btn btn-primary"
                                                id="btnCheckPrice{{ $arrc->id }}">Check
                                                price</button>
                                            <button type="button" class="btn btn-primary btn-create-cart"
                                                id="btnSubmitCreate{{ $arrc->id }}">Update</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        </form>
                    </div>
                    <script type="text/javascript">
                        $(".btn-create-cart").hide()
                        $("#btnCheckPrice{{ $arrc->id }}").click(function() {
                            url = "/admin/checking_price";
                            data = {
                                service_id: service_id_{{ $arrc->id }},
                                quantity: $("#totalPetEdit{{ $arrc->id }}").val()
                            }
                            console.log(data)
                            $.ajax({
                                type: "GET",
                                url: url,
                                data: data,
                                success: function(response) {
                                    console.log(response);
                                    var price = response.total_price.toLocaleString('it-IT', {
                                        style: 'currency',
                                        currency: 'VND'
                                    });
                                    document.getElementById("totalPricePay{{ $arrc->id }}").innerHTML =
                                        'Total price: ' +
                                        price
                                    $("#btnSubmitCreate{{ $arrc->id }}").show();
                                    $("#btnSubmitCreate{{ $arrc->id }}").prop("type", false);
                                    $("#btnSubmitCreate{{ $arrc->id }}").attr("type", "submit");
                                }
                            })
                        })
                    </script>
                @endif
            @endforeach
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            const service_id = [];
            var checkboxes = $('.checkboxes');
            checkboxes.change(function() {
                if ($('.checkboxes:checked').length > 0) {
                    checkboxes.removeAttr('required');
                } else {
                    checkboxes.attr('required', 'required');
                }

                var checked = $(this).val();
                if ($(this).is(':checked')) {
                    service_id.push(checked);
                } else {
                    service_id.splice($.inArray(checked, service_id), 1);
                }
                console.log(service_id);
            });

            $("#btnShowAddServiceCart").click(function() {
                $("#viewAddService").slideToggle(500);
                $("#tableListServ").slideToggle(500);
                var x = document.getElementById("btnShowAddServiceCart");
                if (x.innerHTML == "Cancle") {
                    x.innerHTML = "Create cart service"
                } else {
                    x.innerHTML = "Cancle"
                }
            })

            $("#btnCheckPrice").click(function() {
                url = "/admin/checking_price";
                data = {
                    service_id: service_id,
                    quantity: $("#totalPetInput").val()
                }
                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    success: function(response) {
                        console.log(response);
                        var price = response.total_price.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        });
                        document.getElementById("totalPricePay").innerHTML = 'Total price: ' +
                            price
                        $("#btnSubmitCreate").show();
                        $("#btnSubmitCreate").prop("type", false);
                        $("#btnSubmitCreate").attr("type", "submit");
                    }
                })
            })
        });
    </script>
</body>

</html>
