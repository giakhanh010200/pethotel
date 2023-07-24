$(function () {
    $("#price_range_prd").slider({
        animate: true,
        range: true,
        min: 0,
        max: 1000000,
        step: 10000,
        values: [$("#hidden_minimum_price").val(), $("#hidden_maximum_price").val()],
        slide: function (event, ui) {
            $("#amount").html(
                "From " +
                    ui.values[0]
                        .toString()
                        .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
                    " VNĐ to " +
                    ui.values[1]
                        .toString()
                        .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
                    " VNĐ"
            );
            $("#hidden_minimum_price").val(ui.values[0])
            $("#hidden_maximum_price").val(ui.values[1])
        },
    });

    $("#amount").html(
        "From " +
            $("#price_range_prd")
                .slider("values", 0)
                .toString()
                .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
            " VNĐ to " +
            $("#price_range_prd")
                .slider("values", 1)
                .toString()
                .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
            " VNĐ"
    );
});
// $(".select-sort-by").change(function() {
//     $("form#ajax-auto-submit").submit();
// });

