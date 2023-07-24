$(document).ready(function () {
    $("#btnAddService").click(function () {
        $(".btn-add-service-new").toggleClass("activated");
        $("div.box-show-add-service").toggle(500);
    })
})
