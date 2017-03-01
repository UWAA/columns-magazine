<?php 

/**
 * Template Name: Columns Default
 */

get_header("columns");
use \Columns\Utilities as Utilities;

?>
<div class="single-header">    
</div>

<div class="container-fluid">

    <div class="row">
        <div class="breadcrumbs">
            <?php $Columns->Breadcrumbs->UWAABreadcrumbs(); ?>
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

                <?php the_content(); ?>           



            <?php

            endwhile;

            ?>

        </div>
    </div>
</div>




<?php


get_footer(); 