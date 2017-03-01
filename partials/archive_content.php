<div class="row">
<div class="archive-story-container">



    <?php the_date('F j, Y', '<p class="date">', '</p>'); ?>


<?php  
 if ( get_field('content_thumbnail', $post->ID) ) :
    
    $contentPlacementThumbnailImageID = get_field('content_thumbnail', $post->ID);  //returns a image id
    $atts = array(
        // "style" => "margin-bottom:5px;margin-right:14px;float:left",
        "class" => "archive-thumbnail"
        );
    echo wp_get_attachment_image($contentPlacementThumbnailImageID, '' , '', $atts);
 endif;




// if(get_field("content_thumbnail")) :
            // $thumbnail = get_field("content_thumbnail");


// endif;
?>
            





 <!-- @TODO Pull this into CSS -->
 <!-- @TODO Pull in the Content Thumbnail from our better system, not the featured post -->

<h2 class="archive-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>

<?php the_excerpt(); ?>
<hr>

</div>
</div>    