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
        $this->Breadcrumbs = new Breadcrumbs();
    }




    private function init() {

        new Styles;
        new Scripts;
        new Images;
        new OpenGraph;
        new Favicon;


        //Custom Post Types

        new \Columns\CustomPostTypes\Feature;
        new \Columns\CustomPostTypes\Media;

        //Taxonomies

        new \Columns\CustomTaxonomies\Placement;

        //Menus

        new \Columns\Menus\Navigation;



        new Utilities;


    }
}