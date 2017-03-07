<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>


<div class="archive-header">
<h1>Search</h1>
    
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

<div class="archive-posts">
<?php

if (have_posts() ):
while ( have_posts() ) : the_post(); 
get_template_part( 'partials/search_content' );

endwhile;

 else :

    get_template_part( 'partials/search_empty' );            
          endif;

?>

</div>
</div>

<div class="container-fluid">
        
</div> 


<?php


get_footer(); 