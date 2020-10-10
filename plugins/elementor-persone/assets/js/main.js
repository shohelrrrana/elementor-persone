/*global $, WOW*/
/*
===========================================================================
 EXCLUSIVE ON themeforest.net
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 Project Name		: Persoway - Responsive CV/Resume Template
 Author             : Yahya Essam
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 Copyright (c) 2016 - Yahya Essam - https://themeforest.net/user/yahyaessam
===========================================================================
*/
var $window = $(window), /* window cash */
    $loading = $('.loading'), /* loading cash */
    $body = $("body"), /* body cash */
    $header = $('.large-header'), /* header cash */
    $nav = $('#nav'), /* nav cash */
    $link = $("#nav a"); /* nav a cash */

/* Loading Animations */
$window.on("load", function () {
    'use strict';
    $loading.fadeOut();
    $body.css({overflow: "visible"});
    $header.css({display: "block"});
});
$(function () {
    "use strict";


    /* Nav scroll */
    $window.on("scroll", function () {
        if ($window.scrollTop() > 280) {
            $nav.addClass("scroll");
        } else {
            //remove the background property
            $nav.removeClass("scroll");
        }
    });
    /* Nav Toggle */
    $link.on("click", function () {
        if ($(".navbar-toggle").css("display") !== "none") {
            $(".navbar-toggle").trigger("click");
        }
    });

    /* Active Toggle */
    $window.on("scroll", function (event) {
        var $scrollPos = $(document).scrollTop(),
            $links = $('.nav li a');
        $links.each(function () {
            var $currLink = $(this),
                $refElement = $($currLink.attr("href"));
            if ($refElement.position().top <= $scrollPos + 100 && $refElement.position().top + $refElement.height() > $scrollPos) {
                $links.removeClass("active").blur();
                $currLink.addClass("active");
            } else {
                $currLink.removeClass("active");
            }
        });
    });
    $body.scrollspy({target: "#nav", offset: 100});
    $link.on('click', function (event) {
        if (this.hash !== "") {
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {
                window.location.hash = hash;
            });
        }
    });
    /* Wow */
    new WOW().init();

    $('.option').on("click", function () {
        $('.box').toggleClass('open');
    });
    $('body').on('click', function (e) {
        if (!$(e.target).closest('.box').length) {
            $('.box').removeClass('open');
        }
    });
    $('.green').on("click", function () {
        $('#color').attr("href", "control/css/green.css");
    });
    $('.blue').on("click", function () {
        $('#color').attr("href", "control/css/blue.css");
    });
    $('.orange').on("click", function () {
        $('#color').attr("href", "control/css/orange.css");
    });
    $('.purple').on("click", function () {
        $('#color').attr("href", "control/css/purple.css");
    });
    $('.crimson').on("click", function () {
        $('#color').attr("href", "control/css/crimson.css");
    });


});

// Contact Form
function submit_form() {
    "use strict";
//Variable declaration and assignment
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/,
        fullname = $("#fullname").val(),
        email = $("#email").val(),
        message = $("#message").val(),
        dataString = {'fullname': fullname, 'email': email,   'message': message, 'submitted': '1'};

    if (fullname === "") { //Validation against empty field for fullname
        $("#response_brought").html('<br clear="all"><div class="form_info" align="left">Please enter your fullname in the required field to proceed. Thanks.</div>');
        $("#fullname").focus();
    } else if (email === "") { //Validation against empty field for email address
        $("#response_brought").html('<br clear="all"><div class="form_info" align="left">Please enter your email address in the required email field to proceed. Thanks.</div>');
        $("#email").focus();
    } else if (reg.test(email) === false) { //Validation for working email address
        $("#response_brought").html('<br clear="all"><div class="form_info" align="left">Sorry, your email address is invalid. Please enter a valid email address to proceed. Thanks.</div>');
        $("#email").focus();
    } else if (message === "") { //Validation against empty field for email message
        $("#response_brought").html('<br clear="all"><div class="form_info" align="left">Please enter your message in the required message field to proceed. Thanks.</div>');
        $("#message").focus();
    } else {
        //Show loading image
        $("#response_brought").html('<br clear="all"><div align="left" style=" padding-top:6px; margin-left:100px; margin-top:15px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="control/img/loading.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div>');

        $.post('contact_form.php', dataString,  function (response) {
            //Check to see if the message is sent or not
            var response_brought = response.indexOf('Congrats');
            if (response_brought !== -1) {
                //Clear all form fields on success
                $(".contact-form").slideUp(500);


                //Display success message if the message is sent
                $("#response_brought").html(response);


                //Remove the success message also after a while of displaying the message to the user
                setTimeout(function () {
                    $("#response_brought").html('');
                }, 10000);
            } else {
                //Display error message is the message is not sent
                $(".contact-form").slideUp(500);
                $("#response_brought").html(response);
            }
        });
    }
}