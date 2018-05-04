<?php 
get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;
use \Columns\SearchWalker;
?>


<div class="archive-header search-header">
  <h1>Search</h1>
    <div class="columns-form search-form search-widescreen">
              <form role="search" method="get" id="search-form-widescreen">
                <input id="Search" name="s" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_search_query() ); ?>" maxlength="255">
                <input id="searchSite" name="search" class="inlineSubmit columns-search-input-submit" type="submit" value="Search" >
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
        <li class="drawer-menu-section-title">Search Issue:</li>
        <li>Entire Site</li>
        <li>Current Issue</li>

                
        <li class="cat-item cat-item-3 drawer-dropdown">
        <a href="#" data-cat_id="3" class=" drawer-menu-item filter-item">Choose Issue</a>
        <a class="drawer-dropdown dropdown-toggle" data-toggle="dropdown" role="button" href=" #"="">
          <span class="drawer-caret dropdown-toggle"></span>
        </a>

          <ul class="drawer-dropdown-menu">
          	
          

          <?php 

            // check if the repeater field has rows of data
            if( have_rows('columns_print_issues', 'option') ):
            
              // loop through the rows of data
                while ( have_rows('columns_print_issues', 'option') ) : the_row();
            
                    // display a sub field value                  

                    // get raw date
                    $date = get_sub_field('columns_print_issue_publication_date', false, false);


                    // make date object
                    $date = new DateTime($date);                  

                    ?>

                    <li class="cat-item">
                      <a href="#"  class="drawer-dropdown-menu-item filter-item">  
                      <!-- data-cat_id="20" -->
                    <?php echo $date->format('M Y'); ?>
                    </li>

                    <?php
                    
                endwhile;
              
              else :
            
                // no rows found
            
            endif;
          
          ?>
        </ul>
        </li>
      <!-- Category Menu -->
        <ul class="drawer-menu">
        <li class="drawer-menu-section-title">Category: </li>
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
          <button id="FilterSearch" name="search" class="inlineSubmit columns-search-input-submit" type="submit" value="SearchSideBar">apply filters</button>
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

    <a href="<?php echo esc_url(add_query_arg( 'order', 'asc')); ?>">Oldest</a>
    <a href="<?php echo esc_url(add_query_arg( 'order', 'desc')); ?>">Newest</a>

    <?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>

      <?php

        if (have_posts() ):

        $issuesInSearch = array();

         function convertLabelToDate($label) {          

          //need to handle web or viewpoint

          if (is_array($label)) {
            $label = ucwords($label['label']);            
          }            
        
        $issueDate = DateTime::createFromFormat('F_Y', ucwords($label));

        return $issueDate;

        }

        while ( have_posts() ) : the_post(); 
        //also extract out the issue date for the post here
        //this is garbage...

        
       


        // $field = get_field('columns_print_issue', $post->ID);
        // echo $field;

        $date = convertLabelToDate(get_field('columns_print_issue', $post->ID));        

        $issuesInSearch[] = $date;

        get_template_part( 'partials/search_content' );        

        endwhile;

        else :

            get_template_part( 'partials/search_empty' );            
        endif;

      ?>

      <?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>

  </div>




</div> 
</div>

<div class="container-fluid search-issue-covers">

  <div class="row">

  

  <?php 

  var_dump($issuesInSearch);

          // check if the repeater field has rows of data
          if( have_rows('columns_print_issues', 'option') ):
          
           	// loop through the rows of data
              while ( have_rows('columns_print_issues', 'option') ) : the_row();
          
                  // display a sub field value

                  $coverImage = get_sub_field('columns_issue_cover_image', false, false);  //returns a image id
                  // var_dump($coverImage);
                    $atts = array(
                          "class" => "full, search-issue-cover"
                          );
                  echo wp_get_attachment_image($coverImage, 'full', false, $atts);
                  
              endwhile;
            
          else :
          
              // no rows found
          
          endif;
          
          ?>

  </div>
</div>

<?php


get_footer(); 