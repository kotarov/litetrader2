<?php
session_start();
$request_uri = basename($_SERVER['REQUEST_URI']);

if($request_uri == 'index.php'  ||  substr($_SERVER['REQUEST_URI'],-1) == '/'){
    $request_uri = '';
}else{
    $request_uri .= '/';
}

if(isset($_SESSION['admin']['id']))
    header('Location: '.$request_uri.'home/');
else
    header('Location: '.$request_uri.'login.php');
?>