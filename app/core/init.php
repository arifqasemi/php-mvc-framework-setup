<?php
spl_autoload_register(function($class_name)
{
	$parts = explode("\\", $class_name);
	$class_name = array_pop($parts);
        $file= "../app/model/" .$class_name . ".php";

    // Check if the file exists
    if(file_exists($file)){

        require_once $file;

    }
});
require_once('functions.php');
require_once('route.php');
require_once('database.php');
require_once('model.php');
require_once('controller.php');