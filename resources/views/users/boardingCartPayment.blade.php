<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/boardingCart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart Boarding Payment</title>
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-product-info">
        <h1 class="title-section-showww">Booking Confirmation</h1>
        <div class="block-section section-booking-first col-lg-9 col-md-9 col-sm-12">
            <div class="section-booking-details">
                <div class="block-widget-1">
                    <h2 class="title-wg">Booking details</h2>


                    <div class="form-label label-booking-details">
                        <label for="boarding">Accommodation type: </label>
                        <input type="text" disabled name="boarding" id="boardingBooking"
                            class="form-control quantity-booking content-widget" value="{{ $boarding[0]->name }}">
                    </div>
                    <div class="form-label label-booking-details">
                        <label for="quantity">Total accommodation: </label>
                        <input type="text" disabled name="quantity" id="quantityBooking"
                            class="form-control quantity-booking content-widget" value="{{ $total_pet }}">
                    </div>
                    <div class="form-label label-booking-details">
                        <label for="pet">Pet: </label>
                        <input type="text" disabled name="pet" id="petBooking"
                            class="form-control quantity-booking content-widget" value="{{ $pet[0]->name }}">
                    </div>
                    <div class="form-label label-booking-details">
                        <label for="start_date">Check-in : </label>
                        <input type="date" disabled name="start_date" id="checkinBooking"
                            class="form-control quantity-booking content-widget" value="{{ $start_date }}">
                    </div>
                    <div class="form-label label-booking-details">
                        <label for="end_date">Check-out : </label>
                        <input type="date" disabled name="end_date" id="checkoutBooking"
                            class="form-control quantity-booking content-widget" value="{{ $end_date }}">
                    </div>
                    <div class="form-label label-booking-details">
                        <label for="store">Store booking address: </label>
                        <input type="text" disabled name="store" id="storeBooking"
                            class="form-control address-booking content-widget" value="{{ $store[0]->address }}">
                    </div>
                    <div class="map-store-check">
                        {!! $store[0]->map_place !!}
                    </div>
                </div>
                <div class="block-widget-2">
                    <h2 class="title-wg">Your information</h2>
                    <div class="form-label label-booking-user">
                        <label for="name">Customer name: </label>
                        <input type="text" name="user_name" id="nameBooking"
                            class="form-control name-booking content-widget">
                        <div id="erName" class="alert-check alert alert-danger"></div>
                    </div>
                    <div class="form-label label-booking-user">
                        <label for="phone">Customer phone: </label>
                        <input type="text" name="user_phone" id="phoneBooking"
                            class="form-control phone-booking content-widget">
                        <div id="erPhone" class="alert-check alert alert-danger"></div>
                    </div>
                    <div class="form-label label-booking-user">
                        <label for="email">Customer email: </label>
                        <input type="email" name="user_email" id="emailBooking"
                            class="form-control email-booking content-widget">
                        <div id="erEmail" class="alert-check alert alert-danger"></div>
                    </div>
                </div>
            </div>
            <div class="block-widget-3">
                @php
                    $total_price = $total_pet * $boarding[0]->price;
                @endphp
                <div class="block-total-price-show">
                    Total price:
                    @php
                        echo number_format($total_price, 0, '', '.');
                    @endphp
                    VNĐ
                </div>
                <button class="btn btn-payment" id="btnConfirmBooking">Book now</button>
            </div>
            <div class="modal modal-booking-forms" id="confirmBooking">
                <div class="block-chain-widget">
                    <form class="form-horizontal form" id="formConfirm">
                        @csrf
                        <div class="modal-header">
                            <h1 class="title-modal">Terms & Conditions</h1>
                            <button type="button" id="dismissModal"class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="section-terms">
                                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                <p>Integer ut feugiat nisl. Vestibulum molestie viverra malesuada. Curabitur sit
                                    amet
                                    mauris venenatis, vulputate libero eu, dignissim est. Quisque ut convallis sem,
                                    in
                                    efficitur justo. Etiam semper erat est, et fermentum urna condimentum et.
                                    Aliquam
                                    faucibus lectus vitae auctor blandit. Vestibulum tempus semper turpis, vitae
                                    porttitor neque volutpat at. Phasellus in imperdiet magna. Fusce ultrices
                                    posuere
                                    eli.</p>
                            </div>
                            <div class="section-terms">
                                <h3>Orci varius natoque penatibus et magnis dis parturient montes, nascetur
                                    ridiculus
                                    mus.</h3>
                                <p>Nulla efficitur vel ipsum sit amet eleifend. Proin velit elit, scelerisque sit
                                    amet
                                    lectus eget, bibendum iaculis ipsum. Sed tempor, metus sed blandit consequat,
                                    tellus
                                    felis finibus arcu, vel feugiat arcu nibh at ipsum. Maecenas consectetur
                                    faucibus
                                    leo, eget dapibus sapien posuere a. Ut pretium lacinia elit, quis auctor dui
                                    aliquet
                                    quis. Nulla rhoncus vestibulum diam in venenatis. Cras fermentum enim eu ante
                                    dignissim semper. Vestibulum sed pulvinar lacus, at tristique quam. Phasellus
                                    condimentum nunc metus, a interdum velit gravida eget. Nulla nec justo ultrices,
                                    laoreet tortor et, lobortis dui. Praesent semper, ipsum ac venenatis blandit,
                                    turpis
                                    ipsum vehicula metus, id convallis lectus quam pellentesque sapien. Etiam nulla
                                    nisi, tempor tempor elementum non, condimentum a massa. Suspendisse non odio sit
                                    amet augue consequat malesuada sed nec eros. Quisque vitae lacus tristique,
                                    lacinia
                                    sapien ut, imperdiet augue. Nulla vitae libero ac risus volutpat accumsan
                                    facilisis
                                    a felis.</p>
                            </div>
                            <div class="section-terms">
                                <h3>Donec congue tortor in nisi congue, eu pharetra ex finibus.</h3>
                                <p>Maecenas a volutpat elit. Praesent vel orci ut lectus porttitor rhoncus. Etiam
                                    euismod tincidunt sem. Cras maximus est at ipsum tristique consectetur.
                                    Vestibulum
                                    massa ligula, porta ut tempus in, sollicitudin in ligula. Nulla facilisi.
                                    Curabitur
                                    quis imperdiet mi, in euismod purus. Pellentesque dignissim mattis lorem sit
                                    amet
                                    consectetur. Fusce eget elit nunc.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input type="checkbox" id="checkboxConfirm" class="checkbox-confirm" required>I've
                                read
                                and accept the terms & conditions *
                            </div>
                            <button type="button" id="btn-submit-payment" class="btn btn-payment">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @include('footer-page')
    </div>
    </div>
    <div class="modal modal-success-payment-inform" id="modal-success-inform">
        <div class="block-section-modal">
            <div class="modal-header">
                <h1>You have successfully placed your accommodation !!!</h1>
                <h3>Thank you !!! Have a nice day!</h3>
            </div>
            <div class="modal-body">
                <a class="btn btn-primary btn-back-homepage" href="{{ route('welcome') }}">Go to
                    homepage</a>
                <a class="btn btn-success btn-show-order" href="{{ route('users.user_info') }}">Check your
                    boarding accommodation</a>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var lourl = "{{ route('users.user_info') }}";
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/boardingPayment.js') }}"></script>
</body>

</html>
