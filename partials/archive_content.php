<?php use \Columns\Utilities as Utilities; ?>

<div class="row">
<div class="archive-story-container">



    <?php the_date('F j, Y', '<p class="date">', '</p>'); ?>


    <?php
 if ( get_field('content_thumbnail', $post->ID) ) :

    $contentPlacementThumbnailImageID = get_field('content_thumbnail', $post->ID);  //returns a image id
    $atts = array(
        "class" => "archive-thumbnail"
        );
    echo wp_get_attachment_image($contentPlacementThumbnailImageID, 'thumbnail' , '', $atts);
 endif;


 if(get_field("columns_custom_title") != '') {
     $customTitle = wp_kses(get_field('columns_custom_title'), Utilities::$allowedHTML);
 }
 else {
     $customTitle = get_the_title();
 }
    ?> 

<h2 class="archive-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo $customTitle; ?></a>
</h2>

<?php the_excerpt(); ?>
<hr>

</div>
</div>    

