<?php namespace Columns;


/**
* 
*/
class Columns 
{
    
    function __construct($wp)
    {
        
        $this->wp = $wp;
        $this->init();        
    }




    private function init() {

        new Styles;
        new Scripts;        


        //Custom Post Types

        new \Columns\CustomPostTypes\Feature;

        //Taxonomies
        
        new \Columns\CustomTaxonomies\Placement;


        new Utilities;

    }
}