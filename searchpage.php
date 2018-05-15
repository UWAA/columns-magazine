<?php 
/*
Template Name: Search Page
*/


 // https://codex.wordpress.org/Creating_a_Search_Page
      global $query_string;

      $search_query = wp_parse_str( $query_string, $search_query_string );

      $search_query_string['post_type'] = array('post', 'feature', 'media');
      $search_query_string['posts_per_page'] = '20';  

      $paged = (get_query_var('searchpage')) ? get_query_var('searchpage') : 1;
      // $paged=3;

      if(array_key_exists('searchpage', $search_query_string)) {
        
        $search_query_string['paged'] = $search_query_string['searchpage'];
      }  

      
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
              <form role="search" method="get" id="search-form-widescreen">
                <input id="Search" name="search" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_query_var('search')  ); ?>" maxlength="255">
                <input id="searchSite" class="inlineSubmit columns-search-input-submit" type="submit">
              </form>
    </div>
</div>

<div class="container-fluid search-container drawer drawer--left">


 

  
    <button id="filterToggle" name="drawerToggle" class="drawer-toggle drawer-button">
      <span class="chevron"></span>
      Choose Filters
    </button>
  
  

  <div id="search-drawer" role="search">        
    <div class="drawer-nav" role="navigation">
        <!-- Category Menu -->
          <ul class="drawer-menu issue-menu">
          <li class="drawer-menu-section-title">Search Issue:</li>
          <li><a href=#>Entire Site</a></li>
          <li><a href=#>Current Issue</a></li>

                  
          <li class="drawer-dropdown">
          <a href=#>Choose Issue</a>
          <a class="drawer-dropdown dropdown-toggle" data-toggle="dropdown" role="button" href="#">          
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
            </ul>
        <!-- Category Menu -->
          <ul class="drawer-menu category-menu">
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
            <button id="FilterSearch" name="search" class="inlineSubmit columns-search-input-submit drawer-button" type="submit" value="SearchSideBar">apply filters</button>
    </div>
  </div>

  <div class="search-results">
    <div class="current-filters-row">

      <h2 class="search-results-title">Current Search Filters</h2>
      <div class="current-filter-wrapper current-filter-wrapper-search">
        <span>Search Term: </span>
        <span class="search-filter-item">
          <?php

        if (isset($search_query_string['searchValue'])) {
          echo esc_attr( $search_query_string['searchValue'] );
        }

        ?>
            
        </span>
        
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
  
    <div class="results-row">
      

      <div class="result-display-controls">
          <a href="<?php echo esc_url(add_query_arg( 'order', 'asc')); ?>">Oldest</a>
        <a href="<?php echo esc_url(add_query_arg( 'order', 'desc')); ?>">Newest</a>

        <?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>

      </div>
      
    
    </div>

    <div class="results-row">


      <?php

      
      
      if(is_array($search_query_string)) {

          unset($search_query_string['search']);
          unset($search_query_string['searchValue']);
          unset($search_query_string['pagename']);

        }


      $search = new WP_Query( $search_query_string );
        

      if ($search->have_posts() ):

        // previous_posts_link( 'Older Posts' );
        // next_posts_link( 'Newer Posts', $search->max_num_pages );

        echo paginate_links( array(
            // 'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'base'         => '%_%',
            'total'        => $search->max_num_pages,
            'current'      => max( 1, get_query_var( 'searchpage' ) ),
            'format'       => '?searchpage=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 0,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Previous', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );

       

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


        // the_posts_pagination( array( 'mid_size' => 1 ) );

        // the_posts_pagination( array( 
        //   'mid_size' => 1,
	      //   'prev_text' => __( 'Back', 'textdomain' ),
	      //   'next_text' => __( 'Onward', 'textdomain' ),
        //   ) );

        wp_reset_query();



        else :

            get_template_part( 'partials/search_empty' );            
        endif;

      ?>

    </div>    

    <div class="row issue-row">

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
                            "class" => "full, cover-image"
                            );
                      
                            echo '<div class="carousel-cell">';
                            echo wp_get_attachment_image($coverImage, 'full', false, $atts);
                            echo '</div>';

                      
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

  

</div>

<?php
get_footer(); 
