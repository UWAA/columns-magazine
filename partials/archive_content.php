<div class="row">
<div class="archive-story-container">



    <?php the_date('F j, Y', '<p class="date">', '</p>'); ?>


<h2 class="archive-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>
<?php  
 if ( has_post_thumbnail() ) :
    the_post_thumbnail( 'thumbnail' , 'style=margin-bottom:5px;');
 endif;
?>
<?php the_excerpt(); ?>
<hr>

</div>
</div>    