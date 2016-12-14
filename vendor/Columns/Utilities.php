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

}