<?php

if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->prepare("SELECT 
    c.id,
    c.title,
    c.id_parent,
    __CAT_SUBTITLE__
    c.position,
    c.tags AS `tags[]`,
    c.children
FROM categories c WHERE id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);
