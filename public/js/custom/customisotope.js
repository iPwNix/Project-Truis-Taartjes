$(function() {
    
// init Isotope
var $grid = $('.grid').isotope({
  //$grid.isotope({ filter: '*' });
});
// filter items on button click
$('.filter-button-group').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});

});
