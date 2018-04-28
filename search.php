<?php 
get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;
use \Columns\SearchWalker;
?>


<div class="archive-header search-header">
  <h1>Search</h1>
    <div class="columns-form search-form search-widescreen">
              <form role="search" method="get" id="search-form-widescreen" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input id="Search" name="s" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_search_query() ); ?>" maxlength="255">
                <input id="searchSite" name="search" class="inlineSubmit" type="submit" value="Search" class="columns-search-input-submit">
              </form>
    </div>
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
    <?php

    if (get_search_query() != "") {
      echo '<span class="active filter-item search-filter-item">' . esc_attr( get_search_query() ) . '</span>';
    }

    ?>
    

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
              echo '<span class="filter-item" data-cat_id="'. $category->term_id .'">' . $category->name . '</span>';
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