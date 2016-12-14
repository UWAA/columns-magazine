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

  // $('.modal-content').flickity({
  //   cellSelector: '.modal-cell',
  //   cellAlign: 'left',        
  //   pageDots: false,
  //   draggable: false
  // });

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



 $('#HUB_Modal').on( 'shown.bs.modal', function( event ) {
  $('.gallery').flickity('resize');
 console.log('eh?');
});




});
