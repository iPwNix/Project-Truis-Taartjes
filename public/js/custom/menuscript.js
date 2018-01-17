$(function() {
    
	$openMenuBtn = $(".open-mob-menu-btn");
	$closeMenuBtn = $(".close-mob-menu-btn");
	$mobMenu = $(".mob-nav-menu");

	$openMenuBtn.click(function() {
	  //$mobMenu.css("left", "0%");
	  $mobMenu.fadeIn("400");
	  $mobMenu.css({"display": "block", "left": "0%"});
	});

	$closeMenuBtn.click(function() {
	  //$mobMenu.css("left", "-100%");
	  $mobMenu.fadeOut("400");
	  $mobMenu.css({"left": "-100%"});
	});


/* Scroll Magic Class Toggles: http://scrollmagic.io/examples/basic/class_toggles.html*/

$quotePhoto = $(".quote-photo-container");
$quoteText = $(".quote-text");
$pageNavTwo = $(".pagenav-a-two");

// TweenLite.set($quotePhoto, {className: 'fadein-trigger'})

	var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 600}});
	// build scenes
	new ScrollMagic.Scene({triggerElement: ".section-top"})
					.setClassToggle(".pagenav-a-one", "pagenav-active") // add class toggle
					//.addIndicators() // add indicators (requires plugin)
					.addTo(controller);
	new ScrollMagic.Scene({triggerElement: ".section-quote"})
					.setClassToggle(".pagenav-a-two", "pagenav-active") // add class toggle
					//.addIndicators() // add indicators (requires plugin)
					.addTo(controller)
					.on('start', function () {
					     $('.quote-photo-container').addClass("fadein-trigger-left");
    					 $('.quote-text').addClass("fadein-trigger-right");
					 });
	new ScrollMagic.Scene({triggerElement: ".section-voorbeelden"})
					.setClassToggle(".pagenav-a-three", "pagenav-active") // add class toggle
					//.addIndicators() // add indicators (requires plugin)
					.addTo(controller);
	new ScrollMagic.Scene({triggerElement: ".section-completed"})
					.setClassToggle(".pagenav-a-four", "pagenav-active") // add class toggle
					//.addIndicators() // add indicators (requires plugin)
					.addTo(controller);


// $(window).scroll(function() {
//    var hT = $('.quote-photo-container').offset().top,
//        hH = $('.quote-photo-container').outerHeight(),
//        wH = $(window).height(),
//        wHH = $(window).height()-200,
//        wS = $(this).scrollTop();
//     //console.log((hT-wH) , wS);
//    if (wS > (hT+hH-wHH)){
//    	//console.log('reach');
//     $('.quote-photo-container').addClass("fadein-trigger-left");
//     $('.quote-text').addClass("fadein-trigger-right");
//     //$(window).off('scroll');
//    }
// });


/* Smooth Scrolling voor alle A href links
   http://codepen.io/chriscoyier/pen/dpBMVP
*/
$('a[href*="#"]:not([href="#"])').click(function() {
  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000);
      return false;
    }
  }
});



});