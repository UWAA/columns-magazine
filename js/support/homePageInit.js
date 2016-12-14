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

  var $hubFlickity = $('.gallery').flickity({
    cellSelector: '.hub_modal_gallery_item',
    cellAlign: 'left',        
    pageDots: false,
    draggable: false,
    adaptiveHeight: true
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




// flickity UI, maybe pull this out...
// 
 $('#HUB_Modal').on( 'shown.bs.modal', function( event ) {
  $('.gallery').flickity('resize'); 
});

var $hubItemGroup = $('#hub');
var $hubItems = $hubItemGroup.find('.hub-item');

$hubItemGroup.on( 'click', '.hub-item', function() {
  var index = $(this).index();
  $hubFlickity.flickity( 'select', index );
});





});
