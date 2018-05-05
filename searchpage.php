<?php 
/*
Template Name: Search Page
*/


 // https://codex.wordpress.org/Creating_a_Search_Page
      global $query_string;

      $search_query = wp_parse_str( $query_string, $search_query_string );

      $search_query_string['post_type'] = 'any';
      $search_query_string['posts_per_page'] = '50';

      
      if(array_key_exists('search', $search_query_string)) {

        $search_query_string['s'] = $search_query_string['search'];
        $search_query_string['searchValue'] = $search_query_string['search'];
      }  

      if(array_key_exists('issue', $search_query_string)) {

        $search_query_string['meta_key'] = 'columns_print_issue';
        $search_query_string['meta_value'] = $search_query_string['issue'];

        $multipleIssueQueryString = preg_split("/,/", $search_query_string['issue']);

        if($multipleIssueQueryString) {
          unset($search_query_string['meta_key']);
          unset($search_query_string['meta_value']);

          foreach ($multipleIssueQueryString as $issueQuery) {
            $search_query_string['meta_query'][] = array(
              'key' => 'columns_print_issue',
              'value' => $issueQuery
             );
            
          }          

          $search_query_string['meta_query']['relation'] = 'OR';

        }
       
        
        unset($search_query_string['issue']);

        
        
      }

      // $search_query_string available for pre-loop functions      

      


get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;
use \Columns\SearchWalker;
?>


<div class="archive-header search-header">
  <h1>Search</h1>
    <div class="columns-form search-form search-widescreen">
              <form role="search" method="get" id="search-form-widescreen" action="<?php echo esc_url( home_url( '/search' ) ); ?>">
                <input id="Search" name="search" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_search_query() ); ?>" maxlength="255">
                <input id="searchSite" class="inlineSubmit" type="submit" class="columns-search-input-submit">
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
                      <a href="#"  class="drawer-dropdown-menu-item filter-item issue-filter" data-issue="<?php echo lcfirst($date->format('F_Y')); ?>">                      
                    <?php echo $date->format('M Y'); ?>
                  </a>
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

    if (isset($search_query_string['searchValue'])) {
      echo '<span class="active filter-item search-filter-item">' . esc_attr( $search_query_string['searchValue'] ) . '</span>';
    }

    ?>
    

  </div>
    <div class="current-filter-wrapper current-filter-wrapper-issue">
      <span>Issue: </span>
      <?php       
      
      $field = get_field_object('field_5835c2de61539');

      if ($field) {
        foreach ($field['choices'] as $issue=>$value) {
          echo '<span class="filter-item" data-issue="'. $issue .'">' . $value . '</span>';
        }


      }


            

              

        ?>

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

      
      
      if(is_array($search_query_string)) {

          unset($search_query_string['search']);
          unset($search_query_string['searchValue']);
          unset($search_query_string['pagename']);

        }


      $search = new WP_Query( $search_query_string );
        

        if ($search->have_posts() ):          

        $issuesInSearch = array();

         function convertLabelToDate($date) {          

          //need to handle web or viewpoint
        $articleIssueDate = DateTime::createFromFormat('F_Y', ucwords($date));

        if (!is_object($articleIssueDate)) {
            switch ($date) {
              case 'none':
                return "No Issue";
                break;

              case 'web':
                return "Columns Online";
                break;

              case 'viewpoint':
                return "Viewpoint Magazine";
                break;
              
              default:
                return;
                break;
            }            
          }

        return date_format($articleIssueDate, 'F_Y');

        }

        while ($search->have_posts() ) : $search->the_post(); 
        //also extract out the issue date for the post here
        //this is garbage...


        $articleDateObject = get_field('columns_print_issue', $post->ID);

        $date = convertLabelToDate($articleDateObject['value']);        

        $issuesInSearch[] = $date;

        get_template_part( 'partials/search_content' );        

        endwhile;

        wp_reset_postdata();

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
  

        if ($search->have_posts() ): 

          // check if the repeater field has rows of data
          if( have_rows('columns_print_issues', 'option') ):

            
          
           	// loop through the rows of data
              while ( have_rows('columns_print_issues', 'option') ) : the_row();

              //filter out rows from the repeater if the columns_print_issue_publication_date is not in $issuesInSearch
              $issueDate = new DateTime(get_sub_field('columns_print_issue_publication_date', false, false));
              
                if(is_object($issueDate)) {                  
                  
                  
                  if (in_array(date_format($issueDate, 'F_Y'), $issuesInSearch)) {

                     // display a sub field value

                    $coverImage = get_sub_field('columns_issue_cover_image', false, false);  //returns a image id
                  
                    $atts = array(
                          "class" => "full, search-issue-cover"
                          );
                    echo wp_get_attachment_image($coverImage, 'full', false, $atts);

                    
                  }
                }
          
                 
                  
              endwhile;
            
          else :
          
              // no rows found
          
          endif;
        endif;
          
          ?>

  </div>
</div>

<?php


get_footer(); 