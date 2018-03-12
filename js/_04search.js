jQuery(document).ready(function($) {

  var $iconSearch = $('#icon-search');
  var $nav = $('.menu-columns-navigation-container');
  var $searchMobile = $('.search-mobile');
  var $searchWide = $('.search-widescreen');

  $iconSearch.click(function(event) {
    var $width = $( window ).width();
          if ($width < 768) {
            if ($nav.hasClass('show')) {
              $nav.toggleClass('show');
            }
            if ($searchWide.hasClass('show')) {
              $searchWide.toggleClass('show');
            }
            $searchMobile.toggleClass('show');       
          } else {
            if ($searchMobile.hasClass('show')) {
              $searchMobile.toggleClass('show');
            }
            $searchWide.toggleClass('show');          
          }      
    $(this).toggleClass('is-active');
  });

  $('#navbar-button').click(function(event) {
    var $width = $( window ).width();
      if ($width < 768) {
        if ($searchMobile.hasClass('show')) {
          $searchMobile.toggleClass('show');          
        }
        $nav.toggleClass('show');
      }
      else {
        if ($searchMobile.hasClass('show')) {
          $searchMobile.toggleClass('show');          
        }
        $searchWide.toggleClass('show');          
      }  
    $(this).toggleClass('is-active');
  });



});







