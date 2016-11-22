jQuery(document).ready(function($) {
	$('.home-feature-slider').unslider();
	
	$('.home-high').flickity({
	cellSelector: '.carousel-cell',
	cellAlign: 'left'
	});	
});