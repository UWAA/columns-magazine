<?php use \Columns\Utilities as Utilities; ?>

<div class="search-story-container">

    <?php

        if(get_field('columns_external_media_file')) {

    ?>
    <div class="embed-container">
        <?php the_field('columns_external_media_file'); ?>
    </div>

    <?php } 

 if (get_field('columns_print_issue', get_option('page_for_posts'))) {


    $field = get_field('columns_print_issue', $post->ID);
    
        echo '<p class="date issue-date">' . $field['label'] . '</p>';
   
    }
  

    ?> 

    <h2 class="search-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
    </h2>

    <?php echo "<p>". wp_strip_all_tags(wp_kses(get_the_excerpt(), Utilities::$allowedHTML)) . "</p>"; ?>
    <hr>

</div>
