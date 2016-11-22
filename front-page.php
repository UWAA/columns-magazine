<?php 


get_header("columns");
wp_enqueue_script('flickity');
wp_enqueue_script('unslider');
wp_enqueue_script('homepage');


?>
<div class="container-fluid">
	
	<!-- Get partial for Main Slideshow, should have row -->
	<?php get_template_part("partials/feature_carousel") ?>    


<div class="feature-row home-high">
	<!-- Loop here for featured articles -->
	<?php get_template_part("partials/feature_row") ?>    

</div>

<div class="row hub-row" id="hub">


	
	<!-- Masonry here, plus output of all the stuff needed to run it -->
</div>

<div class="row feature-row home-low">
	
</div>





</div>

<?php






get_footer(); 