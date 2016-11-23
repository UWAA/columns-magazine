<div class="row">

<div class="current-issue">

</div>
    
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
          'terms'    => 'home-low',          
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

        <div class="copy-block">
            <div class="category"><?php the_terms(get_the_ID(), 'category' )  ?></div>
            <h3 class="title"> <?php the_title(); ?> </h3>
            <p class="excerpt"><?php echo wp_trim_words(wp_kses(get_the_excerpt(), Utilities::$allowedHTML), 15, '...'); ?></p>
            <p class="published-date"><?php echo wp_kses(get_the_date(), Utilities::$allowedHTML); ?></p>
        </div>

        </div>

        

<?php

    }
    echo '</div>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    
}
?>



</div> <!-- end feature row -->

