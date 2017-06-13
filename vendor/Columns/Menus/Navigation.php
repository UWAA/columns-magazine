<?php namespace Columns\Menus;

class Navigation {
    function __construct() {


        if ( ! function_exists( 'columns_navigation_menu' ) ) {
            add_action( 'init', array($this, 'columns_navigation_menu' ));
        }

    }


// Register Navigation Menus
public function columns_navigation_menu() {

    $locations = array(
        'Main Navigation' => __( 'Header Navigation', 'text_domain' ),
        'Footer Menu' => __( '(In Progress) False-footer Columns Menu', 'text_domain' ),
    );
    register_nav_menus( $locations );

}
}
