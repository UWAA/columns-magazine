<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>
<div class="single-header">    
</div>

<div class="container-fluid">

    <div class="row">
        <div class="breadcrumbs">
            <?php uw_breadcrumbs() ?>
        </div> 
        <div class="content-tags">
            <!-- Fluid containter, 2 cols -->
        </div>
    </div>

    <div class="columns-feature-content">
        <div class="row">
            <?php


            while ( have_posts() ) : the_post(); 

            ?>

            <h1><?php the_title() ?></h1>
         

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


                <?php the_content(); ?>


            <?php  if (get_field("columns_tagline") != '') {     ?>
                <div class="row">
                   <hr>
                   <p class="final-byline">           


                    <?php echo get_field('columns_tagline'); ?>

                </p>
            </div>
            <?php } ?>



            <?php

            endwhile;

            ?>

        </div>
    </div>
</div>




<?php


get_footer(); 