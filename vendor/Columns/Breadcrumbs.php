<?php namespace Columns;


//Reworking UW_Breadcrumb code to mesh with our structure for Custom Post Types like Benefits, Chapters, and Tours.  A good project for the future would be to make these work like the menus.
class Breadcrumbs {

    public function UWAABreadcrumbs() {
        echo $this->getUWAABreadcrumbs();
    }



    private function UWAAIsCustomPostType()
    {
        return array_key_exists(  get_post_type(),  get_post_types( array( '_builtin'=>false) ) );
    }






    private function getUWAABreadcrumbs() {
    global $post;
    $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
    $html = '<li><a href="http://uw.edu" title="University of Washington">Home</a></li>';
    $html .= '<li' . (is_front_page() ? ' class="current"' : '') . '><a href="' . home_url('/') . '" title="' . get_bloginfo('title') . '">' . get_bloginfo('title') . '</a><li>';


    if (is_archive() )
    {
      $category = get_category( get_query_var( 'cat' ) );        
        $html .=  '<li class="current"><span>'. get_cat_name($category->term_id ) . '</span>';
    }
   
      if ( is_single() )
      {
        if ( has_category() AND $this->UWAAIsCustomPostType() != TRUE )
        {
          $categories= get_the_category( get_the_ID() );
          $cat = array_shift($categories);

        $html .=  '<li class="current"><a href="'  . get_category_link( $cat->term_id ) .'" title="'. get_cat_name( $cat->term_id ).'">'. get_cat_name($cat->term_id ) . '</a>';               
        }
        if ( $this->UWAAIsCustomPostType() )
        {
          $posttype = get_post_type_object( get_post_type() );
          $archive_link = get_post_type_archive_link( $posttype->query_var );
          $postName = $posttype->name;

          
          switch ($postName) {
            case 'feature':
                $html .=  '<li class="current"><a href="'  . home_url('/') .'feature" title="Features">Features</a></li>';
                
                break;           
            
            default:
                
                break;
          }
          
         
        }
        // $html .=  '<li class="current"><span>'. get_the_title( $post->ID ) . '</span>';
      }
    

    // If the current view is a page then the breadcrumbs will be parent pages.
    else if ( is_page() )
    {

      if ( ! is_home() || ! is_front_page() )
        $ancestors[] = $post->ID;

      if ( ! is_front_page() )
      {
        foreach ( array_filter( $ancestors ) as $index=>$ancestor )
        {
          $class      = $index+1 == count($ancestors) ? ' class="current" ' : '';
          $page       = get_post( $ancestor );
          $url        = get_permalink( $page->ID );
          $title_attr = esc_attr( $page->post_title );
          if (!empty($class)){
            $html .= "<li $class><span>{$page->post_title}</span></li>";
          }
          else {
            $html .= "<li><a href=\"$url\" title=\"{$title_attr}\">{$page->post_title}</a></li>";
          }
        }
      }

    }

    return "<nav class='uw-breadcrumbs' role='navigation' aria-label='breadcrumbs'><ul>$html</ul></nav>";   
}


}