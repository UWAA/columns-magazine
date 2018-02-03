
<?php
use \Columns\Utilities as Utilities;
// WP_Query arguments
 $args = array (
      'post_type' => array('post', 'feature'),
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'tax_query' => array(
        array(
          'taxonomy' => 'content_location',
          'field'    => 'slug',
          'terms'    => 'home-low',
          )
      ) //End tax query
      );
// The Query
 $query = new WP_Query( $args ); ?>



<div class="feature-row">

    <div class="current-issue carousel-cell">
        <?php
        // check if the repeater field has rows of data
        if( have_rows('columns_print_issues', 'options') ):
            // loop through the rows of data
            while ( have_rows('columns_print_issues', 'options') ) :
                the_row();
                if(get_sub_field('is_current_issue') == true) {
                    // display a sub field value
                    $coverImage = get_sub_field('columns_issue_cover_image');
                    $issuuURL = get_sub_field('columns_issuu_url');
                    $issuePDF = get_sub_field('columns_issue_pdf');
                    $issueDate = get_sub_field('columns_print_issue_publication_date', false, false);
                    $issueDateObject = new DateTime($issueDate);

        ?>

        <div class="copy-block">

            
            <img class="cover-image" src="<?php echo $coverImage['url'];  ?>" alt="<?php echo $coverImage['alt']; ?>" />
            
            

            <div class="category">
                <a href="<?php echo $issuePDF['url']; ?>">Current Issue</a>
            </div>
            <h3 class="title">
                <a href="<?php echo $issuePDF['url']; ?>"><?php echo $issueDateObject->format("F o"); ?></a>
            </h3>            
            <p>
                View PDF of the current print magazine
                <a class="more" href="<?php echo $issuePDF['url']; ?>"></a>
            </p>
        </div>
        
        
            <!-- </a> -->        
        <?php
                }
            endwhile;
        else :
            // no rows found
endif;
        ?>

    </div>


<?php
// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>





    <div class="carousel-cell">

        <div class="copy-block">
            <div class="category"><?php the_terms(get_the_ID(), 'category' )  ?></div>
            <h3 class="title">
                <a href="<?php echo get_the_permalink(); ?>"><?php
            if(get_field("columns_custom_title") != '') {
              echo wp_kses(get_field('columns_custom_title'), Utilities::$allowedHTML);
            }
            else {
              the_title();
            }
            ?>
                </a>
            </h3>
            <?php            
            the_excerpt();
            ?><?php
        if(get_field("columns_print_issue")) {
            $issue = get_field_object("columns_print_issue");
            $value = $issue['value'];
            $label = $issue['choices'][ $value ];
        }
              ?>
            <p class="published-date"><?php echo $label; ?>
            </p>
        </div>

    </div>



<?php
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
}
?>



</div> <!-- end feature row -->
