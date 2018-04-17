<?php 
get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;

?>


<div class="archive-header">
<h1>Search</h1>
    <!-- Add new search bar here.  Remove from header. -->
</div>

<div class="container-fluid search-container drawer drawer--left">

<div id="search-drawer" role="banner">
    <button type="button" class="drawer-toggle drawer-hamburger">
      <span class="sr-only">toggle navigation</span>
      <span class="drawer-hamburger-icon"></span>
    </button>
    <nav class="drawer-nav" role="navigation">
      <ul class="drawer-menu">
        <li><a class="drawer-brand" href="#">Brand</a></li>
        <li><a class="drawer-menu-item" href="#">Nav1</a></li>
        <li><a class="drawer-menu-item" href="#">Nav2</a></li>
      </ul>
    </nav>
  </div>



<div class="archive-posts">
<?php

if (have_posts() ):
while ( have_posts() ) : the_post(); 
get_template_part( 'partials/search_content' );

endwhile;

 else :

    get_template_part( 'partials/search_empty' );            
          endif;

?>

</div>
</div>

<div class="container-fluid">
        
</div> 


<?php


get_footer(); 