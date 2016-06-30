<?php
session_start();
$request_uri = basename($_SERVER['REQUEST_URI']);

if($request_uri == 'index.php'  ||  substr($_SERVER['REQUEST_URI'],-1) == '/'){
    $request_uri = '';
}else{
    $request_uri .= '/';
}

include __DIR__.'/../../lib/URLBase.php';
define('URL_BASE', base_url());

print_r(URL_BASE);exit;

if(isset($_SESSION['admin']['id']))
    header('Location: '.URL_BASE.'home/');
else
    header('Location: '.URL_BASE.'login.php');
?>