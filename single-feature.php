<?php 


get_header("columns");
use \Columns\Utilities as Utilities;

?>
<div class="container-fluid">
<?php


while ( have_posts() ) : the_post(); 
// check if the flexible content field has rows of data

$feature = get_field("columns_feature_image");

?>

<div class="row">
     <div class="headline-image" style="background-image: url('<?php echo esc_attr($feature['url']); ?>')"></div>
</div>

<div class="row">
    <div class="breadcrumbs">
        <?php uw_breadcrumbs() ?>
    </div> 
    <div class="content-tags">
        <!-- Fluid containter, 2 cols -->
    </div>
</div>

<div class="row">
    
    <div class="container columns-feature-container">

    <h1 class="feature-title"><?php the_title();  ?> </h1>

    <p class="teaser-intro"><?php echo wp_kses(get_field("columns_feature_introduction"), Utilities::$allowedHTML); ?></p>

<p class="byline">
<?php 
    if (get_field("columns_author") != '') {
        echo "by " . wp_kses(get_field("columns_author"), Utilities::$allowedHTML);
    }

    if (get_field("columns_photographer") != '') {
        echo " | photos by " . wp_kses(get_field("columns_photographer"), Utilities::$allowedHTML);
    }

    echo " | " . wp_kses(get_the_date(), Utilities::$allowedHTML);


?>
    


</p>


<?php
if( have_rows('feature_content') ):

    echo "<div class=\"columns-feature\">";

     // loop through the rows of data
    while ( have_rows('feature_content') ) : the_row();

        if( get_row_layout() == 'copy_block' ):
            
             the_sub_field('copy', true);

        elseif( get_row_layout() == 'block_quote' ): 
        ?>

            <div class="blockquote">
                <p class="quote-text"><span class="leftquote">&ldquo;</span><?php the_sub_field('quote_text'); ?><span class="rightquote">&rdquo;</span></p>
                <p class="cutline"><?php the_sub_field('quote_quotee'); ?></p>
            </div>

        <?php

        elseif( get_row_layout() == 'columns-split-feature' ): 
        ?>

        <div class="container-fluid">
            <div class="split-left"></div>
            <div class="split-right"></div>
        </div>

           

        <?php

        elseif( get_row_layout() == 'columns_featured_writer_byline' ): ?>


            <p class="final-byline">
            <?php the_sub_field('columns_final_byline'); ?>
            </p>

        <?php
        endif;

    endwhile;

else :

    // no layouts found

    echo "</div>";
endif;

endwhile;

?>

        
    </div>
</div>






</div>

<?php


get_footer(); 