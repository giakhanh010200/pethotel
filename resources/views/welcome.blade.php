<!DOCTYPE html>
<html lang="en">

<head>

    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/main-welcome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Moonlight Hotel</title>
</head>

<body>
    @include('header-page')
    <div class="background-section">
        <div id="fullpage" class="full-home-page">

            <div class="home-page-image">
                <section class="vertical-scrolling">
                    <div class="__section-vertical_standard_boarding">
                        <div class="box-section-review">
                            <div class="sidebar-boarding-policy-menu content-left">
                                <ul class="menu-left-boarding-tab" id="boarding-sidebar">
                                    <li class="boarding-sidebar-item slide-active" id="cat-item-boarding">
                                        <button class="btn btn-slide-show-cat" id="btnshowCatSlide">Cat</button>
                                    </li>
                                    <li class="boarding-sidebar-item" id="dog-item-boarding">
                                        <button class="btn btn-slide-show-dog" id="btnshowDogSlide">Dog</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="main-slide-show-boarding-policy content-right">
                                <div class="slide-show-for-cat activeSlide__Show" id="catSlideView">
                                    <div class="slide-show-container-cat">
                                        <div class="catSlides cat-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Schedule a visit
                                            </div>
                                            <img src="{{ URL::asset('image/cat-slide-1.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                Visiting the intended facility before you decide to board your cat there
                                                for
                                                multiple days is imperative. You want to ensure your furry friend is in
                                                a
                                                clean, well-managed, organized accommodation where she is exceptionally
                                                cared for. Ideally, the facility will have spacious cages equipped with
                                                clean bedding, toys, and litter boxes, space for cats to play outside
                                                the
                                                kennel, and friendly, attentive kennel staff. The cat kennels should be
                                                separated from the dog kennels to minimize stress. A boarding facility
                                                associated with a veterinary clinic in the same building is an excellent
                                                bonus. Should anything go wrong, your furry friend will be in an ideal
                                                place
                                                to receive the care she needs.
                                            </div>
                                        </div>
                                        <div class="catSlides cat-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Do a trial run
                                            </div>
                                            <img src="{{ URL::asset('image/cat-slide-2.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                Before dropping your cat off and leaving for a two-week vacation without
                                                warning, consider taking her to the boarding facility for a day or night
                                                to
                                                allow her to become accustomed to the change in surroundings. There is a
                                                lot
                                                to take in—a new bed, new smells, new playmates, new caretakers, and
                                                possibly a new food. For cats who spend most of their time indoors doing
                                                the
                                                same activities in the same environment every day, boarding can be
                                                incredibly stressful, so help minimize that stress by slowly introducing
                                                her
                                                to this new adventure. If she doesn’t do well the first day, be patient
                                                and
                                                try again, keeping in mind that old habits die hard. An older, finicky
                                                cat,
                                                in particular, may take longer to adjust than her younger, more
                                                adaptable
                                                counterpart.
                                            </div>
                                        </div>
                                        <div class="catSlides cat-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Introduce your pet to a crate
                                            </div>
                                            <img src="{{ URL::asset('image/cat-slide-3.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                If your cat has never seen the inside of a traveling crate, now is the
                                                time
                                                to get her accustomed to one. Familiarizing her with the crate for
                                                travel to
                                                the facility is as important as a trial kennel run. To avoid your cat
                                                associating the carrier with feelings of loneliness or abandonment, keep
                                                the
                                                crate in the living room or an area where she enjoys relaxing. Equip the
                                                inside with your cat’s favorite toy or blanket, and encourage and praise
                                                her
                                                when she approaches or enters the crate. You can use treats to entice
                                                and
                                                reassure her, as well.
                                            </div>
                                        </div>

                                        <a class="prev-slide-cat" onclick="changeCatSlides(-1)">&#10094;</a>
                                        <a class="next-slide-cat" onclick="changeCatSlides(1)">&#10095;</a>

                                    </div>
                                    <br>
                                    <div style="text-align:center">
                                        <span class="dotCat" onclick="currentCatSlide(1)"></span>
                                        <span class="dotCat" onclick="currentCatSlide(2)"></span>
                                        <span class="dotCat" onclick="currentCatSlide(3)"></span>
                                    </div>
                                </div>
                                <div class="slide-show-for-dog" id="dogSlideView">
                                    <div class="slide-show-container-dog">
                                        <div class="dogSlides dog-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Before You Board Your Dog
                                            </div>
                                            <img src="{{ URL::asset('image/dog-slide-1.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                Each dog is unique, so matching a boarding facility’s amenities with
                                                your
                                                dog’s needs will help to set them up for a successful stay. Dogs with
                                                separation anxiety need extra preparation before being boarded. Spending
                                                time at the new facility to acclimate and get to know the staff can be
                                                very
                                                helpful. Choose a facility that allows trial visits and is willing to
                                                spend
                                                the extra time needed to help your dog feel more comfortable.
                                            </div>
                                        </div>
                                        <div class="dogSlides dog-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Make Sure Your Dog Is up-to-Date On Their Vaccinations
                                            </div>
                                            <img src="{{ URL::asset('image/dog-slide-2.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                Vaccinations are the most cost-effective and safest way to prevent
                                                diseases
                                                from spreading. Places where dogs are in close proximity to one another,
                                                such as a boarding facility, are at a higher risk of having an outbreak.
                                                Check your dog’s vaccination records or contact your veterinarian to
                                                make
                                                sure they are up-to-date on their vaccinations.
                                            </div>
                                        </div>
                                        <div class="dogSlides dog-slide-fade boarding-slide">
                                            <div class="boarding-slide-title">
                                                Make Sure Your Dog Is on Parasite Prevention Medicine
                                            </div>
                                            <img src="{{ URL::asset('image/dog-slide-3.jpeg') }}" style="width:100%">
                                            <div class="boarding-slide-content">
                                                Year-round parasite prevention is important as well — you don’t want
                                                your
                                                dog bringing home any fleas or ticks or getting diseases these parasites
                                                transmit. Ensure that your dog is on a prevention program that covers
                                                them
                                                for external parasites like fleas and ticks, as well as internal
                                                parasites
                                                like heartworm and intestinal worms. A good boarding kennel will require
                                                all
                                                of the animals in their care to be on continuous parasite prevention.
                                            </div>
                                        </div>

                                        <a class="prev-slide-dog" onclick="changeDogSlides(-1)">&#10094;</a>
                                        <a class="next-slide-dog" onclick="changeDogSlides(1)">&#10095;</a>
                                    </div>
                                    <br>
                                    <div style="text-align:center">
                                        <span class="dotDog" onclick="currentDogSlide(1)"></span>
                                        <span class="dotDog" onclick="currentDogSlide(2)"></span>
                                        <span class="dotDog" onclick="currentDogSlide(3)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>



                <section class="vertical-scrolling">
                    <div class="__section-vertical_standard_services">
                        <div class="box-section-statistics-services">
                            <div class="content-right right-side-content-services">
                                <h2 class="main-title-content-services">Services</h2>
                                <h4 class="sub-title-content-services">Pet care with love</h4>
                                <div class="substance-content-services">
                                    We offer high-class care services and activities for your pets. No matter what
                                    accommodation type you choose, your pet will always receive premium meals, daily
                                    exercise and play time and constant care from our professional trained team of pet
                                    welfare staff.
                                </div>
                                <div class="statistics-box-wget-block-adv">
                                    <h5 class="title-progress-bar-wget-advanced">Statistics services for pets of our
                                        client</h5>
                                    @foreach ($array_pet as $arraypet)
                                        <div class="wget-advanced-process-block">
                                            <div class="wget-progress-bar__wrapper" data-fill-amount="50">
                                                <div class="progress-bar__wrapper-header">
                                                    <p class="progress-bar__wrapper-title">{{ $arraypet->name }} care
                                                    </p>
                                                    <p class="progress-bar__wrapper-percent">50%</p>
                                                </div>
                                                <div class="progress-bar__wrapper-content__bar">
                                                    <div class="progress-bar-wget_color-active" style="width:50%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="content-left left-side-content-services">
                                <div class="block-wget-services col-12">
                                    @foreach ($array_services as $array_services)
                                        <div class="col-4 wget-each-service-show">
                                            <a href="{{ route('services') }}" value="{{ $array_services->id }}"
                                                class="block-columns-{{ $array_services->id }} block-each-service">
                                                <div
                                                    class="image-block-container wget-service-image-{{ $array_services->id }}">
                                                    <img class="image-thumb-service"
                                                        src="{{ URL::asset('image/service') }}/{{ $array_services->image }}">
                                                </div>
                                                <div
                                                    class="title-block-container wget-service-title-{{ $array_services->id }}">
                                                    {{ $array_services->name }} (16%)
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="vertical-scrolling">
                    <div class="__section-vertical_standard_products">
                        <div class="box-section-statistics-products">
                            <div class="row wget-products">
                                <div id="productsSlider" class="carousel slide hidden-xs wget-list-new-prd"
                                    data-ride="carousel" data-type="multi">
                                    <h3 class="title-wget-products-new">New Products</h3>
                                    <div class="carousel-inner-wget">
                                        @foreach ($array_products_new->chunk(4) as $array_products)
                                            <div
                                                class="product-carousel-wget carousel-item @if ($loop->first) {{ 'active' }} @endif">
                                                <div class="row col-lg-12 col-md-12 col-sm-12">
                                                    @foreach ($array_products as $arr_prd)
                                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                                            <div class="slider-product-wget-shown">
                                                                <div class="box-image-wget-prd-sli">

                                                                    <img height="350px"
                                                                        src="{{ URL::asset('image/product') }}/{{ $arr_prd->thumbnail }}">
                                                                    <div class="btn-action-wget each-prd-shown-btn">
                                                                        <button type="button" title="Add To Cart"
                                                                            value={{ $arr_prd->id }}
                                                                            class="btn btn-ajax-cart-prd-notQV btn-ajax-prd">
                                                                            <i class="fas fa-cart-plus"></i>
                                                                        </button>
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#quickViewOnePrd"
                                                                            value="{{ $arr_prd->id }}"
                                                                            title="Quick View"
                                                                            class="btn btn-ajax-quickview-prd btn-ajax-prd">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="box-content-wget-prd-sli">
                                                                    <a href="{{ asset('view_one_product/' . $arr_prd->name) }}"
                                                                        class="content-prd-name">{{ \Illuminate\Support\Str::limit($arr_prd->name, 70) }}</a>
                                                                    <p
                                                                        class="msg-ajax-rec msg-ajax-rec-{{ $arr_prd->id }}">
                                                                    </p>
                                                                    <p class="content-prd-name">
                                                                        {{ number_format($arr_prd->sale_price, '0', '.', '.') }}
                                                                        VND
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="controls pull-right">
                                    <a class="carousel-control-prev carousel-control-pull-prd" href="#productsSlider"
                                        data-slide="prev" style="opacity: 1; left: -7%;">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a class="carousel-control-next carousel-control-pull-prd" href="#productsSlider"
                                        data-slide="next" style="opacity: 1; transform: rotate(-180deg); right: -5%;">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="vertical-scrolling">
                    <div class="__section-vertical_standard_contact">
                        <div class="box-section-statistics-contact">

                            <div class="column-contact-form column-right-section-contact col-lg-5 col-md-12 col-sm-12">
                                <h4 class="title-contact-form-column">Have a question ?</h4>
                                <form method="POST" id="sendFormGoogleSheet" name="google-sheet-submit"
                                    class="form-horizontal form-contact-send-google-sheet" onSubmit="return false">
                                    <div class="intro-group-contact">
                                        <div class="form-group full-name-contact intro-contact">
                                            <label class="control-label">Name* </label>
                                            <input class="form-control input-info-contact" type="text"
                                                name="Name" id="full_name_contact">
                                            <span class="valid-err error-form" id="erNameContact"></span>
                                        </div>
                                    </div>
                                    <div class="intro-group-contact">
                                        <div class="form-group phone-contact intro-contact">
                                            <label class="control-label">Phone* </label>
                                            <input class="form-control input-info-contact" type="text"
                                                name="Phone" id="phone_contact">
                                            <span class="valid-err error-form" id="erPhoneContact"></span>
                                        </div>
                                    </div>
                                    <div class="intro-group-contact">
                                        <div class="form-group  email-contact intro-contact">
                                            <label class="control-label">Email* </label>
                                            <input class="form-control input-info-contact" type="text"
                                                name="Email" id="email_contact">
                                            <span class="valid-err error-form" id="erEmailContact"></span>
                                        </div>
                                    </div>
                                    <div class="intro-group-contact">
                                        <div class="form-group message-contact intro-contact">
                                            <label class="control-label">Message </label>
                                            <textarea class="form-control input-info-contact" type="text" name="Message" id="message_contact"></textarea>
                                        </div>
                                    </div>
                                    <div class="button-send-form-intro-contact">
                                        <button type="submit" id="sendGoogleSheet" name="sendGoogleSheet"
                                            onclick="return myValidateContact()"
                                            class="btn-submit btn-send-form-contact">Send
                                        </button>
                                        <span class="loading-send-contact"></span>
                                    </div>
                                </form>
                            </div>

                            <div
                                class="column-image-contact-section column-left-section-contact col-lg-7 col-md-12 col-sm-12">
                                <div class="row-image-intro-contact">
                                    <div class="info-group-box-contact col-lg-12 col-md-12 col-sm-12">
                                        <div
                                            class="headquarter-contact headquarter-address col-lg-12 col-md-12 col-sm-12">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div class="addressOn">
                                                <p class="title">Headquarter Offices:</p>
                                                <p class="content">Hà Nội: 63A/447 - Ngọc Lâm - Long Biên - Hà
                                                    Nội</p>
                                                <p class="content">HCM: 79/24/34E Âu Cơ, Phường 14, Quận 11,
                                                    Thành
                                                    phố Hồ Chí Minh, Việt Nam</p>
                                            </div>
                                        </div>
                                        <div class="headquarter-contact headquarter-phone col-lg-6 col-md-6 col-sm-12">
                                            <i class="fas fa-phone"></i>
                                            <div class="phoneOn">
                                                <p class="title">Phones: </p>
                                                <p class="content">0123456789 (from 8am to 6pm)</p>
                                                <p class="content">0123777782 (available 24/7)</p>
                                            </div>
                                        </div>
                                        <div class="headquarter-contact headquarter-email col-lg-6 col-md-6 col-sm-12">
                                            <i class="fas fa-envelope"></i>
                                            <div class="emailOn">
                                                <p class="title">Emails: </p>
                                                <p class="content">giakhanh010200@gmail.com</p>
                                                <p class="content">moonlighthotel@gmail.com</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-image-section-left">
                                        <img class="image-bot-intro-contact-left"
                                            src="{{ URL::asset('image/contact-image-hotel-1.jpeg') }}">
                                        <img class="image-bot-intro-contact-right"
                                            src="{{ URL::asset('image/contact-image-hotel-2.jpeg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="vertical-scrolling">
                    @include('footer-page')
                </section>





            </div>
        </div>
    </div>

    </div>
    </div>
    <!-- Modal quick view prd -->
    <div class="modal box-modal-prd__welcome" data-easein="fadeIn" tabindex="-1" role="dialog"
        aria-labelledby="costumModalLabel" aria-hidden="true" id="quickViewOnePrd">
        <div class="prd-box-detail__quickview">
            <div class="modal__qv-content">
                <div class="box-prd-thumnail__qv">
                    <img id="thumbnail__qv-prd" class="thumbnail-prd-onQV-abs" src="">
                </div>
                <div class="content-prdSli__onQV">
                    <button type="button" class="close-prdQV" data-dismiss="modal" aria-hidden="true"><i
                            class="fas fa-times"></i></button>
                    <div class="header-prdQV">
                        <div class="content-prdQV__name" id="name__qv-prd"></div>
                    </div>
                    <div class="content-prdQV__manufacturer" id="manufacturer__qv-prd"></div>
                    <div class="content-prdQV__description" id="description__qv-prd"></div>
                    <div class="content-prdQV__price" id="price__qv-prd"></div>
                    <div class="quantity-prd-input">
                        <button type="button" id="btn__decrease-quantity"
                            class="btn-caret-quantity btn-caret_btn__decrease-quantity">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type=text value="1" onchange="myInputFunction(this.val)"
                            oninput="this.value= ['','-'].includes(this.value) ? this.value : this.value|0"
                            id="quantity-input_prdQV">
                        <button type="button" id="btn__increase-quantity"
                            class="btn-caret-quantity btn-caret_btn__increase-quantity">
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="content-prdQV__quantity-count" id="quantity-count__qv-prd"></div>
                    </div>
                    <div class="modal-wget-button-quickview">
                        <button type="button" data-toggle="modal" class="btn btn-ajax-cart-prd-qv">
                            <i class="fas fa-cart-plus"></i>
                            <span>Add to cart</span>
                        </button>
                        <button type="button" data-toggle="modal" class="btn btn-ajax-wishlist-prd-qv">
                            <i class="fas fa-heart"></i>
                        </button>
                        <p class="alert alert-ajax-click" id="msg-ajax"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal popup success message send form google sheet-->
    <div class="popupSuccessMessageSendGGForm" id="popupSendGGForm">
        <div class="my-popup-success" id="popupGGSuccess">
            <h2 class="popup-title-success">Your information has been sent</h2>
            <p class="popup-content-success">Thank you for your information! We will contact you soon. Have a great
                day!!!</p>
        </div>
    </div>
    <div class="popupSuccessMessageSendGGForm" id="popupAddToCartSuccess">
        <div class="my-popup-success" id="popupGGSuccess">
            <h2 class="popup-title-success">Your information has been sent</h2>
            <p class="popup-content-success">Thank you for your information! We will contact you soon. Have a great
                day!!!</p>
        </div>
    </div>
    <!-- Modal popup action message confirm to login-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.1.2/fullpage.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/welcome.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".close-prdQV").click(function() {
            $('.btn-ajax-wishlist-prd-qv').removeClass('active');
            $('#quantity-input_prdQV').val(1);
        });
        $("#btnSubmitToLogin").click(function() {
            window.location.href = '{{ route('users.user_login') }}';
        });
        $("#btnClosePopup").click(function() {
            $("#submitToLogin").fadeOut(300);
        });
        $(".btn-ajax-quickview-prd").click(function() {
            var prd_id = $(this).val();
            var url = '/product_show/' + prd_id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    $('#thumbnail__qv-prd').attr('src', "{{ URL::asset('image/product') }}/" +
                        response.data.thumbnail)
                    $("#name__qv-prd").text(response.data.name + ' (Serial:' + response.data.serial +
                        ')');
                    $(".btn-ajax-wishlist-prd-qv").val(response.data.id);
                    $(".btn-ajax-cart-prd-qv").val(response.data.id);
                    $("#manufacturer__qv-prd").text('Manufacturer: ' + response.data.manufacturer);
                    $("#quantity-count__qv-prd").text("(" + response.data.quantity + " products left)");
                    var str = response.data.description;
                    if (str.length > 200) str = str.substring(0, 200)
                    $("#description__qv-prd").html(str +
                        ' . . . <a href="{{ asset('') }}view_one_product/' + response.data
                        .name + '">See more details</a>');
                    var price = response.data.sale_price.toLocaleString('it-IT', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    document.getElementById("quantity-input_prdQV").setAttribute("max", response.data
                        .quantity);
                    $("#price__qv-prd").text('Price: ' + price + '/per');
                    if (response.log == 200) {
                        $('.btn-ajax-wishlist-prd-qv').addClass('active');
                    }
                },
            });
        });

        function changeStyle() {
            if ($('#msg-ajax').hasClass('alert-danger')) {
                $('#msg-ajax').removeClass('alert-danger');
            }
            if ($('#msg-ajax').hasClass('alert-success')) {
                $('#msg-ajax').removeClass('alert-success');
            }
            var x = document.getElementById("msg-ajax");
            x.style.opacity = 1;
            setTimeout(function() {
                x.style.opacity = 0
            }, 5000);
        };

        $(".btn-ajax-wishlist-prd-qv").click(function() {
            var user_id = '{{ Session::get('user_id') }}';
            if (user_id == "") {
                document.getElementById("submitToLogin").style.visibility =
                    "visible";
                document.getElementById("submitToLogin").style.opacity = "1";
                $("#submitToLogin").fadeIn(500);
            } else {
                var btn = $(this);
                var prd_id = $(this).val();
                var url = '/addToWishList/' + prd_id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        if (response.log == 200) {
                            changeStyle()
                            btn.addClass('active');
                            $('#msg-ajax').addClass('alert-success');
                            $('#msg-ajax').text('Add product to wishlist success');

                        } else if (response.log == 400) {
                            changeStyle()
                            btn.removeClass('active');
                            $('#msg-ajax').addClass('alert-success');
                            $('#msg-ajax').text('Remove product from wishlist success');

                        } else {
                            changeStyle()
                            $('#msg-ajax').addClass('alert-danger');
                            $('#msg-ajax').text('Error');

                        }

                    }
                });
            }
        });

        $(".btn-ajax-cart-prd-qv").click(function() {
            var user_id = '{{ Session::get('user_id') }}';
            if (user_id == "") {
                document.getElementById("submitToLogin").style.visibility =
                    "visible";
                document.getElementById("submitToLogin").style.opacity = "1";
                $("#submitToLogin").fadeIn(500);
            } else {
                var prd_id = $(this).val();
                var url = '/addToCart/' + prd_id;
                var quantity = parseInt($('#quantity-input_prdQV').val());
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
                        changeStyle();
                        if (response.log == 300 || response.log == 400 || response.log == 500) {
                            $('#msg-ajax').addClass('alert-success');
                        } else {
                            $('#msg-ajax').addClass('alert-danger');
                        }
                        $('#msg-ajax').text(response.msg);

                    },
                });
            }
        });
        $(".btn-ajax-cart-prd-notQV").click(function() {
            var user_id = '{{ Session::get('user_id') }}';
            if (user_id == "") {
                document.getElementById("submitToLogin").style.visibility =
                    "visible";
                document.getElementById("submitToLogin").style.opacity = "1";
                $("#submitToLogin").fadeIn(500);
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
    </script>
</body>

</html>
