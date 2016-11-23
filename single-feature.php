<?php 


get_header("columns");



?>
<div class="container-fluid">

<?php


while ( have_posts() ) : the_post(); 
// check if the flexible content field has rows of data
// 
?>

<h1><?php the_title();  ?> </h1>

<p class="byline"><?php the_field("columns_author"); ?></p>


<?php
if( have_rows('feature_content') ):

     // loop through the rows of data
    while ( have_rows('feature_content') ) : the_row();

        if( get_row_layout() == 'copy_block' ):

        	the_sub_field('copy');

        elseif( get_row_layout() == 'block_quote' ): 

        	the_sub_field('quote_text');
        	the_sub_field('quote_quotee');

        endif;

    endwhile;

else :

    // no layouts found

endif;

endwhile;

?>





</div>

<?php






get_footer(); 