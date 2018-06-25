<?php namespace Columns\CustomPostTypes;

class Media
{
    function __construct()
   {
   	add_action('init', array($this, 'register_media_post_type'), 1);
   }

   public function register_media_post_type() {

       $labels = array(
		'name'                  => 'Media Posts',
		'singular_name'         => 'Media Post',
		'menu_name'             => 'Media Content',
		'name_admin_bar'        => 'Media Content',
		'archives'              => 'Media Archives',
		'attributes'            => 'Media Attributes',
		'parent_item_colon'     => 'Media:',
		'all_items'             => 'All Media',
		'add_new_item'          => 'Add New Media Post',
		'add_new'               => 'Add Media',
		'new_item'              => 'New Item',
		'edit_item'             => 'Edit Media',
		'update_item'           => 'Update Media',
		'view_item'             => 'View Media',
		'view_items'            => 'View Media',
		'search_items'          => 'Search Media',
		'not_found'             => 'Media Not found',
		'not_found_in_trash'    => 'Media Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Attached to Media',
		'items_list'            => 'Media List',
		'items_list_navigation' => 'Media list navigation',
		'filter_items_list'     => 'Filter Media LIst',
	);
	$args = array(
		'label'                 => 'Media',
		'description'           => 'Media Content, such as Videos, Photo Galleries, and Audio',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( '\'category\'', ' \'post_tag\'', ' \'content_location\'' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-album',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'media', $args );

   }



}
