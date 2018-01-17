$(function() {
	$('#meerFotos').on('change',function(){

    if($(this).prop("checked")){
    	//alert("lelelel");
    	$('.custom-Images-Form').fadeIn("slow");
    	$('#photoTwo').removeAttr('disabled');
    	$('#photoThree').removeAttr('disabled');
    	$('#photoFour').removeAttr('disabled');

    }else{
    	//alert("else");
    	$('.custom-Images-Form').fadeOut("slow");
    	$('#photoTwo').attr('disabled','disabled');
    	$('#photoThree').attr('disabled','disabled');
    	$('#photoFour').attr('disabled','disabled');
    }
});

//Ducktyping
//https://jsfiddle.net/311aLtkz/
 

// // progressbar.js@1.0.0 version is used
// // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

// var cakeBar = new ProgressBar.SemiCircle(cakeProcent, {
//   strokeWidth: 6,
//   color: '#FFEA82',
//   trailColor: '#eee',
//   trailWidth: 1,
//   easing: 'easeInOut',
//   duration: 3000,
//   svgStyle: null,
//   text: {
//     value: '',
//     alignToBottom: false
//   },
//   from: {color: '#FFEA82'},
//   to: {color: '#ED6A5A'},
//   // Set default step function for all animate calls
//   step: (state, cakeBar) => {
//     cakeBar.path.setAttribute('stroke', state.color);
//     var value = Math.round(cakeBar.value() * 25);
//     if (value === 0) {
//       cakeBar.setText('');
//     } else {
//       cakeBar.setText(value);
//     }

//     cakeBar.text.style.color = state.color;
//   }
// });
// cakeBar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
// cakeBar.text.style.fontSize = '2rem';

// //cakeBar.animate(1.0);  // Number from 0.0 to 1.0
// ////////////////////////////////////////////////////////////
// var decoratieBar = new ProgressBar.SemiCircle(decoratieProcent, {
//   strokeWidth: 6,
//   color: '#FFEA82',
//   trailColor: '#eee',
//   trailWidth: 1,
//   easing: 'easeInOut',
//   duration: 3000,
//   svgStyle: null,
//   text: {
//     value: '',
//     alignToBottom: false
//   },
//   from: {color: '#FFEA82'},
//   to: {color: '#ED6A5A'},
//   // Set default step function for all animate calls
//   step: (state, decoratieBar) => {
//     decoratieBar.path.setAttribute('stroke', state.color);
//     var value = Math.round(decoratieBar.value() * 50);
//     if (value === 0) {
//       decoratieBar.setText('');
//     } else {
//       decoratieBar.setText(value);
//     }

//     decoratieBar.text.style.color = state.color;
//   }
// });
// decoratieBar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
// decoratieBar.text.style.fontSize = '2rem';

// //decoratieBar.animate(1.0);  // Number from 0.0 to 1.0
// //////////////////////////////////////////////////////////////
// var creatieBar = new ProgressBar.SemiCircle(creatieProcent, {
//   strokeWidth: 6,
//   color: '#FFEA82',
//   trailColor: '#eee',
//   trailWidth: 1,
//   easing: 'easeInOut',
//   duration: 3000,
//   svgStyle: null,
//   text: {
//     value: '',
//     alignToBottom: false
//   },
//   from: {color: '#FFEA82'},
//   to: {color: '#ED6A5A'},
//   // Set default step function for all animate calls
//   step: (state, creatieBar) => {
//     creatieBar.path.setAttribute('stroke', state.color);
//     var value = Math.round(creatieBar.value() * 50);
//     if (value === 0) {
//       creatieBar.setText('');
//     } else {
//       creatieBar.setText(value);
//     }

//     creatieBar.text.style.color = state.color;
//   }
// });
// creatieBar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
// creatieBar.text.style.fontSize = '2rem';

// //creatieBar.animate(1.0);  // Number from 0.0 to 1.0

// $(window).scroll(function() {
//    var hT = $('.completed-container').offset().top,
//        hH = $('.completed-container').outerHeight(),
//        wH = $(window).height(),
//        //wHH = $(window).height()+150,
//        wS = $(this).scrollTop();
//     //console.log((hT-wH) , wS);
//    if (wS > (hT+hH-wH)){
//     console.log('reach');
//     cakeBar.animate(1.0);
//     decoratieBar.animate(1.0);
//     creatieBar.animate(1.0);
//     $(window).off('scroll');
//    }
// });


});