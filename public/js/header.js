$(document).ready(function () {
    $("#showInfoAdmin").click(function () {
        $("#menuAdmin").toggle(500);
    });
    $("#asideFullMenu").click(function () {
        $("#branding-logo").toggle("500");
        $(".aside-item-text").toggle("500");
        $(".show-body-control").toggleClass("active");
    });
    $("#asideMain").click(function () {
        $("#asideMain").toggleClass("rotated");
        $("#menuAsideForMain").toggle(500);
    });
    $("#asidePB").click(function () {
        $("#asidePB").toggleClass("rotated");
        $("#menuAsideForPB").toggle(500);
    });
    $("#asideSv").click(function () {
        $("#asideSv").toggleClass("rotated");
        $("#menuAsideForSv").toggle(500);
    });
    $("#asideCart").click(function () {
        $("#asideCart").toggleClass("rotated");
        $("#menuAsideForCart").toggle(500);
    });
    $("#asideUA").click(function () {
        $("#asideUA").toggleClass("rotated");
        $("#menuAsideForUA").toggle(500);
    });
});
/*
jQuery(function($){
 var path = window.location.href;
 $(".menu-side-nav-link").each(function(){
    if(this.href === path){
        $(this).addClass('activated');
    }
 })
})

*/
