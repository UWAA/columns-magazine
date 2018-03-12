<?php namespace Columns\CustomTaxonomies;

class Placement {

    function __construct() {

        add_action( 'init', array($this, 'register_content_placement_taxonomy'), 0 );

    }

    // Register Custom Taxonomy
    public function register_content_placement_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Content Placements', 'Taxonomy General Name', 'columns_content_placement' ),
        'singular_name'              => _x( 'Content Placement', 'Taxonomy Singular Name', 'columns_content_placement' ),
        'menu_name'                  => __( 'Placement', 'columns_content_placement' ),
        'all_items'                  => __( 'All Placements', 'columns_content_placement' ),
        'parent_item'                => __( 'Parent Placement', 'columns_content_placement' ),
        'parent_item_colon'          => __( 'Parent Placement:', 'columns_content_placement' ),
        'new_item_name'              => __( 'New Content Placement', 'columns_content_placement' ),
        'add_new_item'               => __( 'Add New Placement', 'columns_content_placement' ),
        'edit_item'                  => __( 'Edit Placement', 'columns_content_placement' ),
        'update_item'                => __( 'Update Placement', 'columns_content_placement' ),
        'view_item'                  => __( 'View Placement', 'columns_content_placement' ),
        'separate_items_with_commas' => __( 'Seperate placements with commas', 'columns_content_placement' ),
        'add_or_remove_items'        => __( 'Add or Remove Placement', 'columns_content_placement' ),
        'choose_from_most_used'      => __( 'Choose From Frequent Placement', 'columns_content_placement' ),
        'popular_items'              => __( 'Popular Placements', 'columns_content_placement' ),
        'search_items'               => __( 'Search Placement', 'columns_content_placement' ),
        'not_found'                  => __( 'No Placement Found', 'columns_content_placement' ),
        'no_terms'                   => __( 'No Placements', 'columns_content_placement' ),
        'items_list'                 => __( 'Content Placement Locations', 'columns_content_placement' ),
        'items_list_navigation'      => __( 'Placements list navigation', 'columns_content_placement' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => false,
    );
    register_taxonomy( 'content_location', array( 'post', ' page', ' feature', 'media' ), $args );

}

}