jQuery(document).ready(function($) {

  var $iconSearch = $('#icon-search');
  var $nav = $('.menu-columns-navigation-container');
  var $searchField = $('.search-mobile');

  $iconSearch.click(function(event) {
    var $width = $( window ).width();
      if ($width < 479) {
        if ($nav.hasClass('show')) {
          $nav.toggleClass('show');          
        }
        $searchField.toggleClass('show');
        
      } else {
        $('.search-widescreen').toggleClass('show');
          $nav.toggleClass('show');
      }    
    $(this).toggleClass('is-active');
  });

  $('#navbar-button').click(function(event) {
    var $width = $( window ).width();
      if ($width < 768) {
        if ($searchField.hasClass('show')) {
          $searchField.toggleClass('show');          
        }
        $nav.toggleClass('show');
      }  
    $(this).toggleClass('is-active');
  });



});







