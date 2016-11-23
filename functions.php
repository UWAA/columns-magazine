<?php

//Autoloads all of the UWAA classes, as they follow PSR-0 autoloading standards.  Classes can be called using that \UWAA\Path\To\Class->Method syntax
require_once(__DIR__ . '/vendor/autoload.php');

//Instantiates site-wite classes.  
if (!isset($Columns)){
    
    $Columns = new Columns\Columns($wp);
}


