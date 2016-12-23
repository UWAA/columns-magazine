<?php
use \Columns\Utilities as Utilities;

// WP_Query arguments
$args = array (
  'post_type' => array('post', 'feature'),      
  'posts_per_page' => -1,
  'tax_query' => array(        
    array(
      'taxonomy' => 'content_location',
      'field'    => 'slug',
      'terms'    => 'home_hub',          
      )
      ) //End tax query 
  );

// The Query
  $query = new WP_Query( $args ); ?>


  <?php



// The Loop
  if ( $query->have_posts() ) {
   
    while ( $query->have_posts() ) {
      $query->the_post();
      
      $storyImage = get_field("columns_hub_image");
        $hubCropSize = get_field("columns_hub_size_selector");  //size selected from dropdown controlled by editor                        
        
        if ($hubCropSize === 'hub-vertical-rectangle') {
          $hubShape = 'hub-item--height2';
        }

        if ($hubCropSize === 'hub-horizontal-rectangle') {
          $hubShape = 'hub-item--width2';
        }

        if ($hubCropSize === 'hub-large-square') {
          $hubShape = 'hub-item--width2 hub-item--height2';
        }

        if ($hubCropSize === 'hub-standard-square') {
          $hubShape = '';
        }



        if ($storyImage){  
          ?>

          <div class="hub-item <?php echo $hubShape; ?> ">          
            
            <img src="<?php echo $storyImage['sizes'][$hubCropSize];  ?>" alt="<?php echo $storyImage['alt']; ?>" data-toggle="modal" data-target="#HUB_Modal">

          </div>
          <?php 
        }

      } //endwhile ?>

      <!-- modal -->

      <div class="modal-container modal fade" id="HUB_Modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">              
              <div class="gallery" data-flickity='{ "cellAlign": "left", "contain": true, "cellSelector" : ".hub_modal_gallery_item" }'>


                <?php 
                wp_reset_postdata();
                while ( $query->have_posts() ) {
                  $query->the_post();
                  $modalImage = get_field("columns_hub_image");
                  ?>
                  <div class="hub_modal_gallery_item" >
                    <img src="<?php echo $modalImage['url'];  ?>" alt="<?php echo $modalImage['alt']; ?>">

                    <div class="hub_modal_copy">
                      <p class="category"><?php the_terms(get_the_ID(), 'category', '', ' | ', ' | ' );   ?> <span class="published-date"><?php echo wp_kses(get_the_date(  ), Utilities::$allowedHTML); ?></span></p>
                      <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"> <?php 

                        if(get_field("columns_custom_title") != '') {
                          echo wp_kses(get_field('columns_custom_title'), Utilities::$allowedHTML);
                        }
                        else {
                          the_title();   
                        }
                        

                        ?> </a> </h3>
                        <p class="excerpt"><?php echo wp_trim_words(wp_kses(get_the_excerpt(), Utilities::$allowedHTML), 60, '...'); ?></p>      
                      </div>


                    </div>

                    <?php 



                  } 
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        

        <?php    
        
        /* Restore original Post Data */
        wp_reset_postdata();
      } else {
        
      }
      ?>