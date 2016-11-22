jQuery(document).ready(function($) {
	$('.home-feature-slider').unslider();
	
	$('.home-high').flickity({
	cellSelector: '.carousel-cell',
	cellAlign: 'left',
    pageDots: false
	});	

    $('.home-low .feature-row').flickity({
    cellSelector: '.carousel-cell',
    cellAlign: 'center',
    pageDots: false,
    contain: true    
    }); 
});