<?php namespace Columns;


class Images {

      public $UW_IMAGE_SIZES = array(
       'Mug Shot',
       'Sidebar',
       'Half width',
       'Content area',
       'Full page',
       'Thimble',
       'Thumbnail large',
       'RSS',
       );

       public $COLUMNS_IMAGE_SIZES = array(

            'hub-standard-square' => array(
                'name'    => 'HUB - Standard',
                     'width'   => 198,
                     'height'  => 178,
                     'crop'    => true,
                     'show'    => false
                ),
            'hub-vertical-rectangle' => array(
                'name'    => 'HUB - Vertical',
                     'width'   => 198,
                     'height'  => 359,
                     'crop'    => true,
                     'show'    => false
                ),
            'hub-horizontal-rectangle' => array(
                'name'    => 'HUB - Horizontal',
                     'width'   => 399,
                     'height'  => 178,
                     'crop'    => true,
                     'show'    => false
                ),
            'hub-large-square' => array(
                'name'    => 'HUB - Large',
                     'width'   => 399,
                     'height'  => 359,
                     'crop'    => true,
                     'show'    => false
                ),

        );



    function __construct() {
        add_action('init', array($this, 'removeUWThemeImageSizes'), 11);
        add_action('after_setup_theme', array($this, 'addColumnsImageSizes'), 10);
    }


    public function removeUWThemeImageSizes() {
        foreach ($this->UW_IMAGE_SIZES as $image) {
            remove_image_size($image);            
        }        
    }

    function addColumnsImageSizes()
    {

        foreach ( $this->COLUMNS_IMAGE_SIZES as $name=>$image )
        {
          add_image_size(
            $name,
            $image['width'],
            $image['height'],
            $image['crop']
          );
        }
        
     }
}