<?php 
get_header("columns");
wp_enqueue_script('homepage');
wp_enqueue_script('flickity');
wp_enqueue_script('isotope');
wp_enqueue_script('isotope-packery');

?>
<div class="container-fluid">
	
	<!-- Get partial for Main Slideshow, should have row -->
	<?php get_template_part("partials/feature_carousel") ?>    

</div>
<div class="feature-row home-high row">
	<!-- Loop here for featured articles -->
	<?php get_template_part("partials/home_high") ?>

</div>


<div class="home-section-divider">
	<h2>
		Hub
		<!-- <span>What's happening at the U</span> -->
	</h2>
	
</div>

<div class="container-fluid">
	<!-- Masonry here, plus output of all the stuff needed to run it -->

    	<?php get_template_part("partials/home_hub") ?>
    


</div> <!-- /container-fluid -->

<div class="home-section-divider">
	<h2>In Print
	<!-- <span>@TODO Get Current Issue</span> -->
	</h2>
	
</div>

<div class="row feature-row home-low">

    <?php get_template_part("partials/home_low") ?>
	
</div>

<div class="home-section-divider">
	<h2>People</h2>
</div>

<div class="feature-row home-people row">
	<!-- Loop here for featured people articles -->
	<?php get_template_part("partials/home_people") ?>

</div>


<div class="home-section-divider">
	<h2>Solutions</h2>
</div>

<div class="feature-row home-solutions row">
	<!-- Loop here for featured solutions articles -->
	<?php get_template_part("partials/home_solutions") ?>

</div>



<?php






get_footer(); 