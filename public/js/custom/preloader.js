$(function(){

$preload = $(".preload");




var $count = 3;
var $counter=setInterval(timer, 1000);
/*******************************************************************************
****Als er bijwerken in de URL staat de timer korter maken**********************
****Omdat de enige pop in de text editor is duurt dit minder lang dan fotos*****
********************************************************************************/
if(window.location.href.indexOf("bijwerken") > -1) {
$counter=setInterval(timer, 250);
}

function timer()
{
  $count = $count-1;
  if ($count <= 0)
  {
     clearInterval($counter);

     $(".preload").fadeOut("slow");
     return;
  }

  
}



     // $(".carousel-image1").css({"background": "url(/uploads/frontslider/slider1.jpg)", 
          //        "background-size": "cover", 
          //        "background-position": "center"});

     // $(".carousel-image2").css({"background": "url(/uploads/frontslider/slider2.jpg)",
     //               "background-size": "cover", 
     //               "background-position": "center"});

     // $(".carousel-image3").css({"background": "url(/uploads/frontslider/slider3.jpg)", 
          //        "background-size": "cover", 
          //        "background-position": "center"});

     // $(".carousel-image4").css({"background": "url(/uploads/frontslider/slider4.jpg)", 
     //               "background-size": "cover", 
     //               "background-position": "center"});

     // $(".quote-photo").css({"background": "url(http://lorempixel.com/output/city-h-c-400-600-4.jpg)", 
     //             "background-size": "cover", 
     //             "background-position": "center top",
     //             "background-repeat" : "no-repeat"});


});