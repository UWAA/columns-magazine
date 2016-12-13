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




        ?>


        <div class="hub-item <?php echo $hubShape; ?> ">
          <?php 
          if ($storyImage){  ?>

            <img src="<?php echo $storyImage['sizes'][$hubCropSize];  ?>" alt="<?php echo $storyImage['alt']; ?>">


          <?php         

        }


          ?>

        </div>
        

<?php

    }
    
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    
}
?>