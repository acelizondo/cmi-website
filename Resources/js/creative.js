/*!
 * Start Bootstrap - Creative Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    /*$('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });*/

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    // Initialize WOW.js Scrolling Animations
    new WOW().init();
    var form = document.getElementById('contact1');
    $('form').on('submit', function(e){

        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mail_post.php',
            data: ({
                email: form.elements[1].value,
                name: form.elements[0].value,
                message: form.elements[2].value
            }),
            dataType: 'JSON',
        success: function () {
            console.log($('form').serialize());
            alert('Mail Sent');
        },error: function(){alert('There was an error.')}
        });
    })


})(jQuery); // End of use strict
