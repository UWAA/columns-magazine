
<div class="search-story-container">



    <?php 
    
    // the_date('F j, Y', '<p class="date">', '</p>');  // Old, date of proc_get_status
    
    ?> 



<?php  


 if (get_field('columns_print_issue', get_option('page_for_posts'))) {


    $field = get_field('columns_print_issue', $post->ID);

    
    // Hack and to deal with ACF bug
    // TODO Extract out to utility class 
    $fieldTranslation = array(
        none => 'No Issue',
        web => 'Columns Online',
        viewpoint => 'Viewpoint Magazine',
        december_2017 => 'Dec. 2017 issue',
        september_2017 => 'Sept. 2017 issue',
        june_2017 => 'June 2017 issue',
        march_2017 => 'March 2017 issue',
        december_2016 => 'Dec. 2016 issue',
        september_2016 => 'Sept. 2016 issue',
        june_2016 => 'June 2016 issue',
        march_2016 => 'March 2016 issue',
        december_2015 => 'Dec. 2015 issue',
    );
    

    if (is_array($field)) {
        echo '<p class="date issue-date">' . $field['label'] . '</p>';
    } else {
        echo '<p class="date issue-date">' . $fieldTranslation[$field] . '</p>';
    }


   
 }
  

?> 

<h2 class="search-story-title">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>

<?php the_excerpt(); ?>
<hr>

</div>
