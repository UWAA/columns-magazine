<div class="current-issue">
<?php

// check if the repeater field has rows of data
if( have_rows('columns_print_issues', 'options') ):

  // loop through the rows of data
    while ( have_rows('columns_print_issues', 'options') ) : the_row();

    if(get_sub_field('is_current_issue') == true) {
        // display a sub field value
        $coverImage = get_sub_field('columns_issue_cover_image');
        $issuuURL = get_sub_field('columns_issuu_url');
        $issuePDF = get_sub_field('columns_issue_pdf');
    ?>
    <p>current issue</p>
    <!-- <a href="<?php // echo $issuuURL; ?>"> -->
    <div class="center-block">
    <img src="<?php echo $coverImage['url'];  ?>" alt="<?php echo $coverImage['alt']; ?>">
    <!-- </a> -->
    </div>
    <a class="pdf-link" href="<?php echo $issuePDF['url']; ?>">View .PDF</a>


  <?php
    }     

    endwhile;

else :

    // no rows found

endif;

?>

</div>
    
<?php
use \Columns\Utilities as Utilities;

// WP_Query arguments
 $args = array (
      'post_type' => array('post', 'feature'),      
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
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
            <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"> 
            <?php 

            if(get_field("columns_custom_title") != '') {
              echo wp_kses(get_field('columns_custom_title'), Utilities::$allowedHTML);
            }
            else {
              the_title();   
            }
            

            ?> </a> </h3>
            <p class="excerpt">
            <?php

            // echo wp_trim_words(wp_kses(get_the_excerpt(), Utilities::$allowedHTML), 15, '...'); 
            // 
            the_excerpt();

            ?>
              
            </p>
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

