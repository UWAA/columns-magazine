<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>


<div class="archive-header">
<h1><?php echo "Features"; ?>
    
</h1>
    
</div>

<div class="container-fluid">

<div class="archive-posts">
<?php


while ( have_posts() ) : the_post(); 

get_template_part( 'partials/archive_content' );

endwhile;

?>

</div>

</div>

<div class="container-fluid">
        
</div> 


<?php


get_footer(); 