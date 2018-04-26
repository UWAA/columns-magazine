<div class="row">
<div class="search-story-container">



    <?php the_date('F j, Y', '<p class="date">', '</p>'); ?>


<?php  
 
 if ( get_field('content_thumbnail', $post->ID) ) :
    
    $contentPlacementThumbnailImageID = get_field('content_thumbnail', $post->ID);  //returns a image id    
    $atts = array(        
        "class" => "search-thumbnail"
        );
    echo wp_get_attachment_image($contentPlacementThumbnailImageID, 'thumbnail' , '', $atts);
 endif;
?> 

<h2 class="search-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>

<?php the_excerpt(); ?>
<hr>

</div>
</div>    