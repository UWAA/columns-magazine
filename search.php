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
          <button id="FilterSearch" name="search" class="inlineSubmit" type="submit" value="SearchSideBar" class="columns-search-input-submit">apply filters</button>
      </div>
  </div>

</div>

<div class="container">
<div class="row">

<div class="search-container">
  <h2>Current Search Filters</h2>
  <div class="current-filter-wrapper current-filter-wrapper-search">
    <span>Search Term: </span>
    <p class="active filter-item">Dummy Search Term</p>

  </div>
  <div class="current-filter-wrapper current-filter-wrapper-issue">
    <span>Issue: </span>
    
  </div>
  <div class="current-filter-wrapper current-filter-wrapper-category">
    <span>Category: </span>
    <?php 
          $categoryList = get_categories(array(            
            'exclude' => array('11', '1')  //Issue here with test vs prod
            )
            );

            foreach ($categoryList as $category) {
              echo '<div class="filter-item" data-cat_id="'. $category->term_id .'">' . $category->name . '</div>';
            }

          ?>
  </div>
  <div class="current-filter-wrapper current-filter-wrapper-content_type">
    <span>Content Type: </span>
  </div>

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

</div>

<?php


get_footer(); 