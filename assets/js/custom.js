// ****** JS FOR FRONT END LAYOUT ****** //

$(document).ready(function() {


    $('.nav-button').click(function() {
        $('.nav-button').toggleClass('change');
    });

    $(window).scroll(function() {
        let position = $(this).scrollTop();
        if (position >= 200) {
            $('.nav-menu').addClass('custom-navbar');
        } else {
            $('.nav-menu').removeClass('custom-navbar');
        }
    });




});







// ******  END JS FOR FRONT END LAYOUT ****** //