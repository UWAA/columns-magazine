
<div class="search-story-container">



    <?php 
    
    // the_date('F j, Y', '<p class="date">', '</p>');  // Old, date of proc_get_status
    
    ?> 



<?php  


 if (get_field('columns_print_issue', get_option('page_for_posts'))) {


    $field = get_field('columns_print_issue', $post->ID);
    
        echo '<p class="date issue-date">' . $field['label'] . '</p>';
    


   
 }
  

?> 

<h2 class="search-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>

<?php the_excerpt(); ?>
<hr>

</div>
