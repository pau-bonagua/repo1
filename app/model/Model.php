<?php

$path = '../model/';

foreach (glob($path . "*.php") as $filename)
{
    // include $filename;
    
    if($filename != $path .'Model.php' && $filename != $path . 'App.php')
    {
        require_once $filename;
        // echo $filename . '<br>';
    }
}