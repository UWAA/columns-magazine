<?php

//Autoloads all of the UWAA classes, as they follow PSR-0 autoloading standards.  Classes can be called using that \UWAA\Path\To\Class->Method syntax
require_once(__DIR__ . '/vendor/autoload.php');

//Instantiates site-wite classes.  
if (!isset($Columns)){
    
    $Columns = new Columns\Columns($wp);
}



        
        
        // if ( ! function_exists( 'remove_anonymous_object_filter' ) )
        //     {
                /**
                 * Remove an anonymous object filter.
                 *
                 * @param  string $tag    Hook name.
                 * @param  string $class  Class name
                 * @param  string $method Method name
                 * @return void
                 * http://wordpress.stackexchange.com/questions/57079/how-to-remove-a-filter-that-is-an-anonymous-object
                 */
                function remove_anonymous_object_filter( $tag, $class, $method )
                {
                    
                    $filters = $GLOBALS['wp_filter'][ $tag ];
                    if ( empty ( $filters ) )
                    {
                        return;
                    }

                    foreach ( $filters as $priority => $filter )
                    {
                        foreach ( $filter as $identifier => $function )
                        {
                            
                            if ( is_array( $function)
                                and is_a( $function['function'][0], $class )
                                and $method === $function['function'][1]
                            )
                            {                                
                                remove_filter(
                                    $tag,
                                    array ( $function['function'][0], $method ),
                                    $priority
                                );

                            }
                        }
                    }
                }
            // }
        
        // remove_anonymous_object_filter('wp_head', 'UW_Analytics', 'loadscript');
        // remove_anonymous_object_filter('wp_enqueue_scripts', 'UW_Analytics', 'script');
        
    function fixExcerpts($excerpt) {                        
        return get_the_excerpt() . '<a class="more" href="' . get_permalink() . '"></a>';
    }

add_action('the_excerpt', "fixExcerpts", 11);

function wrap_embed_with_div($html, $url, $attr) {

     return '<div class="video-container">' . $html . '</div>';

}

 add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);