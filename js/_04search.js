jQuery(document).ready(function($) {

  $('#icon-search').click(function(event) {
    var $width = $( window ).width();
      if ($width < 479) {
        $('.search-mobile').toggle();
      } else {
        $('.search-widescreen')
          .toggle();
      }    
    $(this).toggleClass('is-active');
  });

  $('#navbar-button').click(function(event) {
    var $width = $( window ).width();
      if ($width < 768) {
        $('.menu-columns-navigation-container').toggleClass('show');
      }  
    $(this).toggleClass('is-active');
  });



});







