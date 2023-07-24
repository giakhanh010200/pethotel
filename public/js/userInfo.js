$(document).ready(function () {
    $(".alert").hide();
    $("#form-add-address").submit(function (e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        var phone = $("#phoneAdd").val();
        const regexPhone =
            /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(phone);
        if (regexPhone == false) {
            document.getElementById("errPhoneAdd").innerHTML ==
                "Invalid phone number";
        } else {
            var data = {
                user_id: $("#idAdd").val(),
                name: $("#fullnameAdd").val(),
                phone: $("#phoneAdd").val(),
                address: $("#addresslAdd").val(),
            };

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (response) {
                    $("#tableViewAddress").append(
                        '<div class="col-lg-12 col-md-12 col-sm-12 block-add">\
                        <div class="col-lg-10 col-md-10 col-sm-12 each-add-show"id="viewAdd' +
                            response.data.id +
                            '">\
                            <div class="wget-block-title">\
                                <div class="add-name-user-title" id="name-add-' +
                            response.data.id +
                            '">Name:</div>\
                                <div class="add-phone-user-title"id="phone-add-' +
                            response.data.id +
                            '">Phone:</div>\
                                <div class="add-add-user-title"id="add-add-' +
                            response.data.id +
                            '">Address:</div>\
                            </div>\
                            <div class="wget-block-content">\
                                <div class="add-name-user-content">' +
                            response.data.name +
                            '</div>\
                                <div class="add-name-user-content">' +
                            response.data.phone +
                            '</div>\
                                <div class="add-name-user-content">' +
                            response.data.address +
                            '</div>\
                            </div>\
                        </div>\
                        <div class="col-lg-2 col-md-2 col-sm-12 btn-action-address" id="viewBtn' +
                            response.data.id +
                            '">\
                            <button class="btn-warning btn-address-edit" value="' +
                            response.data.id +
                            '" data-target="#modelEditAddress" data-toggle="modal">Edit</button>\
                            <button class="btn-danger btn-address-del" value="' +
                            response.data.id +
                            '" data-target="#modelDeleteAddress" data-toggle="modal">Delete</button>\
                        </div>\
                    </div>'
                    );
                    $("#success-message").addClass("alert alert-success");
                    $("#success-message").text(response.message);
                    $(".modal").hide();
                    $(".modal-backdrop.show").hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                },
            });
        }
    });

    $(".btn-address-edit").click(function () {
        console.log(this);
        var edit_id = $(this).val();
        console.log(edit_id);

        var url = "/users/user_address_show/" + edit_id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response.data);
                $("#fullnameEdit").val(response.data.name);
                $("#phoneEdit").val(response.data.phone);
                $("#addressEdit").val(response.data.address);
                $("#idAddEdit").val(response.data.id);
            },
        });
    });

    $(".btn-address-del").click(function () {
        var del_id = $(this).val();
        console.log(del_id);
        var url = "/users/user_address_show/" + del_id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response.data);
                $("#fullnameDel").text(response.data.name);
                $("#phoneDel").text(response.data.phone);
                $("#addressDel").text(response.data.address);
                $("#idDell").val(response.data.id);
            },
        });
    });

    $("#form-edit-address").submit(function (e) {
        e.preventDefault();
        var id = $("#idAddEdit").val();
        var url = "/users/user_address_update/" + id;
        var phone = $("#phoneEdit").val();
        const regexPhone =
            /((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/.test(phone);
        if (regexPhone == false) {
            document.getElementById("errPhoneEdit").innerHTML ==
                "Invalid phone number";
        } else {
            var data = {
                user_id: $("#idAdd").val(),
                name: $("#fullnameEdit").val(),
                phone: $("#phoneEdit").val(),
                address: $("#addressEdit").val(),
            };
            $.ajax({
                type: "PUT",
                url: url,
                data: data,
                success: function (response) {
                    $("#success-message").addClass("alert alert-success");
                    $("#success-message").text(response.message);
                    $(".modal").hide();
                    $(".modal-backdrop.show").hide();
                    console.log(response.data);
                    $("#name-add-" + id).text(response.user_address.name);
                    $("#phone-add-" + id).text(response.user_address.phone);
                    $("#add-add-" + id).text(response.user_address.address);
                },
            });
        }
    });

    $("#form-del-address").submit(function (e) {
        e.preventDefault();
        var form_delete_id = $("#idDell").val();
        var url = "/users/user_address_del/" + form_delete_id;
        var _this = $(this);
        $.ajax({
            type: "DELETE",
            url: url,
            success: function (response) {
                _this
                    .parents()
                    .find("#viewAdd" + form_delete_id)
                    .remove();
                _this
                    .parents()
                    .find("#viewBtn" + form_delete_id)
                    .remove();
                $("#success-message").addClass("alert alert-success");
                $("#success-message").text(response.message);
                $(".modal").hide();
                $(".modal-backdrop.show").hide();
                _this.parent().remove;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            },
        });
    });
});

// user order
$(document).ready(function () {
    $(".btn-cancle-order-us").click(function () {
        var id = $(this).val();
        url = "/users/cart_render";
        data = {
            id: id,
        };
        var _this = $(this);
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            success: function (response) {
                var i = 0;
                $("#productList").html("");
                document.getElementById("modalCancleTitle").innerHTML =
                    "Order " + id;
                var price = response.totalPrice.toLocaleString("it-IT", {
                    style: "currency",
                    currency: "VND",
                });
                _this.addClass("change-style-btn");
                document.getElementById("btnCancleOrderUs").value = id;
                $("#totalPrice").text("Total price: " + price);
                // console.log(response.data[0].product_name)
                $.each(response.data, function (key, index) {
                    i = i + 1;
                    console.log(response.data[key].product_name);
                    $("#productList").append(
                        '<div class="each-product-show">' +
                            i +
                            "/ " +
                            response.data[key].product_name +
                            "</div>"
                    );
                });
            },
        });
    });
    $(".btn-cancle-form-order").click(function () {
        $(".change-style-btn").removeClass("change-style-btn");
    });
    $("#btnCancleOrderUs").click(function () {
        var cart_id = $(this).val();
        var msg = document.getElementById("message-order");
        console.log(cart_id);
        data = {
            cart_id: cart_id,
        };
        url = "/users/user_cancle_order/";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                console.log(response.data);
                console.log(response.msg);
                msg.innerHTML = response.msg;
                msg.style.color = "red";
                render_id = response.data[0].cart_id_render
                $("#btn-order-us-"+render_id).removeClass(
                    "btn-primary btn-cancle-order-us"
                );
                console.log(response.status)
                if (response.status == 2) {
                    $("#btn-order-us-"+render_id).addClass(
                        "btn-danger btn-order-cancled"
                    );
                    $("#btn-order-us-"+render_id).html("You have cancled this order");
                    $("#btn-order-us-"+render_id).attr("disabled", "disabled");
                    $("#btn-order-us-"+render_id).removeClass("change-style-btn");

                } else {
                    $("#btn-order-us-"+render_id).remove();
                }
                $(".modal").hide();
                $(".modal-backdrop.show").hide();
            },
        });
    });

    $(".btn-delivery-order").click(function () {
        var cart_id = $(this).val();
        var msg = document.getElementById("message-order");
        data = { cart_id: cart_id };
        url = "/users/user_confirm_deli";
        var _this = $(this);
        $.ajax({
            type: "put",
            url: url,
            data: data,
            success: function (response) {
                console.log(response.data);
                console.log(response.msg);
                if(response.status == 3){
                    _this.html("Order has been successfully delivered");
                    _this.removeClass("btn-delivery-order");
                    _this.addClass("btn-order-success");
                    _this.attr("disabled", "disabled");
                    document.getElementById("span" + cart_id).innerHTML = "";
                    msg.innerHTML = response.msg;
                    msg.style.color = "green";
                }else{
                    _this.remove();
                    document.getElementById("span" + cart_id).innerHTML = "";
                    msg.innerHTML = response.msg;
                    msg.style.color = "red";
                }

            },
        });
    });
    $(".btn-cancle-edit-each").hide();
    $("#btn-edit-name").click(function () {
        $("#edit-user-name").removeAttr("disabled");
        $(this).hide();
        $("#btn-cancle-edit-name").show();
    });
    $("#btn-edit-email").click(function () {
        $("#edit-user-email").removeAttr("disabled");
        $(this).hide();
        $("#btn-cancle-edit-email").show();
    });
    $("#btn-cancle-edit-name").click(function () {
        var x = document.getElementById("edit-user-name");
        x.value = x.defaultValue;
        $(this).hide();
        $("#edit-user-name").attr("disabled", "disabled");
        $("#btn-edit-name").show();
    });
    $("#btn-cancle-edit-email").click(function () {
        var x = document.getElementById("edit-user-email");
        x.value = x.defaultValue;
        $(this).hide();
        $("#edit-user-email").attr("disabled", "disabled");
        $("#btn-edit-email").show();
    });
    $("#alert-success-data-user").hide();
    $("#form-data-user").submit(function (event) {
        event.preventDefault();
        var id = $("#btn-save-change-acc").val();
        var url = "/users/change_account_prof/" + id;
        data = {
            username: $("#edit-user-name").val(),
            email: $("#edit-user-email").val(),
        };
        $.ajax({
            type: "PUT",
            url: url,
            data: data,
            success: function (response) {
                console.log(response.data);
                console.log(response.msg_n);
                console.log(response.msg_e);
                console.log(response.admin);
                document.getElementById("err-uname-change").innerHTML =
                    response.msg_n;
                document.getElementById("err-email-change").innerHTML =
                    response.msg_e;

                if (response.msg_n == "" && response.msg_e == "") {
                    $("#btn-cancle-edit-email").hide();
                    $("#btn-cancle-edit-name").hide();
                    $("#btn-edit-email").show();
                    $("#btn-edit-name").show();
                    $("#edit-user-name").attr("disabled", "disabled");
                    $("#edit-user-email").attr("disabled", "disabled");
                    document.getElementById("edit-user-email").value =
                        response.data.email;
                    document.getElementById("edit-user-name").value =
                        response.data.username;
                    document.getElementById(
                        "alert-success-data-user"
                    ).innerHTML = "data change successfully";
                    $("#alert-success-data-user").show();
                }
            },
        });
    });

    $("#modal-change-pass").submit(function (e) {
        e.preventDefault();
        var id = $("#btn-submit-change").val();
        url = "/users/change_new_password/" + id;
        data = {
            old_password: $("#old_password").val(),
            new_password: $("#new_password").val(),
            confirm_password: $("#confirm_password").val(),
        };
        $.ajax({
            type: "put",
            url: url,
            data: data,
            success: function (response) {
                console.log(response.msg_o);
                document.getElementById("err-oldpass").innerHTML =
                    response.msg_o;
                document.getElementById("err-newpass").innerHTML =
                    response.msg_n;
                document.getElementById("err-confpass").innerHTML =
                    response.msg_c;
                if (response.err == false) {
                    $("#alert-success-data-user").show();
                    $(".modal").hide();
                    $(".modal-backdrop.show").hide();
                    document.getElementById(
                        "alert-success-data-user"
                    ).innerHTML = "password change successfully";
                }
            },
        });
    });

    //style btn change tab
    function removeActiveTab() {
        $(".btn-change-tab").removeClass("active");
        $(".block-view-tab").removeClass("active");
    }
    $("#btn-address-change").click(function () {
        removeActiveTab();
        $("#forAddressTab").addClass("active");
        $("#btn-address-change").addClass("active");
    });
    $("#btn-prd-ordered-change").click(function () {
        removeActiveTab();
        $("#forProductOrderTab").addClass("active");
        $("#btn-prd-ordered-change").addClass("active");
    });
    $("#btn-prd-boarding-change").click(function () {
        removeActiveTab();
        $("#forBoardingTab").addClass("active");
        $("#btn-prd-boarding-change").addClass("active");
    });

    $(".btn-show-all-cart").click(function () {
        var id = $(this).val();
        var url = "/users/cart_render";
        data = { id: id };
    });
});
