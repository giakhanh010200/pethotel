<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/singleBoarding.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>{{ $singleBoard[0]->name }}</title>
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-product-info">
        <h1 class="title-section-showww">{{ $singleBoard[0]->name }}</h1>
        <div class="wget-image-slide wget-single-boarding">


            <div classs="row carousel-mx-auto mx-auto my-auto">
                <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner w-100" role="listbox">
                        @for ($i = 0; $i < 4; $i++)
                            <div
                                class="wget-col-image carousel-item col-lg-4 col-md-6 col-sm-12 @if ($i == 0) active @endif">
                                @if ($singleBoard[0]->name == 'Standard Boarding')
                                    <img src="{{ URL::asset('image/regular-boarding-') }}{{ $i + 1 }}.jpeg">
                                @endif
                                @if ($singleBoard[0]->name == 'Deluxe Boarding')
                                    <img src="{{ URL::asset('image/deluxe-boarding-') }}{{ $i + 1 }}.jpeg">
                                @endif
                            </div>
                        @endfor
                    </div>
                    <a class="carousel-control-prev carousel-control-h" href="#recipeCarousel" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-control-h" href="#recipeCarousel" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="bottom-block-content-view">
                <div class="content-booking-view-details col-lg-12- col-md-12">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="text-view-about"
                            @if ($singleBoard[0]->name == 'Standard Boarding') <p>
                                    Shared suites are the perfect environment for sociable pets that enjoy the wonders
                                    of communal living. Each of the shared rooms has single beds available for each pet
                                    staying there, and is attended around the clock by trained professionals.
                                </p>
                                <p>
                                    All of the boarding rooms are equipped with at least one air purifier to circulate
                                    clean air flow. Instead of televisions, soothing music is provided during the day
                                    for a more relaxed and enjoyable stay.
                                </p>
                                <p>
                                    At check-in, each pet is assigned an individual area to safely store extra food and
                                    any extra belongings required during their stay. If desired, please bring toys,
                                    bedding or other small items, which might make your pet feel more at home.
                                </p> @endif
                            @if ($singleBoard[0]->name == 'Deluxe Boarding') <p>
                                    For those requiring more exclusive accommodations, our suites will provide your
                                    pampered pet with a more spacious private room. We have TVs playing pet-friendly
                                    movies in each suite and offer private walks for bathroom breaks morning, noon and
                                    night.
                                </p>
                                <p>
                                    Bright and airy, each room has access to separate outdoor and sheltered indoor play
                                    space for exercise and socialization. Each suite has a nice homey atmosphere and
                                    mattress-style toddler sized bed.
                                </p>
                                <p>
                                    The single pet suites are separated from the standard rooms for a more peaceful,
                                    private environment and are as well perfect for multiple pets in a family. Rooms are
                                    cleaned and sanitized daily.
                                </p> @endif
                            </div>
                            <div class="block-details">
                                <div class="details-section-view">
                                    <h2 class="section-title">Details</h2>
                                    @if ($singleBoard[0]->name == 'Standard Boarding')
                                        <ul class="details-standart-view">
                                            <li class="item-details amenities-details">Amenities: classical music,
                                                climate
                                                control</li>
                                            <li class="item-details view-details">View: courtyard</li>
                                            <li class="item-details size-details">Size: 16m²</li>
                                            <li class="item-details bed-details">Bed Type: donut bed</li>
                                        </ul>
                                    @endif
                                    @if ($singleBoard[0]->name == 'Deluxe Boarding')
                                        <ul class="details-deluxe-view">
                                            <li class="item-details amenities-details">Amenities: climate control, live
                                                cameras</li>
                                            <li class="item-details view-details">View: courtyard</li>
                                            <li class="item-details size-details">Size: 16m²</li>
                                            <li class="item-details bed-details">Bed Type: bed with mattress and pillows
                                            </li>
                                        </ul>
                                    @endif
                                    <hr>
                                    <div class="price-details">Price:
                                        <span>{{ number_format($singleBoard[0]->price, 0, '.', '.') }}</span>/per night
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="block-form-check-booking">
                                <div class="form-booking-view">
                                    <div class="section-booking-check-date">
                                        <h2 class="section-title-form">
                                            Reservation Form
                                        </h2>
                                        <form class="form-reservation" id="formReservation" action="{{ route('users.reservationConfirm') }}" method="get">
                                            <div class="form-group form-booking form-select-store">
                                                <input type="hidden" name="boarding_id" value = "{{ $singleBoard[0]->id }}">
                                                <label for="store" class="control-label label-booking-form">
                                                    Store:
                                                </label>
                                                {{-- <input list="chooseStore" class="form-control" id="list-store-check"> --}}
                                                <select name="store" required class="slect-store select-booking-form"
                                                    id="chooseStore" placeholder="Choose booking store...">
                                                    <option class="option-choose" selected>Choose booking store...
                                                    </option>
                                                    @foreach ($shopAddress as $sa)
                                                        <option class="option-choose" value="{{ $sa->id }}">
                                                            {{ $sa->address }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <div class="alert alert-danger" id="alertStore"></div>
                                            </div>
                                            <div class="form-group form-booking form-select-store">
                                                <label for="pet" class="control-label label-booking-form">
                                                    Pet:
                                                </label>
                                                <br>
                                                <select required name="pet"
                                                    class="select-pet-type pet-type control-label" id="choosePet">
                                                    <option class="pet-selected" selected>Select type of pet</option>
                                                    @foreach ($array_pet as $pet)
                                                        <option class="pet-selected" value="{{ $pet->id }}">
                                                            {{ $pet->name }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <div class="alert alert-danger" id="alertPet"></div>
                                            </div>
                                            <div class="form-group form-booking form-input-start">
                                                <label for="start_date" class="control-label label-booking-form">
                                                    Check-in date"
                                                </label>
                                                <input type="date" name="start_date" id="startDate" required
                                                    class="form-control" placeholder="Choose start date...">
                                                <br>
                                                <div class="alert alert-danger" id="alertStartDate"></div>
                                            </div>
                                            <div class="form-group form-booking form-input-end">
                                                <label for="end_date" class="control-label label-booking-form">
                                                    Check-out
                                                    date </label>
                                                <input type="date" name="end_date" id="endDate" required
                                                    class="form-control" placeholder="Choose start date...">
                                                <br>
                                                <div class="alert alert-danger" id="alertEndDate"></div>
                                            </div>
                                            <div class="form-group form-booking form-button-check">
                                                <button type="button" value="{{ $singleBoard[0]->id }}"
                                                    class="btn btn-check-reservation btn-reservation"
                                                    id="btnReservation">Check availablity</button>
                                            </div>
                                            <div class="alert" id="alertCheck"></div>
                                            <div class="form-group form-booking form-after-check-success"
                                                id="formAfterSuccess">

                                                <label for="quantity" class="control-label label-booking-form">Number
                                                    of pets: </label>
                                                <select name="quantity"class="select-number-required number-pet" id="select-number"
                                                    required>

                                                </select>
                                                <button type="submit" value="{{ $singleBoard[0]->id }}"
                                                    class="btn btn-submit-form btn-reservation">Confirm
                                                    reservation</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script type="text/javascript">
        // $('#recipeCarousel').carousel({
        //     interval: 1000
        // })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(".alert").hide();
        })
        new TomSelect("#chooseStore", {
            create: false,
            sortField: {
                field: "text",
                direction: "desc"
            }
        });

        $('.carousel .carousel-item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 2; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

        $("#btnReservation").click(function() {

            var id = $(this).val();
            var url = "/checkingReservation/";
            console.log(url);
            var store = $("#chooseStore").val();
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            var pet = $("#choosePet").val();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            var err = false;
            today = yyyy + '-' + mm + "-" + dd;
            var check = parseInt(store);
            var checkpet = parseInt(pet);
            if (isNaN(checkpet)) {
                $("#alertPet").show();
                err = true;
                document.getElementById("alertPet").innerHTML = "* Select pet is required "
            } else {
                $("#alertPet").hide();
            }
            if (isNaN(check)) {
                $("#alertStore").show();
                err = true;
                document.getElementById("alertStore").innerHTML = "* Select store is required "
            } else {
                $("#alertStore").hide();
            }
            if (startDate == "") {
                $("#alertStartDate").show();
                err = true;
                document.getElementById("alertStartDate").innerHTML = "* Select check in date is required"
            } else {
                $("#alertStartDate").hide();
            }

            if (startDate < today) {
                $("#alertStartDate").show();
                err = true;
                document.getElementById("alertStartDate").innerHTML =
                    "* Check in date must be today or in the future"
            } else {
                $("#alertStartDate").hide();
            }
            if (startDate > endDate && endDate != "" || endDate < today) {
                document.getElementById("alertEndDate").innerHTML =
                    "* Check out date must must be greater than check in date";
                $("#alertEndDate").show();
                err = true;
            } else if (endDate == "") {
                $("#alertEndDate").show();
                err = true;
                document.getElementById("alertEndDate").innerHTML = "* Select check out date is required"
            } else {
                $("#alertEndDate").hide();
            }
            if (err == false) {
                data = {
                    id: id,
                    store: store,
                    startDate: startDate,
                    endDate: endDate,
                    pet: pet
                }
                console.log(data)
                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    success: function(response) {
                        $("#select-number").html("");
                        if (response.count > 0) {
                            $("#formAfterSuccess").show();
                            $("#alertCheck").show();

                        } else {
                            $("#formAfterSuccess").hide();
                            $("#alertCheck").show();
                        }
                        document.getElementById("alertCheck").innerHTML = response.msg;
                        if (response.log == 200) {

                            $("#alertCheck").removeClass("alert-success");
                            $("#alertCheck").addClass("alert-danger");

                        } else {
                            $("#alertCheck").removeClass("alert-danger");
                            $("#alertCheck").addClass("alert-success");
                        }
                        for (var i = 1; i <= response.count; i++) {
                            $("#select-number").append(
                                '<option class="choose-number-pet" value="' + i + '">' + i +
                                '</option>'
                            )
                        }
                        console.log(response.count)
                    }
                })
            }
        });
        $("#btnSubmitToLogin").click(function() {
            window.location.href = '{{ route('users.user_login') }}';
        });
        $("#btnClosePopup").click(function() {
            $("#submitToLogin").fadeOut(300);
        });
        $("#formAfterSuccess").hide();
    </script>
</body>

</html>
