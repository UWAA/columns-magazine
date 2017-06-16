<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>


<div class="archive-header">
    <h1><?php echo single_cat_title( '', false ); ?></h1>
    
</div>

<div class="container-fluid">

  

    <div class="archive-posts">
        <?php


        while ( have_posts() ) : the_post(); 
        get_template_part( 'partials/archive_content' );

        endwhile;

        ?>

    </div>

    <div class="container-fluid">

    </div>
     
    </div>


    <?php


    get_footer(); 