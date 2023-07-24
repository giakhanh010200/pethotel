<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/userWelcome.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>User Information </title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-user-login">
        <h1 class="title-section-showww">User infomation</h1>

        <div class="show_body__section__user-login">
            <div class="col-lg-12 col-md-12 col-sm-12 wget-bg-user-login">
                <div class="col-lg-4 col-md-4 col-sm-12 avatar-user">
                    <img src="{{ URL::asset('image/user-icon.png') }}" class="user-avatar-pro">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 profile-user">
                    <form class="form-change-data-user" id="form-data-user">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label name-label">Username: </label>
                            <div class="form-section">
                                <input type="text" name="username" placeholder="Username"
                                    value="{{ $array_user[0]->username }}" class="form-control name-edit-control"
                                    id="edit-user-name" disabled>

                                <button type="button" class="btn-edit-name" id="btn-edit-name">
                                    <i class="fas fa-edit"> </i>Edit
                                </button>
                                <button type="reset" class="btn-click-edit btn-cancle-edit-name btn-cancle-edit-each"
                                    id="btn-cancle-edit-name">
                                    <i class="fas fa-times"> </i>Cancel
                                </button>
                            </div>
                            <div class="alert-error" id="err-uname-change">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label email-label">Email: </label>
                            <div class="form-section">
                                <input type="email" name="email" placeholder="Email"
                                    value="{{ $array_user[0]->email }}" class="form-control email-edit-control"
                                    id="edit-user-email" disabled>

                                <button type="button" class="btn-click-edit btn-edit-email" id="btn-edit-email">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="reset" class="btn-cancle-edit-email btn-cancle-edit-each"
                                    id="btn-cancle-edit-email">
                                    <i class="fas fa-times"> </i>Cancel
                                </button>
                            </div>
                            <div class="alert-error" id="err-email-change">
                            </div>
                        </div>
                        <hr>
                        <div class="block-btn-button-group">
                            <button type="reset" class="btn btn-warning btn-cancle-change">Cancle change</button>
                            <button type="submit" id="btn-save-change-acc" value="{{ $array_user[0]->id }}"
                                class="btn btn-success btn-save-change">Save
                                change</button>
                            <button type="button" data-toggle="modal" data-target="#formChangePass"
                                class="btn-edit-pass btn btn-primary" id="btn-edit-pass">
                                <i class="fas fa-edit"></i>Change password
                            </button>

                        </div>
                        <div>
                            <span class="alert-success alert" id="alert-success-data-user"></span>
                        </div>
                    </form>

                </div>
            </div>

            <div class="modal modal-show-change-password-modal" id="formChangePass">
                <div class="block-form-change">
                    <form id="modal-change-pass" class="form-toggle-passs">
                        <div class="modal-header">
                            <h4 class="modal-title">Change password</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-label">
                                <label for="old_password" class=" label-primary label-old-pass">Old Password:</label>
                                <input type="password" class="form-control" name="old_password" id="old_password"
                                    required>
                                <span class="alert-error" id="err-oldpass">
                                </span>
                            </div>
                            <div class="form-label">
                                <label for="new_password" class="label-primary label-old-pass">New Password:</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    required>
                                <span class="alert-error" id="err-newpass">
                                </span>
                            </div>
                            <div class="form-label">
                                <label for="confirm_password" class="label-primary label-old-pass">Confirm New
                                    Password:</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    id="confirm_password" required>
                                <span class="alert-error" id="err-confpass">
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-submit-change" class="btn btn-primary"
                                value="{{ $array_user[0]->id }}">Save</button>
                        </div>

                    </form>
                </div>
            </div>


            <div class="content-bottom-user-info">
                <div class="tab-change">
                    <button id="btn-address-change"
                        class="title-wget-user-address btn-change-tab active">Address</button>
                    <button id="btn-prd-ordered-change" class="title-wget-user-payment btn-change-tab">Product
                        Ordered</button>
                    <button id="btn-prd-boarding-change" class="title-wget-user-boarding btn-change-tab">Boarding
                        Accommodation</button>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 block-view-tab wget-user-address-info active"
                    id="forAddressTab">

                    <div class="box-wget-show-add" id="tableViewAddress">
                        @foreach ($array_add as $arrad)
                            <div class="col-lg-12 col-md-12 col-sm-12 block-add">
                                <div class="col-lg-10 col-md-10 col-sm-12 each-add-show"
                                    id="viewAdd{{ $arrad->id }}">

                                    <div class="wget-block-title">
                                        <div class="add-name-user-title">Name:
                                        </div>
                                        <div class="add-phone-user-title">
                                            Phone:
                                        </div>
                                        <div class="add-add-user-title">Address:
                                        </div>

                                    </div>
                                    <div class="wget-block-content">
                                        <div class="add-name-user-content" id="name-add-{{ $arrad->id }}">
                                            {{ $arrad->name }}</div>
                                        <div class="add-name-user-content" id="phone-add-{{ $arrad->id }}">
                                            {{ $arrad->phone }}</div>
                                        <div class="add-name-user-content" id="add-add-{{ $arrad->id }}">
                                            {{ $arrad->address }}</div>
                                    </div>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 btn-action-address"
                                    id="viewBtn{{ $arrad->id }}">
                                    <button class="btn-warning btn-address-edit" value="{{ $arrad->id }}"
                                        data-target="#modelEditAddress" data-toggle="modal">Edit</button>
                                    <button class="btn-danger btn-address-del" value="{{ $arrad->id }}"
                                        data-target="#modelDeleteAddress" data-toggle="modal">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="box-wget-title">

                        <button class="btn btn-primary btn-add-more-address" id="btn-show-add-modal"
                            data-target="#modelAddAddress" data-toggle="modal">
                            Add new address
                        </button>
                        <div id="success-message"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 block-view-tab wget-user-cart-order"
                    id="forProductOrderTab">
                    <div class="box-wget-title-order">

                        <span class="message-order" id="message-order"></span>
                    </div>
                    @if (count($array_cart) > 0)
                        <div class="table-show-orderd">
                            @php
                                $cart_id = '';
                                $i = 0;
                                $j = 0;
                                $fake_cart_id = $array_cart[0]->cart_id_render;
                            @endphp
                            @foreach ($array_cart as $arrc)
                                @if ($cart_id != $arrc->cart_id_render)
                                    <div class="show-order-create">
                                        @php
                                            $i = 0;
                                            $cart_id = $arrc->cart_id_render;
                                            $total_prices = 0;
                                        @endphp
                                        <div clas="block-header-with-id">
                                            <div class="cart_id_render show-off-id-cart">Order code:
                                                {{ $arrc->cart_id_render }}
                                            </div>
                                            @if ($arrc->status == 2)
                                                <button class="btn btn-primary btn-cancle-order-us"
                                                    id="btn-order-us-{{ $arrc->cart_id_render }}" data-toggle="modal"
                                                    data-target="#formConfirmCancleOrder"
                                                    value="{{ $arrc->cart_id_render }}">Cancle order</button>
                                            @elseif ($arrc->status == 3)
                                                <button class="btn btn-success btn-delivery-order"
                                                    value="{{ $arrc->cart_id_render }}">Your order are
                                                    being delivered</button>
                                                <span class="msg-for-button" id="span{{ $arrc->cart_id_render }}">(
                                                    <-- Press this button when you receive this order )</span>
                                                    @elseif ($arrc->status == 4)
                                                        <button class="btn btn-danger btn-order-cancled" disabled>You
                                                            have
                                                            cancled
                                                            this order </button>
                                                    @elseif ($arrc->status == 5)
                                                        <button class="btn btn-danger btn-order-cancled" disabled>Order
                                                            canceled due to
                                                            lack of stock</button>
                                                    @elseif ($arrc->status == 6)
                                                        <button class="btn btn-success btn-order-success"
                                                            disabled>Order
                                                            has
                                                            been
                                                            successfully delivered</button>
                                                    @elseif ($arrc->status == 7)
                                                        <button class="btn btn-danger btn-order-cancled" disabled>
                                                            Order canceled due to no recipient</button>
                                            @endif
                                        </div>
                                        @foreach ($array_cart as $arrcs)
                                            @if ($arrcs->cart_id_render == $arrc->cart_id_render)
                                                @php

                                                    $i = $i + 1;
                                                @endphp

                                                <div class="products-in-cart-show">
                                                    @php echo $i @endphp/ {{ $arrcs->product_name }}
                                                </div>
                                                @php
                                                    $total_prices = $total_prices + $arrcs->total_prices;
                                                @endphp
                                            @endif
                                        @endforeach


                                        <div class="ordered-price-show">Order price: @php
                                            echo number_format($total_prices, 0, '', '.');
                                        @endphp VND</div>
                                        <a target="_blank" class="btn-show-all-cart btn-details btn"
                                            id="btnDetailsCartPrd"
                                            href="{{ route('users.cart_details', ['id' => $arrc->cart_id_render]) }}"
                                            value="{{ $arrc->cart_id_render }} "><i class="fas fa-eye"></i>More
                                            details</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="msg-alert">You have not placed any orders yet</div>
                    @endif

                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 block-view-tab wget-user-boarding-order"
                    id="forBoardingTab">
                    <div class="widget-table-view-boarding">
                        @foreach ($array_board as $arrb)
                            <div class="each-data-boarding">
                                <div class="cart_id_render show-off-id-cart">Order code:
                                    {{ $arrb->cart_id }}
                                </div>
                                <div class="boarding-content boarding-user-name">Customer name: {{ $arrb->user_name }}
                                </div>
                                <div class="boarding-content boarding-type-Accommodation">Accommodation type:
                                    {{ $arrb->boarding_name }} </div>
                                <div class="boarding-content boarding-pet">Pet: {{ $arrb->pet_name }}</div>
                                <div class="boarding-content boarding-start">Check-in: {{ $arrb->start_date }}</div>
                                <div class="boarding-content boarding-end">Check-out: {{ $arrb->end_date }}</div>
                                <div class="boarding-content boarding-start">Status:
                                    @if ($arrb->status == 1)
                                        Confirmed
                                    @endif
                                    @if ($arrb->status == 2)
                                        Processing
                                    @endif
                                    @if ($arrb->status == 3)
                                        Done
                                    @endif
                                    @if ($arrb->status == 4)
                                        Cancled
                                    @endif
                                </div>
                                <a target="_blank"
                                    href="{{ route('users.boarding_details', ['id' => $arrb->cart_id]) }}"
                                    class="btn-show-all-boarding btn-details btn" id="btnDetailsCartBoarding"
                                    value="{{ $arrb->id }}"><i class="fas fa-eye"></i>More
                                    details</a>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
            {{-- model thêm sửa địa chỉ --}}
            <div class="modal modal-add-new" id="modelAddAddress">
                <div class="feature-box-add feature-box">
                    <form id="form-add-address" data-url="{{ route('users.user_address_add') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add new address</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idAdd" name="user_id"
                                value="{{ Session::get('user_id') }}">
                            <div class="form-label">
                                <label class="control-label" for="name">Name: </label>
                                <input type="text" name="name" placeholder="Full Name" id="fullnameAdd"
                                    required class="form-control">
                            </div>
                            <div class="form-label">
                                <label class="control-label" for="name">Phone: </label>
                                <input type="text" name="phone" placeholder="Phone Number" id="phoneAdd"
                                    required class="form-control">
                                <div class="alert alert-danger" id="errPhoneAdd"></div>
                            </div>
                            <div class="form-label">
                                <label class="control-label" for="name">Address: </label>
                                <input type="text" name="address" placeholder="Address" id="addresslAdd" required
                                    class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="btn-upload-address">Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="modal modal-add-edit" id="modelEditAddress">
                <div class="feature-box-edit feature-box">
                    <form id="form-edit-address">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Address</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idAddEdit">
                            <input type="hidden" id="idEdit" name="user_id"
                                value="{{ Session::get('user_id') }}">
                            <div class="form-label">
                                <label class="control-label" for="name">Name: </label>
                                <input type="text" name="name" placeholder="Full Name" id="fullnameEdit"
                                    required class="form-control">
                            </div>
                            <div class="form-label">
                                <label class="control-label" for="name">Phone: </label>
                                <input type="text" name="phone" placeholder="Phone Number" id="phoneEdit"
                                    required class="form-control">
                                <div class="alert alert-danger" id="errPhoneAdd"></div>
                            </div>
                            <div class="form-label">
                                <label class="control-label" for="name">Address: </label>
                                <input type="text" name="address" placeholder="Email" id="addressEdit" required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-edit-address">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal modal-add-edit" id="modelDeleteAddress">
                <div class="feature-box-edit feature-box">
                    <form id="form-del-address">
                        <div class="modal-header">
                            <h4 class="modal-title">Xóa địa chỉ</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body modal-body-block-delete">
                            <input type="hidden" id="idDell">
                            <div class="title-delete">
                                <div class="title-name">Name: </div>
                                <div class="title-phone">Phone: </div>
                                <div class="title-address">Address: </div>
                            </div>

                            <div class="content-delete">
                                <div class="add-name-del" id="fullnameDel">Name: </div>
                                <div class="add-phone-del" id="phoneDel">Phone: </div>
                                <div class="add-address-del" id="addressDel">Address: </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text warning">Are you sure you want to cancel this address?</div>
                            <button type="submit" class="btn btn-primary" id="btn-delete-address">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>


            {{-- cancle order --}}
            <div class="modal modal-confirm-cancle-order" id="formConfirmCancleOrder">
                <div class="toggle-box">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalCancleTitle"></h4>
                        <button type="button" class="close btn-cancle-form-order" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text warning">Are you sure you want to cancel this order?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-cancle-form-order"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnCancleOrderUs">Cancle</button>


                    </div>
                </div>
            </div>

            {{-- view details cart product --}}
            <div class="modal modal-showing-cart-prd" id="viewMoreCart">
                <div class="form-view-data">
                    <div class="data-field-list-group">
                        <div class="modal-header">
                            <h4 class="modal-title order-cart-id" id="cartId"></h4>
                            <button type="button" class="close btn-cancle-form-order" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- view details boarding cart --}}
            @include('footer-page')
        </div>
    </div>
    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/userInfo.js') }}"></script>
</body>

</html>
