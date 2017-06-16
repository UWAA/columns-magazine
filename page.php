<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>
<div class="single-header">    
</div>

<div class="container-fluid">

  

    <div class="columns-feature-content">
        <div class="row">
            <?php


            while ( have_posts() ) : the_post(); 

            ?>

            <h1><?php the_title() ?></h1>

                <?php the_content(); ?>           



            <?php

            endwhile;

            ?>

        </div>
    </div>
</div>




<?php


get_footer(); 