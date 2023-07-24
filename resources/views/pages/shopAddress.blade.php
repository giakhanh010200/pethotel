<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/main-header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/shopAddress.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Address & Contact</title>
</head>

<body>
    @include('header-page')
    <div class="__section-body-content-address-contact">
        <div class="show_body__section__address-contact">

            <div class="first__section section-address-body">
                <h1 class="title-section-showww">New Store Address</h1>
                <div class="col-lg-12 col-md-12 col-sm-12 row-show__address">
                    @foreach ($array_address as $arradd)
                        <div class="col-lg-6 col-md-6 col-sm-12 row-each-address-view">
                            <div class="show-full-map-iframe" value="{{ $arradd->id }}">
                                <div class="box-section-address box-address__{{ $arradd->id }}">
                                    <div class="map-place-small-if col-6">
                                        {!! $arradd->map_place !!}
                                    </div>
                                    <div class="address-information col-6">
                                        <p class="add-name">{{ $arradd->address }}</p>
                                        <p class="add-time">Open from {{ $arradd->open }} -
                                            {{ $arradd->close }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="second__section section-contact-body">
                <h1 class="title-section-showww">Contact Us</h1>
                <div class="headquater-offical-address">
                    <div class="hanoi-offical-address offical-section-add">
                        <div class="headquarter-contact headquarter-address col-lg-6 col-md-12 col-sm-12">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="addressOn">
                                <p class="title">Headquarter Offices:</p>
                                <p class="content">Hà Nội: 63A/447 - Ngọc Lâm - Long Biên - Hà
                                    Nội</p>
                            </div>
                        </div>
                        <div class="headquarter-contact headquarter-phone col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-phone"></i>
                            <div class="phoneOn">
                                <p class="title">Phones: </p>
                                <p class="content">0123456789</p>
                            </div>
                        </div>
                        <div class="headquarter-contact headquarter-email col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-envelope"></i>
                            <div class="emailOn">
                                <p class="title">Emails: </p>
                                <p class="content">giakhanh010200@gmail.com</p>
                            </div>
                        </div>
                        <div class="box-map-headquater-if col-lg-12 col-md-12 col-sm-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.581069162164!2d105.87330921554408!3d21.04944209244635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abd564edf0f5%3A0xb1b6adc5cbc0134a!2zNjMgTmfDtSA0NDcgTmfhu41jIEzDom0sIE5n4buNYyBMw6JtLCBMb25nIEJpw6puLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1642413299858!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                    <div class="hochiminh-offical-address offical-section-add">
                        <div class="headquarter-contact headquarter-address col-lg-6 col-md-12 col-sm-12">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="addressOn">
                                <p class="title">Headquarter Offices:</p>
                                <p class="content">HCM: 79/24/34E Âu Cơ, Phường 14, Quận 11,
                                    Thành
                                    phố Hồ Chí Minh, Việt Nam</p>
                            </div>
                        </div>
                        <div class="headquarter-contact headquarter-phone col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-phone"></i>
                            <div class="phoneOn">
                                <p class="title">Phones: </p>
                                <p class="content">0123777782</p>
                            </div>
                        </div>
                        <div class="headquarter-contact headquarter-email col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-envelope"></i>
                            <div class="emailOn">
                                <p class="title">Emails: </p>
                                <p class="content">moonlighthotel@gmail.com</p>
                            </div>
                        </div>
                        <div class="box-map-headquater-if col-lg-12 col-md-12 col-sm-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5363024765206!2d106.64702131548304!3d10.77017526225242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ebe29d554c3%3A0xcadfcf051570b3c9!2zNzkvMjQvMzRFIMOCdSBDxqEsIFBoxrDhu51uZyAxNCwgUXXhuq1uIDExLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1642413359096!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="google-sheet-col-contact col-lg-12 col-sm-12 col-md-12">
                    <div class="column-contact-form">
                        <form method="POST" id="sendFormGoogleSheet" name="google-sheet-submit"
                            class="form-horizontal form-contact-send-google-sheet" onSubmit="return false">
                            <div class="intro-group-contact">
                                <div class="form-group full-name-contact intro-contact">
                                    <label class="control-label">Name* </label>
                                    <input class="form-control input-info-contact" type="text" name="Name"
                                        id="full_name_contact">
                                    <span class="error-form" id="erNameContact"></span>
                                </div>
                            </div>
                            <div class="intro-group-contact">
                                <div class="form-group phone-contact intro-contact">
                                    <label class="control-label">Phone* </label>
                                    <input class="form-control input-info-contact" type="text" name="Phone"
                                        id="phone_contact">
                                    <span class="error-form" id="erPhoneContact"></span>
                                </div>
                            </div>
                            <div class="intro-group-contact">
                                <div class="form-group  email-contact intro-contact">
                                    <label class="control-label">Email* </label>
                                    <input class="form-control input-info-contact" type="text" name="Email"
                                        id="email_contact">
                                    <span class="error-form" id="erEmailContact"></span>
                                </div>
                            </div>
                            <div class="intro-group-contact">
                                <div class="form-group message-contact intro-contact">
                                    <label class="control-label">Message </label>
                                    <textarea class="form-control input-info-contact" type="text" name="Message"
                                        id="message_contact"></textarea>
                                </div>
                            </div>
                            <div class="button-send-form-intro-contact">
                                <button type="submit" id="sendGoogleSheet" name="sendGoogleSheet"
                                    onclick="return myValidateContact()" class="btn-submit btn-send-form-contact">Send
                                </button>
                                <span class="loading-send-contact"></span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
    <div class="popupSuccessMessageSendGGForm" id="popupSendGGForm">
        <div class="my-popup-success" id="popupGGSuccess">
            <h2 class="popup-title-success">Your Information Data Has Been Sent</h2>
            <p class="popup-content-success">Thank you for your information! We will contact you soon. Have a sweet day!
            </p>
        </div>
    </div>
    <script type="text/javascript">
        $(".loading-send-contact").hide();

        function myValidateContact() {
            let name = document.getElementById("full_name_contact").value;
            let phone = document.getElementById("phone_contact").value;
            let email = document.getElementById("email_contact").value;
            var errorName = true;
            var errorPhone = true;
            var errorEmail = true;
            var nameInput = document.getElementById("full_name_contact");
            var phoneInput = document.getElementById("phone_contact");
            var emailInput = document.getElementById("email_contact");
            var messInput = document.getElementById("message_contact");
            var erName = document.getElementById("erNameContact");
            var erPhone = document.getElementById("erPhoneContact");
            var erEmail = document.getElementById("erEmailContact");
            const regexName =
                /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/
                .test(
                    name
                );
            const regexPhone = /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(
                phone
            );
            const regexEmail =
                /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/
                .test(
                    email
                );
            if (regexName == false) {
                erName.innerHTML = "Your name is invalid";
                nameInput.style.border = "2px solid red";
                errorName = true;
            } else {
                nameInput.style.border = "2px solid green";
                erName.innerHTML = null;
                errorName = false;
            }
            if (regexPhone == false) {
                erPhone.innerHTML = "Your phone number is invalid";
                phoneInput.style.border = "2px solid red";
                errorPhone = true;
            } else {
                phoneInput.style.border = "2px solid green";
                erPhone.innerHTML = null;
                errorPhone = false;
            }
            if (regexEmail == false) {
                erEmail.innerHTML = "Your email is invalid";
                emailInput.style.border = "2px solid red";
                errorEmail = true;
            } else {
                emailInput.style.border = "2px solid green";
                erEmail.innerHTML = null;
                errorEmail = false;
            }
            messInput.style.border = "2px solid green";

            if (errorPhone == false && errorEmail == false && errorName == false) {
                $(".loading-send-contact").show();
                var data = $("form#sendFormGoogleSheet").serialize();
                $.ajax({
                    type: "GET",
                    url: "https://script.google.com/macros/s/AKfycbx9-xhzC-iWKaQXCPf9qmwQj_ltCeUmGGVz4RlbHBwlto9_LPm_3FrKpFzJBSljXDAJ/exec",
                    dataType: "json",
                    crossDomain: true,
                    data: data,
                    success: function(data) {
                        document.getElementById("popupSendGGForm").style.visibility =
                            "visible";
                        document.getElementById("popupSendGGForm").style.opacity = "1";
                        $(".loading-send-contact").hide();
                        $("#popupSendGGForm")
                            .fadeIn(1000)
                            .fadeTo(2000, 5)
                            .fadeOut(1000, function() {
                                $("#popupSendGGForm").fadeOut(1000);
                            });
                    },
                    error: function() {
                        $(".loading-send-contact").hide();
                    },
                });

                return false;
            }

            return false;
        }
    </script>
</body>

</html>
