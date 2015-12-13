/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
    	event.preventDefault();
    	
        var $anchor = $(this);
        var navHeight = $(".navbar").innerHeight();
        var offset = $($anchor.attr('href')).offset().top;
        if(! $anchor.hasClass("navbar-brand")) { offset-=navHeight; }
        	
        $('html, body').stop().animate({
            scrollTop: offset
        }, 1500, 'easeInOutExpo');
        
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});