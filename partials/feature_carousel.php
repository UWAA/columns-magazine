


<?php
use \Columns\Utilities as Utilities;

// WP_Query arguments
$args = array (
  'post_type' => array('feature'),      
  'posts_per_page' => 5,
  'tax_query' => array(        
    array(
      'taxonomy' => 'content_location',
      'field'    => 'slug',
      'terms'    => 'home-feature',          
      )
      ) //End tax query 
  );

// The Query
  $query = new WP_Query( $args ); ?>

  <div class="row">

    <div class="home-feature-carousel">

      <?php

// The Loop
      if ( $query->have_posts() ) {
       
        while ( $query->have_posts() ) {
          $query->the_post();



          if (get_field("columns_feature_image")) {

            $feature = (get_field("columns_alternate_feature_image") ? get_field("columns_alternate_feature_image") : get_field("columns_feature_image") );
            $textStyles = array();
            $inlineTextStyles = false;

            if (get_field('columns_superhero_text_color_selection') ) {
              $textStyles[] = "color:". get_field('columns_superhero_text_color_selection') . ";";
            }

            if (get_field('columns_superhero_text_shadow')) {
              $textStyles[] = "text-shadow: 1px 1px 1px rgba(0,0,0,.3);";
            }

            
            if (count($textStyles) > 0){
              $inlineTextStyles = 'style="' . implode(' ', $textStyles) .'"';    
            }



            
            $overlay = (get_field("columns_superhero_title_background_overlay") ? ' style="background-color: rgba(0, 0, 0, 0.35)" ' : '' );
            
            

          }
          ?>
          


          <div class="feature-cell">            
                <a href="<?php echo get_permalink() ?>">                                           
            <div class="background-image" style="background-image: url('<?php echo esc_attr($feature['url']); ?>')">
              <div class="title-area" <?php echo $overlay ?> >
                  <h2 <?php echo ($inlineTextStyles ? $inlineTextStyles : ''); ?> >
                    
                    <?php 

                    if (get_field('columns_superhero_custom_title') != '') {
                      echo  wp_kses(get_field('columns_superhero_custom_title'), Utilities::$allowedHTML);
                    } else {
                      echo wp_kses(get_the_title(), Utilities::$allowedHTML);
                    }
                    



                    ?>
                    

                  </h2>
                  <!-- New ternary here to pull in a editorial headline  -->
                  <p>
                    <?php echo get_the_excerpt(); ?>
                  </p>
              </div>
            </div>
                </a>
          </div>

          
          
          


          <?php

        }
        
        /* Restore original Post Data */
        wp_reset_postdata();
      } else {
        
      }
      ?>		
      
    </div> <!-- End home-feature-carousel -->
    </div> <!-- end row -->