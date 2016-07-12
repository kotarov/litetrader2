<?php

if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$sth = $dbh->prepare("SELECT 
    c.id,
    c.title,
    c.id_parent,
    
    c.position,
    c.tags AS `tags[]`,
    c.children
FROM categories c WHERE id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);
