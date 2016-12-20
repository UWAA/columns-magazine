<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>


<div class="archive-header">
<h1><?php 
//echo single_cat_title( '', false ); ?>
    echo "Features";
</h1>
    
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

<div class="archive-posts">
<?php


while ( have_posts() ) : the_post(); 
echo "hi";
get_template_part( 'partials/archive_content' );

endwhile;

?>

</div>

<div class="container-fluid">
        
</div> 


<?php


get_footer(); 