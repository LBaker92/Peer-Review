$(document).ready(function() {
    var main = document.getElementsByTagName("main")[0];
    var added = false;

    // Look for a click even on the form
    $("main").on("click", ".form-container", function(e) {
        
        var screenWidth = $(window).width();
        var background = document.createElement("div");
        $(background).addClass("greyed-out");

        var clickedElement = $(e.target);

        if (clickedElement.is("input") && screenWidth > 768) {
            if (!added) {
                main.appendChild(background)
                $(background).fadeIn(300);
                $(".form-container").addClass("box-shadow");
                $(".form-container").css({"border": "none"});
                added = true;
            }
        }

    });

    // Look for click even on the form background
    $("main").on("click", ".greyed-out", function() {
        $(this).fadeOut(300, function() {
            $(this).remove();
            $(".form-container").removeClass("box-shadow");
        });
        added = false;

    });

});