<?php
//function that performs the autoload of class files when an object is created
function __autoload($class){
    $elements = explode('_', $class);
    $path = implode (DIRECTORY_SEPARATOR, $elements);
    require_once($path . '.php');
}
?>