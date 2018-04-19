<?php 
get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;
use \Columns\SearchWalker;



?>


<div class="archive-header">
<h1>Search</h1>
    <!-- Add new search bar here.  Remove from header. -->
</div>

<div class="container-fluid search-container drawer drawer--left">



  <div id="search-drawer" role="search">
      <button type="button" class="drawer-toggle drawer-hamburger">
        <span class="sr-only">toggle navigation</span>
        <span class="drawer-hamburger-icon"></span>
      </button>
      <div class="drawer-nav" role="navigation">
      <!-- Category Menu -->
      <ul class="drawer-menu">
        <?php 
         wp_list_categories(array(
           'title_li' => '',
           'class' => 'drawer-menu',
           'walker' => new SearchWalker,
           'exclude' => array('11', '1')  //Issue here with test vs prod
           )
          );
        ?>
        </ul>

        <!-- Apply Filter Button -->
        <button type="button" class="search-apply-filter-button">Apply Filters</button>
      </div>
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