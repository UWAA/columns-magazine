<?php namespace Columns;

/**
* 
*/
class OpenGraph
{
    
    function __construct()
    {
        add_action('wp_head', array($this, 'columnsOpenGraph'), 5);

    }


    public function columnsOpenGraph() {
    global $post;
 
    if(is_single()) {

        if (get_field("columns_opengraph_image")) {
            $img_src = get_field("columns_opengraph_image");

        } elseif (get_field("columns_feature_image")) {             
            $feature = get_field("columns_feature_image");
            $img_src = $feature['url'];
            $img_dimensions = "
                <meta property=\"og:image:width\"      content=\" ". $feature['width'] ." \">
                <meta property=\"og:image:height\"     content=\" ". $feature['height'] ." \">
            ";
        } elseif (get_field("content_thumbnail")) {
            $thumbnail = get_field("content_thumbnail");
            $img_src = $thumbnail['url'];
            $img_dimensions = "
                <meta property=\"og:image:width\"      content=\" ". $thumbnail['width'] ." \">
                <meta property=\"og:image:height\"     content=\" ". $thumbnail['height'] ." \">
            ";
        } else {
            $img_src = get_stylesheet_directory_uri() . '/assets/opengraph_fallback.jpg';
            $img_dimensions = "";
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
    ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>

    <!-- FB: 500 x 262 -->
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
    <!-- excerpt/standfirst/title -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@columnsmag">
    <meta name="twitter:title" content="<?php echo the_title(); ?>">
    <meta name="twitter:description" content="<?php echo $excerpt; ?>">
    <meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    echo $img_dimensions;
    } else {
        return;
    }
}

}