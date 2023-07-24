$(document).ready(function () {
    $(".alert-check").hide();
    $("#btnConfirmBooking").click(function () {
        let name = document.getElementById("nameBooking").value;
        let phone = document.getElementById("phoneBooking").value;
        let email = document.getElementById("emailBooking").value;
        var errorName = true;
        var errorPhone = true;
        var errorEmail = true;
        var nameInput = document.getElementById("nameBooking");
        var phoneInput = document.getElementById("phoneBooking");
        var emailInput = document.getElementById("emailBooking");
        var erName = document.getElementById("erName");
        var erPhone = document.getElementById("erPhone");
        var erEmail = document.getElementById("erEmail");
        const regexName =
            /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/.test(
                name
            );
        const regexPhone =
            /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(phone);
        const regexEmail =
            /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/.test(
                email
            );
        if (regexName == false) {
            $("#erName").show();
            erName.innerHTML = "Your name is invalid";
            nameInput.style.border = "2px solid red";
            errorName = true;
        } else {
            $("#erName").hide();
            nameInput.style.border = "2px solid green";
            erName.innerHTML = null;
            errorName = false;
        }
        if (regexPhone == false) {
            $("#erPhone").show();
            erPhone.innerHTML = "Your phone number is invalid";
            phoneInput.style.border = "2px solid red";
            errorPhone = true;
        } else {
            $("#erPhone").hide();
            phoneInput.style.border = "2px solid green";
            erPhone.innerHTML = null;
            errorPhone = false;
        }
        if (regexEmail == false) {
            $("#erEmail").show();
            erEmail.innerHTML = "Your email is invalid";
            emailInput.style.border = "2px solid red";
            errorEmail = true;
        } else {
            $("#erEmail").hide();
            emailInput.style.border = "2px solid green";
            erEmail.innerHTML = null;
            errorEmail = false;
        }
        if (errorPhone == false && errorEmail == false && errorName == false) {
            $("#confirmBooking").show();
        }
    });
    $("#dismissModal").click(function () {
        $("#confirmBooking").hide();
    });
    $("#btn-submit-payment").click(function () {
        var url = "/users/reservationPayment";
        var data = {
            boarding: $("#boardingBooking").val(),
            quantity: $("#quantityBooking").val(),
            pet: $("#petBooking").val(),
            start_date: $("#checkinBooking").val(),
            end_date: $("#checkoutBooking").val(),
            store: $("#storeBooking").val(),
            name: $("#nameBooking").val(),
            phone: $("#phoneBooking").val(),
            email: $("#emailBooking").val()
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response){
                // $("#modal-success-inform").show();
                console.log(response.data);
                document.location.href = lourl;
            }
        })
    })
});
