<?php 
/*
Template Name: Search Page
*/


 // https://codex.wordpress.org/Creating_a_Search_Page
      global $query_string;
      $resultsPerPage = 20;

      $search_query = wp_parse_str( $query_string, $search_query_string );

      $search_query_string['post_type'] = array('post', 'feature', 'media');
      $search_query_string['posts_per_page'] = $resultsPerPage;  

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

        if ($search_query_string['issue'] != 'all') {
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

        

        
        
      }


      if(is_array($search_query_string)) {

          unset($search_query_string['search']);
          unset($search_query_string['searchValue']);
          unset($search_query_string['pagename']);

        }


      $search = new WP_Query( $search_query_string );
      // $search_query_string available for pre-loop functions      

      


get_header("columns");
wp_enqueue_script('drawerInit');
use \Columns\Utilities as Utilities;
use \Columns\SearchWalker;
?>


<div class="archive-header search-header">
  <h1>Search</h1>
    <div class="columns-form search-form search-widescreen">
              <form role="search" class="columns-search-form" id="search-form-widescreen">
                <input id="Search" name="search" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_query_var('search')  ); ?>" maxlength="255">
                <input id="searchSiteWidescreen" class="inlineSubmit columns-search-input-submit" type="submit">
              </form>
    </div>
</div>

<div class="container-fluid search-container drawer drawer--left">

  <div class="mobile-search-row">
    <div class="search search-mobile">
              <div class="columns-form search-form" id="search-form-mobile">
                <form role="search" class="columns-search-form" id="search-form-mobile">
                  <input id="Search" name="search" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_query_var('search')  ); ?>" maxlength="255">
                  <input id="searchSiteMobile" class="inlineSubmit columns-search-input-submit" type="submit">
                </form>
              </div>        
            </div> 
  </div>


 

  
    <button id="filterToggle" name="drawerToggle" class="drawer-button">
      <svg class="chevron">
        <use href="<?php echo get_bloginfo('stylesheet_directory') . "/assets/Columns_Sprite_4_Symbols4.svg#carrot-dark" ?>"
     x="0" y="0" width="100%" height="100%"/>
      </svg>
    
    </button>
  
  

  <div id="search-drawer" class="search-drawer-scroller" role="search">

   <?php 

              // check if the repeater field has rows of data
              if( have_rows('columns_print_issues', 'option') ):
              
                // loop through the rows of data
                  while ( have_rows('columns_print_issues', 'option') ) : the_row();
              
                      
                      
                    if(get_sub_field('is_current_issue', false, false)):

                    
                      $currentIssue = new DateTime(get_sub_field('columns_print_issue_publication_date', false, false));
                      break;

                    endif;

                  endwhile;
                
                else :
              
                  // no rows found
              
              endif;
?>

    <div class="drawer-nav" role="navigation">

      <div class="menu-scroller">
        <!-- Category Menu -->
        <button id="FilterSearch" name="search" class="inlineSubmit columns-search-input-submit drawer-button" type="submit" value="SearchSideBar">apply filters</button>
          <ul class="drawer-menu issue-menu">
          <li class="cat-item drawer-menu-section-title">Search Issue:</li>
          <li class ="cat-item"><a data-issue="all" href="?issue=all">Entire Site</a></li>
          <li class ="cat-item"><a class="issue-filter" data-issue="<?php echo esc_attr(lcfirst($currentIssue->format('F_Y'))); ?>" href="?issue=<?php echo esc_attr(lcfirst($currentIssue->format('F_Y'))); ?>">Current Issue</a></li>

                  
          <li class="drawer-dropdown">
          <a href=#>Past Issues</a>
          <a class="drawer-dropdown dropdown-toggle" data-toggle="dropdown" role="button" >          
          </a>

            <ul class="drawer-dropdown-menu">
              
            

            <?php 

              // check if the repeater field has rows of data
              if( have_rows('columns_print_issues', 'option') ):
              
                // loop through the rows of data
                  while ( have_rows('columns_print_issues', 'option') ) : the_row();

                  $isCurrentIssue = get_sub_field('is_current_issue', false, false);

                  if($isCurrentIssue == 0) :

                      // display a sub field value                  

                      // get raw date
                      $date = get_sub_field('columns_print_issue_publication_date', false, false);


                      // make date object
                      $date = new DateTime($date);                  

                      ?>

                      <li class="cat-item">
                        <a   class="drawer-dropdown-menu-item filter-item issue-filter" data-issue="<?php echo esc_attr(lcfirst($date->format('F_Y'))); ?>">                      
                      <?php echo $date->format('M Y'); ?>
                      <svg class="close-no-bg-sprite">
                        <use href="<?php echo get_bloginfo('stylesheet_directory') . "/assets/Columns_Sprite_4_Symbols4.svg#close-no-bg" ?>" x="0" y="0" width="100%" height="100%"/>
                      </svg>
                    </a>
                      </li>

                      <?php

                  endif;
              
                    
                      
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
              // 'exclude' => array('11', '1')  
              'exclude' => array('1', '254')  
              )
              );
            ?>
          </ul>
          </div>
            <!-- <button id="FilterSearch" name="search" class="inlineSubmit columns-search-input-submit drawer-button" type="submit" value="SearchSideBar">apply filters</button> -->
    </div>
  </div>

  <div class="search-results">
    <div class="current-filters-row">

      <div class="filter-controls-wrapper">

        <h2 class="search-results-title">Current Search Filters</h2>
        <div class="current-filter-wrapper current-filter-wrapper-search">
          <span class="filter-lead">Search Term: </span>
          <span class="search-filter-item">
            <?php

          if (isset($search_query_string['s'])) {
            echo esc_attr( $search_query_string['s'] );
          }

     ?>
              
          </span>
          
        </div>

        <div class="current-filter-wrapper current-filter-wrapper-issue">
          <span class="filter-lead">Issue: </span>
          <?php       
          
          $field = get_field_object('field_5835c2de61539');

          if ($field) {
            foreach ($field['choices'] as $issue=>$value) {
              ?>
              <span class="filter-item" data-issue="<?php echo $issue ?>">
                <?php echo $value ?>
                <svg class="close-no-bg-sprite">
                  <use href="<?php echo get_bloginfo('stylesheet_directory') . "/assets/Columns_Sprite_4_Symbols4.svg#close-no-bg" ?>" x="0" y="0" width="100%" height="100%"/>
                </svg>
              </span>
              <?php
            }


          }     

            ?>
        </div>

        <div class="current-filter-wrapper current-filter-wrapper-category">
          <span class="filter-lead">Category: </span>
          <?php 
                $categoryList = get_categories(array(            
                  'exclude' => array('11', '1')  //Issue here with test vs prod
                  )
                  );

                  foreach ($categoryList as $category) {                    

                    ?>
              <span class="filter-item" data-cat_id="<?php echo $category->term_id ?>">
                <?php echo $category->name ?>
                <svg class="close-no-bg-sprite">
                  <use href="<?php echo get_bloginfo('stylesheet_directory') . "/assets/Columns_Sprite_4_Symbols4.svg#close-no-bg" ?>" x="0" y="0" width="100%" height="100%"/>
                </svg>
              </span>
              <?php
                  }

            ?>
        </div>

        <!-- <div class="current-filter-wrapper current-filter-wrapper-content_type">
          <span class="filter-lead">Content Type: </span>
        </div> -->

      </div>

      <hr>

      <?php  if ($search->have_posts() ): 

      $offset = "1";

      if(isset($search_query_string['searchpage'])){
        $offset = ($search_query_string['paged'] - 1) * $resultsPerPage + 1;
      }

      $finalResultOnPage = $offset + $resultsPerPage;

      if ($finalResultOnPage > $search->found_posts) {
        $finalResultOnPage = $search->found_posts;
      }      
      
      
      ?>

      <div class="total-results">
        
        
        


        <?php echo $offset; ?>-<?php echo $finalResultOnPage; ?> of <?php echo $search->found_posts; ?> results
      </div>

      <?php endif; ?>
    
    </div>
   

    <div class="results-row">


      <?php if ($search->have_posts() ): ?>
               
        
        <div class="result-display-controls">
          <a class="order-oldest" href="<?php echo esc_url(add_query_arg( 'order', 'asc')); ?>"><span>Oldest</span></a>
          <a class="order-newest" href="<?php echo esc_url(add_query_arg( 'order', 'desc')); ?>"><span>Newest</span></a>        
        </div>

            <div class="pagination-controls">
              <?php 
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
                  'prev_text'    => sprintf( '<span class="dashicons dashicons-controls-play"></span>%1$s', __( 'Previous', 'text-domain' ) ),
                  'next_text'    => sprintf( '%1$s <span class="dashicons dashicons-controls-play"></span>', __( 'Next', 'text-domain' ) ),
                  'add_args'     => false,
                  'add_fragment' => '',
                  ) ); 
              ?>
            </div>
    </div>      
      

        <?php
       

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

        if ($search->current_post == 0):

          echo '<div class="results-row">';

        endif;
        
        if ($search->current_post % 2 == 0):

          echo '</div>';
          echo '<div class="results-row">';

        else:
        
        echo  '';

        endif;


        $articleDateObject = get_field('columns_print_issue', $post->ID);

        $date = convertLabelToDate($articleDateObject['value']);        

        $issuesInSearch[] = $date;

        $postType = get_post_type($post->ID);

        switch ($postType) {
          case 'media':
            get_template_part( 'partials/search_media' );
            break;
          
          default:
            get_template_part( 'partials/search_content' );
            break;
        }

        endwhile;

        wp_reset_postdata();
        wp_reset_query();

        ?>
        </div>  <!-- end results row -->
        <div class="results-row">
        <div class="pagination-controls pull-right">
        <?php 
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
                  'prev_text'    => sprintf( '<span class="dashicons dashicons-controls-play"></span>%1$s', __( 'Previous', 'text-domain' ) ),
                  'next_text'    => sprintf( '%1$s <span class="dashicons dashicons-controls-play"></span>', __( 'Next', 'text-domain' ) ),
                  'add_args'     => false,
                  'add_fragment' => '',
                  ) ); 
              ?>
        </div>
        </div>
        
        
        <?php

        else :
            get_template_part( 'partials/search_empty' );
            echo "</div>"; // end results row.
        endif;

      ?>

    
  
    

      

    <?php 

          if ($search->have_posts() ):
            
            ?>
            <div class="row issue-row">
            <h2 class="search-results-title">Search term found in:</h2>

            <?php

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
                      
                            ?>

                            <div class="carousel-cell">
                              <div class="image-wrapper">
                                <a href="<?php echo esc_url( home_url( '/search' ) ) . '?issue=' . strtolower(date_format($issueDate, 'F_Y')) ?>

">
                                <?php echo wp_get_attachment_image($coverImage, 'full', false, $atts); ?>
                                <div class="article-date">
                                  <?php echo date_format($issueDate, 'F Y');?>
                                </div>
                              </a>
                            </div>
                            </div>

                            <?php
                    }
                  }
            
                  
                    
                endwhile;
              
            else :
            
                // no rows found
            
            endif;
            ?> </div> <?php
          endif;
            
    ?>

  
  
  </div>

  

</div>

<?php
get_footer(); 
