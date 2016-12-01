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
          'terms'    => 'hub',          
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

        ?>
        

<?php

    }
    
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    
}
?>


  <div class="hub-item ">1</div>
  <div class="hub-item hub-item--height2">2</div>
  <div class="hub-item">3</div>
  <div class="hub-item">4</div>
  <div class="hub-item hub-item--width2 hub-item--height2">5</div>
  <div class="hub-item hub-item--width2">6</div>
  <div class="hub-item hub-item--height2">7</div>
  <div class="hub-item">8</div>
  <div class="hub-item">9</div>  
  <div class="hub-item">11</div>
  <div class="hub-item">12</div>




<!-- 
<div class="carousel-cell">

        <div class="copy-block">
            <div class="category"><?php// the_terms(get_the_ID(), 'category' )  ?></div>
            <h3 class="title"> <?php // the_title(); ?> </h3>
            <p class="excerpt"><?php// echo wp_trim_words(wp_kses(get_the_excerpt(), Utilities::$allowedHTML), 15, '...'); ?></p>
            <p class="published-date"><?php //echo wp_kses(get_the_date(), Utilities::$allowedHTML); ?></p>
        </div>

        </div> -->