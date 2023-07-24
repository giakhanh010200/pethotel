$.fn.addClassDelay = function (className, delay) {
    var $addClassDelayElement = $(this),
        $addClassName = className;
    setTimeout(function () {
        $addClassDelayElement.addClass($addClassName);
    }, delay);
};
$.fn.addStyleDelay = function (styleName, delay) {
    var $addStyleDelayElement = $(this),
        $addStyleName = styleName;
    setTimeout(function () {
        $addStyleDelayElement.addClass($addStyleName);
    }, delay);
};
$.fn.removeClassDelay = function (className, delay) {
    var $removeClassDelayElement = $(this),
        $removeClassName = className;
    setTimeout(function () {
        $removeClassDelayElement.removeClass($removeClassName);
    }, delay);
};
$(document).ready(function () {
    $("button.block-each-service").click(function () {
        var val = $(this).val();
        var clsicon = "icon-services-" + val;
        var clscontent = "about-services-" + val;
        let wget = document.querySelectorAll(".wget-each-service-show");
        for (let i = 0; i < wget.length; i++) {
            wget[i].classList.add("animate__animated", "animate__zoomOut");
            wget[i].style.animationDuration = "2s";
        }
        let non = document.querySelectorAll(".navigation-bar-services");
        let nav = document.querySelectorAll(".item-navbar-change");
        var delay = 0.5;
        var delay_rm = 500;
        for (let i = 0; i < wget.length; i++) {
            non[i].classList.remove("non-active");
            nav[i].classList.add("animate__animated", "animate__flipInX");
            nav[i].style.animationDelay = delay + "s";
            nav[i].style.animationDuration = "2s";
            delay += 0.5;
            delay_rm += 500;
        }
        $(".wget-each-service-show").addClassDelay("non-active", delay_rm);
        $("." + clscontent).removeClassDelay("non-active", delay_rm);
        $("." + clscontent).addClassDelay("animate__animated", delay_rm);
        $("." + clscontent).addClassDelay("animate__slideInUp", delay_rm);
        delay_rm +=1500;
        $("." + clsicon).addClassDelay("active",delay_rm);


        document.querySelector("." + clscontent).style.animationDuration = "2s"
    });



    $("button.item-navbar-change").click(function(){
        var val = $(this).val();
        var clsicon = "icon-services-" + val;
        var clscontent = "about-services-" + val;
        let nav = document.querySelectorAll(".item-navbar-change");
        let non = document.querySelectorAll(".view-content-services");
        for (let i = 0; i < non.length; i++) {
            non[i].classList.add("animate__animated");
            non[i].classList.remove("animate__slideInUp");
            let j = i+1;
            if($('.icon-services-'+j).hasClass('active')){

                $('#icon-services-'+j).removeClass('active');
                $('#about-services-'+j).addClass('animate__fadeOut');
                document.querySelector('.about-services-'+j).style.animationDuration="1s"
                $('#about-services-'+j).addClassDelay('non-active',1000);
                $('#about-services-'+j).removeClassDelay('animate__fadeOut',1000);
            }
        }
        $('#icon-services-'+val).addClassDelay('active',1000);
        $('#about-services-'+val).removeClassDelay('non-active',1000);
        $('#about-services-'+val).addClassDelay('animate__fadeIn',1000);
        document.querySelector('.about-services-'+val).style.animationDuration = "2s";

    })
});
