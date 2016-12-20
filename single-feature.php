<?php 


get_header("columns");
use \Columns\Utilities as Utilities;

?>
<!-- <div class="container-fluid"> -->
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


<div class="columns-feature-content">
<div class="row">
    
    

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

    </div>
    </div>




<?php
if( have_rows('feature_content') ):

    echo "<div class=\"columns-feature\">";

     // loop through the rows of data
    while ( have_rows('feature_content') ) : the_row(); 

        if( get_row_layout() == 'copy_block' ): ?>

            <div class="columns-feature-content">
        <div class="row">

                <?php the_sub_field('copy', true); ?>
        
            </div>
        </div>

        
        <?php

        elseif( get_row_layout() == 'block_quote' ): 
        ?>

            <div class="columns-feature-content">
            <div class="row">
            <div class="blockquote">
            <?php if(get_sub_field('isQuote') == 1): ?>
                <p class="quote-text"><span class="leftquote">&ldquo;</span><?php the_sub_field('quote_text'); ?><span class="rightquote">&rdquo;</span></p>
                <p class="cutline"><?php the_sub_field('quote_quotee'); ?></p>
            
        <?php else: ?>
            <p class="quote-text"><?php the_sub_field('quote_text'); ?></p>

        <?php endif; ?>
             </div>
        </div>
        </div>

        <?php

        elseif( get_row_layout() =='columns_split_feature' ): 
        ?>
        
        
        <div class="row split-feature-row">

        <?php 
                if (have_rows('left_column')):

                    while ( have_rows('left_column')): the_row();

        ?>

                <div class="split-left">

        <?php            

                if(get_row_layout() == 'split_copy_content') :
        ?>
                    <div class="split-copy-container" style="background-color:<?php echo esc_attr(get_sub_field('background_color')); ?>">
                        <p style="color:<?php echo esc_attr(get_sub_field('text_color')); ?>">
                            <?php the_sub_field('copy', FALSE); ?>
                        </p>
                    </div>
        <?php        
                elseif(get_row_layout() == 'split_image_content') :                    
                         
                    $leftSplitImage = get_sub_field('split_image');                      
        ?>            

                <div class="split-img-container" style="background-image: url('<?php echo esc_attr($leftSplitImage['url']);  ?>')">
                    <?php // echo $leftSplitImage['alt'];  Need a11y alt tagging scheme ?>  
                </div>

        <?php
                elseif(get_row_layout() == 'quote_content') :
        ?>

                    <div class="split-copy-container" style="background-color:<?php echo esc_attr(get_sub_field('background_color')); ?>">
                        <p class="quote-text" style="color:<?php echo esc_attr(get_sub_field('text_color')); ?>"><span class="leftquote">&ldquo;</span><?php the_sub_field('quote', FALSE); ?><span class="rightquote">&rdquo;</span>
                        </p>
                        <p class="cutline"><?php the_sub_field('quotee', FALSE); ?></p>
                    </div>

                


        <?php

                endif;

                echo "</div>";  //sketchy
                    
            endwhile;  //Left Column

        endif;

        ?>

        <?php 
                if (have_rows('right_column')):

                    while ( have_rows('right_column')): the_row();
        ?>
                <div class="split-right">

        <?php
                        if(get_row_layout() == 'split_copy_content') :

                        ?>                            
                        
                         <div class="split-copy-container" style="background-color:<?php echo esc_attr(get_sub_field('background_color')); ?>">
                            <p style="color:<?php echo esc_attr(get_sub_field('text_color')); ?>">
                                <?php the_sub_field('copy', FALSE); ?>
                            </p>
                        </div>
                        

                        <?php 
                        elseif(get_row_layout() == 'split_image_content'):
                            $rightSplitImage = get_sub_field('split_image');
        ?>
            
                
                <div class="split-img-container" style="background-image: url('<?php echo esc_attr($rightSplitImage['url']);  ?>')">
                    <?php // echo $leftSplitImage['alt'];  Need a11y alt tagging scheme ?>  
                </div>

        <?php
                elseif(get_row_layout() == 'quote_content') :
        ?>

                    <div class="split-copy-container" style="background-color:<?php echo esc_attr(get_sub_field('background_color')); ?>">
                        <p class="quote-text" style="color:<?php echo esc_attr(get_sub_field('text_color')); ?>"><span class="leftquote">&ldquo;</span><?php the_sub_field('quote', FALSE); ?><span class="rightquote">&rdquo;</span>
                        </p>
                        <p class="cutline"><?php the_sub_field('quotee', FALSE); ?></p>
                    </div>

                


        <?php

                endif;

                echo "</div>";  //sketchy
                    
            endwhile;  //Left Column

                endif;

        ?>
            
            
        
        </div>

           

        <?php            

        elseif( get_row_layout() == 'columns_featured_writer_byline' ): ?>


            <div class="columns-feature-content">
             <div class="row">
            <p class="final-byline">
            <?php the_sub_field('columns_final_byline'); ?>
            </p>
            </div>
            </div>

        <?php
        endif;

    endwhile;

else :

    // no layouts found

    echo "</div>";
endif;

endwhile;

?>

        
    <!-- </div> -->


<?php


get_footer(); 