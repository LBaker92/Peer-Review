$(document).ready(function() {
    var main = document.getElementsByTagName("main")[0];
    var added = false;

    // Look for a click even on the form
    $('main').on('click', '.form-container', function(e) {
        
        var screenWidth = $(window).width();
        var background = document.createElement("div");
        $(background).addClass("greyed-out");

        var clickedElement = $(e.target);

        if (clickedElement.is("input") && screenWidth > 768) {
            var clickedID = clickedElement[0].id;
            if (!added && clickedID != 'form-remember') {
                main.appendChild(background)
                $(background).fadeIn(300);
                $('.form-container').css({'border': '1px solid rgba(0, 0, 0, .4)'});
                $('.form-container').css({'box-shadow': 'none'});
                added = true;
            }
        }

    });

    // Look for click even on the form background
    $('main').on('click', '.greyed-out', function() {

        $(this).fadeOut(300, function() {
            $(this).remove();
            $('.form-container').css({
                'box-shadow': '0 1.5rem 5rem -1rem rgba(0, 0, 0, .15)',
                'border-color': 'rgba(0, 0, 0, .2)'
            });
        });
        added = false;

    });



});