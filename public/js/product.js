
document.getElementById("thumbnail").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("showImage").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

$(document).ready(function () {
    $("#btnAddProduct").click(function () {
        const btn = document.getElementById("btnAddProduct");
        if(btn.innerText === "Add new"){
            btn.innerText = "Cancel";
        }else{
            btn.innerText = "Add new";
        }
        $(".session-add-new-product").slideToggle(1000);
        $(".session-view-all-product").slideToggle(1000);
    });
});

$('.view-description-btn').click(function () {
    var view_description = $(this).val();
    $("#descriptionprd"+view_description).slideToggle(500);
})
