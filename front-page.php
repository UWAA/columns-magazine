<?php 


get_header("columns");
wp_enqueue_script('flickity');
wp_enqueue_script('homepage');
wp_enqueue_script('isotope');
wp_enqueue_script('isotope-packery');


?>
<div class="container-fluid">
	
	<!-- Get partial for Main Slideshow, should have row -->
	<?php get_template_part("partials/feature_carousel") ?>    


<div class="feature-row home-high">
	<!-- Loop here for featured articles -->
	<?php get_template_part("partials/home_high") ?>

</div>

<div class="row hub-row" id="hub">
	
	<!-- Masonry here, plus output of all the stuff needed to run it -->
    <?php get_template_part("partials/home_hub") ?>
</div>

<div class="row feature-row home-low">

    <?php get_template_part("partials/home_low") ?>
	
</div>





</div>

<?php






get_footer(); 