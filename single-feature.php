<?php 


get_header("columns");



?>
<div class="container-fluid">

<?php


while ( have_posts() ) : the_post(); 
// check if the flexible content field has rows of data
if( have_rows('feature_content') ):

     // loop through the rows of data
    while ( have_rows('feature_content') ) : the_row();

        if( get_row_layout() == 'copy_block' ):

        	the_sub_field('copy');

        elseif( get_row_layout() == 'block_quote' ): 

        	the_sub_field('copy');
        	the_sub_field('name');

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