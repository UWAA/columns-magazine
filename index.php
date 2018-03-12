<?php 
get_header("columns");
wp_enqueue_script('socialShare');
use \Columns\Utilities as Utilities;

?>
<div class="single-header">    
</div>

<div class="container-fluid">

  
</div>

    
    <div class="columns-feature-content">
    <div class="row">
        
            <?php


            while ( have_posts() ) : the_post(); 

            ?>

            <h1><?php the_title() ?></h1>

            <p class="teaser-intro"><?php echo wp_kses(get_field("columns_feature_introduction"), Utilities::$allowedHTML); ?></p>
         

            <p class="byline">
<?php

    if(get_field("columns_custom_byline") != '') {
        
        echo wp_kses(get_field("columns_custom_byline"), Utilities::$allowedHTML);   
    }

    else {
        if (get_field("columns_author") != '') {
            echo "by " . wp_kses(get_field("columns_author"), Utilities::$allowedHTML   );
        }

    if (get_field("columns_photographer") != '') {
        echo " | photos by " . wp_kses(get_field("columns_photographer"), Utilities::$allowedHTML);
    }
} //no custom byline

    echo " | " . wp_kses(get_the_date(), Utilities::$allowedHTML);


?>




</p>
</div>
</div>

<?php get_template_part( 'partials/social_share' ); ?>

<div class="columns-feature-content">
<div class="row">

                <?php the_content(); ?>


            <?php  if (get_field("columns_tagline") != '') {     ?>
               
                   <hr>
                   <p class="final-byline">           


                    <?php echo get_field('columns_tagline'); ?>

                </p>
        
            <?php } ?>



            <?php

            endwhile;

            ?>

        </div>
    </div>

     <!-- Comment Ares -->
    <div class="columns-feature-content">
        <div class="row">
            
                   
            <?php

            if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }


            ?>
        </div>
    </div>

</div>




<?php


get_footer(); 