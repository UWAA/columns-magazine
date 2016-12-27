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

                <?php the_content(); 

                $headers = "?reference=COLUMNSMAGAZINE&hideComments=yes&personOrOrg=P";            
                ?>
            
            <div class="text-center">
              <iframe id="givingFrame" width="520" scrolling="no" height="1725" frameborder="0" src="https://online.gifts.washington.edu/bioupdate<?php echo $headers;?>"> … </iframe>
            </div>

            <?php

            endwhile;

            ?>

        </div>
    </div>
</div>




<?php


get_footer(); 