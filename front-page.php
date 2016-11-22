<?php 


get_header("columns");
wp_enqueue_script('unslider');


?>
<div class="container-fluid">
	
	<!-- Get partial for Main Slideshow, should have row -->
	<?php get_template_part("partials/feature_carousel") ?>    


<div class="row feature-row">
	<!-- Loop here for featured articles -->
</div>

<div class="row hub-row" id="hub">
	
	<!-- Flickity here, plus output of all the stuff needed to run it -->
</div>

<div class="row feature-row home-low">
	
</div>





</div>

<?php






get_footer(); 