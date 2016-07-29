<?php
$path = realpath(__DIR__."/../").'/';

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
    if(substr($name,-14) == 'php_errors.log'){
        echo "Deleting: $name\n";
        unlink($name);
    }
}


