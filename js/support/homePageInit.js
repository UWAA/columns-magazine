jQuery(document).ready(function($) {

    $('.home-feature-carousel').flickity({
    cellSelector: '.feature-cell',
    cellAlign: 'center'    
    }); 

	
	$('.home-high').flickity({
	cellSelector: '.carousel-cell',
	cellAlign: 'left',
    pageDots: false
	});	

    $('.home-low .feature-row').flickity({
    cellSelector: '.carousel-cell',
    cellAlign: 'left',
    pageDots: false,
    contain: true    
    }); 


    

// init Isotope
var $grid = $('#hub').isotope({
  itemSelector: '.hub-item',
  layoutMode: 'packery',
  // resize: false,
  packery: {
    columnWidth: 198,
    gutter: 3,
    horizontal: true
 }
});




});