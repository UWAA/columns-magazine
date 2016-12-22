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
          'terms'    => 'home-high',          
          )
      ) //End tax query 
      );

// The Query
$query = new WP_Query( $args ); ?>


 
 <div class="feature-row">


<?php

// The Loop
if ( $query->have_posts() ) {
   
    while ( $query->have_posts() ) {
        $query->the_post();

        ?>





        <div class="carousel-cell">

        <?php if(get_field("content_thumbnail")) {
            $thumbnail = get_field("content_thumbnail");            
         ?>
            <img src="<?php echo $thumbnail['url'];  ?>" alt="<?php echo $thumbnail['alt']; ?>">
        <?php } ?>
        

        <div class="copy-block">
            <div class="category"><?php the_terms(get_the_ID(), 'category' )  ?></div>
            <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
            
            <?php 

            //echo wp_trim_words(wp_kses(get_the_excerpt(), Utilities::$allowedHTML), 15, '...'); 
            the_excerpt();
            ?>              
            
            <p class="published-date"><?php echo wp_kses(get_the_date(), Utilities::$allowedHTML); ?></p>
        </div>

        </div>

        

<?php

    }    
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    
}
?>



</div> <!-- end feature row -->

