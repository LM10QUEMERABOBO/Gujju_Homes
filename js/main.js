function onScroll() {
    window.addEventListener("scroll", function(event) {
        var top = this.scrollY;

        if (top > 0){
            document.getElementById("myBtn").style.display = "block";
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("bars").style.backgroundColor="unset";
        }
        else
            document.getElementById("myBtn").style.display = "none";
    });
}

let counter = 0;
function opencloseNav() {
    if (counter == 0) {
        document.getElementById("mySidenav").style.width = "40%";
        document.getElementById("bars").style.backgroundColor = "var(--mainhover-color)"; //color inside style.css
        counter++;
    }
    else {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("bars").style.backgroundColor = "unset";
        counter--;
    }
}

// jQuery
((function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();

})(jQuery));