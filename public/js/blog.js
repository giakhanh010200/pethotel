$(document).ready(function () {
    $("#btnAddBlog").click(function () {
        const btn = document.getElementById("btnAddBlog");
        if(btn.innerText === "Add new"){
            btn.innerText = "Cancel";
        }else{
            btn.innerText = "Add new";
        }
        $(".session-add-new-blog").slideToggle(1000);
        $(".session-view-all-blog").slideToggle(1000);
    });
});
document.getElementById("thumbnail").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("showImage").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
