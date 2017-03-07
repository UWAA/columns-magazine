jQuery(document).ready(function($) {

  $('#icon-search').click(function(event) {
    var $width = $( window ).width();
      if ($width < 425) {
        $('.search-mobile').toggle();
      } else {
        $('.search-widescreen')
          .toggle();
      }    
    $(this).toggleClass('is-active');
  });



});







