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
        /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/.test(
            name
        );
    const regexPhone = /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(
        phone
    );
    const regexEmail =
        /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/.test(
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
            success: function (data) {
                document.getElementById("popupSendGGForm").style.visibility =
                    "visible";
                document.getElementById("popupSendGGForm").style.opacity = "1";
                $(".loading-send-contact").hide();
                $("#popupSendGGForm")
                    .fadeIn(1000)
                    .fadeTo(2000, 5)
                    .fadeOut(1000, function () {
                        $("#popupSendGGForm").fadeOut(1000);
                    });
            },
            error: function () {
                $(".loading-send-contact").hide();
            },
        });

        return false;
    }

    return false;
}
if ($(window).width() <= 1024) {
    $("#fullpage").removeAttr("id");
} else {
    $(function () {
        $("#fullpage").fullpage({
            licenseKey: 'YOUR_KEY_HERE',
            sectionSelector: ".vertical-scrolling",
            navigation: true,
            navigationPosition: "right",
            navigationTooltips: false,
            showActiveTooltip: false,
            slidesNavigation: false,
            slidesNavPosition: "bottom",
            loopBottom: true,
            anchors: [
                "BoardingCarer",
                "ServicesStatistics",
                "NewProduct",
                "ContactInformation",
                "Footer",
            ],
        });
    });
}
//Change view slides
$(document).ready(function () {
    $("#btnshowCatSlide").click(function () {
        $("#cat-item-boarding").addClass("slide-active");
        $("#dog-item-boarding").removeClass("slide-active");
        $("#catSlideView").addClass("activeSlide__Show");
        $("#dogSlideView").removeClass("activeSlide__Show");
    });
    $("#btnshowDogSlide").click(function () {
        $("#catSlideView").removeClass("activeSlide__Show");
        $("#dogSlideView").addClass("activeSlide__Show");
        $("#cat-item-boarding").removeClass("slide-active");
        $("#dog-item-boarding").addClass("slide-active");
    });
});
// cat slide show

var slideCatIndex = 1;
showCatSlides(slideCatIndex);

function changeCatSlides(n) {
    showCatSlides((slideCatIndex += n));
}

function currentCatSlide(n) {
    showCatSlides((slideCatIndex = n));
}

function showCatSlides(n) {
    var i = 0;
    var slidesCat = document.getElementsByClassName("catSlides");
    var dotsCat = document.getElementsByClassName("dotCat");
    if (n > slidesCat.length) {
        slideCatIndex = 1;
    }
    if (n < 1) {
        slideCatIndex = slidesCat.length;
    }
    for (i = 0; i < slidesCat.length; i++) {
        slidesCat[i].style.display = "none";
    }
    for (i = 0; i < dotsCat.length; i++) {
        dotsCat[i].className = dotsCat[i].className.replace(
            "catSlideActive",
            ""
        );
    }
    slidesCat[slideCatIndex - 1].style.display = "flex";
    dotsCat[slideCatIndex - 1].className += " catSlideActive";
}
//dog slide show

var slideDogIndex = 1;
showDogSlides(slideDogIndex);

function changeDogSlides(n1) {
    showDogSlides((slideDogIndex += n1));
}

function currentDogSlide(n1) {
    showDogSlides((slideDogIndex = n1));
}

function showDogSlides(n1) {
    var i = 0;
    var slidesDog = document.getElementsByClassName("dogSlides");
    var dotsDog = document.getElementsByClassName("dotDog");
    if (n1 > slidesDog.length) {
        slideDogIndex = 1;
    }
    if (n1 < 1) {
        slideDogIndex = slidesDog.length;
    }
    for (i = 0; i < slidesDog.length; i++) {
        slidesDog[i].style.display = "none";
    }
    for (i = 0; i < dotsDog.length; i++) {
        dotsDog[i].className = dotsDog[i].className.replace(
            "dogSlideActive",
            ""
        );
    }
    slidesDog[slideDogIndex - 1].style.display = "flex";
    dotsDog[slideDogIndex - 1].className += " dogSlideActive";
}


$(document).ready(function () {
    $("#btnClosePopup").click(function () {
        $("#submitToLogin").fadeOut(500);
    });
});
// quantity button
$("#btn__increase-quantity").click(function() {
    var input_val = parseInt($('#quantity-input_prdQV').val());
    var max_val = parseInt($('#quantity-input_prdQV').attr('max'));
    if (input_val >= max_val){
        $('#quantity-input_prdQV').val(max_val);
    }else{
        input_val += 1;
        $('#quantity-input_prdQV').val(input_val);
    }
});


$("#btn__decrease-quantity").click(function() {
    var input_val = parseInt($('#quantity-input_prdQV').val());
    var min_val = 1;
    if (input_val <= 1){
        $('#quantity-input_prdQV').val(min_val);
    }else{
        let x = input_val - 1;
        $('#quantity-input_prdQV').val(x);
    }
});


