<?php namespace Columns;

class Utilities{

	public static $allowedHTML = array(
    	'a' => array(
    	    'href' => array(),
    	    'title' => array()
    	),
    	'br' => array(),
    	'em' => array(),
    	'strong' => array()
    	);

	function __construct() {

		add_action( 'admin_menu', array($this, 'renamePostsToShortContent') );
		add_action( 'init', array($this, 'updatePostLabelsForShortContent') );
        add_action('admin_menu', array($this, 'addIssueControlOptionsPage'));
        add_filter( 'pre_get_posts', array($this, 'namespace_add_custom_types' ));
        add_action( 'admin_init', array($this, 'addOrderToPosts' ));      
        // add_filter( 'wp_insert_post_data', array($this, 'myplugin_update_slug' ) , 99, 2 );
	}	

    
	public function renamePostsToShortContent() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Short Content';
		$submenu['edit.php'][5][0] = 'Short Content';
		$submenu['edit.php'][10][0] = 'Add Short Content';
		$submenu['edit.php'][16][0] = 'Short Content Tags';
		echo '';
	}
	public function updatePostLabelsForShortContent() {
		global $wp_post_types;
			$labels = &$wp_post_types['post']->labels;
			$labels->name = 'Short Content';
			$labels->singular_name = 'Short Content';
			$labels->add_new = 'Add Short Content';
			$labels->add_new_item = 'Add Short Content';
			$labels->edit_item = 'Edit Short Content';
			$labels->new_item = 'Short Content';
			$labels->view_item = 'View Short Content';
			$labels->search_items = 'Search Short Content';
			$labels->not_found = 'No Short Content found';
			$labels->not_found_in_trash = 'No Short Content found in Trash';
	}

    public function addIssueControlOptionsPage() {
        if( function_exists('acf_add_options_page') ) {
    
            acf_add_options_page(array(
                'page_title'    => 'Issue Settings',
                'menu_title'    => 'Issue Settings',
                'menu_slug'     => 'issue-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ));    
        
        }
    }	

    public function namespace_add_custom_types( $query ) {
        if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters']   )   ) {      
          $query  ->set( 'post_type', array(        
           'post', 'nav_menu_item', 'feature'   
              ));
            return $query;
        }
    }

    public function customizeColumnsExcerptLength( $length ) {
        return 25;
    }

    public function wpdocs_excerpt_more( $more ) {
    return '...';
    }

    public function excerpt_more_override($excerpt) {
        return $excerpt . '<div><a class="more" href="' . get_permalink() . '">more</a></div>';
    }

    public function addOrderToPosts() {
        add_post_type_support( 'post', 'page-attributes' );    
    }

    public function myplugin_update_slug( $data, $postarr ) {
        if($postType  = 'feature') {            
        $data['post_name'] = sanitize_title( $data['post_title'] );
        return $data;    
    }
}


}