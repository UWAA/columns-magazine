<?php
use \Columns\Utilities as Utilities;

// WP_Query arguments
$args = array (
     'post_type' => array('media'),
     'posts_per_page' => -1,
     'orderby' => 'menu_order',
     'tax_query' => array(
       array(
         'taxonomy' => 'content_location',
         'field'    => 'slug',
         'terms'    => 'home-media',
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





<div class="carousel-cell">

    <?php

        if(get_field('columns_external_media_file')) {

    ?>
    <div class="embed-container">
        <?php the_field('columns_external_media_file'); ?>
    </div>

    <?php } ?>


    <div class="copy-block">

        <h3 class="title">
            <!--<a href="<?php // echo get_the_permalink(); ?>">-->
                <?php

        if(get_field("columns_custom_title") != '') {
            echo wp_kses(get_field('columns_custom_title'), Utilities::$allowedHTML);
        }
        else {
            the_title();
        }


                ?>
            <!--</a>-->
        </h3>

        <?php

        echo wp_strip_all_tags(wp_kses(get_the_excerpt(), Utilities::$allowedHTML));
        //the_excerpt();
        ?>
        <?php
        if(get_field("columns_print_issue")) {

            $issue = get_field_object("columns_print_issue");
            $value = $issue['value'];
            $label = $issue['choices'][ $value ];

        }
        ?>
        
    </div>

</div>



<?php

    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {

}
?>





