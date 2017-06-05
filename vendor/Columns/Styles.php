<?php namespace Columns;


class Styles {

    public $STYLES;


    function __construct() {


        $this->STYLES = array(
              'google-font-merriweather' => array(
              'id'      => 'google-font-merriweather',
              'url'     => 'https://fonts.googleapis.com/css?family=Merriweather:400,400i,700,700i,900,900i',
              'deps'    => array(),
              'version' => '',
              'admin'   => true
            ), 
              'columns_style' => array(
              'id'      => 'columnsStylesheet',
              'url'     => get_stylesheet_directory_uri() . '/style.css',
              'deps'    => array($parent_style),
              'version' => wp_get_theme()->get('Version'),
              'admin'   => true
            )

        );

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueueColumnsFonts' ) );        

    }

    function enqueueColumnsFonts() {


        foreach ($this->STYLES as $style) {
            $style = (object) $style;

                wp_enqueue_style(
                  $style->id,
                  $style->url,
                  $style->deps,
                  $style->version
            );
        }
    }


}