<?php

if(!isset($_GET['id'])) exit;

$as = '';
if(isset($_GET['forscript'])) $as = 'content_script';

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$sth = $dbh->prepare("SELECT 
    id,
    content $as
FROM items WHERE id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);