<?php namespace Columns\CustomPostTypes;

class Feature

{
    function __construct()
    {
        add_action( 'init', array($this, 'register_feature_post_type'), 1 );
        
    }  

function register_feature_post_type() {

	$labels = array(
		'name'                  => _x( 'Features', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Feature', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Features', 'text_domain' ),
		'name_admin_bar'        => __( 'Features', 'text_domain' ),
		'archives'              => __( 'Feature Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Feature', 'text_domain' ),
		'all_items'             => __( 'All Features', 'text_domain' ),
		'add_new_item'          => __( 'Add New Feature', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Feature', 'text_domain' ),
		'edit_item'             => __( 'Edit Feature', 'text_domain' ),
		'update_item'           => __( 'Update Feature', 'text_domain' ),
		'view_item'             => __( 'View Feature', 'text_domain' ),
		'search_items'          => __( 'Search Feature', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into feature', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this feature', 'text_domain' ),
		'items_list'            => __( 'Features List', 'text_domain' ),
		'items_list_navigation' => __( 'Features list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter features list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Feature', 'text_domain' ),
		'description'           => __( 'Feature-Length Articles', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag', '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'feature', $args );

}
}
