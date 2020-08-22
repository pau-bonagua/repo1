<?php

$path = '../inheritance/';

foreach (glob($path . "*.php") as $filename)
{
    // include $filename;
    
    if($filename != $path .'Inheritance.php')
    {
        require_once $filename;
        // echo $filename . '<br>';
    }
}