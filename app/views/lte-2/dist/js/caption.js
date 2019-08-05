$(document).ready(function () {

    $('.with-caption').hover(
            function () {
                $(this).find('.caption').show(); //.fadeIn(250)
            },
            function () {
                $(this).find('.caption').hide(); //.fadeOut(205)
            }
    );
});