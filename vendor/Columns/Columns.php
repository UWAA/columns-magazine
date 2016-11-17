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

    }
}