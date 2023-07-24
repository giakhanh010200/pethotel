$(document).ready(function () {
    // button click view map embed
    $("#btn-view-map").click(function () {
        var x = document.getElementById("address-map-place").value;
        document.getElementById("box-show-map").innerHTML = x;
    });
    $("#btn-view-map-edit").click(function () {
        var x = document.getElementById("address-map-place-edit").value;
        document.getElementById("box-show-map-edit").innerHTML = x;
    });

    // add new address form ajax
    $("#form-action-address").submit(function (e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        var data = {
            address: $("#address-add").val(),
            open: $("#address-open").val(),
            close: $("#address-close").val(),
            map_place: $("#address-map-place").val(),
        };

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                $("#tableViewAddress").prepend(
                    '<div class="col-12 show-view-edit-shop">\
                    <div class="box-view-shop" id="view' +
                        response.data.id +
                        '">\
                        <div class="col-3 title-shop-address">Moonlight Hotel ' +
                        response.data.id +
                        '</div>\
                        <div class="col-5 content-shop-address">' +
                        response.data.address +
                        '</div>\
                        <div class="col-2 time-shop-address">' +
                        response.data.open +
                        " - " +
                        response.data.close +
                        '</div>\
                        <div class="col-2 action-shop-address">\
                            <button data-target="#view-address" data-toggle="modal" class="btn btn-info btn-show" type="button">View</button>\
                            <button data-target="#edit-address" data-toggle="modal" class="btn btn-edit btn-warning" type="button">Edit</button>\
                            <button data-target="#delete-address" data-toggle="modal" class="btn btn-delete btn-danger" type="button">Delete</button>\
                        </div>\
                    </div>\
                </div>'
                );
                $("#success-message").addClass("alert alert-success");
                $("#success-message").text(response.message);
                $("#form-action-address").find("#address-add").val("");
                $("#form-action-address").find("#address-map-place").val("");
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    });

    $(".btn-address-detail").click(function () {
        var show_id = $(this).val();
        var url = "/admin/shop_address_show/" + show_id;
        //var url = $(this).attr('data-url');
        $("#title-box-detail").text("Moonlight hotel " + show_id);
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response);
                $("#body-address-times-detail").text(
                    "From " + response.data.open + " to " + response.data.close
                );
                $("#body-address-add-detail").text(response.data.address);
                document.getElementById("body-address-map-detail").innerHTML =
                    response.data.map_place;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //xử lý lỗi tại đây
            },
        });
    });

    $(".btn-address-edit").click(function () {
        var edit_id = $(this).val();
        var url = "/admin/shop_address_show/" + edit_id;
        $("#title-box-edit").text("Moonlight hotel " + edit_id);
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response);
                $("#id-address-form-edit").val(response.data.id);
                $("#address-add-edit").val(response.data.address);
                $("#address-map-place-edit").val(response.data.map_place);
            },
        });
    });

    $("#form-action-edit-address").submit(function (e) {
        e.preventDefault();
        var form_edit_id = document.getElementById(
            "id-address-form-edit"
        ).value;
        var url = "/admin/shop_address_update/" + form_edit_id;
        var data = {
            address: $("#address-add-edit").val(),
            open: $("#address-open-edit").val(),
            close: $("#address-close-edit").val(),
            map_place: $("#address-map-place-edit").val(),
        };
        $.ajax({
            type: "PUT",
            url: url,
            data: data,
            success: function (response) {
                $("#success-message").addClass("alert alert-success");
                console.log(response);
                $("#success-message").text(
                    "Update data for Moonlight Hotel " +
                        form_edit_id +
                        " successfully !!!"
                );
                $("#address-shot-add-" + form_edit_id).text(
                    response.array_address.address
                );
                $("#address-shot-times-" + form_edit_id).text(
                    response.array_address.open +
                        " - " +
                        response.array_address.close
                );
                $('.modal-backdrop.show').hide();
                $('#edit-address').hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    });

    $(".btn-address-delete").click(function () {
        var delete_id = $(this).val();
        var url = "/admin/shop_address_show/" + delete_id;
        document.getElementById("delete-id-opt").value = delete_id;
        $("#title-box-delete").text(
            "Confirm to delete Moonlight hotel " + delete_id + " ?"
        );
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response);

                $("#address-at-delete-box").text(response.data.address);
            },
        });
    });

    $("#form-action-delete-address").submit(function (e) {
        e.preventDefault();
        var form_delete_id = document.getElementById("delete-id-opt").value;
        var url = "/admin/shop_address_delete/" + form_delete_id;
        var _this = $(this);
        $.ajax({
            type: "DELETE",
            url: url,
            success: function (response) {
                _this.parents().find("#view"+form_delete_id).remove();
                $("#success-message").addClass("alert alert-success");
                console.log(response);
                $("#success-message").text(
                    "Delete data at Moonlight Hotel " +
                        form_delete_id +
                        " successfully !!!"
                );
                $('.modal-backdrop.show').hide();
                $('#delete-address').hide();
                _this.parent().remove;
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    });
});
